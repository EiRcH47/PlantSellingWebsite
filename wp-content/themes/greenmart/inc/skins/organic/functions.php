<?php 

if ( !function_exists('greenmart_tbay_private_size_image_setup') ) {
	function greenmart_tbay_private_size_image_setup() {

    	// Be sure your theme supports post-thumbnails
		add_theme_support( 'post-thumbnails' );
		// Post Thumbnails Size
		set_post_thumbnail_size(380, 220, true); // Unlimited height, soft crop

		update_option('thumbnail_size_w', 380);
		update_option('thumbnail_size_h', 220);		

		update_option('medium_size_w', 470);
		update_option('medium_size_h', 272);		

		update_option('large_size_w', 470);
		update_option('large_size_h', 272);


	}
	add_action( 'after_setup_theme', 'greenmart_tbay_private_size_image_setup' );
}
/*
* Remove config default media
*
*/
if(greenmart_tbay_get_global_config('config_media',false)) {
	remove_action( 'after_setup_theme', 'greenmart_tbay_private_size_image_setup' );
}

if ( !function_exists('greenmart_tbay_private_menu_setup') ) {
	function greenmart_tbay_private_menu_setup() {

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu','greenmart' ),
			'mobile-menu' => esc_html__( 'Mobile Menu','greenmart' ),
			'topmenu'  => esc_html__( 'Top Menu', 'greenmart' ),
			'nav-account'  => esc_html__( 'Nav Account', 'greenmart' ),
			'category-menu'  => esc_html__( 'Category Menu', 'greenmart' ),
			'category-menu-image'  => esc_html__( 'Category Menu Image', 'greenmart' ),
			'social'  => esc_html__( 'Social Links Menu', 'greenmart' ),
			'footer-menu'  => esc_html__( 'Footer Menu', 'greenmart' ),
		) );

	}
	add_action( 'after_setup_theme', 'greenmart_tbay_private_menu_setup' );
}

/**
 * Load Google Front
 */
function greenmart_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $Roboto 		= _x( 'on', 'Roboto font: on or off', 'greenmart' );
    $Roboto_Slab    = _x( 'on', 'Roboto Slab font: on or off', 'greenmart' );
 
    if ( 'off' !== $Roboto || 'off' !== $Roboto_Slab ) {
        $font_families = array();
  
        if ( 'off' !== $Roboto ) {
            $font_families[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900';
        }
		
		if ( 'off' !== $Roboto_Slab ) {
            $font_families[] = 'Roboto Slab:100,300,400,700';
        }
 
		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'swap' ),
		); 
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

if ( !function_exists('greenmart_tbay_fonts_url') ) {
	function greenmart_tbay_fonts_url() {  
		$protocol 		  = is_ssl() ? 'https:' : 'http:';
		$show_typography  = greenmart_tbay_get_config('show_typography', false);
		$font_source 	  = greenmart_tbay_get_config('font_source', "1");
		$font_google_code = greenmart_tbay_get_config('font_google_code');
		if( !$show_typography ) {
			wp_enqueue_style( 'greenmart-theme-fonts', greenmart_fonts_url(), array(), null );
		} else if ( $font_source == "2" && !empty($font_google_code) ) {
			wp_enqueue_style( 'greenmart-theme-fonts', $font_google_code, array(), null );
		}
	}
	add_action('wp_enqueue_scripts', 'greenmart_tbay_fonts_url');
}
/**
 * Register Sidebar
 *
 */
if ( !function_exists('greenmart_tbay_widgets_init') ) {
	function greenmart_tbay_widgets_init() {
		
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'greenmart' ),
			'id'            => 'sidebar-default',
			'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Contact Layout 2', 'greenmart' ),
			'id'            => 'top-contact',
			'description'   => esc_html__( 'Add widgets here to appear in Top Contact.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Top Contact Layout 4', 'greenmart' ),
			'id'            => 'top-contact-2',
			'description'   => esc_html__( 'Add widgets here to appear in Top Contact Layout 4.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Header Contact Layout 4', 'greenmart' ),
			'id'            => 'header-contact-v4',
			'description'   => esc_html__( 'Add widgets here to appear in Header Contact Layout 4.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Top Archive Product', 'greenmart' ),
			'id'            => 'top-archive-product',
			'description'   => esc_html__( 'Add widgets here to appear in Top Archive Product.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Blog left sidebar', 'greenmart' ),
			'id'            => 'blog-left-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Blog right sidebar', 'greenmart' ),
			'id'            => 'blog-right-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Product left sidebar', 'greenmart' ),
			'id'            => 'product-left-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Product right sidebar', 'greenmart' ),
			'id'            => 'product-right-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'greenmart' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'greenmart' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
	}
	add_action( 'widgets_init', 'greenmart_tbay_widgets_init' );
}

