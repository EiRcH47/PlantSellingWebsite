<?php
//convert hex to rgb
if ( !function_exists ('greenmart_tbay_getbowtied_hex2rgb') ) {
	function greenmart_tbay_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}

if ( !function_exists ('greenmart_tbay_color_lightens_darkens') ) {
	/**
	 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
	 * @param str $hex Colour as hexadecimal (with or without hash);
	 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
	 * @return str Lightened/Darkend colour as hexadecimal (with hash);
	 */
	function greenmart_tbay_color_lightens_darkens( $hex, $percent ) {
		
		// validate hex string
		if( empty($hex) ) return $hex;
		
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		
		
		return $new_hex;
	}
}

if ( !function_exists ('greenmart_tbay_default_theme_primary_color') ) {
	function greenmart_tbay_default_theme_primary_color() {

		$active_theme = greenmart_tbay_get_theme();

		$theme_variable = array();

		switch ($active_theme) {
			case 'fresh-el':
				$theme_variable['main_color'] 					= '#00AB55';
				$theme_variable['main_color_second'] 			= '#FFB240';
				break;
			case 'organic-el':
				$theme_variable['main_color'] 					= '#86bc42';
				break;
			case 'organic':
				$theme_variable['main_color'] 					= '#86bc42';
				break;
			case 'flower':
				$theme_variable['main_color'] 			    	= '#ff3636';
				break;
			case 'health':
				$theme_variable['main_color'] 			    	= '#4f9f1e';
				break;
		}

		return apply_filters( 'greenmart_get_default_theme_color', $theme_variable);
	}
}

if ( !function_exists ('greenmart_tbay_default_theme_primary_fonts') ) {
	function greenmart_tbay_default_theme_primary_fonts() {

		$active_theme = greenmart_tbay_get_theme();
 
		$theme_variable = array();

		switch ($active_theme) {
			case 'fresh-el':
				$theme_variable['main_font'] 					= 'Public Sans, sans-serif';
				$theme_variable['main_font_second'] 			= 'Public Sans, sans-serif';
				$theme_variable['font_second_enable'] 			= false;
				break;
			case 'organic-el':
				$theme_variable['main_font'] 					= 'Roboto, sans-serif';
				$theme_variable['main_font_second'] 			= 'Roboto Slab, sans-serif';
				$theme_variable['font_second_enable'] 			= true;
				break;
			case 'organic':
				$theme_variable['main_font'] 					= 'Roboto, sans-serif';
				$theme_variable['main_font_second'] 			= 'Roboto Slab, sans-serif';
				$theme_variable['font_second_enable'] 			= true;
				break;
			case 'flower':
				$theme_variable['main_font'] 					= 'Roboto, sans-serif';
				$theme_variable['main_font_second'] 			= 'Playfair Display, serif';
				$theme_variable['font_second_enable'] 			= true;
				break;
			case 'health':
				$theme_variable['main_font'] 					= 'Roboto, sans-serif';
				$theme_variable['main_font_second'] 			= 'Roboto Slab, sans-serif';
				$theme_variable['font_second_enable'] 			= true;
				break;
		}


		return apply_filters( 'greenmart_get_default_theme_fonts', $theme_variable);
	}
}

if (!function_exists('greenmart_tbay_check_empty_customize')) {
    function greenmart_check_empty_customize($option, $default){
        if( !is_array( $option ) ) {
            if( !empty($option) && $option !== 'Array' ) {
                echo trim( $option );
            } else {
                echo trim( $default );
            }
        } else {
            if( !empty($option['background-color']) ) {
                echo trim( $option['background-color'] );
            } else {
                echo trim( $default );
            }
        } 
    }
}

