<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
					

defined( 'ABSPATH' ) || exit;


global $product, $woocommerce_loop;

$active_theme = greenmart_tbay_get_part_theme();


	
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( isset($pagi_columns) && !empty( $pagi_columns ) ) {
	$woocommerce_loop['columns'] = $pagi_columns;
} else if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Increase loop count
 
// Extra post classes
$classes = array();
$skin = greenmart_tbay_get_theme();
$item = ($skin === 'organic-el' || $skin === 'fresh-el') ? 'inner-v1' : 'inner';
$woo_display = greenmart_tbay_woocommerce_get_display_mode(); 
 


if( ( isset($list) && $list === 'list' && $skin === 'fresh-el'  ) ) {
	$item = $list;
} else if( empty($list) && $woo_display == 'list' && $skin === 'fresh-el'  ) { 
	$item = 'list';
} else { 
	$item = ($skin === 'organic-el' || $skin === 'fresh-el') ? 'inner-v1' : 'inner';
}

?>


<div <?php wc_product_class( $classes, $product ); ?>>
	 	<?php wc_get_template_part( 'item-product/'.$active_theme.'/'.$item ); ?>
</div>
