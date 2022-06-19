<?php 
global $product;

$rating				= wc_get_rating_html( $product->get_average_rating());
$flash_sales 		= isset($flash_sales) ? $flash_sales : false;
?>
<div class="product-block grid <?php greenmart_class_product(); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
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
				
				<?php
					/** 
					* greenmart_before_shop_grid_group_button hook
					*
					*/
					do_action('greenmart_before_shop_grid_group_button');
				?>
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
			<?php greenmart_tbay_stock_flash_sale($flash_sales); ?>
			<?php (class_exists( 'YITH_WCBR' )) ? greenmart_brands_get_name($product->get_id()): ''; ?>
			<?php
				/** 
				* greenmart_tbay_after_shop_loop_item_title hook
				*
				*/
				do_action('greenmart_tbay_after_shop_loop_item_title');
			?>

		</div>
		<div class="caption">
			<div class="meta">
				<div class="infor">
					<div class="name-subtitle">
						<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php do_action( 'greenmart_after_title_tbay_subtitle'); ?>
						
					</div>
					<?php 
						do_action('greenmart_woo_after_shop_loop_item_caption');
					?>
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
			<div class="groups-button clearfix">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>		
		</div>
    </div>
</div>
