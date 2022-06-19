<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 2.1.6
 */
/*

*Template Name: 404 Page
*/
get_header();
$sidebar_configs = greenmart_tbay_get_page_layout_configs();

greenmart_tbay_render_breadcrumbs();

?>
<section id="main-container" class=" container inner">
	<div class="clearfix">
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>
		<div id="main-content" class="main-page page-404 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<section class="error-404 not-found text-center clearfix">
			<div class="notfound-top">
				<h1><?php esc_html_e( 'Page Not Found', 'greenmart' ); ?></h1>
				<p class="sub"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'greenmart' ); ?></p>
			</div>
				<div class="page-content notfound-bottom">
					<p class="sub-title"><?php esc_html_e( 'If you want go back to my store. Please in put the BOX BELOW', 'greenmart' ); ?></p>

					<?php get_search_form(); ?>
					<a class="backtohome" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('back to home', 'greenmart'); ?><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- .content-area -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
	</div>
</section>
<?php get_footer(); ?>