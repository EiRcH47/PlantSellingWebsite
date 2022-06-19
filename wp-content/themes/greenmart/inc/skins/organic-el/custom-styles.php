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
if ( !function_exists ('greenmart_tbay_custom_styles') ) {
	function greenmart_tbay_custom_styles() {
		global $reduxConfig;	

		$output = $reduxConfig->output;

		$main_color  = $main_bg_color = $main_border_color  = greenmart_tbay_get_config('main_color');
		
		$logo_img_width        	= greenmart_tbay_get_config( 'logo_img_width' );
		$logo_padding        	= greenmart_tbay_get_config( 'logo_padding' );

		$logo_img_width_mobile 	= greenmart_tbay_get_config( 'logo_img_width_mobile' );
		$logo_mobile_padding 	= greenmart_tbay_get_config( 'logo_mobile_padding' );

		
		$custom_css 			= greenmart_tbay_get_config( 'custom_css' );
		$css_desktop 			= greenmart_tbay_get_config( 'css_desktop' );
		$css_tablet 			= greenmart_tbay_get_config( 'css_tablet' );
		$css_wide_mobile 		= greenmart_tbay_get_config( 'css_wide_mobile' );
		$css_mobile         	= greenmart_tbay_get_config( 'css_mobile' );

		
		$show_typography        = greenmart_tbay_get_config( 'show_typography', false );

		ob_start();	
		?>
		
			<?php if( $show_typography ) : ?>
				<?php
					$font_source = greenmart_tbay_get_config('font_source');
					$main_font = greenmart_tbay_get_config('main_font');
					$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
					$main_google_font_face = greenmart_tbay_get_config('main_google_font_face');
					$main_custom_font_face = greenmart_tbay_get_config('main_custom_font_face');

					$primary_font = $output['primary-font'];
				?>
				<?php if ( ($font_source == "2" && $main_google_font_face) || ($font_source == "3" && $main_custom_font_face) ): ?>
					<?php echo trim($primary_font); ?>
					{font-family: 
						<?php 
							switch ($font_source) { 
								case '3': 
									echo trim($main_custom_font_face);
									break;	
								case '2':
									echo trim($main_google_font_face);
									break;							
								
								default:
									echo trim($main_google_font_face);
									break;
							}
						?> 
					}
				<?php endif; ?>

			<?php endif; ?>

			/* check main color */ 
			
			<?php if( !empty($bg_buy_now) ) : ?>
				.has-buy-now .tbay-buy-now.button, .has-buy-now .tbay-buy-now.button.disabled {
					background-color: <?php echo esc_html( $bg_buy_now ) ?> !important;
				}
				
			<?php endif; ?>

			<?php if ( $logo_img_width != "" ) : ?>
			.site-header .logo img {
				max-width: <?php echo esc_html( $logo_img_width ); ?>px;
			} 
			<?php endif; ?>

			<?php if ( $logo_padding != "" ) : ?>
			.site-header .logo img {

				<?php if( !empty($logo_padding['padding-top'] ) ) : ?>
					padding-top: <?php echo esc_html( $logo_padding['padding-top'] ); ?>;
				<?php endif; ?>

				<?php if( !empty($logo_padding['padding-right'] ) ) : ?>
					padding-right: <?php echo esc_html( $logo_padding['padding-right'] ); ?>;
				<?php endif; ?>
				
				<?php if( !empty($logo_padding['padding-bottom'] ) ) : ?>
					padding-bottom: <?php echo esc_html( $logo_padding['padding-bottom'] ); ?>;
				<?php endif; ?>

				<?php if( !empty($logo_padding['padding-left'] ) ) : ?>
						padding-left: <?php echo esc_html( $logo_padding['padding-left'] ); ?>;
				<?php endif; ?>

			}
			<?php endif; ?> 


		<?php if ( $main_color != "" ) : ?>
		.wcfmmp_sold_by_wrapper a:hover {
			color: <?php echo esc_html( $main_color ) ?> !important; 
		}
		/*Tablet*/
		@media (max-width: 1199px)  and (min-width: 768px) {
			/*color*/
			<?php if( isset($output['tablet_color']) && !empty($output['tablet_color']) ) : ?>
				<?php echo trim($output['tablet_color']); ?> {
					color: <?php echo esc_html( $main_color ) ?>;
				}
			<?php endif; ?>


			/*background*/
			<?php if( isset($output['tablet_background']) && !empty($output['tablet_background']) ) : ?>
				<?php echo trim($output['tablet_background']); ?> {
					background-color: <?php echo esc_html( $main_bg_color ) ?>;
				}
			<?php endif; ?>

			/*Border*/
			<?php if( isset($output['tablet_border']) && !empty($output['tablet_border']) ) : ?>
			<?php echo trim($output['tablet_border']); ?> {
				border-color: <?php echo esc_html( $main_border_color ) ?>;
			}
			<?php endif; ?>

		}

		/*Mobile*/
		@media (max-width: 767px) {
			/*color*/
			<?php if( isset($output['mobile_color']) && !empty($output['mobile_color']) ) : ?>
				<?php echo trim($output['mobile_color']); ?> {
					color: <?php echo esc_html( $main_color ) ?>;
				}
			<?php endif; ?>

			/*background*/
			<?php if( isset($output['mobile_background']) && !empty($output['mobile_background']) ) : ?>
				<?php echo trim($output['mobile_background']); ?> {
					background-color: <?php echo esc_html( $main_bg_color ) ?>;
				}
			<?php endif; ?>

			/*Border*/
			<?php if( isset($output['mobile_border']) && !empty($output['mobile_border']) ) : ?>
			<?php echo trim($output['mobile_border']); ?> {
				border-color: <?php echo esc_html( $main_border_color ) ?>;
			}
			<?php endif; ?>
		}

		/*No edit code customize*/	
		@media (max-width: 1199px)  and (min-width: 768px) {	       
			/*color*/
			.footer-device-mobile > * a:hover,.footer-device-mobile > *.active a,.footer-device-mobile > *.active a i , body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a,body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a i,.vc_tta-container .vc_tta-panel.vc_active .vc_tta-panel-title > a span,.cart_totals table .order-total .woocs_special_price_code {
				color: <?php echo esc_html( $main_color ) ?>;
			}

			/*background*/
			.topbar-device-mobile .top-cart a.wc-continue,.topbar-device-mobile .cart-dropdown .cart-icon .mini-cart-items,.footer-device-mobile > * a .mini-cart-items,.tbay-addon-newletter .input-group-btn input {
				background-color: <?php echo esc_html( $main_bg_color ) ?>;
			}

			/*Border*/
			.topbar-device-mobile .top-cart a.wc-continue {
				border-color: <?php echo esc_html( $main_border_color ) ?>;
			}
		}


		<?php endif; ?>

		@media (max-width: 1199px) {

			<?php if ( $logo_img_width_mobile != "" ) : ?>
			/* Limit logo image height for mobile according to mobile header height */
			.mobile-logo a img {
				max-width: <?php echo esc_html( $logo_img_width_mobile ); ?>px;
			}     
			<?php endif; ?>       

			<?php if ( $logo_mobile_padding != "" ) : ?>
			.mobile-logo a img {

				<?php if( !empty($logo_mobile_padding['padding-top'] ) ) : ?>
					padding-top: <?php echo esc_html( $logo_mobile_padding['padding-top'] ); ?>;
				<?php endif; ?>

				<?php if( !empty($logo_mobile_padding['padding-right'] ) ) : ?>
					padding-right: <?php echo esc_html( $logo_mobile_padding['padding-right'] ); ?>;
				<?php endif; ?>

				<?php if( !empty($logo_mobile_padding['padding-bottom'] ) ) : ?>
					padding-bottom: <?php echo esc_html( $logo_mobile_padding['padding-bottom'] ); ?>;
				<?php endif; ?>

				<?php if( !empty($logo_mobile_padding['padding-left'] ) ) : ?>
						padding-left: <?php echo esc_html( $logo_mobile_padding['padding-left'] ); ?>;
				<?php endif; ?>
				
			}
			<?php endif; ?>
		}

		@media screen and (max-width: 782px) {
			html body.admin-bar{
				top: -46px !important;
				position: relative;
			}
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
		?>

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

		wp_enqueue_style( 'greenmart-style', get_template_directory_uri() . '/style.css', array(), '1.0' );

		wp_add_inline_style( 'greenmart-style', $custom_css );
	}
}

?>
<?php add_action( 'wp_head', 'greenmart_tbay_custom_styles', 99 ); ?>