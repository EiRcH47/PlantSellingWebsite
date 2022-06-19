<?php global $product; ?>
<li class="media product-block widget-product <?php echo (isset($item_order) && ($item_order%2)) ?'first':'last'; ?>">
	<div class="row">
		<?php if((isset($item_order) && $item_order==1) || !isset($item_order)) : ?>
			<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" class="image pull-left">
				<?php echo trim( $product->get_image() ); ?>
				<?php if(isset($item_order) && $item_order==1) { ?> 
					<span class="first-order"><?php echo trim($item_order); ?></span>
				<?php } ?>
			</a>
		<?php endif; ?>
		<?php if(isset($item_order) && $item_order > 1){ ?>
			<div class="order"><span><?php echo trim($item_order); ?></span></div>
		<?php }?>
		
		<div class="media-body meta">
			<h3 class="name">
				<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_html( $product->get_title() ); ?></a>
			</h3>
			<?php add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5); ?>
			<div class="price"><?php echo trim($product->get_price_html()); ?></div>
		</div>
	</div>
</li>


