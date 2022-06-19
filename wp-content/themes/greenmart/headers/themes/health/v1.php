<header id="tbay-header" class="site-header header-default header-v1 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">

       	<?php if(is_active_sidebar('top-bar-layout1')) : ?>
			<div class="top-bar-wrapper">
				<?php dynamic_sidebar('top-bar-layout1'); ?>
			</div><!-- End Top Contact Widget -->
		<?php endif;?>

 


		<div class="header-top">
			<div class="container">
				<div class="row">

					<div class="tbay-mainmenu col-md-8">

						<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>

					</div>

					<div class="col-md-4 text-right header-right">

						<?php
							if( class_exists( 'WOOCS' ) ) {
								wp_enqueue_style('sumoselect');
								wp_enqueue_script('jquery-sumoselect');	
								?>
								<div class="tbay-currency">
								<?php
									echo do_shortcode( '[woocs]' );

								?>
								</div>
								<?php 
							}
	                    ?>

	                    <?php if ( greenmart_tbay_get_config('header_login', true) ) { ?>
							<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
						<?php } ?>

						<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<div class="top-cart hidden-xs">
								<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
							</div>
						<?php endif; ?>

					</div>

				</div>
			</div>

		</div>

        <div class="header-inner">
           	<div class="container">
                <div class="row">
					<!-- //LOGO -->
                    <div class="logo-in-theme col-md-4 text-left">
                        <?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>

                        <?php greenmart_tbay_get_page_templates_parts( 'click-icon-layout-1' ); ?>
                    </div>
					
                    <!-- SEARCH -->
                    <div class="search-content-wrapper col-md-8">

                    	<div class="search-content">
				             <?php if(is_active_sidebar('top-contact-layout1')) : ?>
								<div class="top-contact">
									<?php dynamic_sidebar('top-contact-layout1'); ?>
								</div><!-- End Top Contact Widget -->
							<?php endif;?>

							<?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>

						</div>
                    </div>
				
                </div>
            </div>
        </div>
    </div>
</header>