<?php

do_action( 'woocommerce_before_cart' ); ?>

<div class="widget">

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="table-responsive">

<table class="shop_table shop_table_responsive cart  woocommerce-cart-form__contents" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail"><?php esc_html_e( 'Image', 'greenmart' ); ?></th>
			<th class="product-name"><?php esc_html_e( 'Product', 'greenmart' ); ?></th>
			<th class="product-price"><?php esc_html_e( 'Price', 'greenmart' ); ?></th>
			<th class="product-quantity"><?php esc_html_e( 'Quantity', 'greenmart' ); ?></th>
			<th class="product-subtotal"><?php esc_html_e( 'Total', 'greenmart' ); ?></th>
			<th class="product-remove"><?php esc_html_e( 'Remove', 'greenmart' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


				<td class="product-thumbnail">
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo trim($thumbnail);
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
						}
					?>
				</td>

				<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'greenmart' ); ?>">
					<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', esc_html( $_product->get_name() ), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), esc_html( $_product->get_name() ) ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'greenmart' ) . '</p>', $product_id ) );
						}
					?>
				</td>

				<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'greenmart' ); ?>">
					<?php
						echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
				</td>

				<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'greenmart' ); ?>">
					<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'  => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value'     => $_product->get_max_purchase_quantity(),
								'min_value'   => '0',
								'product_name'  => $_product->get_name(),
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
					?>
				</td>

				<td class="product-subtotal price" data-title="<?php esc_attr_e( 'Total', 'greenmart' ); ?>">
					<?php
						echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
					?>
				</td>

				<td class="product-remove">
					<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_html__( 'Remove this item', 'greenmart' ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
					?>
				</td>

				</tr>
			<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">
				<div class="clearfix">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon pull-left">
							<label for="coupon_code"><?php esc_html_e( 'Coupon', 'greenmart' ); ?>:</label> <input type="text" name="coupon_code" class="input-text " id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'greenmart' ); ?>" /> <input type="submit" class="btn btn-default" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'greenmart' ); ?>" />
							<?php do_action('woocommerce_cart_coupon'); ?>
						</div>
					<?php } ?>

					<div class="pull-right">
						<input type="submit" class="btn btn-default" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'greenmart' ); ?>" />

				    <?php do_action( 'woocommerce_cart_actions' ); ?>
						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</div>
				</div>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

</div>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
<div class="cart-collaterals widget">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
