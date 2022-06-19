<?php

if( !class_exists('YITH_WCQV') ) return;

add_action( 'greenmart_woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 30 );

add_action( 'tbay_quick_view_product_image', 'woocommerce_show_product_sale_flash', 10 ); 
add_action( 'tbay_quick_view_product_image', 'greenmart_woo_only_feature_product', 10 ); 

if ( ! function_exists( 'greenmart_woo_show_product_images' ) ) {
    add_action( 'tbay_quick_view_product_image', 'greenmart_woo_show_product_images', 20 ); 
	function greenmart_woo_show_product_images() {
		wc_get_template( 'single-product/quickview-product-image.php' );
	}
}


if (! function_exists('greenmart_woo_change_skin_fresh')) {
    add_action('yith_wcqv_before_product_image', 'greenmart_woo_change_skin_fresh', 20);
    function greenmart_woo_change_skin_fresh()
    {
        if( greenmart_tbay_get_theme() !== 'fresh-el' ) return;

        remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 ); 
        remove_action( 'yith_wcqv_product_summary', 'greenmart_woo_get_subtitle', 7 ); 
        remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10 ); 
    }
}