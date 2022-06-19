<?php

$footer 		= apply_filters( 'greenmart_tbay_get_footer_layout', 'default' );
$copyright 		= greenmart_tbay_get_config('copyright_text', '');

?>

	</div><!-- .site-content -->

	<footer id="tbay-footer" class="tbay-footer" role="contentinfo">
		<?php if ( !empty($footer) ): ?>
			<?php greenmart_tbay_display_footer_builder(); ?>
		<?php else: ?>
			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer">
					<div class="container">
						<div class="row">
							<?php dynamic_sidebar( 'footer' ); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if( !empty($copyright) ) : ?>
				<div class="tbay-copyright">
					<div class="container">
						<div class="copyright-content">
							<div class="text-copyright text-center">
							
								<?php echo trim($copyright); ?>

							</div> 
						</div>
					</div>
				</div>

			<?php else: ?>
				<div class="tbay-copyright">
					<div class="container">
						<div class="copyright-content">
							<div class="text-copyright text-center">
							<?php
								$allowed_html_array = array( 'a' => array('href' => array() ) );
								echo wp_kses(__('Copyright &copy; 2022 - greenmart. All Rights Reserved. <br/> Powered by <a href="//thembay.com/">ThemBay</a>', 'greenmart'), $allowed_html_array);
							
							?>

							</div> 
						</div>
					</div>
				</div>

			<?php endif; ?>	
			
		<?php endif; ?>			
	</footer><!-- .site-footer -->

	<?php $tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type') );
		if ( empty($tbay_header) ) {
			$tbay_header = 'v1';
		}
	?>
	
	<?php 

	$_id = greenmart_tbay_random_key();

	?>

	<?php
	if ( greenmart_tbay_get_config('back_to_top') ) { ?>
		<div class="tbay-to-top <?php echo esc_attr($tbay_header); ?>">
			
			<?php if( class_exists( 'YITH_WCWL' ) ) { ?>
			<a class="text-skin wishlist-icon" href="<?php $wishlist_url = YITH_WCWL()->get_wishlist_url(); echo esc_url($wishlist_url); ?>"><i class="<?php echo greenmart_get_icon('icon_wishlist'); ?>" aria-hidden="true"></i><span class="count_wishlist"><?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_attr($wishlist_count); ?></span></a>
			<?php } ?>
			
			
			<?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
			<!-- Setting -->
			<div class="tbay-cart top-cart hidden-xs">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mini-cart">
					<i class="<?php echo greenmart_get_icon('icon_cart'); ?>"></i>
					<span class="mini-cart-items-fixed">
					   <?php echo sprintf( '%d', WC()->cart->cart_contents_count );?>
					</span>
				</a>
			</div>
			<?php endif; ?>
			
			<a href="javascript:void(0);" id="back-to-top">
				<i class="tb-icon tb-icon-zt-arrow-down-1"></i>
			</a>
		</div>
	<?php
	}
	?>
	
	

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>