<?php
get_header();
$sidebar_configs = greenmart_tbay_get_blog_layout_configs();

greenmart_tbay_render_breadcrumbs();
$active_theme = greenmart_tbay_get_part_theme();
$skin = greenmart_tbay_get_theme();
$class_row_reverse = '';
if ( ($skin === 'organic-el' || $skin === 'fresh-el' ) && isset($sidebar_configs['left'])) {
	$class_row_reverse = 'flex-row-reverse';
}
if ( isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) {
	$sidebar_configs['main']['class'] .= ' pull-right';
}

$blog_columns = apply_filters( 'loop_blog_columns', 1 );


if( isset($blog_columns) ) { 

	switch ($blog_columns) {
	    case '1':
	        $blog_archive_class = 'col-xs-12 col-lg-12 col-md-12 col-sm-12';
	        break;
	    case '2':
	         $blog_archive_class = 'col-xs-12 col-lg-6 col-md-6 col-sm-6';
	        break;
	    case '3':
	         $blog_archive_class = 'col-xs-12 col-lg-4 col-md-4 col-sm-6';
	        break;	    
	    case '4':
	         $blog_archive_class = 'col-xs-12 col-xlg-3 col-lg-4 col-md-4 col-sm-6';
	        break;	    
	    case '5':
	         $blog_archive_class = 'col-xs-12 col-xlg-2-4 col-lg-2-4 col-md-2-4 col-sm-6';
	        break;	    
	    case '6':
	         $blog_archive_class = 'col-xs-12 col-xlg-2-4 col-lg-2 col-md-2 col-sm-6';
	        break;
	    default:
	      $blog_archive_class = 'col-xs-12 col-lg-4 col-md-4 col-sm-6';
	}

}

$columns	= $blog_columns;
if(isset($blog_columns) && $blog_columns >= 4) {
	$screen_desktop 		= 3;
	$screen_desktopsmall 	= 3;
} else {
	$screen_desktop 			= $blog_columns;
	$screen_desktopsmall 	= $blog_columns;
}


$screen_tablet 				= 2;
$screen_mobile 				= 2;

$data_responsive = ' data-xlgdesktop='. $columns .'';

$data_responsive .= ' data-desktop='. $screen_desktop .'';

$data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';

$data_responsive .= ' data-tablet='. $screen_tablet .'';

$data_responsive .= ' data-mobile='. $screen_mobile .'';

?>
<section id="main-container" class="main-content  <?php echo apply_filters('greenmart_tbay_blog_content_class', 'container');?> inner">
	<div class="row <?php echo esc_attr($class_row_reverse); ?>">
	
		<?php
			if( $skin === 'fresh-el' ) { ?>
				<header class="page-header header-archive col-sm-12 col-12 col-xl-12">
				<?php 
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
				</header><!-- .page-header -->
			<?php }
		?>

		<?php if ( isset($sidebar_configs['left']) && isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div> 
		<?php endif; ?>

		<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<main id="main" class="site-main layout-blog" role="main">

			<?php if ( have_posts() ) : ?>

					
					<?php
						if( $skin !== 'flower' && $skin !== 'fresh-el' ) { ?>
							<header class="page-header hidden">
							<?php 
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
							</header><!-- .page-header -->
						<?php }
					?>
				
				<div class="row" <?php echo esc_attr($data_responsive); ?>>
					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						?>
						<div class="<?php echo isset($blog_archive_class) ? esc_attr($blog_archive_class) : '';  ?>">
						
								<?php get_template_part( 'post-formats/'.$active_theme.'/content', get_post_format() ); ?>
						</div>
						<?php
					// End the loop.
					endwhile;

					// Previous/next page navigation.
					greenmart_tbay_paging_nav();

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'post-formats/'.$active_theme.'/content', 'none' );

				endif;
				?>
			</div>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
		
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
