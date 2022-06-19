<?php

if ( ! function_exists( 'greenmart_tbay_body_classes' ) ) {
	function greenmart_tbay_body_classes( $classes ) {
		global $post;
		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'tbay_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
		}
		if ( greenmart_tbay_get_config('preload') ) {
			$classes[] = 'tbay-body-loader';
		}

		if ( greenmart_tbay_is_home_page() ) {
			$classes[] = 'tbay-homepage';
		}

		if ( !(greenmart_is_woocommerce_activated()) ) {
			$classes[] = 'tb-no-shop';
		} else {
			$classes[] = 'woocommerce';
		}

		if( !(defined('GREENMART_TBAY_FRAMEWORK_ACTIVED') && GREENMART_TBAY_FRAMEWORK_ACTIVED) ) {
			$classes[] = 'tb-no-framework';
		}

		return $classes;
	}
	add_filter( 'body_class', 'greenmart_tbay_body_classes' );
}

if ( ! function_exists( 'greenmart_tbay_get_shortcode_regex' ) ) {
	function greenmart_tbay_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

if ( ! function_exists( 'greenmart_tbay_tagregexp' ) ) {
	function greenmart_tbay_tagregexp() {
		return apply_filters( 'greenmart_tbay_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|greenmart_tbay_media' );
	}
}

/**Is Active Plugin**/
if ( !function_exists('greenmart_is_merlin_activated') ) {
    function greenmart_is_merlin_activated() {
        return class_exists('Merlin') ? true : false;
    }
}

if (!function_exists('greenmart_elementor_is_activated')) {
    function greenmart_elementor_is_activated() {
		if( function_exists('elementor_load_plugin_textdomain') ) {
			return true; 
		} else {
			return false;
		}
    }
}

if (!function_exists('greenmart_vc_is_activated')) {
    function greenmart_vc_is_activated()
    {
        return class_exists('Vc_Manager');
    }
}

if ( ! function_exists( 'greenmart_elementor_is_edit_mode' ) ) {
	function greenmart_elementor_is_edit_mode() {
		if( !greenmart_elementor_is_activated() ) return false;

		return Elementor\Plugin::$instance->editor->is_edit_mode();
	} 
}

if ( ! function_exists( 'greenmart_elementor_is_preview_page' ) ) {
	function greenmart_elementor_is_preview_page() {
		return isset( $_GET['preview_id'] );
	}
}

if ( ! function_exists( 'greenmart_elementor_is_preview_mode' ) ) {
	function greenmart_elementor_is_preview_mode() {
		if( !greenmart_elementor_is_activated() ) return false;
		
		return Elementor\Plugin::$instance->preview->is_preview_mode();
	}
}

if (!function_exists('greenmart_is_woocommerce_activated')) {
    function greenmart_is_woocommerce_activated() {
        return class_exists('WooCommerce') ? true : false;
    }
}

if (!function_exists('greenmart_is_wpbakery_activated')) {
    function greenmart_is_wpbakery_activated() {
		if( greenmart_tbay_get_theme() === 'organic-el' || greenmart_tbay_get_theme() === 'fresh-el' ) return false;

        return class_exists('WPBakeryShortCode') ? true : false;
    }
}

if(!function_exists('greenmart_switcher_to_boolean')) {
	 function greenmart_switcher_to_boolean($var) {
		if( $var === 'yes' ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( !function_exists('greenmart_tbay_class_container_vc') ) {
	function greenmart_tbay_class_container_vc($class, $isfullwidth, $post_type) {
		global $post;
		$isfullwidth = false;
		if ( $post_type == 'tbay_megamenu' ) {
			$isfullwidth = false;
		} elseif ( $post_type == 'tbay_footer' ) {
			$isfullwidth = false;
		} else {
			if ( is_page() ) {
				$isfullwidth  = get_post_meta( $post->ID, 'tbay_page_fullwidth', true );
				if ( $isfullwidth === 'yes' ) {
					$isfullwidth = true; 
				} else {
					$isfullwidth = false;
				}
			} elseif ( greenmart_is_woocommerce_activated() && is_woocommerce() ) {
				if ( is_singular('product') ) {
					$isfullwidth  = greenmart_tbay_get_config( 'product_single_fullwidth', false );
				} else {
					$isfullwidth  = greenmart_tbay_get_config( 'product_archive_fullwidth', false );
				}
			} else {
				if ( is_singular('post') ) {
					$isfullwidth  = greenmart_tbay_get_config( 'post_single_fullwidth', false );
				} else {
					$isfullwidth  = greenmart_tbay_get_config( 'post_archive_fullwidth', false );
				}
			}
		}

		if ( $isfullwidth ) {
			return 'tbay-'.$class;
		}
		return $class;
	}
}
add_filter( 'greenmart_tbay_class_container_vc', 'greenmart_tbay_class_container_vc', 1, 3);


if ( !function_exists('greenmart_tbay_get_themes') ) {
	function greenmart_tbay_get_themes() {
		$themes = array();
		$path   = get_template_directory() . '/css/skins/';
		
		if ( is_dir($path) ) {
			$folders = scandir($path);
			$excludes = array('.', '..', '.svn');
			foreach ($folders as $folder) {
				if ( !in_array( $folder, $excludes ) && is_dir($path . $folder) ) {

					if ( $folder === 'organic-el' ) {
						$title = 'Elementor Organic';
					} elseif( $folder === 'fresh-el' ) {
						$title = 'Elementor Fresh';
					} else {
						$title = $folder;
					}
					$theme = array(
				        $folder => array( 
	                        'title' => $title,
	                        'alt'   => $title,
	                        'img'   => get_template_directory_uri() . '/inc/assets/images/active_theme/'.$folder.'.jpg'
	                    ),
	                );  
	                $themes = array_merge($themes,$theme);  
				}
			}
		}
		return $themes;

	}
}

if ( !function_exists('greenmart_tbay_get_theme') ) {
	function greenmart_tbay_get_theme() {
		$kin_default = 'organic';

		if( !empty(greenmart_tbay_get_global_config('active_theme',$kin_default)) ) {
		   return greenmart_tbay_get_global_config('active_theme',$kin_default);
		} else {
		   return $kin_default;
		}
	}
}

if ( !function_exists('greenmart_tbay_only_organic') ) {
	function greenmart_tbay_only_organic() {
		$arrays = array(
			'organic',
			'organic-el',
		);

		return $arrays;
	}
}

if ( !function_exists('greenmart_tbay_get_part_theme') ) {
	function greenmart_tbay_get_part_theme() {
		$active_theme  = greenmart_tbay_get_global_config('active_theme','organic');
		$active_theme  = 'themes/'.$active_theme;

		return $active_theme;

	}
}

if ( !function_exists('greenmart_tbay_get_header_layouts') ) {
	function greenmart_tbay_get_header_layouts() {
		$current_theme 	= greenmart_tbay_get_theme();

		if( $current_theme === 'organic-el' || $current_theme === 'fresh-el' ) {
			return greenmart_tbay_get_header_layouts_elementor();
		} else {
			return greenmart_tbay_get_header_layouts_folder();
		}
		
	}
} 

if ( !function_exists('greenmart_tbay_get_header_layouts_elementor') ) {
	function greenmart_tbay_get_header_layouts_elementor() {
		$headers = array( 'header_default' => esc_html__('Default', 'greenmart'));
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'tbay_header',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$headers[$post->post_name] = $post->post_title;
		}
		return $headers;
	}
}

if ( !function_exists('greenmart_tbay_get_header_layouts_folder') ) {
	function greenmart_tbay_get_header_layouts_folder() {
		$headers 		= array();
		$current_theme 	= greenmart_tbay_get_theme();

		if( $current_theme !== 'organic' ) {
			$files = glob( get_template_directory() . '/headers/themes/'.$current_theme.'/*.php' );
		} else {
			$files = glob( get_template_directory() . '/headers/*.php' );
		}

		usort($files, function ($a, $b) {
		    $aIsDir = is_dir($a);
		    $bIsDir = is_dir($b);
		    if ($aIsDir === $bIsDir)
		        return strnatcasecmp($a, $b);
		    elseif ($aIsDir && !$bIsDir)
		        return -1;
		    elseif (!$aIsDir && $bIsDir)
		        return 1;
		});

	    if ( !empty( $files ) ) { 
	        foreach ( $files as $file ) {
	        	$header = str_replace( '.php', '', basename($file) );
	            $headers[$header] = $current_theme.'-'.$header;
	        }
	    }

		return $headers;
	}
}

if ( !function_exists('greenmart_tbay_get_header_layout') ) {
	function greenmart_tbay_get_header_layout() {
		global $post;

		if ( greenmart_is_woocommerce_activated() && is_shop() ) {
			return greenmart_tbay_page_header_layout();
		}


		if ( is_page() && is_object($post) && isset($post->ID) ) {
			return greenmart_tbay_page_header_layout();
		}
		return greenmart_tbay_get_config('header_type');
	}
	add_filter( 'greenmart_tbay_get_header_layout', 'greenmart_tbay_get_header_layout' );
}

if ( !function_exists('greenmart_tbay_template_part_header_layout') ) {
	function greenmart_tbay_template_part_header_layout() {
		$active_theme = greenmart_tbay_get_theme();
		$tbay_header = apply_filters( 'greenmart_tbay_get_header_layout', greenmart_tbay_get_config('header_type') );
		if ( empty($tbay_header) ) {
			$tbay_header = 'v1';
		}

		if( $active_theme === 'organic' ) {
			get_template_part( 'headers/'.$tbay_header );
		} else if( $active_theme === 'organic-el' || $active_theme === 'fresh-el' ) {
			get_template_part( 'headers/themes/'.$active_theme.'/header' );
		} else {
			get_template_part( 'headers/themes/'.$active_theme.'/'.$tbay_header );
		}
	}
	add_action('greenmart_theme_header', 'greenmart_tbay_template_part_header_layout', 10);
}

if ( !function_exists('greenmart_tbay_get_footer_layouts') ) {
	function greenmart_tbay_get_footer_layouts() {
		$footers = array( '' => esc_html__('Default', 'greenmart'));
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'tbay_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('greenmart_tbay_get_footer_layout') ) {
	function greenmart_tbay_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'tbay_page_footer_type', true );
				if ( $footer == 'global' ||  $footer == '') {
					return greenmart_tbay_get_config('footer_type', '');
				}
			}
			return $footer;
		} else if ( greenmart_is_woocommerce_activated() && is_shop() ) {

			$post_id = wc_get_page_id('shop');
			if ( isset($post_id) ) {
				$footer = get_post_meta( $post_id, 'tbay_page_footer_type', true );
				if ( $footer == 'global' ||  $footer == '') {
					return greenmart_tbay_get_config('footer_type', '');
				}
			}
			return $footer;
		} 

		return greenmart_tbay_get_config('footer_type', '');
	}
	add_filter('greenmart_tbay_get_footer_layout', 'greenmart_tbay_get_footer_layout');
}

