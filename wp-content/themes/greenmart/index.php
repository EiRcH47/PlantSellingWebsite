<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 2.1.6
 */

get_header();

$active_theme = greenmart_tbay_get_part_theme();

$colContent = (is_active_sidebar('sidebar-default')) ? 9 : 12;
?>
	<div id="primary" class="content-area content-index">
		<main id="main" class="site-main" role="main">
			<div class="container">
			<div class="container-inner main-content">
				<div class="row grid"> 
	                <!-- MAIN CONTENT -->
	                <div class="col-lg-<?php echo esc_attr($colContent); ?> col-md-<?php echo esc_attr($colContent); ?> col-sm-<?php echo esc_attr($colContent); ?>">
	                        <?php  if ( have_posts() ) : 
	                        	while ( have_posts() ) : the_post();
									?> 
										<div class="layout-blog">
											<?php get_template_part( 'post-formats/'.$active_theme.'/content', get_post_format() ); ?>
										</div>
									<?php
								// End the loop.
								endwhile;
								greenmart_tbay_paging_nav();
								?>
	                        <?php else : ?>
	                             <?php get_template_part( 'post-formats/'.$active_theme.'/content', 'none' ); ?>
	                        <?php endif; ?>
	                </div>
					<?php if(is_active_sidebar('sidebar-default')) : ?>
						<div class="col-lg-3 col-md-3 col-sm-3 sidebar">
						   <?php dynamic_sidebar('sidebar-default'); ?>
						</div>
					<?php endif;?>
	            </div>
            </div>
            </div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
