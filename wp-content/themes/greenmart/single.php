<?php

get_header();

$sidebar_configs = greenmart_tbay_get_blog_layout_configs();

$active_theme = greenmart_tbay_get_part_theme();
$current_theme = greenmart_tbay_get_theme();

greenmart_tbay_render_breadcrumbs();
$skin = greenmart_tbay_get_theme();
$class_row_reverse = '';
if ( ($skin === 'organic-el' || $skin === 'fresh-el' ) && isset($sidebar_configs['left']) ) {
	$class_row_reverse = 'flex-row-reverse';
}
if ( isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) {
	$sidebar_configs['main']['class'] .= ' pull-right';
}
?>


<section id="main-container" class="main-content <?php echo apply_filters( 'greenmart_tbay_blog_content_class', 'container' ); ?> inner">
	<div class="row <?php echo esc_attr($class_row_reverse); ?>">
		<?php if ( isset($sidebar_configs['left']) && isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
		<div id="main-content" class="<?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content single-post" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'post-formats/'.$active_theme.'/content', get_post_format() ); 

							if( $current_theme == 'fresh-el' ) {
								greenmart_tbay_post_info_author();
							} else {
								// Previous/next post navigation.
								the_post_navigation( array(
									'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'greenmart' ) . '</span> ' .
										'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'greenmart' ) . '</span> ' .
										'<span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'greenmart' ) . '</span> ' .
										'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'greenmart' ) . '</span> ' .
										'<span class="post-title">%title</span>',
								) );
							}


							if ( $current_theme == 'organic' || $current_theme == 'organic-el' || $current_theme == 'fresh-el'  ) {

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								if ( greenmart_tbay_get_config('show_blog_releated', false) ): ?>
									<div class="related-posts">
										<?php get_template_part( 'page-templates/parts/posts-releated' ); ?>
									</div>
				                <?php
								endif;
							} else {
								if ( greenmart_tbay_get_config('show_blog_releated', false) ): ?>
									<div class="related-posts">
										<?php get_template_part( 'page-templates/'.$active_theme.'/parts/posts-releated' ); ?>
									</div>
				                <?php
				                endif;

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) : ?>
									<div id="reviews"><?php comments_template(); ?> </div>
								<?php endif;
							}
							
						// End the loop.
						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
		<?php if ( isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
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