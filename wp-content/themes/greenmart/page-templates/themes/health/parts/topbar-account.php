<?php if( !greenmart_is_catalog_mode_activated() && has_nav_menu( 'nav-account' )) : ?>

	<div class="tbay-login">

		<?php if (is_user_logged_in() ) { ?>
			<div class="click-icon-wrapper">
				<button class="account-button btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="icon-user icons"></i><?php esc_html_e('My Account', 'greenmart'); ?>
					<span class="caret"></span>
				</button>
				<div class="account-menu dropdown-menu  click-icon-content">
				<?php if ( has_nav_menu( 'nav-account' ) ) { ?>
					<?php
					$args = array(
						'theme_location'  => 'nav-account',
						'container_class' => '',
						'menu_class'      => 'menu-topbar'
					);
					wp_nav_menu($args);
					?>
				<?php } ?>
				</div>
			</div>
		<?php } elseif( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() && !empty(get_option('woocommerce_myaccount_page_id')) ) { ?> 
			<div class="click-icon-wrapper"> 
				<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="account-button" title="<?php esc_attr_e('Login','greenmart'); ?>"><i class="icon-user-follow icons"></i><?php esc_html_e('Login','greenmart'); ?></a>  
			</div>        	
		<?php } ?> 

	</div>
	
<?php endif; ?> 