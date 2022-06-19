<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! comments_open() ) {
	return;
}
$count =  $product->get_review_count() ;

$counts = greenmart_woo_get_review_counting();

$average      = $product->get_average_rating();

$active_theme = greenmart_tbay_get_theme();

if( class_exists( 'VI_Woo_Photo_Reviews' ) ) {
	wc_get_template( 'single-product/themes/single-product-reviews-default.php', array( 'counts' => $counts, 'count' => $count, 'average' => $average));
} else {
	wc_get_template( 'single-product/themes/'.$active_theme.'/single-product-reviews.php', array( 'counts' => $counts, 'count' => $count, 'average' => $average));
}