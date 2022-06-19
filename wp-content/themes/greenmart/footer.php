<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 2.1.6
 */

$active_theme = greenmart_tbay_get_theme();
get_template_part( 'footer/themes/'.$active_theme.'/footer' );