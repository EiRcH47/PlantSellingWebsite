<div class="media product-block widget-product">
				
	<div class="order"><span><?php echo esc_html($item_order); ?></span></div>
	<div class="media-body">
		<div class="caption">
			<h3 class="name">
				<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_html( $product->get_title() ); ?></a>
			</h3>

			<div class="rating clearfix">
	            <?php  if ($rating_html = wc_get_rating_html( $product->get_average_rating() )) {
            		echo trim( wc_get_rating_html( $product->get_average_rating() ) );
            	} else {
            		echo '<div class="star-rating"></div>';
            	} ?>
	        </div>

			<div class="price"><?php echo trim($product->get_price_html()); ?></div>
			<div class="action-bottom">
                <div class="action-bottom-wrap">
                    <div class="button-groups add-button clearfix">
                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                        <?php
                            $action_add = 'yith-woocompare-add-product';
                            $url_args = array(
                                'action' => $action_add,
                                'id' => $product->get_id()
                            );
                        ?>
                    </div>
                </div>    

            </div>
        </div>
	</div>
</div>