if ( !function_exists( 'greenmart_tbay_autocomplete_search' ) ) { 
    function greenmart_tbay_autocomplete_search() {
        if ( greenmart_tbay_get_global_config('autocomplete_search') ) {
        	$skin = greenmart_tbay_get_theme();

        	$suffix 		= (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;
            wp_register_script( 'greenmart-autocomplete-js', GREENMART_SCRIPTS_SKINS . '/'.$skin.'/autocomplete-search-init' . $suffix . '.js', array('jquery','jquery-ui-autocomplete'), null, true);
            wp_enqueue_script( 'greenmart-autocomplete-js' );

            add_action( 'wp_ajax_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
            add_action( 'wp_ajax_nopriv_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
        }
    }
}
add_action( 'init', 'greenmart_tbay_autocomplete_search' );

if ( !function_exists( 'greenmart_tbay_autocomplete_suggestions' ) ) {
	add_action( 'wp_ajax_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
	add_action( 'wp_ajax_nopriv_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
    function greenmart_tbay_autocomplete_suggestions() {
    	check_ajax_referer( 'search_nonce', 'security' ); 
		// Query for suggestions
		$search_keyword  = $_REQUEST['term'];

		$args = array(
		    's'                   => $search_keyword,
		    'post_status'         => 'publish',
		    'orderby'         	  => 'relevance',
		    'posts_per_page'      => -1,
		    'ignore_sticky_posts' => 1,
		    'suppress_filters'    => false
		);

		if ( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] != 'all') {
        	$args['post_type'] = $_REQUEST['post_type'];
        } 

        if( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] !== 'post' && greenmart_is_woocommerce_activated() ) {
			$args['meta_query'] = WC()->query->get_meta_query();
			$args['tax_query'] 	= WC()->query->get_tax_query();
		}

		if ( isset( $_REQUEST['category'] ) && !empty($_REQUEST['category']) ) {
		    $args['tax_query'] = array(
		        'relation' => 'AND',
		        array(
		            'taxonomy' => 'product_cat',
		            'field'    => 'slug',
		            'terms'    => $_REQUEST['category']
		        ) );
		}

		if ( version_compare( WC()->version, '2.7.0', '<' ) ) {
		    $args['meta_query'] = array(
		        array(
			        'key'     => '_visibility',
			        'value'   => array( 'search', 'visible' ),
			        'compare' => 'IN'
		        ),
		    );
		}else{
		    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
		    $args['tax_query'][] = array(
		        'taxonomy' => 'product_visibility',
		        'field'    => 'term_taxonomy_id',
		        'terms'    => $product_visibility_term_ids['exclude-from-search'],
		        'operator' => 'NOT IN',
		    );
		}

		$posts = get_posts( $args );

		$style = '';    
		if ( isset($_REQUEST['style']) ) {
		    $style  = $_REQUEST['style'];
		}
        $suggestions = array();
        $show_image = greenmart_tbay_get_config('show_search_product_image', true);
        $show_price = greenmart_tbay_get_config('search_type') == 'product' ? greenmart_tbay_get_config('show_search_product_price') : false;
        $number 	= greenmart_tbay_get_config('search_max_number_results', 5); 
        global $post;
        $count = count($posts); 
        
        $view_all = ( ($count - $number ) > 0 ) ? true : false;
        $index = 0;

        $size_image = 'thumbnail';
        if ( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] === 'product') {
        	$size_image = 'woocommerce_gallery_thumbnail';
        }

        foreach ($posts as $post): setup_postdata($post);
            
            if( $index == $number ) break;

            $suggestion = array();
            $suggestion['label']  = esc_html($post->post_title);
            $suggestion['style']  = $style;
            $suggestion['link']   = get_permalink();
            $suggestion['result'] = '<span class="count">'.$count.' </span> '. esc_html__('result found with', 'greenmart') .' "'.$search_keyword.'" ';

            $suggestion['view_all'] = $view_all;

            if ( $show_image && has_post_thumbnail( $post->ID ) ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size_image );
                $suggestion['image'] = $image[0];
            } else {
                $suggestion['image'] = '';
            }
            if ( $show_price ) { 
				global $product;
                $suggestion['price'] = $product->get_price_html();
            } else {
                $suggestion['price'] = '';
            }

            $suggestions[]= $suggestion;

            $index++;
        endforeach;


        $response = esc_html($_GET["callback"]) . "(" . json_encode($suggestions) . ")";
        echo trim($response);
     
        exit;
    }
}

if ( !function_exists('greenmart_tbay_blog_content_class') ) {
	function greenmart_tbay_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( greenmart_tbay_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'greenmart_tbay_blog_content_class', 'greenmart_tbay_blog_content_class', 1 , 1  );


if ( !function_exists('greenmart_tbay_get_blog_layout_configs') ) {
	function greenmart_tbay_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = greenmart_tbay_get_config('blog_'.$page.'_left_sidebar');
		$right = greenmart_tbay_get_config('blog_'.$page.'_right_sidebar');

		switch ( greenmart_tbay_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-xs-12 col-md-12 col-lg-3'  );
		 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-9' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-xs-12 col-md-12 col-lg-3' ); 
		 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-9' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-xs-12 col-md-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-xs-12 col-md-12 col-lg-3'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-xs-12 col-md-12 col-lg-3' ); 
		 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-6' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12' );
		 		break;
		}

		return $configs; 
	}
}

