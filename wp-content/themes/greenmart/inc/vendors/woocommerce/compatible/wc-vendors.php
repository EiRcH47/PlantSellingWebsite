<?php

if(!class_exists('WC_Vendors')) return;

if( ! function_exists( 'greenmart_tbay_wcv_vendor_shop' ) ) {
	remove_action( 'woocommerce_after_shop_loop_item', array( 'WCV_Vendor_Shop', 'template_loop_sold_by' ), 9 );
	function greenmart_tbay_wcv_vendor_shop( $product_id ) {
		if( ! wc_string_to_bool( get_option( 'wcvendors_display_label_sold_by_enable', 'no' ) ) ) return;

		$vendor_id         = WCV_Vendors::get_vendor_from_product( $product_id );
		$sold_by_label     = get_option( 'wcvendors_label_sold_by' );
		$sold_by_separator = get_option( 'wcvendors_label_sold_by_separator' );
		$sold_by           = WCV_Vendors::is_vendor( $vendor_id )
			? sprintf( '<a href="%s">%s</a>', WCV_Vendors::get_vendor_shop_page( $vendor_id ), WCV_Vendors::get_vendor_sold_by( $vendor_id ) )
			: get_bloginfo( 'name' );
		?>
		<div class="sold-by-meta wcvendors_sold_by_in_loop"><?php echo apply_filters( 'wcvendors_sold_by_in_loop', $sold_by_label ); ?><?php echo apply_filters( 'wcvendors_sold_by_separator_in_loop', $sold_by_separator ); ?><?php echo trim($sold_by); ?>
		</div> 
		<?php
	}
	add_action( 'woocommerce_single_product_summary', 'greenmart_tbay_wcv_vendor_shop', 7 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_tbay_wcv_vendor_shop', 1 );
	remove_action( 'woocommerce_product_meta_start', array( 'WCV_Vendor_Cart', 'sold_by_meta' ), 10, 2 ); 
	add_action( 'yith_wcqv_product_summary', 'greenmart_tbay_wcv_vendor_shop', 7 );
}

if( ! function_exists( 'greenmart_wc_vendors_login_redirect' ) ) {
	add_filter('woocommerce_login_redirect', 'greenmart_wc_vendors_login_redirect', 10, 2);
	function greenmart_wc_vendors_login_redirect( $redirect_to, $user ) {
		// WCV dashboard — Uncomment the 3 lines below if using WC Vendors Free instead of WC Vendors Pro
		if (class_exists('WCV_Vendors') && WCV_Vendors::is_vendor( $user->ID ) ) {
			$redirect_to = get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) );
		}
		return $redirect_to; 
	}
}

if ( function_exists( 'greenmart_tbay_wcv_vendor_shop' ) && !function_exists( 'greenmart_fresh_wcv_vendor_shop' ) ) {
	function greenmart_fresh_wcv_vendor_shop(){
		if( greenmart_tbay_get_theme() !== 'fresh-el' ) return;

        remove_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_tbay_wcv_vendor_shop', 1 );
		remove_action( 'woocommerce_single_product_summary', 'greenmart_tbay_wcv_vendor_shop', 7 );
        add_action( 'greenmart_before_shop_grid_group_button', 'greenmart_tbay_wcv_vendor_shop', 1 );
        add_action( 'greenmart_after_shop_list_price_sold', 'greenmart_tbay_wcv_vendor_shop', 1 );
		add_action( 'greenmart_woo_after_single_rating', 'greenmart_tbay_wcv_vendor_shop', 20 );
	}
	add_action('woocommerce_init', 'greenmart_fresh_wcv_vendor_shop');
}