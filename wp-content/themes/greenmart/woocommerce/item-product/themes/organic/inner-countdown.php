<?php 
global $product;

$time_sale = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
?>
   <div class="product-block grid clearfix" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
		<div class="product-content">
			<div class="block-inner">
				<figure class="image">
					<?php woocommerce_show_product_loop_sale_flash(); ?>
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="product-image">
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
					<?php (class_exists( 'YITH_WCBR' )) ? greenmart_brands_get_name($product->get_id()): ''; ?>

					<div class="button-wishlist">
						<?php
							$enabled_on_loop = 'yes' == get_option( 'yith_wcwl_show_on_loop', 'no' );
							if( class_exists( 'YITH_WCWL' ) || $enabled_on_loop ) {
							echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
						}
					?>  
					</div>
					
				</figure>
			
			</div>
			<div class="caption">
			
				<?php if ( $time_sale ): ?>
					<div class="time">
						<div class="tbay-countdown" data-time="timmer" data-days="<?php esc_attr_e('Days','greenmart'); ?>" data-hours="<?php esc_attr_e('Hours','greenmart'); ?>"  data-mins="<?php esc_attr_e('Mins','greenmart'); ?>" data-secs="<?php esc_attr_e('Secs','greenmart'); ?>"
							 data-date="<?php echo gmdate('m', $time_sale).'-'. gmdate('d', $time_sale) .'-'. gmdate('Y', $time_sale) .'-'. gmdate('H', $time_sale) . '-' . gmdate('i', $time_sale) . '-' .  gmdate('s', $time_sale) ; ?>">
						</div>
					</div> 
				<?php endif; ?> 
				
				<div class="meta">
					<div class="infor">
						<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
						<div class="description"><?php echo greenmart_tbay_substring( get_the_excerpt(), 20, '...' ); ?></div>
						 
						<?php
							/**
							* woocommerce_after_shop_loop_item_title hook
							*
							* @hooked woocommerce_template_loop_rating - 5
							* @hooked woocommerce_template_loop_price - 10
							*/
							do_action( 'woocommerce_after_shop_loop_item_title');

						?>
						
					   
						
						<div class="groups-button">
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
							<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
								<a href="#" class="button yith-wcqv-button tbay-tooltip" data-toggle="tooltip" title="<?php esc_attr_e('Quick View', 'greenmart'); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
									<span>
										<i class="<?php echo greenmart_get_icon('icon_quick_view'); ?>"></i>
									</span>
								</a>
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
									<a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" data-toggle="tooltip" title="<?php esc_attr_e('Compare', 'greenmart'); ?>" class="compare tbay-tooltip" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
										<i class="<?php echo greenmart_get_icon('icon_compare'); ?>"></i>
									</a>
								</div>
							<?php } ?> 
						</div>
					</div>
				</div> 
				  
			</div>
        </div>
		
    </div>
		
