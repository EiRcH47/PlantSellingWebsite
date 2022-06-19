<header id="tbay-header" class="site-header header-v2 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">

	<div class="header-main clearfix">

		<?php if(is_active_sidebar('top-bar-layout1')) : ?>
			<div class="top-bar-wrapper">
				<?php dynamic_sidebar('top-bar-layout1'); ?>
			</div><!-- End Top Contact Widget --> 
		<?php endif;?>

		<div class="header-top"> 
	        <div class="container container-full">
                <div class="row">

                	<div class="col-md-6 text-left">

                		<?php if(is_active_sidebar('top-contact-layout2')) : ?>
							<div class="top-contact">
								<?php dynamic_sidebar('top-contact-layout2'); ?>
							</div><!-- End Top Contact Widget -->
						<?php endif;?>

                	</div>

					<div class="pull-right col-md-6 text-right header-right">
						
						<!-- Wishlist -->
						<div class="top-wishlist">
							<?php greenmart_tbay_get_page_templates_parts('wishlist'); ?>
						</div>

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
							<!-- Cart -->
							<div class="top-cart hidden-xs">
								<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
							</div>
						<?php endif; ?>
					</div>
					
	            </div>
	        </div>
        </div> 
    </div>
	
	<div class="header-inner clearfix">
        <div class="container container-full">
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3 logo-in-theme">
                    <?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>
                    <?php greenmart_tbay_get_page_templates_parts( 'click-icon-layout-1' ); ?>
                </div>
				
				<!-- Main menu -->
				<div class="col-md-9 tbay-mainmenu">

					<div class="tbay-mainmenu-content">
						<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>
						
						 <div class="header-search-v2">
							<?php greenmart_tbay_get_page_templates_parts( 'productsearchform', 'home2' ); ?>
						</div>
					</div>
					
                </div>
				
            </div>
        </div>
    </div>
</header>