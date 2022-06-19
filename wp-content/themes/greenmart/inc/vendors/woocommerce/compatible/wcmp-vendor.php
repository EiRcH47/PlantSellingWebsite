<?php

if(!class_exists('WCMp')) return;


if ( !function_exists('greenmart_wc_marketplace_widgets_init') ) {
    function greenmart_wc_marketplace_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'WC Marketplace Store Sidebar ', 'greenmart' ),
            'id'            => 'wc-marketplace-store',
            'description'   => esc_html__( 'Add widgets here to appear in your site.', 'greenmart' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );                
    }
    add_action( 'widgets_init', 'greenmart_wc_marketplace_widgets_init' );
}


if( ! function_exists( 'greenmart_wcmp_woo_remove_product_tabs' ) ) {
    add_filter( 'woocommerce_product_tabs', 'greenmart_wcmp_woo_remove_product_tabs', 98 );
    function greenmart_wcmp_woo_remove_product_tabs( $tabs ) {

        unset( $tabs['questions'] );    

        return $tabs;
    }
}


if(!function_exists('greenmart_wcmp_vendor_name')){
    function greenmart_wcmp_vendor_name() {
        $active = greenmart_tbay_get_config('show_vendor_name', true);

        if( !$active ) return;

        if ( 'Enable' !== get_wcmp_vendor_settings( 'sold_by_catalog', 'general' ) ) {
            return;
        }

        global $product;
        $product_id = $product->get_id();

        $vendor = get_wcmp_product_vendors( $product_id );

        if ( empty( $vendor ) ) {
            return;
        }

        $sold_by_text = apply_filters( 'vendor_sold_by_text', esc_html__( 'Sold by:', 'greenmart' ) );
        ?> 

        <div class="sold-by-meta sold-wcmp">
            <span class="sold-by-label"><?php echo trim($sold_by_text); ?> </span>
            <a href="<?php echo esc_url( $vendor->permalink ); ?>"><?php echo esc_html( $vendor->user_data->display_name ); ?></a>
        </div>

        <?php
    }
    add_filter( 'wcmp_sold_by_text_after_products_shop_page', '__return_false' );
    add_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_wcmp_vendor_name', 1 );
    add_action( 'woocommerce_single_product_summary', 'greenmart_wcmp_vendor_name', 5 );
    add_action( 'yith_wcqv_product_summary', 'greenmart_wcmp_vendor_name', 7 );
}

if ( function_exists( 'greenmart_wcmp_vendor_name' ) && !function_exists( 'greenmart_fresh_wcmp_vendor_name' ) ) {
	function greenmart_fresh_wcmp_vendor_name(){
        if( greenmart_tbay_get_theme() !== 'fresh-el' ) return;

        remove_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_wcmp_vendor_name', 1 );
        remove_action( 'woocommerce_single_product_summary', 'greenmart_wcmp_vendor_name', 5 );
        add_action( 'greenmart_before_shop_grid_group_button', 'greenmart_wcmp_vendor_name', 1 );
        add_action( 'greenmart_after_shop_list_price_sold', 'greenmart_wcmp_vendor_name', 1 );
        add_action( 'greenmart_woo_after_single_rating', 'greenmart_wcmp_vendor_name', 20 );
	}
	add_action('woocommerce_init', 'greenmart_fresh_wcmp_vendor_name');
}

if(!function_exists('greenmart_wcmp_woocommerce_before_main_content_open')){
    function greenmart_wcmp_woocommerce_before_main_content_open() {
        if( !is_tax( 'dc_vendor_shop' ) ) return;


        if( greenmart_tbay_get_theme() === 'fresh-el' ) {
            $archive_class = ( is_active_sidebar('wc-marketplace-store') ) ? 'col-xl-8' : 'col-lg-12';
        } else {
            $archive_class = ( is_active_sidebar('wc-marketplace-store') ) ? 'col-lg-9' : 'col-lg-12';   
        }

        do_action( 'greenmart_woo_template_main_before' );
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        echo '<div id="main-container" class="container inner main-container-wcmp"><div class="row"><div id="main-wcmp" class="pull-right archive-shop col-xs-12 col-md-12 '. $archive_class .' content">';
    }
    add_action('woocommerce_before_main_content', 'greenmart_wcmp_woocommerce_before_main_content_open', 1);
}

if(!function_exists('greenmart_wcmp_woocommerce_after_main_content_close')){
    function greenmart_wcmp_woocommerce_after_main_content_close() {
        if( !is_tax( 'dc_vendor_shop' ) ) return;

        echo '</div></div>';

        if( greenmart_tbay_get_theme() === 'fresh-el' ) {
            $shop_class = 'col-xl-4';
        } else {
            $shop_class = 'col-lg-3';   
        }

        if ( is_active_sidebar('wc-marketplace-store') ) {
            echo '<div id="sidebar-shop-left" class="sidebar sidebar-mobile-wrapper col-xs-12 col-md-12 '. $shop_class .' hidden-sm hidden-md">';

            dynamic_sidebar( 'wc-marketplace-store');

            echo '</div>'; 
        }

        echo '</div>';
        
        do_action( 'greenmart_woo_template_main_primary_after' );
    }
    add_action('woocommerce_after_main_content', 'greenmart_wcmp_woocommerce_after_main_content_close', 1);
}

/*Get title My Account in top bar mobile*/
if ( ! function_exists( 'greenmart_tbay_wcmp_get_title_mobile' ) ) {
    function greenmart_tbay_wcmp_get_title_mobile( $title = '') {

        if( greenmart_woo_is_vendor_page() ) {
            $vendor_id  = get_queried_object()->term_id;
            $vendor     = get_wcmp_vendor_by_term($vendor_id);

            $title          = $vendor->page_title;
        }

        return $title;
    }
    add_filter( 'greenmart_get_filter_title_mobile', 'greenmart_tbay_wcmp_get_title_mobile' );
}

if ( ! function_exists( 'greenmart_product_archive_fix_description' ) ) {
    function greenmart_product_archive_fix_description( $content ) {
        global $WCMp;
        if (is_tax($WCMp->taxonomy->taxonomy_name)) {
            // Get vendor ID
            $vendor_id = get_queried_object()->term_id;
            // Get vendor info
            $vendor = get_wcmp_vendor_by_term($vendor_id);
            if( $vendor ){
                $description = $vendor->description;

                return $description;
            }
        } else {
            return $content;
        }
    }
    add_filter( 'the_content', 'greenmart_product_archive_fix_description', 10, 1 );
}

/*Fix WCMP 3.7*/
if ( !function_exists('greenmart_wcmp_load_default_vendor_store') ) {
    function greenmart_wcmp_load_default_vendor_store() {
        return true;
    }
    add_filter( 'wcmp_load_default_vendor_store', 'greenmart_wcmp_load_default_vendor_store', 10, 1 );
}

if ( !function_exists('greenmart_wcmp_store_sidebar_args') ) {
    function greenmart_wcmp_store_sidebar_args() {
        $sidebars = array(
            'name'          => esc_html__( 'WC Marketplace Store Sidebar ', 'greenmart' ),
            'id'            => 'wc-marketplace-store',
            'description'   => esc_html__( 'Add widgets here to appear in your site.', 'greenmart' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ); 

        return $sidebars;
    }
    add_filter( 'wcmp_store_sidebar_args', 'greenmart_wcmp_store_sidebar_args', 10, 1 );
}
/*End fix WCMP 3.7*/