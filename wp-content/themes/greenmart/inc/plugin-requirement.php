<?php 
/***** Active Plugin ********/
require_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'greenmart_register_required_plugins' );
function greenmart_register_required_plugins() {
  $plugins[] =(array(
    'name'                       => 'WooCommerce',
      'slug'                     => 'woocommerce',
      'required'                 => true,
  ));

  $plugins[] =(array(
    'name'                       => 'MC4WP: Mailchimp for WordPress',
      'slug'                     => 'mailchimp-for-wp',
      'required'                 =>  true
  ));

  $plugins[] =(array(
    'name'                       => 'Contact Form 7',
      'slug'                     => 'contact-form-7',
      'required'                 => true,
  ));

  $plugins[] =(array(
    'name'                     => esc_html__( 'WPBakery Page Builder', 'greenmart' ),
    'slug'                     => 'js_composer',
    'required'                 => true,
    'source'         		       => esc_url( 'plugins.thembay.com/js_composer.zip' ),
  ));

  $plugins[] =(array(
    'name'                     => esc_html__( 'Tbay Framework', 'greenmart' ),
    'slug'                     => 'tbay-framework',
    'required'                 => true ,
    'source'         		   => esc_url( 'plugins.thembay.com/tbay-framework.zip' ),
  ));

  $plugins[] =(array(
    'name'                     => esc_html__( 'Redux – Gutenberg Blocks Library & Framework', 'greenmart' ),
    'slug'                     => 'redux-framework',
    'required'                 => true ,
  ));

  $plugins[] =(array(
    'name'                     => esc_html__( 'Elementor Website Builder', 'greenmart' ),
    'slug'                     => 'elementor',
    'required'                 => true ,
  ));

  $plugins[] =(array(
    'name'                     => esc_html__( 'Variation Swatches for WooCommerce', 'greenmart' ),
      'slug'                     => 'woo-variation-swatches',
      'required'                 =>  true,
      'source'         		   => esc_url( 'downloads.wordpress.org/plugin/woo-variation-swatches.zip' ),
  ));	

  $plugins[] =(array(
    'name'                     => esc_html__( 'YITH WooCommerce Quick View', 'greenmart' ),
      'slug'                     => 'yith-woocommerce-quick-view',
      'required'                 =>  false
  ));	

  $plugins[] =(array(
    'name'                     => esc_html__( 'YITH WooCommerce Frequently Bought Together', 'greenmart' ),
      'slug'                     => 'yith-woocommerce-frequently-bought-together',
      'required'                 =>  false
  ));
  
  $plugins[] =(array(
    'name'                     => esc_html__( 'YITH WooCommerce Wishlist', 'greenmart' ),
      'slug'                     => 'yith-woocommerce-wishlist',
      'required'                 =>  false
  ));

  if( greenmart_tbay_get_theme() !== 'fresh-el' ) {
    $plugins[] =(array(
      'name'                     => esc_html__( 'YITH Woocommerce Compare', 'greenmart' ),
          'slug'                     => 'yith-woocommerce-compare',
          'required'                 => false
    ));
  } else {
    $plugins[] =(array(
      'name'                     => esc_html__( 'Photo Reviews for WooCommerce', 'greenmart' ),
          'slug'                     => 'woo-photo-reviews',
          'required'                 => false
    ));
  }

  $plugins[] =(array(
    'name'                     => esc_html__( 'Slider Revolution', 'greenmart' ),
    'slug'                     => 'revslider',
    'required'                 => true ,
    'source'         		   => esc_url( 'plugins.thembay.com/revslider.zip' ),
  ));

  $config = array();

  tgmpa( $plugins, $config );
}