<header id="tbay-header" class="site-header header-v4 header-v8 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
	<div id="tbay-topbar" class="tbay-topbar hidden-sm hidden-xs">
        <div class="container">
	
            <div class="topbar-inner clearfix">
                <div class="row">
					<?php if(is_active_sidebar('top-contact-2')) : ?>
						<div class="col-md-4 top-contact">
							<?php dynamic_sidebar('top-contact-2'); ?>
						</div><!-- End Top Contact Widget -->
					<?php endif;?>
					
					
					
					<div class="pull-right col-md-8 text-right">
						<?php if ( greenmart_tbay_get_config('header_login') ) { ?>
							<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
						<?php } ?>
						
						<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<div class="pull-right top-cart-wishlist">
								
								<!-- Cart -->
								<div class="top-cart hidden-xs">
									<?php greenmart_tbay_get_woocommerce_mini_cart('2'); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

				</div>
				
            </div>
        </div> 
    </div>
    
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="row">
                    <!-- LOGO -->
                    <div class="pull-left logo-in-theme col-md-2">
                        <?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>
                    </div>
					<div class="col-md-4">
						<?php if(is_active_sidebar('header-contact-v4')) : ?>
							<div class="top-contact">
								<?php dynamic_sidebar('header-contact-v4'); ?>
							</div><!-- End Top Contact Widget -->
						<?php endif;?>
					</div>
				    <div class="box-search-4 col-md-5">
					   <?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>
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