if (!function_exists('greenmart_tbay_theme_primary_color')) {
    function greenmart_tbay_theme_primary_color()
    {
        $default                        = greenmart_tbay_default_theme_primary_color();

        $main_color                     = greenmart_tbay_get_config(('main_color'),$default['main_color']);

		if( !empty($default['main_color_second']) ) {
			$main_color_second                     = greenmart_tbay_get_config(('main_color_second'),$default['main_color_second']);
		}

        /*Theme Color*/
        ?>
        :root {
            --tb-theme-color: <?php greenmart_check_empty_customize( $main_color, $default['main_color'] ); ?>;
            --tb-theme-color-hover: <?php greenmart_check_empty_customize( greenmart_tbay_color_lightens_darkens($main_color, -0.05), greenmart_tbay_color_lightens_darkens($default['main_color'], -0.05) ); ?>;

			<?php if( !empty($default['main_color_second']) ) : ?>
				--tb-color-second: <?php greenmart_check_empty_customize( $main_color_second, $default['main_color_second'] ); ?>;
            	--tb-color-second-hover: <?php greenmart_check_empty_customize( greenmart_tbay_color_lightens_darkens($main_color_second, -0.05), greenmart_tbay_color_lightens_darkens($default['main_color_second'], -0.05) ); ?>;
			<?php endif; ?>
        } 
        <?php
    }
}

