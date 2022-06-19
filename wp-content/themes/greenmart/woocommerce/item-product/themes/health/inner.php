<?php 
global $product;

$rating				= wc_get_rating_html( $product->get_average_rating());

$class_product =  ( isset($_GET['display_mode']) && $_GET['display_mode'] == 'list' ) ? 'list' : 'grid';
?>
<div class="product-block <?php  echo esc_attr($class_product); ?> <?php greenmart_class_product(); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="product-content">
		<div class="block-inner">
			<figure class="image">
				<?php woocommerce_show_product_loop_sale_flash(); ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php echo the_permalink(); ?>" class="product-image">
					<?php
						/**
						* woocommerce_before_shop_loop_item_title hook
						*
						* @hooked woocommerce_show_product_loop_sale_flash - 10
						* @hooked woocommerce_template_loop_product_thumbnail - 10
						*/
						remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
						do_action( 'woocommerce_before_shop_loop_item_title' );
					?>
				</a>	
			</figure>
			<?php
				/**
				* greenmart_tbay_after_shop_loop_item_title hook
				*
				*/
				do_action('greenmart_tbay_after_shop_loop_item_title');
			?>
			<div class="groups-button clearfix">
				<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
					<div>
					<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
					<a href="#" class="yith-wcqv-button" title="<?php esc_attr_e('Quick view', 'greenmart'); ?>"  data-product_id="<?php echo esc_attr($product->get_id()); ?>">
						<i class="<?php echo greenmart_get_icon('icon_quick_view'); ?>"> </i>
					</a>
				<?php } ?>
				</div>
				<?php } ?>	
				
				<?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
					<?php
						$action_add = 'yith-woocompare-add-product';
						$url_args = array(
							'action' => $action_add,
							'id' => $product->get_id()
						);
					?>
					<div class="yith-compare">
						<a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" title="<?php esc_attr_e('Compare', 'greenmart'); ?>" class="compare" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
							<i class="<?php echo greenmart_get_icon('icon_compare'); ?>"></i>
						</a>
					</div>
				<?php } ?> 
				<div class="button-wishlist">
					<?php
						$enabled_on_loop = 'yes' == get_option( 'yith_wcwl_show_on_loop', 'no' );
							if( class_exists( 'YITH_WCWL' ) || $enabled_on_loop ) {
							echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
						}
					?>  
				</div>
			</div>
		</div>
		<div class="caption">
			<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			
			<?php
				/**
				* woocommerce_after_shop_loop_item_title hook
				*
				* @hooked woocommerce_template_loop_rating - 5
				* @hooked woocommerce_template_loop_price - 10
				*/
				
				do_action( 'woocommerce_after_shop_loop_item_title');

			?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

			<?php if( is_woocommerce() && !is_singular() && !is_cart() ) : ?>
				<div class="grid-none">
					<div class="description-list"><?php echo  the_excerpt();  ?></div>
		    		<div class="groups-button clearfix">
						<div class="button-wishlist">
							<?php
								if( class_exists( 'YITH_WCWL' ) ) {
									echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
								}
							?>  
						</div>
							
						<?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
							<?php
								$action_add = 'yith-woocompare-add-product';
								$url_args = array(
									'action' => $action_add,
									'id' => $product->get_id()
								);
							?>
							<div class="yith-compare">
								<a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" title="<?php esc_attr_e('Compare', 'greenmart'); ?>" class="compare" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
									<i class="<?php echo greenmart_get_icon('icon_compare'); ?>"></i>
								</a>
							</div>
						<?php } ?>

						<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
							<div>
								<a href="#" class="button yith-wcqv-button" title="<?php esc_attr_e('Quick view', 'greenmart'); ?>"  data-product_id="<?php echo esc_attr($product->get_id()); ?>">
									<i class="<?php echo greenmart_get_icon('icon_quick_view'); ?>"> </i>
								</a>
							</div>
						<?php } ?>
					</div>	 
				</div>

			<?php endif; ?>

		</div>
    </div>
</div>
