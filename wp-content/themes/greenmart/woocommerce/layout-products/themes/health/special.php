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
				<div <?php wc_product_class( $classes, $product ); ?> data-product-id="<?php echo esc_attr($product->get_id()); ?>">
					<div class="product-content">
						<div class="block-inner">
							<figure class="image">
								
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
								remove_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_woo_get_subtitle', 15 );
								do_action( 'woocommerce_after_shop_loop_item_title');
								add_action( 'woocommerce_after_shop_loop_item_title', 'greenmart_woo_get_subtitle', 15 );

							?>
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>
				    </div>	
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php wp_reset_postdata(); ?>