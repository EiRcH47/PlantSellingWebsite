<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 2.1.6
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php 
	$tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type') );
	if ( empty($tbay_header) ) {
		$tbay_header = 'v1';
	}
?>
<div id="wrapper-container" class="wrapper-container <?php echo esc_attr($tbay_header); ?>">

	<?php 
		/**
		* greenmart_before_theme_header hook
		*
		* @hooked greenmart_tbay_offcanvas_menu - 10
		* @hooked greenmart_tbay_the_topbar_mobile - 20
		* @hooked greenmart_tbay_custom_form_login - 30
		* @hooked greenmart_tbay_footer_mobile - 40
		*/
		do_action('greenmart_before_theme_header');
	?>

	<?php 
		/**
		* greenmart_theme_header hook
		*
		* @hooked greenmart_tbay_template_part_header_layout - 10
		*/
		do_action('greenmart_theme_header');
	?>

	<?php 
		/**
		* greenmart_after_theme_header hook
		*/
		do_action('greenmart_after_theme_header');
	?>
	

	<div id="tbay-main-content">
