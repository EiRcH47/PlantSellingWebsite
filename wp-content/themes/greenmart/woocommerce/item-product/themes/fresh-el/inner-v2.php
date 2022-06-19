<?php
global $product;

$rating		= wc_get_rating_html( $product->get_average_rating());
$flash_sales 		= isset($flash_sales) ? $flash_sales : false;
?>
<div class="product-block grid <?php greenmart_class_product(); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="product-content">
		<div class="block-inner">
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			<figure class="image">
				<a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>" class="product-image">
					<?php
						/**
						* woocommerce_before_shop_loop_item_title hook
						*
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
		</div>
		<div class="caption">
			<?php (class_exists( 'YITH_WCBR' )) ? greenmart_brands_get_name($product->get_id()): ''; ?>
			<div class="name-subtitle">
				<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<?php do_action( 'greenmart_after_title_tbay_subtitle'); ?>
				
			</div>
			<?php
				/**
				* woocommerce_after_shop_loop_item_title hook
				*
				* @hooked woocommerce_template_loop_rating - 5
				* @hooked woocommerce_template_loop_price - 10
				*/
				do_action( 'woocommerce_after_shop_loop_item_title');

			?>
			
		</div>
	</div>
</div> 