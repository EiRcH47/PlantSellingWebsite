<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Greenmart_Elementor_Addons {
	public function __construct() {
        $this->include_control_customize_widgets();
        $this->include_render_customize_widgets();

		add_action( 'elementor/elements/categories_registered', array( $this, 'add_category' ) );

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'include_widgets' ) );

		add_action( 'wp', [ $this, 'regeister_scripts_frontend' ] );

        // frontend
        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [ $this, 'frontend_after_register_scripts' ]);
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'frontend_after_enqueue_scripts' ] );

        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_icons'], 99);

        // editor 
        add_action('elementor/editor/after_register_scripts', [ $this, 'editor_after_register_scripts' ]);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_after_enqueue_scripts'] );

    
        add_action( 'widgets_init', array( $this, 'register_wp_widgets' ) );
    }  

    public function editor_after_register_scripts() { 
        $skin = greenmart_tbay_get_theme();

        $suffix = (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;
        // /*slick jquery*/
        wp_register_script( 'slick', GREENMART_SCRIPTS . '/slick' . $suffix . '.js', array(), '1.0.0', true );

        wp_register_script( 'popper', GREENMART_SCRIPTS . '/popper' . $suffix . '.js', array(), '1.12.9', true );    

        if( $skin === 'organic-el' || $skin === 'fresh-el') { 
            wp_register_script( 'bootstrap', GREENMART_SCRIPTS . '/bootstrap/bootstrap-4/bootstrap' . $suffix . '.js', array( 'jquery','popper' ), '4.3.1', true );
        } else {
            wp_register_script( 'bootstrap', GREENMART_SCRIPTS . '/bootstrap/bootstrap-3/bootstrap' . $suffix . '.js', array( 'jquery' ), '3.3.5', true );
            wp_register_script( 'owl-carousel', GREENMART_SCRIPTS . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
        }

        /*Treeview menu*/
        wp_register_script( 'jquery-treeview', GREENMART_SCRIPTS . '/jquery.treeview' . $suffix . '.js', array( ), '1.4.0', true ); 
     
        wp_register_style( 'jquery-fancybox', GREENMART_STYLES . '/jquery.fancybox.css', array(), '3.2.0' );
        wp_register_script( 'jquery-fancybox', GREENMART_SCRIPTS . '/jquery.fancybox' . $suffix . '.js', array( 'jquery' ), '20150315', true );
        
        // Add js Sumoselect version 3.0.2
        wp_register_style('sumoselect', GREENMART_STYLES . '/sumoselect.css', array(), '1.0.0', 'all');
        wp_register_script('jquery-sumoselect', GREENMART_SCRIPTS . '/jquery.sumoselect' . $suffix . '.js', array(), '3.0.2', TRUE); 
 
        wp_register_script( 'greenmart-script',  GREENMART_SCRIPTS . '/functions' . $suffix . '.js', array(),  GREENMART_THEME_VERSION,  true );
    }    

    public function frontend_after_enqueue_scripts() {

    }  

    public function editor_after_enqueue_scripts() { 

    } 

    public function enqueue_editor_icons() {

        wp_enqueue_style( 'font-awesome', GREENMART_STYLES . '/font-awesome.css', array(), '4.5.0' );
        wp_enqueue_style( 'simple-line-icons', GREENMART_STYLES . '/simple-line-icons.css', array(), '2.4.0' );
        wp_enqueue_style( 'greenmart-font-tbay-custom', GREENMART_STYLES . '/font-tbay-custom.css', array(), '1.0.0' );

        if ( greenmart_elementor_is_edit_mode() || greenmart_elementor_is_preview_page() || greenmart_elementor_is_preview_mode() ) {
            wp_enqueue_style( 'greenmart-elementor-editor', GREENMART_STYLES . '/elementor-editor.css', array(), GREENMART_THEME_VERSION );
        }
    }


    /**
     * @internal Used as a callback
     */
    public function frontend_after_register_scripts() {
        $this->editor_after_register_scripts();
    }


	public function register_wp_widgets() {

	}

	function regeister_scripts_frontend() {
		
    }


    public function add_category() {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'greenmart-elements',
            array(
                'title' => esc_html__('Greenmart Elements', 'greenmart'),
                'icon'  => 'fa fa-plug',
            ),
            1);
    }

    /**
     * @param $widgets_manager Elementor\Widgets_Manager
     */
    public function include_widgets($widgets_manager) {
        $this->include_abstract_widgets($widgets_manager);
        $this->include_general_widgets($widgets_manager);
        $this->include_header_widgets($widgets_manager);
        $this->include_woocommerce_widgets($widgets_manager);
        $this->include_fresh_el_widgets($widgets_manager);
	} 


    /**
     * Widgets General Theme
     */
    public function include_general_widgets($widgets_manager) {

        $elements = array(
            'template',  
            'heading',  
            'features', 
            'brands',
            'posts-grid',
            'our-team',
            'testimonials',
            'button',
            'menu-vertical',
            'home-banner',
        );

        if( class_exists('MC4WP_MailChimp') ) {
            array_push($elements, 'newsletter');
        }


        $elements = apply_filters( 'greenmart_general_elements_array', $elements );

        foreach ( $elements as $file ) {
            $path   = GREENMART_ELEMENTOR .'/elements/general/' . $file . '.php';
            if( file_exists( $path ) ) {
                require_once $path;
            }
        }

    }    

    /**
     * Widgets WooComerce Theme
     */
    public function include_woocommerce_widgets($widgets_manager) {
        if( !greenmart_is_Woocommerce_activated() ) return;

        $woo_elements = array(
            'products',
            'product-category',
            'product-tabs',
            'woocommerce-tags',
            'product-categories-tabs',
            'list-categories-product',
            'product-recently-viewed',
            'products-width-banner',
            'custom-image-list-categories',
            'product-count-down',
            'product-flash-sales',
        );

        $woo_elements = apply_filters( 'greenmart_woocommerce_elements_array', $woo_elements );

        foreach ( $woo_elements as $file ) {
            $path   = GREENMART_ELEMENTOR .'/elements/woocommerce/' . $file . '.php';
            if( file_exists( $path ) ) {
                require_once $path;
            }
        }

    }    
    public function include_fresh_el_widgets($widgets_manager) {
        $active_theme = greenmart_tbay_get_theme();
        $skin = 'fresh-el';
        if( !greenmart_is_Woocommerce_activated() || ($active_theme !== $skin) ) return;

        $widget1   = GREENMART_ELEMENTOR .'/elements/skins/'. $skin .'/product-recently-viewed.php';
        if( file_exists( $widget1 ) ) {
            require_once $widget1;
        }   
        $widget2   = GREENMART_ELEMENTOR .'/elements/skins/'. $skin .'/products-width-banner.php';
        if( file_exists( $widget2 ) ) {
            require_once $widget2;
        }  
         
        $widget3   = GREENMART_ELEMENTOR .'/elements/skins/'. $skin .'/product-flash-sales.php';
        if( file_exists( $widget3 ) ) {
            require_once $widget3;
        }  
         
        $widget4   = GREENMART_ELEMENTOR .'/elements/skins/'. $skin .'/custom-image-list-tags.php';
        if( file_exists( $widget4 ) ) {
            require_once $widget4;
        }  

    }    

    /**
     * Widgets Header Theme
     */
    public function include_header_widgets($widgets_manager) {

        $elements = array(
            'site-logo',
            'nav-menu',
        ); 

        if( greenmart_is_Woocommerce_activated() ) {
            array_push($elements, 'account', 'search-form', 'mini-cart','search-popup');
        }

        if( class_exists('WOOCS_STARTER') ) {
            array_push($elements, 'currency');
        } 

        if( class_exists( 'YITH_WCWL' ) ) {
            array_push($elements, 'wishlist');
        }


        if( defined('TBAY_ELEMENTOR_DEMO') || class_exists('SitePress') ) {
            array_push($elements, 'custom-language');
        }

        $elements = apply_filters( 'greenmart_header_elements_array', $elements );

        foreach ( $elements as $file ) {
            $path   = GREENMART_ELEMENTOR .'/elements/header/' . $file . '.php';
            if( file_exists( $path ) ) {
                require_once $path;
            }
        }

    }


    /**
     * Widgets Abstract Theme
     */
    public function include_abstract_widgets($widgets_manager) {
        $abstracts = array(
            'image',
            'base',
            'responsive',
            'carousel',
        );

        $abstracts = apply_filters( 'greenmart_abstract_elements_array', $abstracts );

        foreach ( $abstracts as $file ) {
            $path   = GREENMART_ELEMENTOR .'/abstract/' . $file . '.php';
            if( file_exists( $path ) ) {
                require_once $path;
            }
        } 
    }

    public function include_control_customize_widgets() {
        $widgets = array(
            'sticky-header',
            'column',
            'column-border', 
            'section-stretch-row',
            'settings-layout',
        );

        $widgets = apply_filters( 'greenmart_customize_elements_array', $widgets );
 
        foreach ( $widgets as $file ) {
            $control   = GREENMART_ELEMENTOR .'/elements/customize/controls/' . $file . '.php';
            if( file_exists( $control ) ) {
                require_once $control;
            }            
        } 
    }    

    public function include_render_customize_widgets() {
        $widgets = array(
            'sticky-header',
            'column-border',
        );

        $widgets = apply_filters( 'greenmart_customize_elements_array', $widgets );
 
        foreach ( $widgets as $file ) {
            $render    = GREENMART_ELEMENTOR .'/elements/customize/render/' . $file . '.php';         
            if( file_exists( $render ) ) {
                require_once $render;
            }
        } 
    }
}

new Greenmart_Elementor_Addons();

