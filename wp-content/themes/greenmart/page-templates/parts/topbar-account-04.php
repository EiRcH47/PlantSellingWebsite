<div class="pull-right user-menu">
	<div class="dropdown menu">
		<span data-toggle="dropdown" class="dropdown-toggle"><i class="zmdi zmdi-account-o"></i></span>
		<div class="dropdown-menu dropdown-menu-right">
			<ul class="list-inline acount">
				<?php if( !is_user_logged_in() ){ ?>
					<li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Sign up','greenmart'); ?>"> <?php esc_html_e('Sign up', 'greenmart'); ?> </a></li>
					<li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login','greenmart'); ?>"> <?php esc_html_e('Login', 'greenmart'); ?> </a></li>
				<?php }else{ ?>
					<?php $current_user = wp_get_current_user(); ?>
				  <li>  <span class="hidden-xs"><?php esc_html_e('Welcome ','greenmart'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
				  <li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Logout ','greenmart'); ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>