function greenmart_tbay_private_get_load_plugins() {

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'greenmart' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	tgmpa( $plugins );
}


if ( !function_exists('greenmart_tbay_list_theme_icons') ) {
	function greenmart_tbay_list_theme_icons() {

		$theme_icons = array(
			'icon_sidebar_mobile'		=> 'icon-equalizer icons',
			'icon_navigation_menu'		=> 'icofont-navigation-menu',
			'icon_search'				=> 'icofont-search-2',
			'icon_search_mobile'		=> 'icofont-search-2',
			'icon_cart'					=> 'icofont-shopping-cart',
			'icon_wishlist'				=> 'icofont-heart-alt',
			'icon_quick_view'			=> 'icofont-eye-alt',
			'icon_compare'				=> 'icofont-refresh',
			'icon_owl_left'				=> 'icofont-simple-left',
			'icon_owl_right'			=> 'icofont-simple-right',
			'icon_date'					=> 'icofont-calendar',
			'icon_user'					=> 'icofont-user',
			'icon_rounded'				=> 'icofont-rounded-down',
			'icon_comments'				=> 'icofont-speech-comments',
			'icon_readmore'				=> 'icofont-long-arrow-right',
			'icon_readmore2'			=> 'icofont-plus-square',
			'icon_quote_left'			=> 'icofont-quote-left',
			'icon_menu_mobile'			=> 'fa fa-bars',
			'icon_attribute'			=> 'icon-arrow-right icons',
		);

		return apply_filters( 'greenmart_tbay_list_theme_icons', $theme_icons );
	}
}

if ( !function_exists('greenmart_get_icon') ) {
	function greenmart_get_icon($icon_name) {
		$social_icons = greenmart_tbay_list_theme_icons();

		switch ($icon_name) {
			case $icon_name:
				$icon = $social_icons[$icon_name];
				break;
			
			default:
				$icon = '';
				break;
		}

		return $icon;
	}
}

if ( !function_exists('greenmart_tbay_get_page_layout_configs') ) {
	function greenmart_tbay_get_page_layout_configs() {
		global $post;
		if( isset($post->ID) ) {
			$left = get_post_meta( $post->ID, 'tbay_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'tbay_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'tbay_page_layout', true ) ) {
				case 'left-main':
					$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-xs-12 col-md-12 col-lg-3'  );
					$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-9' );
					break;
				case 'main-right':
					$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-xs-12 col-md-12 col-lg-3' ); 
					$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-9' );
					break;
				case 'main':
					$configs['main'] = array( 'class' => 'clearfix' );
					break;
				case 'left-main-right':
					$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-xs-12 col-md-12 col-lg-3'  );
					$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-xs-12 col-md-12 col-lg-3' ); 
					$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-6' );
					break;
				default:
					$configs['main'] = array( 'class' => 'col-xs-12 col-md-12' );
					break;
			}

			return $configs; 
		}
	}
}

if (! function_exists('greenmart_tbay_megamenu_list_icons')) {
	add_filter( 'tbay_megamenu_list_icons', 'greenmart_tbay_megamenu_list_icons', 20, 1 );
    function greenmart_tbay_megamenu_list_icons($icons)
    {
		$icons['icofont'] = array(
			'title'    	=> 'Icofont',
			'url' 		=> '//icofont.com/icons',
		);

		return $icons;
    }
}