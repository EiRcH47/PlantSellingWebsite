<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $woocommerce_loop;

if ( sizeof( $cross_sells ) == 0 ) {
	return;
}

$current_theme = greenmart_tbay_get_theme();
$only_organic  = greenmart_tbay_only_organic();

if( !in_array($current_theme, $only_organic) ) {
	$woocommerce_loop['columns'] = 4;
	$columns_desktopsmall = 4;
	$columns_tablet = 4;
	$columns_mobile = 2;
} else {	
	$woocommerce_loop['columns'] = 2;
	$columns_desktopsmall = 2;
	$columns_tablet = 2;
	$columns_mobile = 2;
}


$rows = 1;


$active_theme = greenmart_tbay_get_part_theme();

if ( $cross_sells ) : ?>

	<div class="cross-sells related products widget ">
    	<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', esc_html__( 'You may like', 'greenmart' ) );

		if ( $heading ) :
			?>
			<h3 class="widget-title"><span><?php echo esc_html( $heading ); ?></span></h3>
		<?php endif; ?>

		<?php  wc_get_template( 'layout-products/'.$active_theme.'/carousel-related.php' , array( 'loops'=>$cross_sells,'rows' => $rows, 'pagi_type' => 'no', 'nav_type' => 'yes','columns'=>$woocommerce_loop['columns'],'screen_desktop'=>$woocommerce_loop['columns'],'screen_desktopsmall'=>$columns_desktopsmall,'screen_tablet'=>$columns_tablet,'screen_mobile'=>$columns_mobile ) ); ?>

	</div>

<?php endif;

wp_reset_postdata();
