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
		$skin = greenmart_tbay_get_theme();  

		$suffix 		= (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;
		wp_register_script( 'greenmart-autocomplete-js', GREENMART_SCRIPTS_SKINS . '/'.$skin.'/autocomplete-search-init' . $suffix . '.js', array('jquery'), null, true);
		wp_enqueue_script( 'greenmart-autocomplete-js' );
    }    
}
add_action( 'init', 'greenmart_tbay_autocomplete_search' );

if ( !function_exists( 'greenmart_tbay_autocomplete_suggestions' ) ) {
	add_action( 'wp_ajax_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
	add_action( 'wp_ajax_nopriv_greenmart_autocomplete_search', 'greenmart_tbay_autocomplete_suggestions' );
    function greenmart_tbay_autocomplete_suggestions() {
    	check_ajax_referer( 'search_nonce', 'security' ); 
    	 
		$args = array( 
			'post_status'         => 'publish',
			'orderby'         	  => 'relevance',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
		);

		if( ! empty( $_REQUEST['query'] ) ) {
			$search_keyword = $_REQUEST['query'];
			$args['s'] = sanitize_text_field( $search_keyword );
		}	

		if( ! empty( $_REQUEST['post_type'] ) ) {
			$post_type = strip_tags( $_REQUEST['post_type'] );
		}		

		if( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] !== 'post' && class_exists( 'WooCommerce' ) ) {
			$args['meta_query'] = WC()->query->get_meta_query();
			$args['tax_query'] 	= WC()->query->get_tax_query();
		} 

		if( ! empty( $_REQUEST['number'] ) ) {
			$number 	= (int) $_REQUEST['number'];
		}

		if ( isset($_REQUEST['post_type']) && $_REQUEST['post_type'] != 'all') {
        	$args['post_type'] = $_REQUEST['post_type'];
        } 


		if ( isset( $_REQUEST['product_cat'] ) && !empty($_REQUEST['product_cat']) ) {

			if ( $args['post_type'] == 'product' ) {

		    	$args['tax_query'] = array(
			        'relation' => 'AND',
			        array(
			            'taxonomy' => 'product_cat',
			            'field'    => 'slug',
			            'terms'    => $_REQUEST['product_cat']
			    ) );


				if ( version_compare( WC()->version, '2.7.0', '<' ) ) {
				    $args['meta_query'] = array(
				        array(
					        'key'     => '_visibility',
					        'value'   => array( 'search', 'visible' ),
					        'compare' => 'IN'
				        ),
				    );
				} else {
					$product_visibility_term_ids = wc_get_product_visibility_term_ids();
					$args['tax_query'][]         = array(
						'taxonomy' => 'product_visibility', 
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['exclude-from-search'],
						'operator' => 'NOT IN',
					);
				}

        	} else {


		    	$args['tax_query'] = array(
			        'relation' => 'AND',
					array(
			            'taxonomy' => 'category',
			            'field'    => 'id',
			            'terms'    => $_REQUEST['product_cat'],
			        ));

        	}

		}


		$results = new WP_Query( $args );

        $suggestions = array();

        $count = $results->post_count;

		$view_all = ( ($count - $number ) > 0 ) ? true : false;
        $index = 0;
        if( $results->have_posts() ) {

        	if( $post_type == 'product' ) {
				$factory = new WC_Product_Factory(); 
			}


	        while( $results->have_posts() ) {
	        	if( $index == $number ) {
					break;
				}

				$results->the_post();

				if( $count == 1 ) {
					$result_text = esc_html__('result found with', 'greenmart');
				} else {
					$result_text = esc_html__('results found with', 'greenmart');
				}

				if( $post_type == 'product' ) {
					$product = $factory->get_product( get_the_ID() );
					$suggestions[] = array(
						'value' => get_the_title(),
						'link' => get_the_permalink(),
						'price' => $product->get_price_html(),
						'image' => $product->get_image(),
						'result' => '<span class="count">'.$count.' </span> '. $result_text .' <span class="keywork">"'.$search_keyword.'"</span>',
						'view_all' => $view_all,
					);
				} else {
					$suggestions[] = array(
						'value' => get_the_title(),
						'link' => get_the_permalink(),
						'image' => get_the_post_thumbnail( null, 'medium', '' ),
						'result' => '<span class="count">'.$count.' </span> '. $result_text .' <span class="keywork">"'.$search_keyword.'"</span>',
						'view_all' => $view_all,
					);
				}


				$index++;

	        }

	        wp_reset_postdata();
	    } else {
	    	$suggestions[] = array(
				'value' => ( $post_type == 'product' ) ? esc_html__( 'No products found.', 'greenmart' ) : esc_html__( 'No posts...', 'greenmart' ),
				'no_found' => true,
				'link' => '',
				'view_all' => $view_all,
			);
	    }

		echo json_encode( array(
			'suggestions' => $suggestions
		) );

		die();
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
		$blog_left_sidebar = greenmart_tbay_get_config('blog_'.$page.'_left_sidebar');
		$blog_right_sidebar = greenmart_tbay_get_config('blog_'.$page.'_right_sidebar');

        $class_left = 'col-12 col-xl-3';
        $class_right = 'col-12 col-xl-9';
		
		$blog_layout = ( isset($_GET['blog_'.$page.'_layout']) )  ? $_GET['blog_'.$page.'_layout'] : greenmart_tbay_get_config('blog_'.$page.'_layout');

		
		if( $blog_layout === 'left-main' && is_active_sidebar($blog_left_sidebar) ) {
			$configs['left'] = array( 'sidebar' => $blog_left_sidebar, 'class' => $class_left  );
			$configs['main'] = array( 'class' => $class_right ); 
		} elseif( $blog_layout === 'main-right' && is_active_sidebar($blog_right_sidebar) ) {
			$configs['right'] = array( 'sidebar' => $blog_right_sidebar,  'class' => $class_left ); 
			$configs['main'] = array( 'class' => $class_right );
		} else {
			$configs['main'] = array( 'class' => 'col-xs-12 col-12' );
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
			'icon_navigation_menu'		=> 'tb-icon tb-icon-navigation-menu',
			'icon_search'				=> 'tb-icon tb-icon-search-2',
			'icon_search_mobile'		=> 'tb-icon tb-icon-search-2',
			'icon_cart'					=> 'tb-icon tb-icon-shopping-cart',
			'icon_wishlist'				=> 'tb-icon tb-icon-heart-alt',
			'icon_quick_view'			=> 'tb-icon tb-icon-eye-alt',
			'icon_compare'				=> 'tb-icon tb-icon-refresh',
			'icon_owl_left'				=> 'tb-icon tb-icon-simple-left',
			'icon_owl_right'			=> 'tb-icon tb-icon-simple-right',
			'icon_date'					=> 'tb-icon tb-icon-calendar',
			'icon_user'					=> 'tb-icon tb-icon-user',
			'icon_rounded'				=> 'tb-icon tb-icon-rounded-down',
			'icon_comments'				=> 'tb-icon tb-icon-speech-comments',
			'icon_readmore'				=> 'tb-icon tb-icon-long-arrow-right',
			'icon_readmore2'			=> 'tb-icon tb-icon-plus-square',
			'icon_quote_left'			=> 'tb-icon tb-icon-quote-left',
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
					$configs['sidebar'] = array( 'id' => $left, 'class' => 'col-12 col-lg-3'  );
					$configs['main'] 	= array( 'class' => 'col-12 col-lg-9' );
					break;
				case 'main-right':
					$configs['sidebar'] = array( 'id' => $right,  'class' => 'col-12 col-lg-3' ); 
					$configs['main'] 	= array( 'class' => 'col-12 col-lg-9' );
					break;
				case 'main':
					$configs['main'] = array( 'class' => 'col-12' );
					break;
				default:
					$configs['main'] = array( 'class' => 'col-12' );
					break;
			}

			return $configs; 
		}
	}
}

