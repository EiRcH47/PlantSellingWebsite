<?php 

if ( !function_exists('greenmart_tbay_private_size_image_setup') ) {
	function greenmart_tbay_private_size_image_setup() {

		update_option('greenmart_avatar_post_carousel', 60, 60, true);
		add_image_size('greenmart_avatar_post_carousel', 60, 60, true); //(cropped)

    	// Be sure your theme supports post-thumbnails
		add_theme_support( 'post-thumbnails' );
		// Post Thumbnails Size
		set_post_thumbnail_size(555, 300, true); // Unlimited height, soft crop

		update_option('thumbnail_size_w', 555);
		update_option('thumbnail_size_h', 300);		

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
    $Playfair    		= _x( 'on', 'Playfair font: on or off', 'greenmart' );
 
    if ( 'off' !== $Roboto || 'off' !== $Playfair ) {
        $font_families = array();
 
        if ( 'off' !== $Roboto ) {
            $font_families[] = 'Roboto:300,400,500,500i,700,900';
        }
		
		if ( 'off' !== $Playfair ) {
            $font_families[] = 'Playfair+Display:400,400i,700,700i,900';
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
			'name'          => esc_html__( 'Top Bar Layout 2', 'greenmart' ),
			'id'            => 'top-bar-layout2',
			'description'   => esc_html__( 'Add widgets here to appear in Top Bar Layout 2', 'greenmart' ),
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
        foreach ($posts as $post): setup_postdata($post);
            
            if( $index == $number ) break;

            $suggestion = array();
            $suggestion['label']  = esc_html($post->post_title);
            $suggestion['style']  = $style;
            $suggestion['link']   = get_permalink();
            $suggestion['result'] = '<span class="count">'.$count.' </span> '. esc_html__('result found with', 'greenmart') .' "'.$search_keyword.'" ';

            $suggestion['view_all'] = $view_all;

            if ( $show_image && has_post_thumbnail( $post->ID ) ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail' );
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


		if ( !is_singular( 'post' ) ) {

			$blog_archive_layout =  ( isset($_GET['blog_archive_layout']) )  ? $_GET['blog_archive_layout'] : greenmart_tbay_get_config('blog_archive_layout', 'main-right');
			if( isset($blog_archive_layout) ) {

				switch ( $blog_archive_layout ) {
						
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
				 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-xs-12 col-md-12 col-lg-3' ); 
				 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-9' );
				 		break;
			    }
			}

		} else {

				$blog_single_layout =	( isset($_GET['blog_single_layout']) ) ? $_GET['blog_single_layout']  :  greenmart_tbay_get_config('blog_single_layout', 'left-main');

				if( isset($blog_single_layout) ) {

					switch ( $blog_single_layout ) {
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
					 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12 col-lg-3' );
			 				break;
					 	default:
					 		$configs['main'] = array( 'class' => 'col-xs-12 col-md-12' );
					 		break;
					 }

				} 
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
			'icon_navigation_menu'		=> 'icons icon-menu',
			'icon_search'				=> 'icons icon-magnifier',
			'icon_search_mobile'		=> 'icons icon-magnifier',
			'icon_cart'					=> 'icons icon-handbag',
			'icon_wishlist'				=> 'icons icon-heart',
			'icon_quick_view'			=> 'icons icon-eye',
			'icon_compare'				=> 'icons icon-shuffle',
			'icon_owl_left'				=> 'icons icon-arrow-left',
			'icon_owl_right'			=> 'icons icon-arrow-right',
			'icon_date'					=> 'icons icon-clock',
			'icon_view'					=> 'icons icon-people',
			'icon_user'					=> 'icons icon-user',
			'icon_cate'					=> 'icons icon-folder',
			'icon_quote_left'			=> 'fa fa-quote-left',
			'icon_quote_right'			=> 'fa fa-quote-right',
			'icon_rounded'				=> 'icofont-rounded-down',
			'icon_comments'				=> 'icofont-speech-comments',
			'icon_readmore'				=> 'icofont-long-arrow-right',
			'icon_readmore2'			=> 'icofont-plus-square',
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

/*Post Views*/
if ( !function_exists('greenmart_set_post_views') ) {
	function greenmart_set_post_views($postID) {
	    $count_key = 'greenmart_post_views_count';
	    $count 		 = get_post_meta($postID, $count_key, true);
	    if( $count == '' ){
	        $count = 1;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '1');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
}

if ( !function_exists('greenmart_track_post_views') ) {
	function greenmart_track_post_views ($post_id) {
	    if ( !is_single() ) return;
	    if ( empty ( $post_id) ) {
	        global $post;
	        $post_id = $post->ID;    
	    }
	    greenmart_set_post_views($post_id);
	}
	add_action( 'wp_head', 'greenmart_track_post_views');
}
if ( !function_exists('greenmart_get_post_views') ) {
	function greenmart_get_post_views($postID, $text = ''){
	    $count_key = 'greenmart_post_views_count';
	    $count = get_post_meta($postID, $count_key, true);

	    if( $count == '' ){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0";
	    }
	    return $count.$text;
	}
}

if ( ! function_exists( 'greenmart_tbay_render_breadcrumbs' ) ) {
	function greenmart_tbay_render_breadcrumbs() {
		global $post;

		$show = true;
		$img = $breadcrumb_class = '';
		$style = array();
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'tbay_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'tbay_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'tbay_page_breadcrumb_color', true );
			$style = array();
			if( $bgcolor  ){
				$style[] = 'background-color:'.$bgcolor;
			}
			if( $bgimage  ){ 
				$img = ' <img src="'.esc_url($bgimage).'">  ';
			}

		} elseif ( is_singular('post') || is_category() || is_home() || is_tag() || is_author() || is_day() || is_month() || is_year()  || is_search() ) {
			$show = greenmart_tbay_get_config('show_blog_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = greenmart_tbay_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = greenmart_tbay_get_config('blog_breadcrumb_color');
	        $style = array();
	        if( $breadcrumb_color  ){
	            $style[] = 'background-color:'.$breadcrumb_color;
				$breadcrumb_class .= ' breadcrumb-color';
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $img = ' <img src="'.$breadcrumb_img['url'].'">  ';
				$breadcrumb_class .= ' breadcrumb-img';
	        }
		}
		$page_title = '';
		if (is_archive()) {
			$page_title = get_the_archive_title();
		} elseif (is_page()) {
			$page_title = $post->post_title;
		}

		$title = '<h1 class="page-title">'.$page_title.'</h1>';

		if( is_page() ) {
			$show = get_post_meta( $post->ID, 'tbay_page_show_title', true );
			if( $show === 'no' ) $title = '';
		}

		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		echo '<section id="tbay-breadscrumb" class="tbay-breadscrumb '. $breadcrumb_class .' " '.$estyle.'>'. ($img) .'<div class="container"><div class="p-relative breadscrumb-inner">';
			greenmart_tbay_breadcrumbs();
		echo '</div>'. $title .'</div></section>';
	}
}


if ( ! function_exists( 'greenmart_get_the_archive_title' ) ) {
	function greenmart_get_the_archive_title() {

		$title = '';
	 	if ( is_category() ) {

	        $title = single_cat_title( '', false );

	    } elseif ( is_tag() ) {

	        $title = single_tag_title( '', false );

	    } elseif ( is_author() ) {

	        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

	    }

	    return $title;
	}

	add_filter( 'get_the_archive_title', 'greenmart_get_the_archive_title');
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