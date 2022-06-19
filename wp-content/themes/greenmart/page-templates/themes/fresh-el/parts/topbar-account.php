<?php if ( greenmart_is_woocommerce_activated() ): ?>
	<ul class="list-inline acount style1">
		<?php if( !is_user_logged_in() ){ ?>
			<li> <?php esc_html_e('Hello ','greenmart'); ?></li>
			<li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login','greenmart'); ?>"> <?php esc_html_e('Login', 'greenmart'); ?> </a></li>
		<?php }else{ ?>
			<?php $current_user = wp_get_current_user(); ?>
			<li>  <i class="<?php echo greenmart_get_icon('icon_user'); ?>"></i><span class="tit hidden-xs"><?php esc_html_e('Hello ','greenmart'); ?></span><span class="user"><?php echo esc_html( $current_user->display_name); ?> </span><i class="<?php echo greenmart_get_icon('icon_rounded'); ?>"></i>
			<ul>
				<li><?php get_template_part( 'page-templates/parts/nav-account' ); ?></li>
			</ul>
			</li>
			<li>
				<a class="login" href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Logout ','greenmart'); ?></a>
			</li>
		<?php } ?>
	</ul>
<?php endif; ?>