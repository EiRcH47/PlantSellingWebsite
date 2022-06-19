<?php   global $woocommerce; ?>

<?php if ( greenmart_is_woocommerce_activated() ): ?>

    <?php if( is_product() || is_cart() || is_checkout() ) : ?>
    <?php else: ?>
    <div class="footer-device-mobile visible-xxs clearfix">
        <div class="device-home <?php echo is_front_page() ? 'active' : '' ?> ">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                <i class="icon-home icons"></i>
                <?php esc_html_e('Home','greenmart'); ?>
            </a>   
        </div>	

        <?php if ( !greenmart_is_catalog_mode_activated() && greenmart_is_woocommerce_activated() ): ?>
            <div class="device-cart <?php echo is_cart() ? 'active' : '' ?>">
                <a class="mobil-view-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" >
    				<span class="icon">
    					<i class="icon-basket icons"></i>
    					<span class="count mini-cart-items cart-mobile"><?php echo sprintf( '%d', $woocommerce->cart->get_cart_contents_count() );?></span>
    					<?php esc_html_e('View Cart','greenmart'); ?>
    				</span>
                </a>   
            </div>
        <?php endif; ?>


        <?php if( class_exists( 'YITH_WCWL' ) ) { ?>
        <div class="device-wishlist">
            <a class="text-skin wishlist-icon" href="<?php $wishlist_url = YITH_WCWL()->get_wishlist_url(); echo esc_url($wishlist_url); ?>">
    			<span class="icon">
    				<i class="icon-heart icons"></i>
    				<span class="count count_wishlist"><?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_attr($wishlist_count); ?></span>
    				<?php esc_html_e('Wishlist','greenmart'); ?>
    			</span>
            </a>
        </div>
        <?php } ?>

        <?php if ( greenmart_is_woocommerce_activated() ): ?>
        <div class="device-account <?php echo is_account_page() ? 'active' : '' ?>">
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login','greenmart'); ?>">
                <i class="icon-user icons"></i>
                <?php esc_html_e('Account','greenmart'); ?>
            </a>
        </div>
        <?php endif; ?>

    </div>

    <?php endif; ?>
<?php endif; ?>