<?php 

if ( !function_exists('greenmart_tbay_private_size_image_setup') ) {
	function greenmart_tbay_private_size_image_setup() {

    	// Be sure your theme supports post-thumbnails
		add_theme_support( 'post-thumbnails' );
		// Post Thumbnails Size
		set_post_thumbnail_size(360, 187, true); // Unlimited height, soft crop

		update_option('thumbnail_size_w', 360);
		update_option('thumbnail_size_h', 187);		

		update_option('medium_size_w', 540);
		update_option('medium_size_h', 281);		

		update_option('large_size_w', 720);
		update_option('large_size_h', 374);


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
    $Public 		= _x( 'on', 'Public font: on or off', 'greenmart' );
    $Public_Sans    = _x( 'on', 'Public Sans font: on or off', 'greenmart' );
 
    if ( 'off' !== $Public || 'off' !== $Public_Sans ) {
        $font_families = array();
  
        if ( 'off' !== $Public ) {
            $font_families[] = 'Public:100,100i,300,300i,400,400i,500,500i,700,700i,900';
        }
		
		if ( 'off' !== $Public_Sans ) {
            $font_families[] = 'Public Sans:100,300,400,500,600,700';
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
		$skin_js = 'organic-el';     

		$suffix 		= (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;
		wp_register_script( 'greenmart-autocomplete-js', GREENMART_SCRIPTS_SKINS . '/'.$skin_js.'/autocomplete-search-init' . $suffix . '.js', array('jquery'), null, true);
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

        $class_left = 'col-12 col-xl-4';
        $class_right = 'col-12 col-xl-8';
		
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
			'icon_sidebar_mobile'		=> 'tb-icon tb-icon-zz-filter',
			'icon_navigation_menu'		=> 'tb-icon tb-icon-navigation-menu',
			'icon_search'				=> 'tb-icon tb-icon-search-2',
			'icon_search_mobile'		=> 'tb-icon tb-icon-zt-search',
			'icon_cart'					=> 'tb-icon tb-icon-zt-cart',
			'icon_wishlist'				=> 'tb-icon tb-icon-zt-favorite',
			'icon_quick_view'			=> 'tb-icon tb-icon-zt-eye',
			'icon_compare'				=> 'tb-icon tb-icon-refresh',
			'icon_owl_left'				=> 'tb-icon tb-icon-zt-chevron-left',
			'icon_owl_right'			=> 'tb-icon tb-icon-zt-chevron-right',
			'icon_date'					=> 'tb-icon tb-icon-calendar',
			'icon_user'					=> 'tb-icon tb-icon-user',
			'icon_rounded'				=> 'tb-icon tb-icon-rounded-down',
			'icon_comments'				=> 'tb-icon tb-icon-zt-forum',
			'icon_readmore'				=> 'tb-icon tb-icon-long-arrow-right',
			'icon_readmore2'			=> 'tb-icon tb-icon-plus-square',
			'icon_quote_left'			=> 'tb-icon tb-icon-quote-left',
			'icon_menu_mobile'			=> 'tb-icon tb-icon-zt-zzmenu',
			'icon_attribute'			=> 'tb-icon tb-icon-zt-chevron-right', 
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
add_filter( 'greenmart_woo_config_display_mode', 'display_modes_active', 10, 1 );

if (!function_exists('display_modes_active')) {
	function display_modes_active() {
		$active = greenmart_tbay_get_config('enable_display_mode', true);
	
	   $active = (isset($_GET['enable_display_mode'])) ? (boolean)$_GET['enable_display_mode'] : (boolean)$active;
	
	   return $active;
	}
}


if(!function_exists('greenmart_tbay_countdown_flash_sale')){
    function greenmart_tbay_countdown_flash_sale($time_sale = '', $date_title = '', $date_title_ended = '', $strtotime = false) {
        wp_enqueue_script( 'jquery-countdowntimer' );
        $_id        = greenmart_tbay_random_key();

        $today      = strtotime("today");
		$days  = apply_filters( 'greenmart_tbay_countdown_flash_sale_day', '<span class="label">'. esc_html__('days', 'greenmart') .'</span>' ); 
		$hours  = apply_filters( 'greenmart_tbay_countdown_flash_sale_day', '<span class="label">'. esc_html__('hours', 'greenmart') .'</span>' ); 
		$mins  = apply_filters( 'greenmart_tbay_countdown_flash_sale_day', '<span class="label">'. esc_html__('mins', 'greenmart') .'</span>' ); 
		$secs  = apply_filters( 'greenmart_tbay_countdown_flash_sale_day', '<span class="label">'. esc_html__('secs', 'greenmart') .'</span>' ); 

        if( $strtotime ) $time_sale = strtotime($time_sale);

        ?> 
        <?php if( !empty($time_sale) ) : ?>
            <div class="flash-sales-date">
            <?php if ( ($today <= $time_sale) ): ?>
                    <?php if( isset($date_title) && !empty($date_title) ) :  ?>
                        <div class="date-title"><?php echo trim($date_title); ?></div>
                    <?php endif; ?>
                    <div class="time">
                        <div class="tbay-countdown" id="tbay-flash-sale-<?php echo esc_attr($_id);?>" data-time="timmer"
                             data-date="<?php echo gmdate('m', $time_sale).'-'.gmdate('d', $time_sale).'-'.gmdate('Y', $time_sale).'-'. gmdate('H', $time_sale) . '-' . gmdate('i', $time_sale) . '-' .  gmdate('s', $time_sale) ; ?>" data-days="<?php echo esc_attr($days); ?>" data-hours="<?php echo esc_attr( $hours ); ?>" data-mins="<?php echo esc_attr($mins); ?>" data-secs="<?php echo esc_attr($secs); ?>">
                        </div>
                    </div> 
            <?php else: ?>
                <?php if( isset($date_title_ended) && !empty($date_title_ended) ) :  ?>
                    <div class="date-title"><?php echo trim($date_title_ended); ?></div>
                <?php endif; ?> 
            <?php endif; ?> 
            </div> 
        <?php endif; ?> 
        <?php
    }
} 

/*Get query*/
if ( !function_exists('greenmart_tbay_get_boolean_query_var') ) {
    function greenmart_tbay_get_boolean_query_var($config) {
        $active = greenmart_tbay_get_config($config,true);

        $active = (isset($_GET[$config])) ? $_GET[$config] : $active;

        return (boolean)$active;
    }
}

if ( !function_exists('greenmart_the_post_category_full') ) {
	function greenmart_the_post_category_full ($has_separator = true) {
		$post_category = "";
		$categories = get_the_category();
		$separator = ($has_separator) ?  ', ' : '';  
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'greenmart' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
			$post_category = trim($output, $separator);
		}      

		echo trim($post_category);
	}
}

if (!function_exists('greenmart_the_post_comments')) {
    function greenmart_the_post_comments($comments, $comments_text)
    {
		if( !$comments || !comments_open() ) return;

		$text_domain =   esc_html__(' comments','greenmart');    
		if( get_comments_number() == 1) {
			$text_domain = esc_html__(' comment','greenmart');
		}	

		if( !$comments_text ) $text_domain ='';
		?>
		<span class="comments-link"><i class="tb-icon tb-icon-zt-forum"></i>
			<?php comments_popup_link( 
				'0' .'<span>'. $text_domain .'</span>',  
				'1' .'<span>'. $text_domain .'</span>',  
				'%' .'<span>'. $text_domain .'</span>'
			); ?>
		</span>
		<?php 
    }
}

if (!function_exists('greenmart_the_post_short_descriptions')) {
    function greenmart_the_post_short_descriptions($short_descriptions)
    {
		if( !$short_descriptions ) return;
		?>
		<div class="entry-top">
			<?php
				if ( has_excerpt() ) {
						echo the_excerpt();
					} else {
						?>
							<div class="entry-description"><?php echo greenmart_tbay_substring( get_the_excerpt(), 20, '[...]' ); ?></div>
						<?php
					}
				?>
		</div>
		<?php
    }
}

if (!function_exists('greenmart_the_post_read_more')) {
    function greenmart_the_post_read_more($read_more, $custom_readmore)
    {
		if( !$read_more ) return;
		
		?>
		<div class="more">
			<a href="<?php the_permalink(); ?>" class="readmore" title="<?php echo trim($custom_readmore); ?>"><?php echo trim($custom_readmore); ?></a>
		</div>
		<?php
    }
}

if (!function_exists('greenmart_the_post_author')) {
    function greenmart_the_post_author($author)
    {
		if( !$author ) return;

		?>
		<span class="author"><?php echo get_avatar(get_the_author_meta( 'ID' ), 50); ?> <?php the_author_posts_link(); ?></span>
		<?php
    }
}

if (!function_exists('greenmart_the_post_date')) {
    function greenmart_the_post_date($date)
    {
		if( !$date ) return;

		?>
		<span class="entry-date"><?php echo greenmart_time_link(); ?></span>
		<?php
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Display meta information for a specific post
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'greenmart_post_meta' )) {
	function greenmart_post_meta( $atts = array() ) {

		$text_domain =   esc_html__(' comments','greenmart');    
		if( get_comments_number() == 1) {
		    $text_domain = esc_html__(' comment','greenmart');
		}

		extract(shortcode_atts(array(
			'date'    	 	=> 1,
			'author'   		=> 1,
			'author_img'    => 1,
			'comments' 		=> 0,
			'comments_text' => 0,
			'tags'     		=> 0,
			'cats'     		=> 1,
			'edit'     		=> 1,
		), $atts));
		?>
		<?php if( get_post_type() === 'post' ): ?>
			<ul class="entry-meta-list">
				<?php 
					if( !$comments_text ) $text_domain ='';
				?>

				<?php // Author ?>
				<?php if ($author == 1): ?>
					<li class="entry-author">
						<?php if( $author_img ) : ?>
							<?php echo get_avatar(greenmart_tbay_get_id_author_post(), 50); ?> 
						<?php endif; ?>
					
						<?php the_author_posts_link(); ?>
					</li>
				<?php endif ?>

				<?php // Date ?>
				<?php if( $date == 1): ?>
					<li class="entry-date"><?php echo greenmart_time_link(); ?></li>
				<?php endif ?>

				<?php // Categories ?>
				<?php if(get_the_category_list( ', ' ) && $cats == 1): ?>
					<li class="entry-category"><span class="label"><?php esc_html_e('Categories:', 'greenmart'); ?></span><?php greenmart_the_post_category_full() ?></li>
				<?php endif; ?>

				<?php // Comments ?>
				<?php if( $comments && comments_open() ): ?>
					<li class="comments-link"><i class="tb-icon tb-icon-zt-forum"></i>
						<?php comments_popup_link( 
							'0' .'<span>'. $text_domain .'</span>',  
							'1' .'<span>'. $text_domain .'</span>',  
							'%' .'<span>'. $text_domain .'</span>'
						); ?>
					</li>
				<?php endif; ?>


				<?php // Tags ?>
				<?php if(get_the_tag_list( '', ', ' ) && $tags == 1): ?>
					<li class="entry-tags"><?php echo get_the_tag_list( '', ', ' ); ?></li>
				<?php endif; ?>

				<?php // Edit link ?>
				<?php if( is_user_logged_in() && $edit == 1 ): ?>
					<li class="edit-link"><?php edit_post_link( esc_html__( 'Edit', 'greenmart' )); ?></li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'greenmart_tbay_breadcrumbs' ) ) {
	function greenmart_tbay_breadcrumbs() {

		$delimiter = '';
		$home = esc_html__('Home', 'greenmart');
		$before = '<li>';
		$after = '</li>';
		if (!is_home() && !is_front_page() || is_paged()) {

			echo '<ol class="breadcrumb">';

			global $post;
			$homeLink = esc_url( home_url() );
			echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . esc_html($delimiter) . '</li> ';

			if (is_category()) {
				echo trim($before) . esc_html__('Blog','greenmart') . $after;
			} elseif (is_day()) { 
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . esc_html($delimiter) . ' ';
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
				}
			}  elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); 
				if( isset($cat) && !empty($cat) ) {
				 $cat = $cat[0];
				 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				}
				echo '<li><a href="' . esc_url( get_permalink($parent->ID) ) . '">' . esc_html($parent->post_title) . '</a></li> ' . esc_html($delimiter) . ' ';
				echo trim($before) . get_the_title() . $after;
			   } elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . esc_html__('Page','greenmart') . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id); 
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo trim($crumb) . ' ' . $delimiter . ' ';
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo trim($before) . esc_html__('Search results for','greenmart')  . get_search_query() . '"' . $after;
			} elseif ( is_tag() ) {
				echo trim($before) . esc_html__('Posts tagged "', 'greenmart'). single_tag_title('', false) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by', 'greenmart') . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'greenmart') . $after;
			}

			echo '</ol>';
		}
	} 
}
if (! function_exists('greenmart_get_the_archive_title')) {
	add_filter( 'get_the_archive_title', 'greenmart_get_the_archive_title', 10, 1);
    function greenmart_get_the_archive_title($title)
    {
		if ( is_category() ) {    
			$title = single_cat_title( '', false );    
		} elseif ( is_tag() ) {    
			$title = single_tag_title( '', false );    
		} elseif ( is_author() ) {    
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;    
		} elseif ( is_tax() ) { //for custom post types
			$title = single_term_title( '', false );
		} elseif (is_post_type_archive()) {
			$title = post_type_archive_title( '', false );
		}
		 
		return $title;   
    }
}