if ( !function_exists('greenmart_tbay_offcanvas_menu') ) {
    function greenmart_tbay_offcanvas_menu() {
		greenmart_tbay_get_page_templates_parts('offcanvas-menu');
	}
	add_action('greenmart_before_theme_header', 'greenmart_tbay_offcanvas_menu', 10);
}

if ( !function_exists('greenmart_tbay_offcanvas_smart_menu') ) {
    function greenmart_tbay_offcanvas_smart_menu() {
		greenmart_tbay_get_page_templates_parts('offcanvas-smartmenu');
	}
	add_action('greenmart_before_theme_header', 'greenmart_tbay_offcanvas_smart_menu', 20);
}

if ( !function_exists('greenmart_tbay_the_topbar_mobile') ) {
    function greenmart_tbay_the_topbar_mobile() {

        greenmart_tbay_get_page_templates_parts('device/topbar-mobile');

	}
	add_action('greenmart_before_theme_header', 'greenmart_tbay_the_topbar_mobile', 30);
}

if ( !function_exists('greenmart_tbay_footer_mobile') ) {
    function greenmart_tbay_footer_mobile() {
		if( greenmart_tbay_get_config('mobile_footer_icon',true) ) {
			greenmart_tbay_get_page_templates_parts('device/footer-mobile');
		}
	}
	add_action('greenmart_before_theme_header', 'greenmart_tbay_footer_mobile', 40);
}

