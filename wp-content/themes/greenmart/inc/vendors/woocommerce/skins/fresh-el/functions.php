<?php
require get_template_directory() . '/inc/vendors/woocommerce/skins/fresh-el/wc-recently-viewed.php';

/**
 * WooCommerce
 *
 */
if ( ! function_exists( 'greenmart_woocommerce_setup_support' ) ) {
    add_action( 'after_setup_theme', 'greenmart_woocommerce_setup_support' );
    function greenmart_woocommerce_setup_support() {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        if( class_exists( 'YITH_Woocompare' ) ) {
            update_option( 'yith_woocompare_compare_button_in_products_list', 'no' ); 
        }        

        if( class_exists( 'YITH_WCWL' ) ) {
            update_option( 'yith_wcwl_button_position', 'add-to-cart' ); 
        }

        if( defined('YITH_WFBT') && YITH_WFBT ) {
            update_option( 'yith-wfbt-form-position', '4'); 
        }

        add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {

            $tbay_thumbnail_width       = get_option( 'tbay_woocommerce_thumbnail_image_width', 160);
            $tbay_thumbnail_height      = get_option( 'tbay_woocommerce_thumbnail_image_height', 160);
            $tbay_thumbnail_cropping    = get_option( 'tbay_woocommerce_thumbnail_cropping', 'yes');
            $tbay_thumbnail_cropping    = ($tbay_thumbnail_cropping == 'yes') ? true : false;

            return array(
                'width'  => $tbay_thumbnail_width,
                'height' => $tbay_thumbnail_height,
                'crop'   => $tbay_thumbnail_cropping,
            );
        } );
    }
}


if ( ! function_exists( 'greenmart_woocommerce_setup_size_image' ) ) { 
    add_action( 'after_setup_theme', 'greenmart_woocommerce_setup_size_image' );
    function greenmart_woocommerce_setup_size_image() { 
        if( greenmart_tbay_get_global_config('config_media', false) ) return;

        $thumbnail_width = 291;    
        $main_image_width = 570;  

        // Image sizes
        update_option( 'woocommerce_thumbnail_image_width', $thumbnail_width );
        update_option( 'woocommerce_single_image_width', $main_image_width ); 

        update_option( 'woocommerce_thumbnail_cropping', '1:1' ); 
    }
}

if ( ! function_exists( 'greenmart_tbay_body_classes_disable_ajax_popup_cart_quanity_mode' ) ) {
    function greenmart_tbay_body_classes_disable_ajax_popup_cart_quanity_mode( $classes ) {
        $class = '';
        $active = greenmart_tbay_woocommerce_quantity_mode_active(); 
        if( isset($active) && $active && !greenmart_is_woo_variation_swatches_pro() ) {  
            $class = 'tbay-disable-ajax-popup-cart';   
        }

        $classes[] = trim($class);

        return $classes;
    }
    add_filter( 'body_class', 'greenmart_tbay_body_classes_disable_ajax_popup_cart_quanity_mode' );
} 

if ( ! function_exists( 'greenmart_quantity_button_action' ) ) {
    add_action('wp_ajax_woocommerce_greenmart_quantity_button', 'greenmart_quantity_button_action');
    add_action('wp_ajax_nopriv_woocommerce_greenmart_quantity_button', 'greenmart_quantity_button_action');
    // WC AJAX can be used for frontend ajax requests.
    add_action('wc_ajax_greenmart_quantity_button', 'greenmart_quantity_button_action');
    function greenmart_quantity_button_action() {
        // Set item key as the hash found in input.qty's name
        $product_id             = $_REQUEST['product_id'];     
        
        if( empty(WC()->cart) ) die();       
  
        $cart_item_key      = WC()->cart->generate_cart_id( $product_id );     
            
        // Get the array of values owned by the product we're updating
        $product_values = WC()->cart->get_cart_item($cart_item_key);

        // Get the quantity of the item in the cart
        $product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_REQUEST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);

        // Update cart validation
        $passed_validation  = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $product_values, $product_quantity);    

        // Update the quantity of the item in the cart
        if ($passed_validation) {
            WC()->cart->set_quantity($cart_item_key, $product_quantity, true);
        } 

        // Return fragments
        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();

        // Fragments and mini cart are returned
        $data = array(
            'fragments' => apply_filters(
                'woocommerce_add_to_cart_fragments',
                array(
                    'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
                )
            ), 
            'cart_hash' => apply_filters('woocommerce_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session()),
        );   

        wp_send_json($data);   

        die();
    }
}

