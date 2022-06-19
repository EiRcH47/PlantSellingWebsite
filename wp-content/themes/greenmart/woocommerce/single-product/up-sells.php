<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( sizeof( $upsells ) == 0 ) {
	return;
}

if( isset($_GET['releated_columns']) ) { 
	$columns = $_GET['releated_columns'];
} else {
	$columns = greenmart_tbay_get_config('releated_product_columns', 4);
}

if( greenmart_woo_single_product_active_full() ) {
	$columns_desktopsmall 	= 1;
	$columns_tablet 		= 1;
	$columns_mobile 		= 1;
	$rows 					= $columns;
	$columns 				= 1;
} else {
	$columns_desktopsmall = 3;
	$columns_tablet = 3;
	$columns_mobile = 2;
	$rows = 1;
}

$active_theme = greenmart_tbay_get_part_theme();

$show_product_upsells = greenmart_tbay_get_config('enable_product_upsells', true);

$heading = apply_filters( 'woocommerce_product_upsells_products_heading', esc_html__( 'You may also like&hellip;', 'greenmart' ) );

if ( $upsells && $show_product_upsells) : ?>

	<div class="upsells widget products">
		<?php if ( $heading ) :?>
			<h3 class="widget-title"><?php echo esc_html( $heading ); ?></h3>
		<?php endif; ?>
		<?php  wc_get_template( 'layout-products/'.$active_theme.'/carousel-related.php' , array( 'loops'=>$upsells,'rows' => $rows, 'pagi_type' => 'no', 'nav_type' => 'yes','columns'=>$columns,'screen_desktop'=>$columns,'screen_desktopsmall'=>$columns_desktopsmall,'screen_tablet'=>$columns_tablet,'screen_mobile'=>$columns_mobile ) ); ?>
	</div>

<?php endif;

wp_reset_postdata();