if (!function_exists('greenmart_get_template_product')) {
	function greenmart_get_template_product() {

		$grid 		= greenmart_get_template_product_grid();
		
		$output = array_merge($grid);

	    return $output;
	}
	add_filter( 'greenmart_get_template_product', 'greenmart_get_template_product', 10, 1 ); 
}

if (!function_exists('greenmart_get_template_product_grid')) {
	function greenmart_get_template_product_grid() {
		$skin = greenmart_tbay_get_theme(); 
        $folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';
	    $folderes = glob(GREENMART_THEMEROOT . '/woocommerce/item-product/themes/'.$folder_skin.'/inner-*');
	    $output = [];
		
	    foreach ($folderes as $folder) {
	        $folder = str_replace('.php', '', wp_basename($folder));
			$value 	= str_replace("inner-", '', $folder);
			$folder2 = str_replace('inner-', ' ', $folder);
			$label = str_replace('_', ' ', str_replace('-', ' ', ucfirst($folder2)));
	        $output[$value] = $label;
	    }

	    return $output;
	}
	add_filter( 'greenmart_get_template_product_grid', 'greenmart_get_template_product_grid', 10, 1 ); 
}



if ( !function_exists('greenmart_dokan_theme_store_sidebar') ) {
    function greenmart_dokan_theme_store_sidebar() {
       if(  function_exists('dokan_get_option') && dokan_get_option( 'enable_theme_store_sidebar', 'dokan_appearance', 'off' ) === 'off' && dokan_is_store_page() ) {
		   return true;
	   } else {
		   return false;
	   }
    } 
}

if (!function_exists('greenmart_change_icon_quick_view_prev')) {
	function greenmart_change_icon_quick_view_prev( $icon ) {
		return 'tb-icon tb-icon-simple-left';
    }
	add_filter( 'greenmart_quick_view_prev', 'greenmart_change_icon_quick_view_prev', 10, 1 );
}    

if (!function_exists('greenmart_change_icon_quick_view_next')) {
	function greenmart_change_icon_quick_view_next( $icon ) {
		return 'tb-icon tb-icon-simple-right';
    }
	add_filter( 'greenmart_quick_view_next', 'greenmart_change_icon_quick_view_next', 10, 1 );
}