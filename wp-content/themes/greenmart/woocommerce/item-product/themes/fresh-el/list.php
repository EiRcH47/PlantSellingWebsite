<?php 
global $product;

?>
<div class="product-block list" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<?php 
		/**
		* Hook: greenmart_woocommerce_before_shop_list_item.
		*
		* @hooked greenmart_remove_add_to_cart_list_product - 10
		*/
		do_action( 'greenmart_woocommerce_before_shop_list_item' );
	?>
	<div class="product-content row">
		<div class="block-inner col-lg-3 col-4">
			<?php 
				/**
				* Hook: woocommerce_before_shop_loop_item.
				*
				* @hooked woocommerce_template_loop_product_link_open - 10
				*/
				do_action( 'woocommerce_before_shop_loop_item' );
			?>
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

				<div class="group-actions-product">
					<div class="button-wishlist">
						<?php
							$enabled_on_loop = 'yes' == get_option( 'yith_wcwl_show_on_loop', 'no' );
								if( class_exists( 'YITH_WCWL' ) || $enabled_on_loop ) {
								echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
							}
						?>  
					</div>
					<?php if (class_exists('YITH_WCQV_Frontend')) { ?>
						<a href="#" class="button yith-wcqv-button" title="<?php esc_attr_e('Quick view', 'greenmart'); ?>"  data-product_id="<?php echo esc_attr($product->get_id()); ?>">
							<span>
								<i class="<?php echo greenmart_get_icon('icon_quick_view'); ?>"> </i>
								<span><?php esc_html_e('Quickview','greenmart'); ?></span>
							</span>
						</a>
					<?php } ?>
				</div>

				<?php if( class_exists( 'YITH_Woocompare' ) && 'yes' === get_option( 'yith_woocompare_compare_button_in_products_list', 'no') ) { ?>
					<?php
						$action_add = 'yith-woocompare-add-product';
						$url_args = array(
							'action' => $action_add,
							'id' => $product->get_id()
						);
					?>
					<div class="yith-compare">
						<a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>"  class="compare tbay-tooltip" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
							<span>
								<i class="<?php echo greenmart_get_icon('icon_compare'); ?>"></i>
							</span>
						</a>
					</div>
				<?php } ?> 

			</figure>
		</div>

        <div class="caption col-lg-9 col-8">
            <div class="row">
                <div class="col-lg-8">
                    <?php (class_exists( 'YITH_WCBR' )) ? greenmart_brands_get_name($product->get_id()): ''; ?>
                    <div class="name-subtitle">
                        <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                        <?php do_action( 'greenmart_after_title_tbay_subtitle'); ?>
                        
                    </div>

                    <?php
						/**
						* greenmart_get_rating_item hook
						*
						* @hooked woocommerce_template_loop_rating - 5
						*/
						
						do_action( 'greenmart_get_rating_item');

                        if (!empty(get_the_excerpt()) ) {
                            ?>
                            <div class="woocommerce-product-details__short-description">
                                <?php echo get_the_excerpt(); ?>
                            </div>
                            <?php
                        }
                       
					?> 

                </div>
                <div class="col-lg-4">
					<div class="wrapper-price-sold">
						<?php
							/**
							* Hook: greenmart_shop_list_price_sold.
							*/
							do_action( 'greenmart_shop_list_price_sold' );
						?> 
					</div>
					<?php
						/**
						* Hook: woocommerce_template_loop_price.
						*/
						do_action( 'greenmart_after_shop_list_price_sold' );
					?> 
                     <?php 
                        /**
                        * Hook: woocommerce_after_shop_loop_item.
                        */
                        do_action( 'woocommerce_after_shop_loop_item' );
                    ?>

                </div>
            </div>

        </div>
		
	</div>
	<?php 
		do_action( 'greenmart_woocommerce_after_shop_list_item' );
	?>
</div>