if ( ! function_exists( 'greenmart_woocommerce_quantity_mode_group_button' ) ) {
    function greenmart_woocommerce_quantity_mode_group_button() {
        
        if( !greenmart_tbay_woocommerce_quantity_mode_active() || greenmart_is_woo_variation_swatches_pro() ) return;

        global $product;

        $cart = WC()->cart;

        if( !empty($cart) ) {
            $cart_item_key      = $cart->generate_cart_id( $product->get_id() );
            $product_values     = $cart->get_cart_item($cart_item_key);
        }

        $input_value = 1;

        if( greenmart_is_quantity_field_archive() &&  $product->is_type( 'simple' ) ) {
            $class_active = 'active';
        } else {     
            $class_active = '';
        }   
   
        if( !empty($product_values) ) {
            $class_active .= ' ajax-quantity';
            $input_value  = $product_values['quantity'];
        }

        echo '<div class="quantity-group-btn '. esc_attr($class_active) .'">';
            if( greenmart_is_quantity_field_archive() && $product->is_type( 'simple' ) ) {
                greenmart_quantity_field_archive($input_value);
            }
            woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }
    add_action('woocommerce_after_shop_loop_item', 'greenmart_woocommerce_quantity_mode_group_button', 5);
} 

if ( ! function_exists( 'greenmart_quantity_field_archive' ) ) {
    function greenmart_quantity_field_archive( $input_value ) {

        global $product;
        if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
            $show_quantities = $product->get_meta( '_greenmart_min_max_quantities_settings' );

            $min_value = 0;
            if( $show_quantities === 'yes' ) {
                $min_value = !empty( $product->get_meta( '_greenmart_min_max_quantities_min_qty' ) ) ? $product->get_meta( '_greenmart_min_max_quantities_min_qty' ) : $min_value;
            }

            woocommerce_quantity_input( array( 'input_value' => $input_value,'min_value' => $min_value ) );
        }

    }
}

if ( ! function_exists('greenmart_ajax_order_by_query')) {
    function greenmart_ajax_order_by_query( $orderby, $order ) {
        // it is always better to use WP_Query but not here
        $WC_Query_class = new WC_Query(); 
    
        switch ( $orderby ) {
            case 'id':
                $args['orderby'] = 'ID';
                break;
            case 'menu_order':
                $args['orderby'] = 'menu_order title';
                break;
            case 'title':
                $args['orderby'] = 'title';
                $args['order']   = ( 'DESC' === $order ) ? 'DESC' : 'ASC';
                break;
            case 'relevance':
                $args['orderby'] = 'relevance';
                $args['order']   = 'DESC';
                break;
            case 'rand':
                $args['orderby'] = 'rand'; // @codingStandardsIgnoreLine
                break;
            case 'date':
                $args['orderby'] = 'date ID';
                $args['order']   = ( 'ASC' === $order ) ? 'ASC' : 'DESC';
                break;
            case 'price':
            case 'price-desc':
                $callback = 'DESC' === $order ? 'order_by_price_desc_post_clauses' : 'order_by_price_asc_post_clauses';
                add_filter( 'posts_clauses', array( $WC_Query_class, $callback ) );
                break;
            case 'popularity':
                add_filter( 'posts_clauses', array( $WC_Query_class, 'order_by_popularity_post_clauses' ) );
                break;
            case 'rating':
                add_filter( 'posts_clauses', array( $WC_Query_class, 'order_by_rating_post_clauses' ) );
                break;
        }
    
    }
}



if ( ! function_exists('greenmart_ajax_load_more_list_product') ) {
	function greenmart_ajax_load_more_list_product() {
		// prepare our arguments for the query
	   $args = json_decode( stripslashes( $_POST['query'] ), true );
	
	   greenmart_ajax_order_by_query( $args['orderby'], $args['order'] ); 
	
	   if (isset($_GET['paged'])) {
		   $args['paged'] = intval($_GET['paged']);
	   }
	   
	   query_posts( $args );
	
	   $list = 'list'; 
	
	   if( have_posts() ) :
	
		   while( have_posts() ): the_post();
	
			   wc_get_template( 'content-product.php', array('list' => $list));
	
	
		   endwhile;
	
	   endif;
	   die; // here we exit the script and even no wp_reset_postdata() required!
	}

	add_action('wp_ajax_nopriv_greenmart_list_post_ajax', 'greenmart_ajax_load_more_list_product', 10);
	add_action('wp_ajax_greenmart_list_post_ajax', 'greenmart_ajax_load_more_list_product', 10);
}
 


