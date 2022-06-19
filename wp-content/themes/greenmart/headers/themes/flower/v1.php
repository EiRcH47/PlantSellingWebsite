<header id="tbay-header" class="site-header header-default header-v1 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="row">
					<!-- //LOGO -->
                    <div class="search col-md-4 hidden-sm hidden-xs">
                        <?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>
                    </div>
					
                    <!-- SEARCH -->
                    <div class="col-md-4 logo-in-theme text-center">
						<?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>
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
						<?php if ( greenmart_tbay_get_config('header_login') ) { ?>
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
    <section id="tbay-mainmenu" class="tbay-mainmenu hidden-xs hidden-sm">
        <div class="container"> 
		
			<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>
			
			
        </div>      
    </section>
</header>