if ( !function_exists('greenmart_tbay_the_topbar_tablet') ) {
    function greenmart_tbay_the_topbar_tablet() {
		$active_theme = greenmart_tbay_get_theme();
		if( $active_theme === 'organic-el' || $active_theme === 'fresh-el' ) return;

        greenmart_tbay_get_page_templates_parts('topbar-mobile');
	}
	add_action('greenmart_before_theme_header', 'greenmart_tbay_the_topbar_tablet', 50);
}


if ( !function_exists('greenmart_tbay_page_content_class') ) {
	function greenmart_tbay_page_content_class( $class ) {
		global $post;
		$fullwidth = get_post_meta( $post->ID, 'tbay_page_fullwidth', true );
		if ( !$fullwidth || $fullwidth == 'no' ) {
			return $class;
		}
		return 'container-fluid';
	}
}
add_filter( 'greenmart_tbay_page_content_class', 'greenmart_tbay_page_content_class', 1 , 1  );



if ( !function_exists('greenmart_tbay_page_header_layout') ) {
	function greenmart_tbay_page_header_layout() {
		global $post;

		if ( is_object($post) && isset($post->ID) ) $post_id = $post->ID;
		
		if ( greenmart_is_woocommerce_activated()  && is_shop() ) {
			$post_id = wc_get_page_id('shop');
		}

		$header = get_post_meta( $post_id, 'tbay_page_header_type', true );
		if ( $header == 'global' || $header == '' ) {
			return greenmart_tbay_get_config('header_type');
		}
		return $header;
	}
}

