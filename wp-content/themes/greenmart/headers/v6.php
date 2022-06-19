<header id="tbay-header" class="site-header header-default header-v6 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
	
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="row">
                    <!-- SEARCH -->
					
                    <div class="search col-md-4 hidden-sm hidden-xs">
						<div class="pull-left category-v6">
							<?php greenmart_tbay_get_page_templates_parts( 'categorymenuimg' ); ?>
						</div>
                        <div class="pull-right">
							<?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>
						</div>
                    </div>
					
					<!-- //LOGO -->
                    <div class="logo-in-theme col-md-4 text-center">
 						<?php greenmart_tbay_get_page_templates_parts( 'logo','layout6' ); ?>
                    </div>
					
					<div class="pull-right col-md-4 right-item">
						<?php if ( greenmart_tbay_get_config('header_login') ) { ?>
						<div class="pull-left">
							<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
						</div>
						<?php } ?>
					
						<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<div class="pull-right top-cart-wishlist">
								
								<!-- Cart -->
								<div class="top-cart hidden-xs">
									<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
								</div>
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