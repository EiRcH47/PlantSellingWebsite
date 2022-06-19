

<div class="header-main clearfix">
	<div class="container">
		<div class="header-inner">
			<div class="row">
				<!-- //LOGO -->
				<div class="logo-in-theme col-md-3">
					<?php greenmart_tbay_get_page_templates_parts( '/logo' ); ?>
				</div>
				
				<div class="col-md-6">
					
				</div>
				<div class="col-md-3">
					<?php 
						$catalog_mode = greenmart_is_catalog_mode_activated();
						if(!$catalog_mode) {
							?>
							<div class="cart-default layout-wrapper-title-price-column position-total-absolute d-flex justify-content-end">
								<?php greenmart_tbay_get_woocommerce_mini_cart_el(); ?>
							</div>
							<?php
						}
					?>
					<!-- Cart -->
				</div>
				
			</div>
		</div>
	</div>
	<section id="tbay-mainmenu" class="tbay-mainmenu">
		<div class="container">
			<?php greenmart_tbay_get_page_templates_parts('nav-header-el'); ?>
		</div>
	</section>
</div>
