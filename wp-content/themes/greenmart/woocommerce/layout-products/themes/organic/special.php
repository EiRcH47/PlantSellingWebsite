<?php
global $woocommerce_loop; 
$woocommerce_loop['columns'] = $columns;

$class = ($columns <= 1) ? 'w-products-list' : 'products products-grid';
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<div class="row">
	 <?php $bcol = 12/$columns; ?>
            
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php 
			global $product;

			// Extra post classes
			$classes = array('products-grid', 'product');
			?>
			<div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-<?php echo esc_attr($bcol); ?> col-xs-12" >
				<div <?php wc_product_class( $classes, $product ); ?>>
					<div class="product-block grid clearfix" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
						<div class="row">
							<div class="block-inner col-lg-5 col-md-5 col-sm-5">
								<figure class="image">
									<?php woocommerce_show_product_loop_sale_flash(); ?>
									<a title="<?php the_title_attribute(); ?>" href="<?php echo  the_permalink(); ?>" class="product-image">
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
						
							</div>
							<div class="caption col-lg-7 col-md-7 col-sm-7">
								<div class="meta">
									<div class="infor">
										<?php (class_exists( 'YITH_WCBR' )) ? greenmart_brands_get_name($product->get_id()): ''; ?>
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
										
										<div class="groups-button clearfix">
											<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
											<?php
												$action_add = 'yith-woocompare-add-product';
												$url_args = array(
													'action' => $action_add,
													'id' => $product->get_id()
												);
											?>
											<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
												<a href="#" class="button yith-wcqv-button" title="<?php esc_attr_e('Quick View', 'greenmart'); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
													<span>
														<i class="<?php echo greenmart_get_icon('icon_quick_view'); ?>"></i>
													</span>
												</a>
											<?php } ?>
											<?php
												if( class_exists( 'YITH_WCWL' ) ) {
													echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
												}
											?>   
									
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
										</div>
									</div>
								</div>    
							</div>    
					    </div>
					</div>	
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php wp_reset_postdata(); ?>