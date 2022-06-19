
<?php 

$_id = greenmart_tbay_random_key(); 

?>

<div class="modal fade search-form-modal" id="searchformshow-<?php echo esc_attr($_id); ?>" tabindex="-1" role="dialog" aria-labelledby="searchformlable-<?php echo esc_attr($_id); ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="searchformlable-<?php echo esc_attr($_id); ?>"><?php esc_html_e('Search form', 'greenmart'); ?></h4>
      </div>
      <div class="modal-body">
			<?php greenmart_tbay_get_page_templates_parts( 'productsearchform' ); ?>
      </div>
    </div>
  </div>
</div>


<header id="tbay-header" class="site-header header-v3 hidden-sm hidden-xs <?php echo (greenmart_tbay_get_config('keep_header', false) ? 'main-sticky-header' : ''); ?>">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="row">
					<!-- //LOGO -->
                    <div class="header-left col-md-2 col-xlg-3">
                    	<div class="logo-in-theme">
	                        <?php 
	                        	greenmart_tbay_get_page_templates_parts('logo'); 
	                        ?> 
	                    </div>
						<div id="search-form-modal-<?php echo esc_attr($_id); ?>" class="search-popup visible-xlg">
							<button type="button" class="btn-search-totop" data-toggle="modal" data-target="#searchformshow-<?php echo esc_attr($_id); ?>">
							   <i class="icons icon-magnifier"></i>
							</button>
						</div>
                    </div>

				    <div class="tbay-mainmenu hidden-xs hidden-sm col-md-7 col-xlg-6">
						
						<div class="mainmenu">

					      <div class="visible-xlg tbay-offcanvas-main verticle-menu active-desktop">
        						<?php greenmart_tbay_get_page_templates_parts('nav-vertical'); ?>
						    </div>					        

						    <div class="hidden-xlg">
						        <?php greenmart_tbay_get_page_templates_parts('nav'); ?>
						    </div>
						</div>

				    </div>
				    <div class="header-right col-md-3">
				    	<div class="hidden-xlg">
					        <button type="button" class="btn-search-totop" data-toggle="modal" data-target="#searchformshow-<?php echo esc_attr($_id); ?>">
							   <i class="icons icon-magnifier"></i>
							</button>
					    </div>
				    	<?php if ( greenmart_tbay_get_config('header_login') ) { ?>
							<?php greenmart_tbay_get_page_templates_parts( 'topbar-account' ); ?>
						<?php } ?>
						<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
							<!-- Cart -->
							<div class="cart-xlg visible-xlg">
							<?php greenmart_tbay_get_woocommerce_mini_cart('2'); ?>
							</div>
							<div class="top-cart hidden-xlg">
								<?php greenmart_tbay_get_woocommerce_mini_cart(); ?>
							</div>
						<?php endif; ?>
						
				    </div>
                </div>
            </div>
        </div>
    </div>
</header>