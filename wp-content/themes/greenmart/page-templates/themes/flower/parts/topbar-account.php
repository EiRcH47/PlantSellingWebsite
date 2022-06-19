<?php if( !greenmart_is_catalog_mode_activated() && has_nav_menu( 'nav-account' )) : ?>

	<div class="tbay-login">

		<?php if (is_user_logged_in() ) { ?>
			<div class="dropdown">
				<a class="account-button" href="javascript:void(0);"><i class="icon-user icons"></i></a>
				<div class="account-menu">
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
				<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login','greenmart'); ?>"><i class="icon-user"></i></a>          	
		<?php } ?> 

	</div>
	
<?php endif; ?> 