if ( ! function_exists( 'greenmart_tbay_get_first_url_from_string' ) ) {
	function greenmart_tbay_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		return ( ! empty( $link[0] ) ) ? $link[0] : false;
	}
}

if ( !function_exists( 'greenmart_tbay_get_link_attributes' ) ) {
	function greenmart_tbay_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );

		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}

if ( !function_exists( 'greenmart_tbay_post_media' ) ) {
	function greenmart_tbay_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = greenmart_tbay_get_first_url_from_string( $content );
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = greenmart_tbay_get_shortcode_regex( greenmart_tbay_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}

if ( !function_exists( 'greenmart_tbay_post_gallery' ) ) {
	function greenmart_tbay_post_gallery( $content ) {
		$pattern = greenmart_tbay_get_shortcode_regex( 'gallery' );
		preg_match( '/' . $pattern . '/s', $content, $media );
		if ( ! empty( $media[2] )  ) {
			return '<div class="entry-gallery">' . do_shortcode( $media[0] ) . '<hr class="pro-clear" /></div>';
		}

		return false;
	}
}

if ( !function_exists( 'greenmart_tbay_random_key' ) ) {
    function greenmart_tbay_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('greenmart_tbay_substring') ) {
    function greenmart_tbay_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}

if ( !function_exists('greenmart_tbay_subschars') ) {
    function greenmart_tbay_subschars($string, $limit, $afterlimit='...'){

	    if(strlen($string) > $limit){
	        $string = substr($string, 0, $limit);
	    }else{
	        $afterlimit = '';
	    }
	    return $string . $afterlimit;
	}
}


/*testimonials*/
if ( !function_exists('greenmart_tbay_get_page_templates_parts') ) {
	function greenmart_tbay_get_page_templates_parts($slug = 'logo', $name = null) {
		$active_theme 	= greenmart_tbay_get_theme();
		$only_organic  	= greenmart_tbay_only_organic();

		if( !in_array($active_theme, $only_organic) ) { 
			return get_template_part( 'page-templates/themes/'.$active_theme.'/parts/'.$slug.'',$name);
		} else {
			return get_template_part( 'page-templates/parts/'.$slug.'',$name);
		}
	}
}

/*testimonials*/
if ( !function_exists('greenmart_tbay_get_testimonials_layouts') ) {
	function greenmart_tbay_get_testimonials_layouts() {
		$testimonials = array();
		$active_theme = greenmart_tbay_get_part_theme();
		$files = glob( get_template_directory() . '/vc_templates/testimonial/'.$active_theme.'/testimonial-*.php' );
	    if ( !empty( $files ) ) {
	        foreach ( $files as $file ) {
	        	$testi = str_replace( "testimonial-", '', str_replace( '.php', '', basename($file) ) );
	            $testimonials[$testi] = $testi;
	        }
	    }

		return $testimonials;
	}
}

/*Check in home page*/
if ( !function_exists('greenmart_tbay_is_home_page') ) {
	function greenmart_tbay_is_home_page() {
		$is_home = false;

		if( is_home() || is_front_page() || is_page( 'home-8' )  || is_page( 'home-7' )  || is_page( 'home-7-2' ) || is_page( 'home' ) || is_page( 'home-1' ) || is_page( 'home-2' ) || is_page( 'home-3' ) || is_page( 'home-4' ) || is_page( 'home-5' ) || is_page( 'home-6' ) || is_page( 'home-7' ) || is_page( 'home-8' ) ) {
			$is_home = true;
		}

		return $is_home;
	}
}

if ( !function_exists('greenmart_gallery_atts') ) {

	add_filter( 'shortcode_atts_gallery', 'greenmart_gallery_atts', 10, 3 );
	
	/* Change attributes of wp gallery to modify image sizes for your needs */
	function greenmart_gallery_atts( $output, $pairs, $atts ) {

			
		if ( isset($atts['columns']) && $atts['columns'] == 1 ) {
			//if gallery has one column, use large size
			$output['size'] = 'full';
		} else if ( isset($atts['columns']) && $atts['columns'] >= 2 && $atts['columns'] <= 4 ) {
			//if gallery has between two and four columns, use medium size
			$output['size'] = 'full';
		} else {
			//if gallery has more than four columns, use thumbnail size
			$output['size'] = 'full';
		}
	
		return $output;
	
	}
}

if ( !function_exists('greenmart_tbay_share_js') ) {
	function greenmart_tbay_share_js() {
		if( greenmart_elementor_is_edit_mode() || greenmart_elementor_is_preview_page() || greenmart_elementor_is_preview_mode() ) return;

		if( !greenmart_tbay_get_config('enable_code_share',false) || greenmart_tbay_get_config('select_share_type') == 'custom' ) return;
        
        if ( is_single() ) {
            echo greenmart_tbay_get_config('code_share');
        }
	}
	add_action('wp_head', 'greenmart_tbay_share_js');
}

/*Get Preloader*/
if ( ! function_exists( 'greenmart_get_select_preloader' ) ) {
    function greenmart_get_select_preloader( ) {

    	$preloader_enable 	= greenmart_tbay_get_global_config('preload', false);

    	if( !$preloader_enable ) return;

    	$preloader 	= greenmart_tbay_get_global_config('select_preloader', 1);
    	$media 		= greenmart_tbay_get_global_config('media-preloader');

    	if( isset($preloader) ) {
	    	switch ($preloader) {
	    		case 'loader1': 
	    			?>
	                <div class="tbay-page-loader">
					  	<div id="loader"></div>
					  	<div class="loader-section section-left"></div>
					  	<div class="loader-section section-right"></div>
					</div>
	    			<?php
	    			break;    		

	    		case 'loader2':
	    			?>
					<div class="tbay-page-loader">
					    <div class="tbay-loader tbay-loader-two">
					    	<span></span>
					    	<span></span>
					    	<span></span>
					    	<span></span>
					    </div>
					</div>
	    			<?php
	    			break;    		
	    		case 'loader3':
	    			?>
					<div class="tbay-page-loader">
					    <div class="tbay-loader tbay-loader-three">
					    	<span></span>
					    	<span></span>
					    	<span></span>
					    	<span></span>
					    	<span></span>
					    </div>
					</div>
	    			<?php
	    			break;    		
	    		case 'loader4':
	    			?>
					<div class="tbay-page-loader">
					    <div class="tbay-loader tbay-loader-four"> <span class="spinner-cube spinner-cube1"></span> <span class="spinner-cube spinner-cube2"></span> <span class="spinner-cube spinner-cube3"></span> <span class="spinner-cube spinner-cube4"></span> <span class="spinner-cube spinner-cube5"></span> <span class="spinner-cube spinner-cube6"></span> <span class="spinner-cube spinner-cube7"></span> <span class="spinner-cube spinner-cube8"></span> <span class="spinner-cube spinner-cube9"></span> </div>
					</div>
	    			<?php
	    			break;    		
	    		case 'loader5':
	    			?>
					<div class="tbay-page-loader">
					    <div class="tbay-loader tbay-loader-five"> <span class="spinner-cube-1 spinner-cube"></span> <span class="spinner-cube-2 spinner-cube"></span> <span class="spinner-cube-4 spinner-cube"></span> <span class="spinner-cube-3 spinner-cube"></span> </div>
					</div>
	    			<?php
	    			break;    		
	    		case 'loader6':
	    			?>
					<div class="tbay-page-loader">
					    <div class="tbay-loader tbay-loader-six"> <span class=" spinner-cube-1 spinner-cube"></span> <span class=" spinner-cube-2 spinner-cube"></span> </div>
					</div>
	    			<?php
	    			break;

	    		case 'custom_image':
	    			?>
					<div class="tbay-page-loader loader-img">
						<?php if( isset($media['url']) && !empty($media['url']) ): ?>
					   		<img src="<?php echo esc_url($media['url']); ?>">
						<?php endif; ?>
					</div>
	    			<?php
	    			break;
	    			
	    		default:
	    			?>
	    			<div class="tbay-page-loader">
					  	<div id="loader"></div>
					  	<div class="loader-section section-left"></div>
					  	<div class="loader-section section-right"></div>
					</div>
	    			<?php
	    			break;
	    	}
	    }
    }
    add_action( 'wp_body_open', 'greenmart_get_select_preloader', 10 );
}

/*Hidden footer body class*/
if ( ! function_exists( 'greenmart_body_class_hidden_footer' ) ) {
  function greenmart_body_class_hidden_footer( $classes ) {

  		$mobile_footer 	= greenmart_tbay_get_config('mobile_footer',true);

  		$footer_icon 	= greenmart_tbay_get_config('mobile_footer_icon',true);

		if( isset($mobile_footer) && !$mobile_footer ) {
			$classes[] = 'mobile-hidden-footer';
		}

		if( isset($footer_icon) && !$footer_icon ) {
			$classes[] = 'mobile-hidden-footer-icon';

			if( isset($mobile_footer) && $mobile_footer ) {
				$classes[] = 'mobile-hideicon-enadesfooter';
			}
		} 
 

		return $classes;

  }
  add_filter( 'body_class', 'greenmart_body_class_hidden_footer',99 );
}

// Number of blog per row
if ( !function_exists('greenmart_tbay_blog_loop_columns') ) {
    function greenmart_tbay_blog_loop_columns($number) {

    		$sidebar_configs = greenmart_tbay_get_blog_layout_configs();

    		$columns 	= greenmart_tbay_get_config('blog_columns', 1);

        if( isset($_GET['blog_columns']) && is_numeric($_GET['blog_columns']) ) {
            $value = $_GET['blog_columns']; 
        } elseif( empty($columns) && isset($sidebar_configs['columns']) ) {
    			$value = 	$sidebar_configs['columns']; 
    		} else {
          $value = $columns;          
        }

        if ( in_array( $value, array(1, 2, 3, 4, 5, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_blog_columns', 'greenmart_tbay_blog_loop_columns' );

if( ! function_exists( 'greenmart_texttrim')) {
	function greenmart_texttrim( $str ) {
		return trim(preg_replace("/('|\"|\r?\n)/", '', $str)); 
	}
}

/*Set excerpt show enable default*/
if ( ! function_exists( 'greenmart_tbay_edit_post_show_excerpt' ) ) {
	function greenmart_tbay_edit_post_show_excerpt() {
	  $user = wp_get_current_user();
	  $unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );
	  if( is_array($unchecked) ) {
		$key = array_search( 'postexcerpt', $unchecked );
		if ( FALSE !== $key ) {
		   array_splice( $unchecked, $key, 1 );
		   update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
		}
	  }
	}
	add_action( 'admin_init', 'greenmart_tbay_edit_post_show_excerpt', 10 );
}


if ( !function_exists('greenmart_tbay_menu_mobile_type') ) {
    function greenmart_tbay_menu_mobile_type() {
    	
        $option = greenmart_tbay_get_config('menu_mobile_type', 'smart_menu');
        $option = (isset($_GET['menu_mobile_type'])) ? $_GET['menu_mobile_type'] : $option;

        return $option;
    }
}
add_filter( 'greenmart_menu_mobile_option', 'greenmart_tbay_menu_mobile_type', 10, 3 );

if ( !function_exists('greenmart_get_youtube_embedurl') ) {
	function greenmart_get_youtube_embedurl($url)
	{
		$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
		$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

		if (preg_match($longUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}

		if (preg_match($shortUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}
		return 'https://www.youtube.com/embed/' . $youtube_id ;
	}
}


if ( !function_exists('greenmart_register_custom_post_elementor') ) {
	function greenmart_register_custom_post_elementor($types) {

		if( greenmart_elementor_is_activated() ) {

			if( in_array('brand', $types) ) {
				unset($types[array_search('brand', $types)]);
			}

			if( in_array('testimonial', $types) ) {
				unset($types[array_search('testimonial', $types)]);
			}

			$types[] = 'header';
		}

		return $types;
	}
	add_filter('tbay_framework_register_post_types', 'greenmart_register_custom_post_elementor', 10, 1);
}


if(!function_exists('greenmart_elements_ready_slick')) {
	function greenmart_elements_ready_slick() {
		$array = [
			'brands', 
			'our-team', 
			'posts-grid',
			'testimonials',
			'custom-image-list-categories',
			'list-categories-product',
			'product-categories-tabs',
			'product-category', 
			'product-count-down',
			'product-tabs', 
			'product-recently-viewed',
			'product-flash-sales',
			'products-width-banner',
			'products' 
		];
	
		return $array; 
	}
}	
 
if (!function_exists('greenmart_elements_ajax_tabs')) {
    function greenmart_elements_ajax_tabs()
    { 
        $array = [
            'product-categories-tabs',  
            'product-tabs',
        ];

        return $array;
    }
}

if(!function_exists('greenmart_elements_ready_countdown_timer')) {
	function greenmart_elements_ready_countdown_timer() {
		$array = [
			'product-count-down',
			'product-flash-sales'
		];
	
		return $array; 
	}
}	
 
if(!function_exists('greenmart_elements_ready_layzyload_image')) {
	function greenmart_elements_ready_layzyload_image() {
		$array = [
			'product-count-down',
			'brands', 
			'products',   
			'posts-grid',
			'our-team', 
			'product-category', 
			'product-tabs', 
			'testimonials',
			'product-categories-tabs',
			'list-categories-product',
			'custom-image-list-categories',
			'product-flash-sales',
		];
	
		return $array; 
	}
}	

// catalog mode
if ( !function_exists('greenmart_is_catalog_mode_activated') ) {
    function greenmart_is_catalog_mode_activated() {
        $active = greenmart_tbay_get_config('enable_woocommerce_catalog_mode', false);

        $active = (isset($_GET['catalog_mode'])) ? $_GET['catalog_mode'] : $active;

        return $active;
    }
}

if( !function_exists('greenmart_rocket_lazyload_exclude_class') ) {
	function greenmart_rocket_lazyload_exclude_class( $attributes ) {
        $attributes[] = 'class="attachment-yith-woocompare-image size-yith-woocompare-image"';
        $attributes[] = 'class="header-logo-img"';
        $attributes[] = 'class="logo-mobile-img"';
        $attributes[] = 'class="mobile-infor-img"';
        $attributes[] = 'class="wpml-ls-flag"';

		return $attributes;
	}
	add_filter( 'rocket_lazyload_excluded_attributes', 'greenmart_rocket_lazyload_exclude_class' );
} 

if ( ! function_exists( 'greenmart_tbay_get_woocommerce_mini_cart_el' ) ) {
    function greenmart_tbay_get_woocommerce_mini_cart_el( $args = array() ) {
        $args = wp_parse_args(
            $args,
            array(
                'icon_mini_cart'                => [
                    'value' => 'tb-icon tb-icon-shopping-cart',
                ],
                'show_title_mini_cart'          => 'yes',
                'title_mini_cart'               => esc_html__('Shopping cart', 'greenmart'),
                'price_mini_cart'               => 'yes',
                'position_total'                 => 'absolute',
            )
        );
        wc_get_template( 'cart/themes/organic-el/mini-cart-button-popup.php', array('args' => $args) ) ;
    }
}


if ( !function_exists('greenmart_tbay_minicart_button_el') ) {
    function greenmart_tbay_minicart_button_el( $icon, $enable_text, $text, $enable_price,$position_total ) {
        global $woocommerce;

        $count = $woocommerce->cart->cart_contents_count;
        if($position_total === 'static' ) {
            $count = '('.$woocommerce->cart->cart_contents_count;
        }
        ?>

        <span class="cart-icon">

            <?php if( !empty($icon['value']) ) : ?>
                <i class="<?php echo esc_attr( $icon['value'] ); ?>"></i>
            <?php endif;  ?>
            
        </span>
        <span class="wrapper-title-cart">

            <?php if( ($enable_text === 'yes') && !empty($text) ) : ?>
                <span class="text-cart"><?php echo trim($text); ?></span>
            <?php endif; ?>

            <?php 
                $class_static = ( $position_total === 'static' ) ? '-static' : '';
            ?>
            <span class="mini-cart-items<?php echo esc_attr($class_static); ?>">
                <?php echo trim($count);?>
                <?php
                    if( $position_total === 'static' ) {
                        ?> <?php echo esc_html__('item)','greenmart') ?> <?php
                    }
                ?>
            </span>

            <?php if( $enable_price === 'yes' ) : ?>
                <span class="mini-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal();?></span>
            <?php endif; ?>

        </span>

        <?php 
    }
}

if ( ! function_exists( 'greenmart_is_active_option_muilti_vendor' ) ) {
    function greenmart_is_active_option_muilti_vendor() {

        if ( function_exists( 'dokan_is_store_page' ) ) {
            return true;
        }

        if ( class_exists( 'WCMp' ) ) {
            return true;
        }

        return false;
    }
}

if ( ! function_exists( 'greenmart_clean' ) ) {
	function greenmart_clean( $var ) {
		if ( is_array( $var ) ) {
			return array_map( 'greenmart_clean', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		}
	}
}

if ( ! function_exists( 'greenmart_clear_transient' ) ) {
	function greenmart_clear_transient() {
		delete_transient( 'greenmart-hash-time' );
	} 
	add_action( 'wp_update_nav_menu_item', 'greenmart_clear_transient', 11, 1 );
} 

if (! function_exists('greenmart_nav_menu_get_menu_class')) {
    function greenmart_nav_menu_get_menu_class($layout, $header_type)
    { 
 
        if( $header_type === 'builder' ) {
            $menu_class    = 'elementor-nav-menu menu nav navbar-nav megamenu';
        } else { 
            $menu_class    = 'menu tbay-menu-category tbay-vertical';
        }

		switch ($layout) {
			case 'vertical':
				$menu_class .= ' flex-column';
				break;

			case 'treeview':
				$menu_class = 'menu navbar-nav';
				break;
			
			default:
				$menu_class .= ' flex-row';
				break;
		}

		return  $menu_class;
    }
}

if (! function_exists('greenmart_get_transliterate')) {
    function greenmart_get_transliterate( $slug ) {
        $prev_locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_ALL, 'C.UTF-8');

        $slug = urldecode($slug);

        if (function_exists('iconv') && defined('ICONV_IMPL') && @strcasecmp(ICONV_IMPL, 'unknown') !== 0) {
            $slug = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $slug);
        }

        setlocale(LC_ALL, $prev_locale);

        return $slug;
    }
}


if ( ! function_exists( 'greenmart_tbay_check_data_carousel' ) ) {
    function greenmart_tbay_check_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile) {
    	$data_array = array(); 

        $data_array['rows']				= isset($rows) ? $rows : 1;
        $data_array['nav'] 				= ($nav_type == 'yes') ? true : false;
        $data_array['pagination'] 		= ($pagi_type == 'yes') ? true : false;
        $data_array['loop'] 			= ($loop_type == 'yes') ? true : false;
        $data_array['auto'] 			= ($auto_type == 'yes') ? true : false;
        $data_array['autospeed'] 		= ( !empty($autospeed_type) ) ? $autospeed_type : 500;
        $data_array['disable_mobile'] 	= ($disable_mobile == 'yes') ? true : false;

        return $data_array;
    }
}

if ( ! function_exists( 'greenmart_tbay_data_carousel' ) ) {
    function greenmart_tbay_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile) {

        $data_array = greenmart_tbay_check_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile);

        $datas  = " data-carousel=\"owl\"";
        $datas .= " data-rows=\"" . esc_attr($data_array['rows']) ."\"";
        $datas .= " data-nav=\"" . esc_attr($data_array['nav']) ."\"";
        $datas .= " data-pagination=\"" . esc_attr($data_array['pagination']) ."\"";
        $datas .= " data-loop=\"" . esc_attr($data_array['loop']) ."\"";
        $datas .= " data-auto=\"" . esc_attr($data_array['auto']) ."\"";

        if($data_array['auto'] == 'yes') {
        	$datas .= " data-autospeed=\"" . esc_attr($data_array['autospeed']) ."\"";
        }

        $datas .= " data-unslick=\"" . esc_attr($data_array['disable_mobile']) ."\"";

        return $datas;
    }
}

if ( ! function_exists( 'greenmart_tbay_check_data_responsive' ) ) {
    function greenmart_tbay_check_data_responsive($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile) {
    	$data_array = array();

		$data_array['desktop']          =      isset($desktop) ? $desktop : $columns;
		$data_array['desktopsmall']     =      isset($desktopsmall) ? $desktopsmall : 3;
		$data_array['tablet']           =      isset($tablet) ? $tablet : 3;
		$data_array['landscape']        =      isset($landscape_mobile) ? $landscape_mobile : 3;
		$data_array['mobile']           =      isset($mobile) ? $mobile : 2;

        return $data_array; 
    }
}

if ( ! function_exists( 'greenmart_tbay_check_data_responsive_carousel' ) ) {
    function greenmart_tbay_check_data_responsive_carousel($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile) {
    	$data_responsive = greenmart_tbay_check_data_responsive($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile);

		$datas = " data-items=\"". $columns ."\"";
		$datas .= " data-desktopslick=\"". $data_responsive['desktop'] ."\"";
		$datas .= " data-desktopsmallslick=\"". $data_responsive['desktopsmall'] ."\"";
		$datas .= " data-tabletslick=\"". $data_responsive['tablet'] ."\"";
		$datas .= " data-landscapeslick=\"". $data_responsive['landscape'] ."\"";
		$datas .= " data-mobileslick=\"". $data_responsive['mobile'] ."\"";

        return $datas;
    }
}
if ( ! function_exists( 'greenmart_tbay_check_data_responsive_grid' ) ) {
    function greenmart_tbay_check_data_responsive_grid($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile) {

    	$data_responsive = greenmart_tbay_check_data_responsive($columns, $desktop, $desktopsmall, $tablet, $landscape_mobile, $mobile);

		$datas  = "";
		$datas .= " data-xlgdesktop=\"" . esc_attr($columns) ."\"";
		$datas .= " data-desktop=\"" . esc_attr($data_responsive['desktop']) ."\"";
		$datas .= " data-desktopsmall=\"" . esc_attr($data_responsive['desktopsmall']) ."\"";
		$datas .= " data-tablet=\"" . esc_attr($data_responsive['tablet']) ."\"";
		$datas .= " data-landscape=\"" . esc_attr($data_responsive['landscape']) ."\"";
		$datas .= " data-mobile=\"" . esc_attr($data_responsive['mobile']) ."\"";

        return $datas;
    }
}

if ( !function_exists('greenmart_is_ajax_popup_quick') ) {
    function greenmart_is_ajax_popup_quick() {
		$active = true;

		if( greenmart_is_woo_variation_swatches_pro() ) {
			$active = false;
		}

        return $active;
    }
}

if (!function_exists('greenmart_array_key_first')) {
    function greenmart_array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}