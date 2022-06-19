<?php

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
            update_option( 'yith_woocompare_compare_button_in_product_page', 'no' ); 
        }        

        if( class_exists( 'YITH_WCWL' ) ) {
            update_option( 'yith_wcwl_button_position', 'shortcode' ); 
        }    

        if( defined('YITH_WFBT') && YITH_WFBT ) {
            update_option( 'yith-wfbt-form-position', '4'); 
        }

        add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {

            $tbay_thumbnail_width       = get_option( 'tbay_woocommerce_thumbnail_image_width', 130);
            $tbay_thumbnail_height      = get_option( 'tbay_woocommerce_thumbnail_image_height', 130);
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
        if( greenmart_tbay_get_global_config('config_media',false) ) return;

        $thumbnail_width = 405;
        $main_image_width = 570; 
        $cropping_custom_width = 1;
        $cropping_custom_height = 1;

        // Image sizes
        update_option( 'woocommerce_thumbnail_image_width', $thumbnail_width );
        update_option( 'woocommerce_single_image_width', $main_image_width ); 

        update_option( 'woocommerce_thumbnail_cropping', 'custom' );
        update_option( 'woocommerce_thumbnail_cropping_custom_width', $cropping_custom_width );
        update_option( 'woocommerce_thumbnail_cropping_custom_height', $cropping_custom_height );

    }
}

if ( ! function_exists( 'greenmart_woocommerce_product_buttons' ) ) {
    // Change Product Buttons
    function greenmart_woocommerce_product_buttons(){
        global $product;
        ?>
        <?php if(class_exists('YITH_WCWL') || class_exists('YITH_Woocompare')){ ?>
            <?php if(class_exists('YITH_WCWL')) { ?> 
                <div class="tbay-wishlist">
                   <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                </div>  
            <?php } ?>
            <?php if(class_exists('YITH_Woocompare')){ ?>
                <div class="tbay-compare">
                    <?php echo do_shortcode('[yith_compare_button]') ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php
    }
    add_action('woocommerce_after_add_to_cart_button', 'greenmart_woocommerce_product_buttons', 20);
}


/**
 *
 * Code used to change the price order in WooCommerce
 *
 * */
if(!function_exists('greenmart_woocommerce_price_html')){
    function greenmart_woocommerce_price_html($price, $product) {
        return preg_replace('@(<del.*>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price);
    }

    add_filter('woocommerce_format_sale_price', 'greenmart_woocommerce_price_html', 100, 2);
}

add_action( 'woocommerce_single_product_summary', 'greenmart_tbay_woocommerce_share_box', 15 );

remove_action( 'greenmart_after_title_tbay_subtitle', 'greenmart_woo_get_subtitle', 0);
remove_action( 'yith_wcqv_product_summary', 'greenmart_woo_get_subtitle', 5);
remove_action( 'woocommerce_single_product_summary', 'greenmart_woo_get_subtitle', 5);
remove_action( 'woocommerce_product_options_general_product_data', 'greenmart_woo_subtitle_field' );

remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'woocommerce_after_cart_table', 'woocommerce_button_proceed_to_checkout' );

remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('woocommerce_after_cart_table', 'woocommerce_cart_totals', 0);

add_filter('yith_wcwl_remove_from_wishlist_label', 'greenmart_remove_wishlist_text', 10, 1);