<header id="tbay-header" class="site-header header-v3 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">
        <div class="container"> 
		
			<div class="row">
				
				<div class="logo-in-theme col-md-3">
						<?php greenmart_tbay_get_page_templates_parts( 'logo' ,'white'); ?>
					   
				</div>

				<div class="col-md-9 text-right login-search-wrapper header-right">

					<div class="login-search-content">
						<?php if ( greenmart_tbay_get_config('header_login', true) ) { ?>
							<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
						<?php } ?>

						<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<!-- Setting -->
							<div class="top-cart hidden-xs">
								<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
							</div>
						<?php endif; ?>

						<div class="header-search-v3">
							<?php greenmart_tbay_get_page_templates_parts( 'productsearchform', 'category' ); ?>
						</div>
					</div>


				</div>
				

			</div>      
        </div>      
    </div>

    <div class="tbay-mainmenu">
    	 <div class="container"> 
    	 	<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>
    	 	<?php greenmart_tbay_get_page_templates_parts( 'click-icon-layout-3' ); ?>
    	 </div>
    </div>

</header>