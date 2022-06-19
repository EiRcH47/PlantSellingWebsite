<?php

get_header();
$sidebar_configs = greenmart_tbay_get_woocommerce_layout_configs();
$current_theme = greenmart_tbay_get_theme();
$only_organic  = greenmart_tbay_only_organic();

$page_title = '';
if( is_shop()){
	$page_title .= esc_html__('Shop', 'greenmart');
}else if( is_singular( 'product' ) ) {
	$page_title .= get_the_title();
} else {
	$page_title .= woocommerce_page_title(false);
}
$skin = greenmart_tbay_get_theme();
$class_row_reverse = '';
if ( ($skin === 'organic-el' || $skin === 'fresh-el' ) && isset($sidebar_configs['left']) ) {
	$class_row_reverse = 'flex-row-reverse';
}

$shop_page = '';
if ($skin === 'fresh-el') {
	$shop_page = 'shop-page';
}
 
if ( isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) {
	$sidebar_configs['main']['class'] .= ' pull-right';
}

$show_top_archive_product  		= greenmart_tbay_get_config( 'show_top_archive_product', false );
$enable_category_title  		= greenmart_tbay_get_config( 'enable_category_title', false );
$enable_category_description  	= greenmart_tbay_get_config( 'enable_category_description', false );
$enable_category_image  		= greenmart_tbay_get_config( 'enable_category_image', false );

?>

<?php do_action( 'greenmart_woo_template_main_before' ); ?>


<section id="main-container" class="main-content <?php echo apply_filters('greenmart_tbay_woocommerce_content_class', 'container');?>">
	<?php
		if( $skin === 'fresh-el' && apply_filters( 'woocommerce_show_page_title', true ) &&   $enable_category_title ) {
			?>
			<h1 class="page-title title-woocommerce"><?php woocommerce_page_title(); ?></h1>
			<?php
		}
	?>
	<div class="row <?php echo esc_attr($class_row_reverse);?> <?php echo esc_attr($shop_page);?>"> 
		
		<?php if ( !is_singular( 'product' )  || !in_array($current_theme, $only_organic) ) : ?>

		<?php if ( isset($sidebar_configs['left']) && isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
				<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
				  <?php do_action( 'greenmart_before_sidebar_mobile' ); ?>
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<?php endif; ?>

		<div id="main-content" class="<?php  echo ( !is_singular( 'product' ) ) ? 'archive-shop' : 'singular-shop'; ?> col-xs-12 col-12 <?php echo ( !is_singular( 'product' ) || !in_array($current_theme, $only_organic) ) ? esc_attr($sidebar_configs['main']['class']) : ''; ?>">

			<?php if ( !is_singular( 'product' ) && !is_search() ) : ?>
				<?php if( $show_top_archive_product && is_active_sidebar('top-archive-product')) : ?>
					<div class="top-archive">
						<?php dynamic_sidebar('top-archive-product'); ?>
					<!-- End Top Archive Product Widget -->
					</div>
				<?php endif;?>
			<?php endif;?>
			
			<?php 
				/**
				 * Hook: woocommerce_before_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 * @hooked WC_Structured_Data::generate_website_data() - 30
				 */
				do_action( 'woocommerce_before_main_content' );
			?>
			<div id="content" class="site-content" role="main">

				<?php  
				if ( is_singular( 'product' ) ) {

				while ( have_posts() ) : the_post();

					wc_get_template_part( 'content', 'single-product' );

				endwhile;
 
			} else { ?>


				<?php if( is_product_category() && isset($enable_category_image) && $enable_category_image ) {
					do_action( 'greenmart_archive_image' ); 
				} ?>

				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) &&   $enable_category_title && $skin !== 'fresh-el') : ?>
						<h1 class="page-title title-woocommerce"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>



				<?php

					if( isset($enable_category_description) && $enable_category_description ) {  
						do_action( 'woocommerce_archive_description' ); 
					}
				?>



					
				<?php if((is_shop() && '' !== get_option('woocommerce_shop_page_display')) || (is_product_category() && 'subcategories' == get_option('woocommerce_category_archive_display')) || (is_product_category() && 'both' == get_option('woocommerce_category_archive_display'))) : ?>
				
				<ul class="all-subcategories row">
					<?php greenmart_woocommerce_sub_categories(); ?>
				</ul>				
				
				<?php endif; ?>

				<?php if ( woocommerce_product_loop() ) : ?>


					<?php do_action('woocommerce_before_shop_loop'); ?>
		
					
					<?php woocommerce_product_loop_start(); ?>

						
						<?php while ( have_posts() ) : the_post(); ?>
						
							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>
					


					<?php do_action('woocommerce_after_shop_loop'); ?>


				<?php  else : ?>

					<?php 
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );	
					?>

				<?php endif;
				
			}
			?>

			</div><!-- #content -->

			<?php
			/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>

		</div><!-- #main-content -->
		
		<?php if ( !is_singular( 'product' ) || !in_array($current_theme, $only_organic) ) : ?>
			<?php if ( isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) : ?>
				<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
					<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
					  	<?php do_action( 'greenmart_before_sidebar_mobile' ); ?>	
				   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
				  	</aside>
				</div>
			<?php endif; ?>
			
			<?php if ( isset($sidebar_configs['right']) ) : ?>
				<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
					<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
					  	<?php do_action( 'greenmart_before_sidebar_mobile' ); ?>	
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				  	</aside>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>

<?php do_action( 'greenmart_woo_template_main_after' ); ?>

<?php if ( is_singular( 'product' ) ) : ?>

	<?php  if ( !in_array($current_theme, $only_organic) ) {
		do_action( 'greenmart_woo_singular_template_main_after' );
	} else { ?>

		<?php 
			do_action( 'greenmart_woo_after_single_product_summary_before' );
		?>
		<div class="woo-after-single-product-summary">
			<div class="container">
				<div class="row <?php echo esc_attr($class_row_reverse) ?>">

					<?php if ( isset($sidebar_configs['left']) && isset($sidebar_configs['right']) ) : ?>
						<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
						  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
						  	</aside>
						</div>
					<?php endif; ?>
		 

					<div class="woo-after-single-content col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
						
						<?php 
							/**
							 * woocommerce_after_single_product_summary hook
							 *
							 * @hooked woocommerce_output_product_data_tabs - 10
							 * @hooked woocommerce_upsell_display - 15
							 * @hooked woocommerce_output_related_products - 20
							 */
							do_action( 'woocommerce_after_single_product_summary' ); 
						?>

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
			</div>
		</div>
	<?php } ?>

<?php endif; ?>

<?php

get_footer();
