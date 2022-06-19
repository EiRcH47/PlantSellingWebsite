<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (class_exists('VI_Woo_Photo_Reviews')) {
	wc_get_template( 'single-product/themes/review-default.php', array( 'comment' => $comment) );
} else {
	wc_get_template( 'single-product/themes/review.php', array( 'comment' => $comment) );
}