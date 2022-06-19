<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}
if ( sizeof( $related_products ) == 0 ) return;


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

$show_product_releated = greenmart_tbay_get_config('show_product_releated', true);

$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'greenmart' ) );

if ( $related_products && $show_product_releated) : ?> 
	<div class="related products widget ">
		<?php if ( $heading ) : ?>
			<h3 class="widget-title"><span><?php echo esc_html( $heading ); ?></span></h3>
		<?php endif; ?>
		<?php wc_get_template( 'layout-products/'.$active_theme.'/carousel-related.php' , array('loops'=>$related_products,'rows' => $rows, 'pagi_type' => 'no', 'nav_type' => 'yes','columns'=>$columns,'screen_desktop'=>$columns,'screen_desktopsmall'=> $columns_desktopsmall,'screen_tablet'=>$columns_tablet,'screen_mobile'=>$columns_mobile ) ); ?>

	</div>

<?php endif;

wp_reset_postdata(); 