add_action( 'greenmart_get_rating_item', 'woocommerce_template_loop_rating' );
add_action( 'greenmart_shop_list_price_sold', 'woocommerce_template_loop_price',10 );


if( !function_exists('greenmart_ajax_load_more_grid_product')) {
    function greenmart_ajax_load_more_grid_product() {
        // prepare our arguments for the query
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        
        greenmart_ajax_order_by_query( $args['orderby'], $args['order'] ); 
     
        // it is always better to use WP_Query but not here 
        query_posts( $args );
    
        $list = 'grid';
      
        if( have_posts() ) :
     
            while( have_posts() ): the_post();
     
                wc_get_template( 'content-product.php', array('list' => $list));
    
     
            endwhile;
     
        endif;
        die; // here we exit the script and even no wp_reset_postdata() required!
    }
    /*Load more shop grid*/ 
    add_action('wp_ajax_nopriv_greenmart_grid_post_ajax', 'greenmart_ajax_load_more_grid_product', 10);
    add_action('wp_ajax_greenmart_grid_post_ajax', 'greenmart_ajax_load_more_grid_product', 10);
} 


if (! function_exists('greenmart_remove_single_product')) {
    function greenmart_remove_single_product()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action( 'woocommerce_single_product_summary', 'greenmart_woo_get_subtitle', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action( 'woocommerce_single_product_summary', 'greenmart_tbay_woocommerce_share_box', 99 );
    }
    add_action('woocommerce_before_single_product', 'greenmart_remove_single_product', 20);
}

if (! function_exists('greenmart_woocommerce_before_single_product_open')) {
    function greenmart_woocommerce_before_single_product_open()
    {
        echo '<div class="single-product-before-wrapper">';
    }
}
if (! function_exists('greenmart_woocommerce_before_single_product_close')) {
    function greenmart_woocommerce_before_single_product_close()
    {
        echo '</div>';
    }
}

if (! function_exists('greenmart_add_single_product')) {
    function greenmart_add_single_product()
    {
        add_action('tbay_woocommerce_before_single_product', 'greenmart_woocommerce_before_single_product_open', 5);
        add_action('tbay_woocommerce_before_single_product', 'woocommerce_template_single_title', 20);
        add_action('tbay_woocommerce_before_single_product', 'greenmart_woo_get_subtitle', 20);
        add_action('tbay_woocommerce_before_single_product', 'greenmart_single_rating_share', 30);
        add_action('tbay_woocommerce_before_single_product', 'greenmart_woocommerce_before_single_product_close', 99);
    }
    add_action('woocommerce_before_main_content', 'greenmart_add_single_product', 20);
    add_action('tbay_quickview_woo_before_main_content', 'greenmart_add_single_product', 20);
}

if (! function_exists('greenmart_single_rating_share')) {
    function greenmart_single_rating_share()
    {
        ?>
        <div class="single-rating-share">
            <?php 
                woocommerce_template_single_rating(); 
                greenmart_tbay_woocommerce_share_box(); 
            ?>
        </div>
        <?php
    }
}

if ( !function_exists('greenmart_tbay_woocommerce_get_cookie_display_mode') ) {
    function greenmart_tbay_woocommerce_get_cookie_display_mode() {

        $woo_mode = greenmart_tbay_get_config('product_display_mode', 'grid');

        if( isset($_COOKIE['greenmart_display_mode']) && $_COOKIE['greenmart_display_mode'] == 'grid' ) {
            $woo_mode = 'grid';
        } else if ( isset($_COOKIE['greenmart_display_mode']) && $_COOKIE['greenmart_display_mode'] == 'grid2' ) {
            $woo_mode = 'grid2';
        } else if( isset($_COOKIE['greenmart_display_mode']) && $_COOKIE['greenmart_display_mode'] == 'list' ) {
            $woo_mode = 'list';
        }

        return $woo_mode;
    }
}

if ( ! function_exists( 'greenmart_compatible_checkout_order' ) ) {
    function greenmart_compatible_checkout_order() { 
        $active = false;

        if( class_exists('WooCommerce_Germanized') ) {
            $active = true;
        }  

        if( function_exists( 'flux_fs' ) ) {
            $active = true;
        }

        return $active;
    }
    
    /*Page check out*/
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
    add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );
}
 
