<?php   global $woocommerce; ?>
<div class="topbar-device-mobile  visible-xxs clearfix">
	<?php
		$mobilelogo = greenmart_tbay_get_config('mobile-logo');
		$active_theme 	= greenmart_tbay_get_theme(); 
		$logo_all_page 	= greenmart_tbay_get_config('logo_all_page', false);
	?>
	<?php if( greenmart_tbay_is_home_page() || $logo_all_page ) : ?>
		<div class="active-mobile">
			<?php echo apply_filters( 'greenmart_get_menu_mobile_icon', 10,2 ); ?>
		</div>

		<div class="mobile-logo">
			<?php if( isset($mobilelogo['url']) && !empty($mobilelogo['url']) ): ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="logo-mobile-img" src="<?php echo esc_url( $mobilelogo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			<?php else: ?>
				<div class="logo-theme">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo-mobile-img" src="<?php echo esc_url_raw( get_template_directory_uri().'/images/'.$active_theme.'/mobile-logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
				</div>
			<?php endif; ?>
		</div>

		<?php if( class_exists( 'YITH_WCWL' ) ) : ?>
			<div class="wishlist-device">
				<a class="text-skin wishlist-icon" href="<?php $wishlist_url = YITH_WCWL()->get_wishlist_url(); echo esc_url($wishlist_url); ?>">
					<span class="icon">
						<i class="tb-icon tb-icon-zt-zzheart"></i>
						<span class="count count_wishlist"><?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_attr($wishlist_count); ?></span>
					</span> 
				</a>
			</div> 
        <?php endif; ?>  

		<?php if( greenmart_is_woocommerce_activated() ) : ?>
		<div class="search-device">
			<a class="show-search" href="javascript:;"><i class="tb-icon tb-icon-zt-search"></i></a>
			<?php get_template_part( 'page-templates/themes/fresh-el/parts/productsearchform-mobile' ); ?>
		</div>
		<?php endif; ?>

	<?php else: ?>
 
	<div class="topbar-post">
		<div class="active-mobile">
			<?php echo apply_filters( 'greenmart_get_menu_mobile_icon', 10,2 ); ?>
		</div>  

		<div class="topbar-title"> 
			<?php $title = apply_filters( 'greenmart_get_filter_title_mobile', 10,2 ); ?>
			<?php echo trim($title);?> 
		</div>

		<?php if ( greenmart_is_woocommerce_activated() && ( is_product() || is_checkout() ) ) : ?>
		<div class="mobile-cart cart-icon">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" > 
				<i class="tb-icon tb-icon-zt-zzcart "></i>
				<span class="count mini-cart-items cart-mobile"><?php echo sprintf( '%d', $woocommerce->cart->get_cart_contents_count() );?></span>
			</a>
		</div> 
		<?php endif; ?>
		

		<?php if( class_exists( 'YITH_WCWL' ) ) : ?>
			<div class="wishlist-device">
				<a class="text-skin wishlist-icon" href="<?php $wishlist_url = YITH_WCWL()->get_wishlist_url(); echo esc_url($wishlist_url); ?>">
					<span class="icon">
						<i class="tb-icon tb-icon-zt-zzheart"></i>
						<span class="count count_wishlist"><?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_attr($wishlist_count); ?></span>
					</span> 
				</a>
			</div>  
        <?php endif; ?>  

		<?php if( greenmart_is_woocommerce_activated() ) : ?>
		<div class="search-device">
			<a class="show-search" href="javascript:;"><i class="tb-icon tb-icon-zt-search"></i></a>
			<?php get_template_part( 'page-templates/themes/fresh-el/parts/productsearchform-mobile' ); ?>
		</div>
		<?php endif; ?>  
		

		</div>
	<?php endif; ?>

</div>
