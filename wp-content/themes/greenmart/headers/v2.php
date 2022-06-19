<header id="tbay-header" class="site-header header-v2 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
	<div id="tbay-topbar" class="tbay-topbar hidden-sm hidden-xs">
        <div class="container">
	
            <div class="topbar-inner clearfix">
                <div class="row">
					<?php if(is_active_sidebar('top-contact')) : ?>
						<div class="col-md-4 top-contact">
							<?php dynamic_sidebar('top-contact'); ?>
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
            <div class="header-inner clearfix row">
                <!-- LOGO -->
                <div class="logo-in-theme pull-left">
                    <?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>
                </div>
				
				<!-- Main menu -->
				<div class="tbay-mainmenu pull-right">

					<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>
					
					 <div class="pull-right header-search-v2">
						<div class="header-setting ">
							<div class="pull-right">

							<button type="button" class="btn-search-totop">
								<i class="<?php echo greenmart_get_icon('icon_search'); ?>"></i>
							</button>
							<?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>

							</div>
						</div>
					</div>
						<!-- //Search -->
					
                </div>
				
               
               
				
            </div>
        </div>
    </div>
</header>