if ( ! function_exists( 'greenmart_add_heading_order_review' ) ) {
    add_action( 'woocommerce_checkout_after_order_review', 'greenmart_add_heading_order_review', 10 );
    function greenmart_add_heading_order_review() {
        echo '<h3 id="order_payment_heading">'. esc_html__( 'Payment method', 'greenmart' ) .'</h3>';
    }
}

if (!function_exists('greenmart_add_new_localize_translate')) {
    add_filter( 'greenmart_localize_translate', 'greenmart_add_new_localize_translate', 10, 1);
    function greenmart_add_new_localize_translate( $config )
    {
        $config['popup_cart_icon']          = apply_filters('greenmart_popup_cart_icon', 'tb-icon tb-icon-zt-verified');
        $config['popup_cart_noti']          = esc_html__('was added to shopping cart.', 'greenmart');
        $config['popup_cart_success']       = esc_html__('Added to cart successfully!', 'greenmart');
        $config['checkout_url']             =  wc_get_checkout_url();
        $config['i18n_checkout']            =  esc_html__('Checkout', 'greenmart');
        $config['ajax_popup_quick']         =  apply_filters( 'greenmart_ajax_popup_quick', greenmart_is_ajax_popup_quick() );
        $config['quantity_minus']         =  apply_filters('greenmart_quantity_minus', '<i class="tb-icon tb-icon-zz-minus"></i>'); 
        $config['quantity_plus']         =  apply_filters('greenmart_quantity_plus', '<i class="tb-icon tb-icon-zz-plus"></i>'); 
        

        return $config; 
    }
}

if (!function_exists('greenmart_change_icon_quick_view_prev')) {
	function greenmart_change_icon_quick_view_prev( $icon ) {
		return 'tb-icon tb-icon-zt-chevron-left';
    }
	add_filter( 'greenmart_quick_view_prev', 'greenmart_change_icon_quick_view_prev', 10, 1 );
}  

if (!function_exists('greenmart_change_icon_quick_view_next')) {
	function greenmart_change_icon_quick_view_next( $icon ) {
		return 'tb-icon tb-icon-zt-chevron-right';
    }
	add_filter( 'greenmart_quick_view_next', 'greenmart_change_icon_quick_view_next', 10, 1 );
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Count Down Flash Sale
 * ------------------------------------------------------------------------------------------------
 */
if (!function_exists('greenmart_tbay_stock_flash_sale')) {
    function greenmart_tbay_stock_flash_sale($flash_sales = '')
    {
        global $product;

        if ($flash_sales && $product->get_manage_stock()) : ?>
            <div class="stock-flash-sale stock">
                <?php
                $total_sales        = $product->get_total_sales();
                $stock_quantity     = $product->get_stock_quantity();
                        
                $total_quantity   = (int)$total_sales + (int)$stock_quantity;

                $divi_total_quantity = ($total_quantity !== 0) ? $total_quantity : 1;

                $sold             = (int)$total_sales / (int)$divi_total_quantity;
                $percentsold      = $sold*100; ?>
                <div class="progress">
                    <div class="progress-bar active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr($percentsold); ?>%">
                    </div>
                </div>
                <span class="tb-sold"><?php echo esc_html__('Sold', 'greenmart'); ?>: <span class="sold"><?php echo esc_html($total_sales) ?></span><span class="total">/<?php echo esc_html($total_quantity) ?></span></span>
            </div>
        <?php endif;
    } 
}  

//Count product of tag

if ( ! function_exists( 'greenmart_get_product_count_of_tags' ) ) {
    function greenmart_get_product_count_of_tags( $tag_id ) {
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => -1,
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'product_tag',
                    'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'         => $tag_id,
                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ),
                array(
                    'taxonomy'      => 'product_visibility',
                    'field'         => 'slug',
                    'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                    'operator'      => 'NOT IN'
                )
            )
        );
        $loop = new WP_Query($args);

        return $loop->found_posts;
    }
}

if ( ! function_exists( 'greenmart_custom_woocommerce_get_availability_text' ) ) {
    function greenmart_custom_woocommerce_get_availability_text( $availability) { 
        if( !empty( $availability ) && is_product() ) {
            return '<span class="label">'. esc_html__('Availability:', 'greenmart') .'</span>'. $availability;
        } else {
            return $availability; 
        }
    }
    add_filter( 'woocommerce_get_availability_text', 'greenmart_custom_woocommerce_get_availability_text', 10, 1 );
} 

add_action( 'woocommerce_single_product_summary', 'greenmart_tbay_woocommerce_share_box', 99 );