if ( !function_exists ('greenmart_tbay_custom_styles') ) {
	function greenmart_tbay_custom_styles() {

		ob_start();

		greenmart_tbay_theme_primary_color();

		$default_fonts 		= greenmart_tbay_default_theme_primary_fonts();

		if (!defined('GREENMART_TBAY_FRAMEWORK_ACTIVED')) {
			?>
			:root {
                --tb-text-primary-font: <?php echo trim($default_fonts['main_font']); ?>;
                <?php if ($default_fonts['font_second_enable']) : ?>
                    --tb-text-second-font: <?php echo trim($default_fonts['main_font_second']); ?>;
                <?php endif; ?>
            }  
			<?php
		}

		if (defined('GREENMART_TBAY_FRAMEWORK_ACTIVED')) {
			$logo_img_width        	= greenmart_tbay_get_config( 'logo_img_width' );
			$logo_padding        	= greenmart_tbay_get_config( 'logo_padding' );

			$logo_tablet_img_width 	= greenmart_tbay_get_config( 'logo_tablet_img_width' );
			$logo_tablet_padding 	= greenmart_tbay_get_config( 'logo_tablet_padding' );

			$logo_img_width_mobile 	= greenmart_tbay_get_config( 'logo_img_width_mobile' );
			$logo_mobile_padding 	= greenmart_tbay_get_config( 'logo_mobile_padding' );

			
			$custom_css 			= greenmart_tbay_get_config( 'custom_css' );
			$css_desktop 			= greenmart_tbay_get_config( 'css_desktop' );
			$css_tablet 			= greenmart_tbay_get_config( 'css_tablet' );
			$css_wide_mobile 		= greenmart_tbay_get_config( 'css_wide_mobile' );
			$css_mobile         	= greenmart_tbay_get_config( 'css_mobile' );

			$show_typography        = greenmart_tbay_get_config( 'show_typography', false );

			if ($show_typography) {
	            $font_source 			= greenmart_tbay_get_config('font_source');
	            $primary_font 			= greenmart_tbay_get_config('main_font')['font-family'];
	            $main_google_font_face = greenmart_tbay_get_config('main_google_font_face');
	            $main_custom_font_face = greenmart_tbay_get_config('main_custom_font_face');

	            $second_font					= greenmart_tbay_get_config('main_font_second')['font-family'];
	            $main_second_google_font_face 	= greenmart_tbay_get_config('main_second_google_font_face');
	            $main_second_custom_font_face 	= greenmart_tbay_get_config('main_second_custom_font_face');

	            if ($font_source  == "2" && $main_google_font_face) {
	                $primary_font = $main_google_font_face;
	                $second_font = $main_second_google_font_face;
	            } elseif ($font_source  == "3" && $main_custom_font_face) {
	                $primary_font = $main_custom_font_face;
	                $second_font = $main_second_custom_font_face;
	            } ?>
				:root {
					--tb-text-primary-font: <?php greenmart_check_empty_customize( $primary_font, $default_fonts['main_font'] ); ?>;

					<?php if ($default_fonts['font_second_enable']) : ?>
						--tb-text-second-font: <?php greenmart_check_empty_customize( $second_font, $default_fonts['main_font_second'] ); ?>;
					<?php endif; ?>
				}  
				<?php
	        } else {
				?>
				:root { 
					--tb-text-primary-font: <?php echo trim($default_fonts['main_font']); ?>;

					<?php if ($default_fonts['font_second_enable']) : ?>
						--tb-text-second-font: <?php echo trim($default_fonts['main_font_second']); ?>;
					<?php endif; ?>
	            }
				<?php
			}

			?>

			/* Woocommerce Breadcrumbs */
			<?php if ( greenmart_tbay_get_config('breadcrumbs') == "0" ) : ?>
			.woocommerce .woocommerce-breadcrumb,
			.woocommerce-page .woocommerce-breadcrumb
			{
				display:none;
			}
			<?php endif; ?>

			<?php if ( $logo_img_width != "" ) : ?>
			.site-header .logo img {
	            max-width: <?php echo esc_html( $logo_img_width ); ?>px;
	        } 
	        <?php endif; ?>

	        <?php if ( $logo_padding != "" ) : ?>
	        .site-header .logo img {  
	            padding-top: <?php echo esc_html( $logo_padding['padding-top'] ); ?>;
	            padding-right: <?php echo esc_html( $logo_padding['padding-right'] ); ?>;
	            padding-bottom: <?php echo esc_html( $logo_padding['padding-bottom'] ); ?>;
	            padding-left: <?php echo esc_html( $logo_padding['padding-left'] ); ?>;
	        }
	        <?php endif; ?>


	       	@media (min-width: 768px) and (max-width: 1024px){

	       		<?php if ( $logo_tablet_img_width != "" ) : ?>
	            /* Limit logo image width for tablet according to mobile header height */
	            .mobile-logo a img {
	               	max-width: <?php echo esc_html( $logo_tablet_img_width ); ?>px;
	            }     
	            <?php endif; ?>      

	            <?php if ( $logo_tablet_padding != "" ) : ?>
	            .mobile-logo a img {
		            padding-top: <?php echo esc_html( $logo_tablet_padding['padding-top'] ); ?>;
		            padding-right: <?php echo esc_html( $logo_tablet_padding['padding-right'] ); ?>;
		            padding-bottom: <?php echo esc_html( $logo_tablet_padding['padding-bottom'] ); ?>;
		            padding-left: <?php echo esc_html( $logo_tablet_padding['padding-left'] ); ?>;
	            }
	            <?php endif; ?>

	         }	        

	         @media (max-width: 767px) {

	        	<?php if ( $logo_img_width_mobile != "" ) : ?>
	            /* Limit logo image height for mobile according to mobile header height */
	            .mobile-logo a img {
	               	max-width: <?php echo esc_html( $logo_img_width_mobile ); ?>px;
	            }     
	            <?php endif; ?>       

	            <?php if ( $logo_mobile_padding != "" ) : ?>
	            .mobile-logo a img {
		            padding-top: <?php echo esc_html( $logo_mobile_padding['padding-top'] ); ?>;
		            padding-right: <?php echo esc_html( $logo_mobile_padding['padding-right'] ); ?>;
		            padding-bottom: <?php echo esc_html( $logo_mobile_padding['padding-bottom'] ); ?>;
		            padding-left: <?php echo esc_html( $logo_mobile_padding['padding-left'] ); ?>;
	            }
	            <?php endif; ?>

	         }

			/* Custom CSS */
	        <?php 
	        if( $custom_css != '' ) {
	            echo trim($custom_css);
	        }
	        if( $css_desktop != '' ) {
	            echo '@media (min-width: 1024px) { ' . ($css_desktop) . ' }'; 
	        }
	        if( $css_tablet != '' ) {
	            echo '@media (min-width: 768px) and (max-width: 1023px) {' . ($css_tablet) . ' }'; 
	        }
	        if( $css_wide_mobile != '' ) {
	            echo '@media (min-width: 481px) and (max-width: 767px) { ' . ($css_wide_mobile) . ' }'; 
	        }
	        if( $css_mobile != '' ) {
	            echo '@media (max-width: 480px) { ' . ($css_mobile) . ' }'; 
	        }
	        
		}?>


	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}

		$custom_css = implode($new_lines);

		wp_enqueue_style( 'greenmart-style', GREENMART_THEME_DIR . '/style.css', array(), '1.0' );

		wp_add_inline_style( 'greenmart-style', $custom_css );
	}
}

add_action( 'wp_head', 'greenmart_tbay_custom_styles', 99 );