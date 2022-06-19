<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<form id="yith-wcwl-form" action="<?php echo esc_url($form_action); ?>" method="post" class="woocommerce">

    <!-- WISHLIST TABLE -->
	<table class="shop_table cart wishlist_table wishlist_view traditional responsive" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo esc_attr( $wishlist_id); ?>" data-token="<?php echo esc_attr($wishlist_token); ?>">

	    <?php $column_count = 2; ?>

        <thead>
        <tr>
	        <?php if( $show_cb ) : ?>

		        <th class="product-checkbox">
			        <input type="checkbox" value="" name="" id="bulk_add_to_cart"/>
		        </th>

	        <?php
		        $column_count ++;
            endif;
	        ?>

            <th class="product-thumbnail"></th>

            <th class="product-name">
                <span class="nobr"><?php echo apply_filters( 'yith_wcwl_wishlist_view_name_heading', esc_html__( 'Product Name', 'greenmart' ) ) ?></span>
            </th>

            <?php if( $show_price ) : ?>

                <th class="product-price">
                    <span class="nobr">
                        <?php echo apply_filters( 'yith_wcwl_wishlist_view_price_heading', esc_html__( 'Unit Price', 'greenmart' ) ) ?>
                    </span>
                </th>

            <?php
	            $column_count ++;
            endif;
            ?>

            <?php if( $show_stock_status ) : ?>

                <th class="product-stock-status">
                    <span class="nobr">
                        <?php echo apply_filters( 'yith_wcwl_wishlist_view_stock_heading', esc_html__( 'Stock Status', 'greenmart' ) ) ?>
                    </span>
                </th>

            <?php
	            $column_count ++;
            endif;
            ?>

            <?php if( $show_last_column ) : ?>

                <th class="product-add-to-cart"><?php esc_html_e( 'Add to cart', 'greenmart' ); ?></th>

            <?php
	            $column_count ++;
            endif;
            ?>

            <?php if( $is_user_owner ): ?>
                <th class="product-remove"><?php esc_html_e( 'Remove', 'greenmart' ); ?></th>
            <?php
                $column_count ++;
            endif;
            ?>

        </tr>
        </thead>

        <tbody>
        <?php
        if( count( $wishlist_items ) > 0 ) :
	        $added_items = array();
            foreach( $wishlist_items as $item ) :
                global $product;

	            $item['prod_id'] = yit_wpml_object_id ( $item['prod_id'], 'product', true );

	            if( in_array( $item['prod_id'], $added_items ) ){
		            continue;
	            }

	            $added_items[] = $item['prod_id'];
	            $product = wc_get_product( $item['prod_id'] );
	            $availability = $product->get_availability();
	            $stock_status = $availability['class'];

                if( $product && $product->exists() ) :
	                ?>
                        <tr id="yith-wcwl-row-<?php echo esc_attr($item['prod_id']); ?>" data-row-id="<?php echo esc_attr($item['prod_id']); ?>">
                            <?php if( $show_cb ) : ?>
                                <td class="product-checkbox">
                                    <input type="checkbox" value="<?php echo esc_attr( $item['prod_id'] ) ?>" name="add_to_cart[]" <?php echo ( ! $product->is_type( 'simple' ) ) ? 'disabled="disabled"' : '' ?>/>
                                </td>
                            <?php endif ?>


                            <td class="product-thumbnail">
                                <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
                                    <?php echo trim($product->get_image()); ?>
                                </a>
                            </td>

                            <td class="product-name">
                                <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>
                                <?php do_action( 'yith_wcwl_table_after_product_name', $item ); ?>
                            </td>

                            <?php if( $show_price ) : ?>
                                <td class="product-price">
                                    <?php 
                                        $html_price = ($product->get_price()) ? $product->get_price_html() : apply_filters( 'yith_free_text', esc_html__( 'Free!', 'greenmart' ) );
                                    ?>
                                    <?php echo trim($html_price); ?>
                                </td>
                            <?php endif ?>

                            <?php if( $show_stock_status ) : ?>
                                <td class="product-stock-status">

                                    <?php 
                                        $html_stock = ($stock_status == 'out-of-stock') ? '<span class="wishlist-out-of-stock">' . esc_html__( 'Out of Stock', 'greenmart' ) . '</span>' : '<span class="wishlist-in-stock">' . esc_html__( 'In Stock', 'greenmart' ) . '</span>';
                                    ?>
                                    <?php echo trim($html_stock); ?>
                                </td>
                            <?php endif ?>

                            <?php if( $show_last_column ): ?>
                            <td class="product-add-to-cart">
                                <!-- Date added -->
                                <?php
                                if( $show_dateadded && isset( $item['dateadded'] ) ):
                                    echo '<span class="dateadded">' . sprintf( esc_html__( 'Added on : %s', 'greenmart' ), date_i18n( get_option( 'date_format' ), strtotime( $item['dateadded'] ) ) ) . '</span>';
                                endif;
                                ?>

                                <!-- Add to cart button -->
                                <?php if( $show_add_to_cart && isset( $stock_status ) && $stock_status != 'out-of-stock' ): ?>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                <?php endif ?>

                                <!-- Change wishlist -->
                                <?php if( $available_multi_wishlist && is_user_logged_in() && count( $users_wishlists ) > 1 && $move_to_another_wishlist && $is_user_owner ): ?>
                                <select class="change-wishlist selectBox">
                                    <option value=""><?php esc_html_e( 'Move', 'greenmart' ) ?></option>
                                    <?php
                                    foreach( $users_wishlists as $wl ):
                                        if( $wl['wishlist_token'] == $wishlist_meta['wishlist_token'] ){
                                            continue;
                                        }

                                    ?>
                                        <option value="<?php echo esc_attr( $wl['wishlist_token'] ) ?>">
                                            <?php
                                            $wl_title = ! empty( $wl['wishlist_name'] ) ? esc_html( $wl['wishlist_name'] ) : esc_html( $default_wishlsit_title );
                                            if( $wl['wishlist_privacy'] == 1 ){
                                                $wl_privacy = esc_html__( 'Shared', 'greenmart' );
                                            }
                                            elseif( $wl['wishlist_privacy'] == 2 ){
                                                $wl_privacy = esc_html__( 'Private', 'greenmart' );
                                            }
                                            else{
                                                $wl_privacy = esc_html__( 'Public', 'greenmart' );
                                            }

                                            echo sprintf( '%s - %s', $wl_title, $wl_privacy );
                                            ?>
                                        </option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <?php endif; ?>
                            </td>

                            <?php if( $show_remove_product ): ?>
                            <td class="product-remove">
                                <div>
                                    <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove remove_from_wishlist" title="<?php esc_attr_e( 'Remove this product', 'greenmart' ) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                     
                                </div>
                            </td>
                            <?php endif; ?>
                            <?php if ($repeat_remove_button) : ?>
                                <td class="product-remove">
                                    <div>
                                        <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove_from_wishlist button" title="<?php esc_attr_e( 'Remove this product', 'greenmart' ) ?>"><?php esc_html_e( 'Remove', 'greenmart' ) ?></a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endif; ?>
                <?php
                endif;
            endforeach;
        else: ?>
            <tr>
                <td colspan="<?php echo esc_attr( $column_count ) ?>" class="wishlist-empty"><?php echo apply_filters( 'yith_wcwl_no_product_to_remove_message', esc_html__( 'No products were added to the wishlist', 'greenmart' ) ) ?></td>
            </tr>
        <?php
        endif;

        if( ! empty( $page_links ) ) : ?>
            <tr class="pagination-row">
                <td colspan="<?php echo esc_attr( $column_count ) ?>"><?php echo esc_html($page_links); ?></td>
            </tr>
        <?php endif ?>
        </tbody>

    </table>

</form>