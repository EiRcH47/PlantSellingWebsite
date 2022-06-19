<?php

if(!class_exists('WCFMmp')) return;

add_action( 'wcfmmp_before_store', 'woocommerce_breadcrumb' );


if(! function_exists( 'greenmart_tbay_wcfm_addclass_sidebar_right' ) ) {
    function greenmart_tbay_wcfm_addclass_sidebar_right() {
        global $WCFMmp;

    	$store_sidebar_pos = isset( $WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos'] ) ? $WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos'] : 'left';

		if( $WCFMmp->wcfmmp_vendor->is_store_sidebar() && ($store_sidebar_pos != 'left' ) ) {
			return 'wcfm-right';
		}
    }
    add_filter( 'wcfm_store_wrapper_class', 'greenmart_tbay_wcfm_addclass_sidebar_right', 10, 2 );
    add_filter( 'wcfm_store_lists_wrapper_class', 'greenmart_tbay_wcfm_addclass_sidebar_right', 10, 2 );
}

if(!function_exists('greenmart_wcfm_shop_vendor_name')){
    function greenmart_wcfm_shop_vendor_name() {
        global $WCFMmp;

        if( !class_exists('WCFMmp_Frontend') ) return;

        remove_action('woocommerce_after_shop_loop_item_title', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 9 );
        remove_action('woocommerce_after_shop_loop_item', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 50 );
        remove_action('woocommerce_after_shop_loop_item_title', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 50 );

        if( greenmart_tbay_get_theme() !== 'fresh-el' ) {
            add_action('woocommerce_after_shop_loop_item_title', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 1 );
        } else {
            add_action( 'greenmart_before_shop_grid_group_button', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 1 );
            add_action( 'greenmart_after_shop_list_price_sold', array( $WCFMmp->frontend, 'wcfmmp_sold_by_product' ), 1 );
        }
    }
    add_action('woocommerce_before_shop_loop_item_title', 'greenmart_wcfm_shop_vendor_name', 5);
}

if(!function_exists('greenmart_tbay_wcfm_group_info_vendor_single_product_open')){
    function  greenmart_tbay_wcfm_group_info_vendor_single_product_open() {
        global $WCFMmp, $WCFM;

        $vendor_sold_by_position = isset( $WCFMmp->wcfmmp_marketplace_options['vendor_sold_by_position'] ) ? $WCFMmp->wcfmmp_marketplace_options['vendor_sold_by_position'] : 'below_atc';

        if( apply_filters( 'wcfm_is_pref_enquiry', true ) && apply_filters( 'wcfm_is_pref_enquiry_button', true ) && apply_filters( 'wcfm_is_allow_product_enquiry_bubtton', true ) && !defined('DOING_AJAX') ) {

            $wcfm_enquiry_button_position  = isset( $WCFM->wcfm_options['wcfm_enquiry_button_position'] ) ? $WCFM->wcfm_options['wcfm_enquiry_button_position'] : 'bellow_atc';

            if( $wcfm_enquiry_button_position === $vendor_sold_by_position ) { ?>
                <div id="greenmart-wcfm-info-vendor-wrapper" class="has-wcfm-enquiry">

        <?php } else { ?>
            <div id="greenmart-wcfm-info-vendor-wrapper">
        <?php }

        }
    }
}

if(!function_exists('greenmart_tbay_wcfm_group_info_vendor_single_product_close')){
    function  greenmart_tbay_wcfm_group_info_vendor_single_product_close() {
        if( apply_filters( 'wcfm_is_pref_enquiry', true ) && apply_filters( 'wcfm_is_pref_enquiry_button', true ) && apply_filters( 'wcfm_is_allow_product_enquiry_bubtton', true ) && !defined('DOING_AJAX') ) {
            echo '</div>';
        }
    }
}

if(!function_exists('greenmart_tbay_wcfm_vendor_sold_by_position')){
    add_action('woocommerce_before_single_product','greenmart_tbay_wcfm_vendor_sold_by_position', 40);
    function  greenmart_tbay_wcfm_vendor_sold_by_position() {
        global $WCFMmp, $WCFM;

        $vendor_sold_by_position = isset( $WCFMmp->wcfmmp_marketplace_options['vendor_sold_by_position'] ) ? $WCFMmp->wcfmmp_marketplace_options['vendor_sold_by_position'] : 'bellow_atc';

        if( apply_filters( 'wcfm_is_pref_enquiry', true ) && apply_filters( 'wcfm_is_pref_enquiry_button', true ) && apply_filters( 'wcfm_is_allow_product_enquiry_bubtton', true ) && !defined('DOING_AJAX') ) {

            $wcfm_enquiry_button_position  = isset( $WCFM->wcfm_options['wcfm_enquiry_button_position'] ) ? $WCFM->wcfm_options['wcfm_enquiry_button_position'] : 'bellow_atc';

            if( $wcfm_enquiry_button_position === $vendor_sold_by_position ) {


                switch ($wcfm_enquiry_button_position) {
                    case 'bellow_price':
                        remove_action( 'woocommerce_single_product_summary',   array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 15 );
                        add_action('woocommerce_single_product_summary', array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 16 );
                    break;        
                    case 'bellow_sc':
                        remove_action( 'woocommerce_single_product_summary',   array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 25 );
                        add_action('woocommerce_single_product_summary', array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 26 );
                    break;
                     default:
                        remove_action( 'woocommerce_single_product_summary',   array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 35 );
                        add_action('woocommerce_product_meta_start', array( $WCFM->wcfm_enquiry, 'wcfm_enquiry_button' ), 60 );
                    break;
                }
            }

        }
        



        switch ($vendor_sold_by_position) {
            case 'bellow_title':
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_open', 5);
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_close', 9);
            break;         

            case 'bellow_price':
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_open', 12);
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_close', 18);
            break;        

            case 'bellow_sc':
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_open', 22);
                add_action('woocommerce_single_product_summary','greenmart_tbay_wcfm_group_info_vendor_single_product_close', 27);
            break;
             
            default:
                add_action('woocommerce_product_meta_start','greenmart_tbay_wcfm_group_info_vendor_single_product_open', 10);
                add_action('woocommerce_product_meta_start','greenmart_tbay_wcfm_group_info_vendor_single_product_close', 99);
            break;
        }
    }
}


/*Get title vendor name in top bar mobile*/
if ( ! function_exists( 'greenmart_tbay_wcfm_get_title_mobile' ) ) {
    function greenmart_tbay_wcfm_get_title_mobile( $title = '') {
        if( !wcfmmp_is_store_page() ) return $title;

        $wcfm_store_url = wcfm_get_option( 'wcfm_store_url', 'store' );
        $store_name = apply_filters( 'wcfmmp_store_query_var', get_query_var( $wcfm_store_url ) );

        $store_id  = 0;
        if ( !empty( $store_name ) ) {
            $store_user = get_user_by( 'slug', $store_name );
        }

        $store_id           = $store_user->ID;

        if( $store_id ) {
            $store_user        = wcfmmp_get_store( $store_user->ID );
            $store_info        = $store_user->get_shop_info();
            $title = apply_filters( 'wcfmmp_store_title', $store_info['store_name'], $store_user->get_id() );
        }

        return $title;
    }
    add_filter( 'greenmart_get_filter_title_mobile', 'greenmart_tbay_wcfm_get_title_mobile', 10, 1 );
}