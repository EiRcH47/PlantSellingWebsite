<?php
/**
 * greenmart functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage greenmart
 * @since greenmart 4.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since greenmart 4.0
 */
define( 'GREENMART_THEME_VERSION', '4.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Define constants.
 * ------------------------------------------------------------------------------------------------
 */
define( 'GREENMART_THEME_DIR', 		get_template_directory_uri() );
define( 'GREENMART_THEMEROOT', 		get_template_directory() );
define( 'GREENMART_IMAGES', 			GREENMART_THEME_DIR . '/images' );
define( 'GREENMART_SCRIPTS', 			GREENMART_THEME_DIR . '/js' ); 
define( 'GREENMART_SCRIPTS_SKINS', 	GREENMART_SCRIPTS . '/skins' );
define( 'GREENMART_STYLES', 			GREENMART_THEME_DIR . '/css' );
define( 'GREENMART_STYLES_SKINS', 	GREENMART_STYLES . '/skins' );

define( 'GREENMART_INC', 				'/inc' );
define( 'GREENMART_MERLIN', 			GREENMART_INC . '/merlin' );
define( 'GREENMART_CLASSES', 			GREENMART_INC . '/classes' );
define( 'GREENMART_ELEMENTOR', 		         GREENMART_THEMEROOT . '/inc/vendors/elementor' );
define( 'GREENMART_ELEMENTOR_TEMPLATES',     GREENMART_THEMEROOT . '/elementor_templates' );
define( 'GREENMART_VENDORS', 			GREENMART_INC . '/vendors' );
define( 'GREENMART_WIDGETS', 			GREENMART_INC . '/widgets' );

define( 'GREENMART_ASSETS', 			GREENMART_THEME_DIR . '/inc/assets' );
define( 'GREENMART_ASSETS_IMAGES', 	GREENMART_ASSETS    . '/images' );

define( 'GREENMART_MIN_JS', '' );
 

if ( ! function_exists( 'greenmart_tbay_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since greenmart 2.1.6
 */
function greenmart_tbay_setup() {
 
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on greenmart, use a find and replace
	 * to change 'greenmart' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'greenmart', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'css/editor-style.css', greenmart_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption','search-popup'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = greenmart_tbay_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'greenmart_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

    if( apply_filters('greenmart_remove_widgets_block_editor', true) ) {
        remove_theme_support( 'block-templates' );
        remove_theme_support( 'widgets-block-editor' );

        /*Remove extendify--spacing--larg CSS*/
        update_option('use_extendify_templates', '');
    }  
	
	greenmart_tbay_private_get_load_plugins();
}
endif; // greenmart_tbay_setup
add_action( 'after_setup_theme', 'greenmart_tbay_setup' );

/*
* Remove config default media
*
*/
if(greenmart_tbay_get_global_config('config_media',false)) {
	remove_action( 'after_setup_theme', 'theme_setup_size_image' );
}



function greenmart_tbay_include_files($path) {
    $files = glob( $path );
    if ( ! empty( $files ) ) {
        foreach ( $files as $file ) {
            include $file;
        }
    }
}

/**
 * Enqueue scripts and styles.
 *
 * @since greenmart 2.1.6
 */
function greenmart_tbay_scripts() { 
	
	$menu_option 	= apply_filters( 'greenmart_menu_mobile_option', 10,2 );
	$suffix 		= (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;

	//load font awesome
	wp_enqueue_style( 'font-awesome', GREENMART_STYLES . '/font-awesome.css', array(), '4.5.0' );

	//load font custom icon tbay
	wp_enqueue_style( 'font-tbay', GREENMART_STYLES . '/font-tbay-custom.css', array(), '1.0.0' );
	
	//load font simple-line-icons
	wp_enqueue_style( 'simple-line-icons', GREENMART_STYLES . '/simple-line-icons.css', array(), '2.4.0' );
	
	//load font material-design-iconic-font
	wp_enqueue_style( 'material-design-iconic-font', GREENMART_STYLES . '/material-design-iconic-font.min.css', array(), '2.2.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate', GREENMART_STYLES . '/animate.css', array(), '3.5.0' );

	$skin = greenmart_tbay_get_theme();
	// Load our main stylesheet.
	if( is_rtl() ){
		
		if ( $skin != 'default' && $skin ) {
			$css_path =  GREENMART_STYLES_SKINS . '/'.$skin.'/template.rtl.css';
		} else {
			$css_path =  GREENMART_STYLES . '/template.rtl.css';
		}
	}
	else{
		if ( $skin != 'default' && $skin ) {
			$css_path =  GREENMART_STYLES_SKINS . '/'.$skin.'/template.css';
		} else {
			$css_path =  GREENMART_STYLES . '/template.css';
		}
	}

	if( $skin === 'organic' ) {
		//load font ico-font
		wp_enqueue_style( 'icofont', GREENMART_STYLES . '/icofont.css', array(), '1.0.1' );
	}

	$template_deps = array();
	if( $skin === 'organic-el' || $skin === 'fresh-el' ) {
		if( is_rtl() ){
			wp_enqueue_style( 'bootstrap', GREENMART_STYLES . '/bootstrap.rtl.css', array(), '4.3.1' );
		}else{
			wp_enqueue_style( 'bootstrap', GREENMART_STYLES . '/bootstrap.css', array(), '4.3.1' );
		}
		array_push($template_deps, 'bootstrap');
	}

	if( greenmart_elementor_is_activated() ) {
		array_push($template_deps, 'elementor-frontend'); 
	} 

	wp_enqueue_style( 'greenmart-template', $css_path, $template_deps, GREENMART_THEME_VERSION );
	
	$footer_style = greenmart_tbay_print_style_footer();
	if ( !empty($footer_style) ) {
		wp_add_inline_style( 'greenmart-template', $footer_style );
	} 

	$custom_style = greenmart_tbay_custom_styles();
	if ( !empty($custom_style) ) {
		wp_add_inline_style( 'greenmart-template', $custom_style );
	}
	
	greenmart_get_elementor_scripts();
	
	// load Sumoselect version 1.0.0
	wp_enqueue_style('sumoselect', GREENMART_STYLES . '/sumoselect.css', array(), '1.0.0', 'all');
	// Add js Sumoselect version 3.0.2
	wp_enqueue_script('jquery-sumoselect', GREENMART_SCRIPTS . '/jquery.sumoselect' . $suffix . '.js', array(), '3.0.2', TRUE);


	// load fancybox
	wp_enqueue_style( 'jquery-fancybox', GREENMART_STYLES . '/jquery.fancybox.css', array(), '3.2.0' );
	wp_enqueue_script( 'jquery-fancybox', GREENMART_SCRIPTS . '/jquery.fancybox' . $suffix . '.js', array( 'jquery' ), '20150315', true );
	
	wp_enqueue_script( 'skip-link-fix', GREENMART_SCRIPTS . '/skip-link-fix' . $suffix . '.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_dequeue_script('revmin');
	wp_enqueue_script( 'revmin');

	/*mmenu menu*/
	if( $menu_option == 'smart_menu' ){
		wp_enqueue_script( 'jquery-mmenu', GREENMART_SCRIPTS . '/jquery.mmenu' . $suffix . '.js', array( 'jquery' ), '7.0.5', true );
	}

	/*Treeview menu*/
	wp_enqueue_style( 'jquery-treeview', GREENMART_STYLES . '/jquery.treeview.css', array(), '1.0.0' );
	wp_enqueue_script( 'jquery-treeview', GREENMART_SCRIPTS . '/jquery.treeview' . $suffix . '.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'js-cookie', GREENMART_SCRIPTS . '/js.cookie' . $suffix . '.js', array(), '2.1.4', true ); 

	if( $skin === 'organic-el' || $skin === 'fresh-el' ) { 
		wp_enqueue_script( 'popper', GREENMART_SCRIPTS . '/bootstrap/bootstrap-4/popper' . $suffix . '.js', array(), '1.12.9', true );
		wp_enqueue_script( 'bootstrap', GREENMART_SCRIPTS . '/bootstrap/bootstrap-4/bootstrap' . $suffix . '.js', array( 'jquery','popper' ), '4.3.1', true );
	} else {
		wp_enqueue_script( 'bootstrap', GREENMART_SCRIPTS . '/bootstrap/bootstrap-3/bootstrap' . $suffix . '.js', array( 'jquery' ), '3.3.5', true );
	}
    
	wp_enqueue_script('waypoints', GREENMART_SCRIPTS . '/jquery.waypoints' . $suffix . '.js', array(), '4.0.0', true);
    
	wp_enqueue_script( 'detectmobilebrowser', GREENMART_SCRIPTS . '/detectmobilebrowser' . $suffix . '.js', array( 'jquery' ), '1.0.6', true );
	
 
	wp_dequeue_script('wpb_composer_front_js');
	wp_enqueue_script( 'wpb_composer_front_js');

	if ($skin !== 'organic-el' && $skin !== 'fresh-el') {
		wp_enqueue_script( 'owl-carousel', GREENMART_SCRIPTS . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
	}

	wp_enqueue_script( 'greenmart-woocommerce', GREENMART_SCRIPTS . '/woocommerce' . $suffix . '.js', array( 'jquery' ), GREENMART_THEME_VERSION, true );

	wp_enqueue_script( 'jquery-countdowntimer', GREENMART_SCRIPTS . '/jquery.countdownTimer' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );

	wp_register_script( 'greenmart-script',  GREENMART_SCRIPTS . '/functions' . $suffix . '.js', array( 'jquery' ), GREENMART_THEME_VERSION, true );   

	wp_register_script( 'greenmart-skins-script', GREENMART_SCRIPTS_SKINS . '/' . $skin .'/' . $skin. $suffix . '.js', array( 'greenmart-script' ), GREENMART_THEME_VERSION, true );

	wp_enqueue_script( 'greenmart-skins-script' );
	if ( greenmart_tbay_get_config('header_js') != "" ) {
		wp_add_inline_script( 'jquery-core', greenmart_tbay_get_config('header_js') );
	}
	
	wp_enqueue_style( 'greenmart-style', GREENMART_STYLES . '/style.css', array(), GREENMART_THEME_VERSION, '1.0' );

	$config = greenmart_localize_translate();

	wp_localize_script( 'greenmart-script', 'greenmart_settings', $config );

}
add_action( 'wp_enqueue_scripts', 'greenmart_tbay_scripts', 100 );

if (!function_exists('greenmart_localize_translate')) {
    function greenmart_localize_translate()
    { 
		global $wp_query; 
		$skin = greenmart_tbay_get_theme();

		$greenmart_hash_transient = get_transient( 'greenmart-hash-time' );
		if ( false === $greenmart_hash_transient ) {
			$greenmart_hash_transient = time();
			set_transient( 'greenmart-hash-time', $greenmart_hash_transient );
		}

		$config = array( 
			'storage_key'  			=> apply_filters( 'greenmart_storage_key', 'greenmart_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() . $greenmart_hash_transient ) ),
			'active_theme' 			=> greenmart_tbay_get_config('active_theme', 'organic'), 
			'ajaxurl' 				=> admin_url( 'admin-ajax.php' ),
			'search_nonce' 			=> wp_create_nonce('search_nonce'),
			'cancel' 				=> esc_html__('cancel', 'greenmart'),
			'mobile' 				=> (wp_is_mobile()) ? true : false,
			'search' 				=> esc_html__('Search', 'greenmart'),
			'posts'             	=> json_encode( $wp_query->query_vars ), // everything about your loop is here
			'view_all' 				=> esc_html__('View all results', 'greenmart'),
			'no_results' 			=> esc_html__('No results found', 'greenmart'),
		); 
		 
		
		$config['skin_elementor'] = ( $skin === 'organic-el' || $skin === 'fresh-el' ) ? true : false;
		$config['skin_elementor_fresh'] = $skin === 'fresh-el'  ? true : false;
		/*Element ready default callback*/   	   
		if( greenmart_elementor_is_activated() ) { 
			$config['elements_ready'] = array(
				'slick'               => greenmart_elements_ready_slick(),
				'ajax_tabs'           => greenmart_elements_ajax_tabs(),
				'countdowntimer'      => greenmart_elements_ready_countdown_timer(),	 
				'layzyloadimage'      => greenmart_elements_ready_layzyload_image(),	
			);

			$config['combined_css'] = greenmart_get_elementor_css_print_method();
		}

		$config['quick_view']['prev']          	=  apply_filters( 'greenmart_quick_view_prev', 'fa fa-angle-left');     
		$config['quick_view']['next']          	=  apply_filters( 'greenmart_quick_view_next', 'fa fa-angle-right');   
	
		if( greenmart_is_woocommerce_activated() ) {
			$config['ajax_single_add_to_cart'] 		= (bool) greenmart_tbay_get_config('ajax_single_add_to_cart', false);
			$config['ajax_update_quantity'] 		= (bool) greenmart_tbay_get_config('ajax_update_quantity', true);
			$config['enable_ajax_add_to_cart'] 		= ( get_option('woocommerce_enable_ajax_add_to_cart') === 'yes' ) ? true : false;
			$config['quantity_mode'] 				= greenmart_tbay_woocommerce_quantity_mode_active();
			$config['wc_ajax_url']          		=  WC_AJAX::get_endpoint('%%endpoint%%');       
			$config['swatches_pro']          		=  greenmart_is_woo_variation_swatches_pro();       
		}

        return apply_filters('greenmart_localize_translate', $config);
    }
}

function greenmart_tbay_footer_scripts() {
	if ( greenmart_tbay_get_config('footer_js') != "" ) {
		$footer_js = greenmart_tbay_get_config('footer_js');
		echo trim($footer_js);
	}
}
add_action('wp_footer', 'greenmart_tbay_footer_scripts');

add_action( 'admin_enqueue_scripts', 'greenmart_tbay_load_admin_styles' );
function greenmart_tbay_load_admin_styles() {
	wp_enqueue_style( 'greenmart-custom-admin', get_template_directory_uri() . '/css/admin/custom-admin.css', false, '1.0.0' );
}  


/**
 * Display descriptions in main navigation.
 *
 * @since greenmart 2.1.6
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function greenmart_tbay_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'greenmart_tbay_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since greenmart 2.1.6
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function greenmart_tbay_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'greenmart_tbay_search_form_modify' );

function greenmart_tbay_get_config($name, $default = '') {
	global $tbay_options;
    if ( isset($tbay_options[$name]) ) {
        return $tbay_options[$name];
    }
    return $default;
}

if ( ! function_exists( 'greenmart_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function greenmart_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'greenmart' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

function greenmart_tbay_get_global_config($name, $default = '') {
	$options = get_option( 'greenmart_tbay_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

require get_theme_file_path('inc/plugin-requirement.php');

/**Include Merlin Import Demo**/
require_once( get_parent_theme_file_path( GREENMART_MERLIN . '/vendor/autoload.php') );
require_once( get_parent_theme_file_path( GREENMART_MERLIN . '/class-merlin.php') );
require_once( get_parent_theme_file_path( GREENMART_INC . '/merlin-config.php') );

require get_template_directory() . '/inc/functions-helper.php';
require_once( get_parent_theme_file_path( GREENMART_INC . '/skins/'.greenmart_tbay_get_theme().'/functions.php') );
require get_template_directory() . '/inc/functions-frontend.php';


/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/custommenu.php';
require get_template_directory() . '/inc/classes/mmenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php'; 


if ( defined( 'TBAY_FRAMEWORK_REDUX_ACTIVED' ) ) {
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/redux-framework/redux-config.php' );
	define( 'GREENMART_REDUX_FRAMEWORK_ACTIVED', true );
}

if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/cmb2/page.php' );
}
if ( greenmart_is_woocommerce_activated() ) {
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/functions.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/wc-dokan.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/wcfm-multivendor.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/wcmp-vendor.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/wc-vendors.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/wc-advanced-free-shipping.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/yith-wcqv.php' );
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/woocommerce/compatible/woo-photo-reviews.php' );
}
if( greenmart_is_wpbakery_activated() ) {
	greenmart_tbay_include_files( get_template_directory() . '/inc/vendors/visualcomposer/*.php' );
}
if ( defined( 'TBAY_FRAMEWORK_REDUX_ACTIVED' ) ) {
	greenmart_tbay_include_files( get_template_directory() . '/inc/widgets/*.php' );
	define( 'GREENMART_TBAY_FRAMEWORK_ACTIVED', true ); 
	define( 'TBAY_FRAMEWORK_WIDGETS_ACTIVED', true );
}


/**
 * Customizer additions.
 *
 */ 

require_once( get_parent_theme_file_path( GREENMART_INC . '/skins/'.greenmart_tbay_get_theme().'/customizer.php') );

require_once( get_parent_theme_file_path( GREENMART_INC . '/custom-styles.php') );

if( greenmart_elementor_is_activated() ) {
	require_once( get_parent_theme_file_path( GREENMART_VENDORS . '/elementor/class-elementor.php') );
	require_once( get_parent_theme_file_path( GREENMART_VENDORS . '/elementor/class-elementor-pro.php') );
	require_once( get_parent_theme_file_path( GREENMART_VENDORS . '/elementor/icons/icons.php') );
}