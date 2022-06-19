<?php   

global $woocommerce; 

if( !greenmart_is_woocommerce_activated() || is_product() || is_cart() || is_checkout() ) return;
?>


<div class="footer-device-mobile visible-xxs clearfix">
    <div class="device-home <?php echo is_front_page() ? 'active' : '' ?> ">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <i class="tb-icon tb-icon-zt-house"></i>
            <?php esc_html_e('Home','greenmart'); ?>
        </a>   
    </div>	

    <?php if ( !greenmart_is_catalog_mode_activated() ) : ?>
        <div class="device-cart <?php echo is_cart() ? 'active' : '' ?>">
            <a class="mobil-view-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" >
                <span class="icon"> 
                    <i class="tb-icon tb-icon-zt-zzcart "></i>
                    <span class="count mini-cart-items cart-mobile"><?php echo sprintf( '%d', $woocommerce->cart->get_cart_contents_count() );?></span>
                    <?php esc_html_e('Cart','greenmart'); ?>
                </span>
            </a>   
        </div>
    <?php endif; ?>

    <?php if ( !greenmart_is_catalog_mode_activated() ) : ?>
        <div class="device-checkout <?php echo is_checkout() ? 'active' : '' ?>">
            <a class="mobil-view-checkout" href="<?php echo esc_url( wc_get_checkout_url() ); ?>" >
                <span class="icon">
                    <i class="tb-icon tb-icon-zt-zzcredit"></i>
                    <?php esc_html_e('Checkout','greenmart'); ?>
                </span>
            </a>   
        </div>
    <?php endif; ?>

    <?php
        $enable 	=  greenmart_tbay_get_config('mobile_footer_menu_recent', true);
        $title 		=  greenmart_tbay_get_config('mobile_footer_menu_recent_title', esc_html__( 'Viewed', 'greenmart' ));
        $icon 		=  greenmart_tbay_get_config('mobile_footer_menu_recent_icon', 'tb-icon tb-icon-history');
        $page_id 	=  greenmart_tbay_get_config('mobile_footer_menu_recent_page');
        
        $active 	= (is_page() && (get_the_ID() == $page_id) ) ? 'active' : '';

        if( !empty($page_id) ) {
            $url = get_permalink($page_id);
        }
    ?> 

    <?php if( $enable && !empty($url) ) : ?>
    <div class="device-recently <?php echo esc_attr($active) ?>">
        <a class="recently-icon" href="<?php echo esc_url($url) ?>">
            <span class="icon">
                <i class="<?php echo esc_attr( $icon ) ?>"></i>
                <?php echo trim($title) ?>
            </span>
        </a>
    </div>
    <?php endif; ?> 

    <div class="device-account <?php echo is_account_page() ? 'active' : '' ?>">
        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login','greenmart'); ?>">
            <i class="tb-icon tb-icon-zz-za-user2"></i>
            <?php esc_html_e('Account','greenmart'); ?> 
        </a>
    </div>
</div>