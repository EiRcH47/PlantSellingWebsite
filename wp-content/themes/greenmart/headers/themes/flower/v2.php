<?php 

$_id = greenmart_tbay_random_key(); 

?>
<header id="tbay-header" class="site-header header-v2 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
	
	<div class="header-main">
        <div class="header-inner">
            <!-- LOGO -->
            <div class="logo-in-theme col-sm-3">
                <?php greenmart_tbay_get_page_templates_parts( 'logo' ); ?>
            </div>
			
			<!-- Main menu -->
			<div class="header-mainmenu col-sm-6">

				<?php greenmart_tbay_get_page_templates_parts( 'nav' ); ?>
				
            </div>
			
			<div class="header-right col-sm-3">
				<div id="search-form-horizontal-<?php echo esc_attr($_id); ?>" class="search-horizontal">
					<button type="button" class="btn-search-totop">
					  <i class="icon-magnifier"></i>
					</button>
					<div class="container-search-horizontal">
						<div class="search-horizontal-wrapper">
						    <div class="search-horizontal-content">
							    <?php greenmart_tbay_get_page_templates_parts( 'productsearchform', 'horizontal'); ?>
							</div>
						</div>
			        </div>
				</div>
				<?php if ( greenmart_tbay_get_config('header_login') ) { ?>
					<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
				<?php } ?>
				<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<!-- Cart -->
					<div class="top-cart hidden-xs">
						<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
					</div>
				<?php endif; ?>
				<?php if(is_active_sidebar('top-bar-layout2')) : ?>
					<div class="top-menu">
						<div class="dropdown">
							<a class="account-button" href="javascript:void(0);"><i class="icons icon-options-vertical"></i></a>
	                    	<div class="account-menu">
								<div class="account-content"> 
									<?php dynamic_sidebar('top-bar-layout2'); ?>
								</div>
	                    	</div>
	                    </div>
                	</div>
				<?php endif;?>
			</div>
        </div>
    </div>
</header>