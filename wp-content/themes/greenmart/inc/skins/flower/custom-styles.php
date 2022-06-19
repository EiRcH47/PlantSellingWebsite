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
		global $post;	
		
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
		ob_start();	
		?>
		
			<?php if( $show_typography ) : ?>
				<?php
					$font_source = greenmart_tbay_get_config('font_source');
					$main_font = greenmart_tbay_get_config('main_font');
					$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
					$main_google_font_face = greenmart_tbay_get_config('main_google_font_face');
					$main_custom_font_face = greenmart_tbay_get_config('main_custom_font_face');
				?>
				<?php if ( ($font_source == "1" && $main_font) || ($font_source == "2" && $main_google_font_face) || ($font_source == "3" && $main_custom_font_face) ): ?>
					body, p, .btn-view-all, btn , a, .group-text .text-heading span, .btn, .button, .navbar-nav.megamenu > li > a, .price, del, ins, .description, #tbay-footer .top-footer .txt1
					{font-family: 
						<?php 
							switch ($font_source) {
								case '3':
									echo trim($main_custom_font_face);
									break;	
								case '2':
									echo trim($main_google_font_face) ?> !important; <?php
									break;							
								case '1':
									echo trim($main_font)?> !important; <?php
									break;
								
								default:
									echo trim($main_google_font_face)?> !important; <?php
									break;
							}
						?> 
					}
				<?php endif; ?>
				<?php
					$secondary_font = greenmart_tbay_get_config('secondary_font');
					$secondary_font = isset($secondary_font['font-family']) ? $secondary_font['font-family'] : false;
					$secondary_google_font_face = greenmart_tbay_get_config('secondary_google_font_face');
					$secondary_custom_font_face = greenmart_tbay_get_config('secondary_custom_font_face');
				?>
				<?php if ( ($font_source == "1" && $secondary_font) || ($font_source == "2" && $secondary_google_font_face)  || ($font_source == "3" && $secondary_custom_font_face) ): ?>
						h1, h2, h3, h4, h5, h6
					{font-family: 
						<?php 
							switch ($font_source) {
								case '3':
									echo trim($secondary_custom_font_face);
									break;
								case '2':
									echo trim($secondary_google_font_face)?> !important; <?php
									break;							
								case '1':
									echo trim($secondary_font)?> !important; <?php
									break;
								
								default:
									echo trim($secondary_google_font_face)?> !important; <?php
									break;
							}
						?>
					}		
				<?php endif; ?> 

			<?php endif; ?>

			/* Custom Color (skin) */ 

			/* check main color */ 
			<?php if ( greenmart_tbay_get_config('main_color') != "" ) : ?>
			/*color*/
			.entry-single .entry-meta .entry-date,
			.archive-shop div.product .information .price,
			.entry-create a,
			a:hover, a:focus,
			.color,
			ul.list-category li a:hover,
			#tbay-header.header-v4 #cart .mini-cart .sub-title .amount,
			#tbay-header.header-v5 #cart .mini-cart .sub-title .amount,
			.navbar-nav.megamenu > li.active > a,
			.widget-categoriestabs ul.nav-tabs > li.active > a i, .widget_deals_products ul.nav-tabs > li.active > a i,
			.widget-categoriestabs ul.nav-tabs > li.active > a, .widget_deals_products ul.nav-tabs > li.active > a,
			.name a:hover,
			.tbay-search-form .button-search:hover,
			.post-grid.vertical .entry-content .entry-title a:hover,
			.flex-control-nav.slick-vertical .slick-arrow:hover.owl-prev:after, .flex-control-nav.slick-vertical .slick-arrow:hover.owl-next:after,
			.woocommerce .quantity input.minus:hover, .woocommerce-page .quantity input.minus:hover, .woocommerce .quantity input.plus:hover, .woocommerce-page .quantity input.plus:hover,
			.widget.yith-woocompare-widget a.compare:hover,
			.top-cart .dropdown-menu .remove:hover,
			.tbay-dropdown-cart .remove:hover,
			.row[data-xlgdesktop="5"] .product-block .groups-button .add-cart a:hover, .row[data-xlgdesktop="6"] .product-block .groups-button .add-cart a:hover,
			.woocommerce .quantity button.minus:hover, .woocommerce-page .quantity button.minus:hover, .woocommerce .quantity button.plus:hover, .woocommerce-page .quantity button.plus:hover,
			.shop_table:not(.woocommerce-checkout-review-order-table) a.remove:hover,
			.woocommerce table.cart .product-remove a.remove:hover, .woocommerce table.cart .product-remove a.remove:focus,
			.mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active > a, .mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active .mm-counter,
			.widget-custom-categories .item .cat-img:hover i, #dokan-store-listing-filter-wrap .right .toggle-view .active,.wcfm_popup_wrapper .wcfm_popup_button:hover,
			.tbay-body-woocommerce-quantity-mod .product-block .groups-button .add-cart a:hover,.tbay-body-woocommerce-quantity-mod .quantity-group-btn.active .add-cart .added_to_cart::before
			{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			/* Compare */
			body table.compare-list .add-to-cart td .add-cart a {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;	
			}

			/*Greenmart Dokan Color*/
			input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme, #dokan-seller-listing-wrap .store-footer > a, #dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .item .dokan-toogle-checkbox:checked, .pagination-container ul.pagination > li > a:hover, .pagination-container ul.pagination > li > a:focus {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			/*Green mart WCMP*/

			#wcmp-store-conatiner input[type="submit"], .widget_wcmp_quick_info #respond input#submit, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input, .wcmp_regi_main .register button.button {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			/*Greenmart WC Vendor*/

			.wcv-dashboard-navigation ~ form input[type="submit"], .wcvendors-pro-dashboard-wrapper a.button, .wcv-form .control-group .control > input.wcv-button:not(#clear_button) {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}


			#wcmp-store-conatiner input[type="submit"]:hover, #wcmp-store-conatiner input[type="submit"]:focus, .widget_wcmp_quick_info #respond input#submit:hover, .widget_wcmp_quick_info #respond input#submit:focus, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input:hover, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input:focus, .wcmp_regi_main .register button.button:hover, .wcmp_regi_main .register button.button:focus, .wcv-dashboard-navigation ~ form input[type="submit"]:hover, .wcv-dashboard-navigation ~ form input[type="submit"]:focus, .wcv_recent_orders a.button:hover, .wcv_recent_orders a.button:focus, .wcvendors-pro-dashboard-wrapper a.button:hover, .wcvendors-pro-dashboard-wrapper .wcv-form .control-group .button:hover, .wcv-form .control-group .control > input.wcv-button:not(#clear_button):hover, .wcv-form .control-group .control > input.wcv-button:not(#clear_button):focus {
				background: #000 !important;
				border-color: #000 !important;
			}

			#wcmp-store-conatiner .wcmp-store-list .wcmp-store-detail-wrap .wcmp-store-detail-list li .wcmp_vendor_detail, .wcvendors-pro-dashboard-wrapper .wcv-navigation ul.menu li.active a {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			.ui-autocomplete.ui-widget-content li.list-bottom a, .wishlist_table.mobile .product-add-to-cart .add-cart a {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;	
			}
			.ui-autocomplete.ui-widget-content li.list-header .count,
			.widget.woocommerce .woocommerce-Price-amount,
			#tbay-cart-modal .woocommerce-Price-amount, .product-block .groups-button .button-wishlist .yith-wcwl-wishlistexistsbrowse a, .product-block .groups-button .button-wishlist .yith-wcwl-wishlistaddedbrowse a, .product-block .yith-wcwl-add-to-wishlist > div.yith-wcwl-add-button a.delete_item, .singular-shop div.product .information .yith-wcwl-add-to-wishlist a.delete_item,
			#wcfm_membership_container .terms_title a {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}

			#yith-wcwl-popup-message {
				background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}

			/*Greenmart Add to cart style form popup*/
			.mobile-btn-cart-click #tbay-click-addtocart,
			.mobile-btn-cart-click #tbay-click-buy-now,
			.yith-wfbt-section .yith-wfbt-form .yith-wfbt-submit-button {
				background:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}  

			.wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).button-variable-item:hover, .wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).button-variable-item.selected,
			.wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).image-variable-item:hover, .wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).image-variable-item.selected {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.topbar-mobile-right .dropdown.open .btn,
			.topbar-mobile-right .dropdown .btn:hover,
			.topbar-mobile .active-mobile>a 
			 {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button.added + .added_to_cart {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;	
			}
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, 
			.yith-modal .yith-wcqv-wrapper .yith-quick-view-content .carousel-controls-v3 .carousel-control,
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, 
			#yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .carousel-controls-v3 .carousel-control,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, 
			.yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button, 
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, 
			#yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button,
			#wcfm-main-contentainer .wcfm_form_simple_submit_wrapper .wcfm_submit_button,
			#wcfm-main-contentainer .wcfm-membership-wrapper input[type="submit"], #wcfm-main-contentainer .wcfm_form_simple_submit_wrapper .wcfm_submit_button {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button + .added_to_cart, 
			.yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button + .added_to_cart, 
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button + .added_to_cart, 
			#yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button + .added_to_cart,
			.yith-quick-view-content.woocommerce div.summary button.button.alt {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>; 
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			/*YITH WFBT SECTION WOOCOMMERCE*/
			.yith-wfbt-section .yith-wfbt-form .yith-wfbt-submit-button {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			/*End YITH WFBT*/
			.mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active .mm-btn_next:after,.wcfm_popup_wrapper .wcfm_popup_button:hover {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			/* Shop */
			.widget_price_filter .ui-slider .ui-slider-handle,
			#add_payment_method .wc-proceed-to-checkout a.checkout-button,
			.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
			#add_payment_method #payment div.form-row.place-order #place_order,
			.woocommerce-cart #payment div.form-row.place-order #place_order,
			#cart .cart-icon .mini-cart-items, .tbay-topcart .cart-icon .mini-cart-items,
			.product-block .groups-button .add-cart .product_type_external, .product-block .groups-button .add-cart .product_type_grouped, .product-block .groups-button .add-cart .add_to_cart_button, .product-block .groups-button .add-cart .product_type_simple,
			.tbay-to-top a span,
			spinner-cube,
			.tbay-loader-five .spinner-cube:before,
			.widget.widget_product_categories .product-categories li:before,
			#reviews .progress .progress-bar-success,
			#yith-wcwl-form .wishlist_table td.product-add-to-cart a,
			.popup-cart .gr-buttons > a,
			.product-block .added_to_cart.wc-forward,
			.product-block .groups-button .add-cart .product_type_external, .product-block .groups-button .add-cart .product_type_grouped, .product-block .groups-button .add-cart .add_to_cart_button, .product-block .groups-button .add-cart button, .product-block .groups-button .add-cart .product_type_simple,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, #yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.widget.yith-woocompare-widget a.compare,
			.pagination span.current, .pagination a.current, .tbay-pagination span.current, .tbay-pagination a.current,
			.tparrows:hover,
			.pagination a:hover, .tbay-pagination a:hover {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.woocommerce-currency-switcher-form .SumoSelect .optWrapper>.options li.opt:hover,
			.navbar-nav.megamenu .dropdown-menu>li.active>a, .navbar-nav.megamenu .dropdown-menu>li:hover>a,
			.special-alert a,
			.woocommerce .star-rating span:before,
			.ft-contact-info i,
			.navbar-nav.megamenu > li.active > a, .navbar-nav.megamenu > li:hover > a,
			.btn-search-totop:hover, .btn-search-totop:focus,
			.product-block .groups-button .yith-wcwl-wishlistexistsbrowse > a:hover, .product-block .groups-button .yith-wcwl-wishlistaddedbrowse > a:hover, .product-block .groups-button .yith-wcwl-add-to-wishlist > a:hover, .product-block .groups-button .yith-compare > a:hover, .product-block .groups-button .add_to_wishlist:hover, .product-block .groups-button .yith-wcqv-button:hover,
			.tbay-offcanvas-main .navbar-nav li.active > a, .tbay-offcanvas-main .navbar-nav li:hover > a,
			.singular-shop div.product .information .product_meta a,
			#respond p.stars a.active:after, #respond p.stars a:hover:after, #respond p.stars a:active:after,
			#tbay-footer .menu > li.active a,
			.product-block .groups-button .yith-compare > a.added,
			.woocommerce-info:before,dl.variation .variation-SoldBy a:hover,
			.woocommerce-cart .woocommerce-error, .woocommerce-cart .woocommerce-info, .woocommerce-cart .woocommerce-message {
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.widget-features .feature-box:hover:before {
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				opacity: 0.2;
			}
			body table.compare-list .add-to-cart td .add-cart a:hover {
				color: #fff !important;
				border-color: transparent !important;
			}
			.footer-device-mobile:before, body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a,
			.footer-device-mobile > *.active,
			.tbay-loader-five .spinner-cube:before,
			#cart .cart-icon .mini-cart-items, .tbay-topcart .cart-icon .mini-cart-items,
			.tbay-to-top a span,
			.widget.widget_product_categories .product-categories li:before,
			#reviews .progress .progress-bar-success, #yith-wcwl-form .wishlist_table td.product-add-to-cart a {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.dokan-pagination-container .dokan-pagination li.active a,
			.btn-theme-2:hover, .post-grid .readmore a:hover, .btn-theme-2:focus, .post-grid .readmore a:focus,
			.top-cart .dropdown-menu p.buttons a.checkout,
			.show-view-all a:hover,
			.tbay-dropdown-cart p.buttons a.checkout,
			.tbay-dropdown-cart p.buttons a:hover,
			.widget.widget_product_categories .product-categories a:hover:before,
			.top-cart .dropdown-menu p.buttons a:hover,
			.widget.widget_product_categories .product-categories li.current-cat a:before,
			.woocommerce .widget_price_filter .price_slider_amount .button:hover,
			.singular-shop div.product .information .single_add_to_cart_button, .singular-shop div.product .information .tbay-buy-now,
			.yith-wcqv-wrapper .entry-summary.has-buy-now form.cart .tbay-buy-now,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, .yith-modal .yith-wcqv-wrapper .yith-wcqv-wrapper-content .summary .single_add_to_cart_button, .yith-wcqv-wrapper .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, .yith-wcqv-wrapper .yith-wcqv-wrapper .yith-wcqv-wrapper-content .summary .single_add_to_cart_button
			 {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#customer_login button.button:hover,
			.woocommerce .woocommerce-ResetPassword input[type="submit"]:hover {
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.tawcvs-swatches .swatch.selected,
			#reviews .reviews-summary .review-summary-total .review-summary-result,
			.woocommerce-info, .woocommerce-cart .woocommerce-error, .woocommerce-cart .woocommerce-info, .woocommerce-cart .woocommerce-message,
			#wcfm-main-contentainer .wcfm_form_simple_submit_wrapper .wcfm_submit_button {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#add_payment_method .wc-proceed-to-checkout a.checkout-button,
			.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
			#add_payment_method #payment div.form-row.place-order #place_order,
			.woocommerce-cart #payment div.form-row.place-order #place_order,
			.widget-products.special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.widget-special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.carousel-special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.widget-carousel-special .product-block .caption .groups-button a.add_to_cart_button:hover,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.pagination a:hover, .tbay-pagination a:hover{
				color: #fff !important;
			}
			/* Greenmart */ 
			.btn-slider.btn-color,
			.btn-slider:hover,
			.widget-categoriestabs .woocommerce .btn-view-all, .widget_deals_products .woocommerce .btn-view-all {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: #fff !important;
			}
			.group-text > p:before,
			#search-form-modal .btn,
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:hover, #tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:active,
			.categorymenu .widgettitle, .widget_tbay_custom_menu .widgettitle,
			#comments .form-submit input,
			.layout-blog .post-list > article.sticky .entry-title, .layout-blog .post-list > article.tag-sticky-2 .entry-title,
			.woocommerce table.wishlist_table tbody tr.mobile td a.button,
			.woocommerce-checkout #payment div.form-row.place-order #place_order,
			.woocommerce .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce .woocommerce-MyAccount-navigation ul li:hover a, .woocommerce .woocommerce-MyAccount-navigation ul li:focus a,
			#tbay-header.header-v2 .header-search-v2 .btn-search-totop,
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li:hover > a, 
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li.active > a,
			#reviews .review_form_wrapper #respond .form-submit input, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce-page .woocommerce-message .button, .woocommerce .return-to-shop a.button, #customer_login input.button, .woocommerce .woocommerce-ResetPassword input[type="submit"], .woocommerce .woocommerce-MyAccount-content a.button, .woocommerce .woocommerce-MyAccount-content .woocommerce-button, .woocommerce .woocommerce-MyAccount-content .woocommerce-Button, .woocommerce .woocommerce-form button.button, .woocommerce .checkout_coupon button.button,
			.cart_totals table tr.shipping .button
			{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.categorymenu .widgettitle:before, .widget_tbay_custom_menu .widgettitle:before{
				background-color: transparent !important;
			}
			.categorymenu .menu-category-menu-container ul li a:hover, .widget_tbay_custom_menu .menu-category-menu-container ul li a:hover{
				border-right-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:hover, #tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:active,
			.widget-categoriestabs .woocommerce .btn-view-all:hover,
			.widget-categoriestabs .woocommerce .btn-view-all:hover i{
				color: #fff !important;
			}
			.woocommerce .woocommerce-MyAccount-content .woocommerce-Button,
			.woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce-page .woocommerce-message .button, .woocommerce .woocommerce-form-login input[type="submit"], .woocommerce .checkout_coupon input[type="submit"], .woocommerce .return-to-shop a.button, .woocommerce .woocommerce-MyAccount-content a.button
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: #fff !important;
			}
			.widget-testimonials.v2 .testimonials-body .description i,
			.vc_blog .title-heading-blog a,
			.meta-info span.author a,
			#tbay-footer .top-footer .txt2 strong,
			#tbay-footer .ft-contact-info .txt1 i,
			#tbay-footer .ft-contact-info .txt3,
			.navbar-nav.megamenu > li.active > a i,
			.navbar-nav.megamenu > li > a:hover i, .navbar-nav.megamenu > li > a:active i,
			.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus,
			.navbar-nav.megamenu .dropdown-menu > li > a:hover, .navbar-nav.megamenu .dropdown-menu > li > a:active,
			.widget-features.style1 .fbox-image i, .widget-features.style1 .fbox-icon i,
			.categorymenu .menu-category-menu-container ul li a:hover i, .widget_tbay_custom_menu .menu-category-menu-container ul li a:hover i,
			.widget-features.style2 .fbox-image i, .widget-features.style2 .fbox-icon i,
			.widget_product_categories .product-categories .current-cat > a,
			.contactinfos li i,
			.page-404 .notfound-top h1,
			.product-block .button-wishlist .yith-wcwl-wishlistexistsbrowse.show a, .product-block .button-wishlist .yith-wcwl-wishlistaddedbrowse.show a,
			.navbar-offcanvas .navbar-nav > li.active > a,
			.singular-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .singular-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a,
			.tbay-breadscrumb .breadscrumb-inner .breadcrumb a:hover,
			#tbay-footer .menu > li:hover > a:before,
			.navbar-nav.megamenu .dropdown-menu .widget ul li.active a,
			.widget-categoriestabs ul.nav-tabs > li:hover a i, .widget_deals_products ul.nav-tabs > li:hover a i,
			.widget-categoriestabs ul.nav-tabs > li:hover a, .widget_deals_products ul.nav-tabs > li:hover a,
			.navbar-offcanvas .dropdown-menu .dropdown-menu-inner ul li.active a,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li.active > a i,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li:hover > a i,
			a.wcvendors_cart_sold_by_meta,
			.wcvendors_sold_by_in_loop a,
			.widget-categoriestabs ul.nav-tabs > li.active > a, .widget_deals_products ul.nav-tabs > li.active > a, .widget-product-tabs ul.nav-tabs > li.active > a,
			.widget-categoriestabs ul.nav-tabs > li:hover a, .widget_deals_products ul.nav-tabs > li:hover a, .widget-product-tabs ul.nav-tabs > li:hover a,
			.woocommerce .track_order a.button:hover, .woocommerce .track_order button.button:hover, .woocommerce .track_order input.button:hover, .woocommerce .track_order #respond input#submit:hover,
			.cart_totals table tr.shipping a, .cart_totals table * tr.shipping a,
			.footer-device-mobile>* a span.icon span.count, .footer-device-mobile>* a span.icon .mini-cart-items
			{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.owl-carousel .owl-nav .owl-prev:hover, .owl-carousel .owl-nav .owl-next:hover,
			.entry-category a ,
			.post-list .entry-excerpt a, .post-list .entry-description a,
			.tbay-breadscrumb .breadscrumb-inner .breadcrumb a {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.navbar-nav.megamenu > li > a:hover, .navbar-nav.megamenu > li > a:active{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget-testimonials.v2 .testimonials-body:hover,
			.post-grid:hover .entry,
			.vc_category .box:hover img,
			.singular-shop div.product .flex-control-thumbs .slick-list li img.flex-active,
			.owl-dot.active span,
			.post-grid:hover .entry, .post-grid:hover .entry-content,
			.widget-testimonials.v2 .testimonials-body:hover .testimonials-content,
			#tbay-header.header-v2 .header-search-v2 .btn-search-totop,
			.widget-categoriestabs ul.nav-tabs > li:hover, .widget_deals_products ul.nav-tabs > li:hover,
			.widget-categories .owl-carousel.categories .owl-item .item .cat-img:hover img,
			.tagcloud a:focus, .tagcloud a:hover,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li a:hover,
			.widget-categoriestabs ul.nav-tabs > li.active, .widget_deals_products ul.nav-tabs > li.active, .widget-product-tabs ul.nav-tabs > li.active,
			.widget-categoriestabs ul.nav-tabs > li:hover, .widget_deals_products ul.nav-tabs > li:hover, .widget-product-tabs ul.nav-tabs > li:hover
			{
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			.navbar-nav.megamenu>li.active>a {
				border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			.tbay-to-top a:hover, .tbay-to-top button.btn-search-totop:hover{
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			body table.compare-list .add-to-cart td a:hover {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.singular-shop div.product .information .single_add_to_cart_button,
			.singular-shop div.product .information .single_add_to_cart_button.added + a,
			.tbay-offcanvas .offcanvas-head .btn-toggle-canvas,
			.tbay-offcanvas.v4 .offcanvas-head .btn-toggle-canvas, .tbay-offcanvas.v5 .offcanvas-head .btn-toggle-canvas,
			body table.compare-list .add-to-cart td a,
			input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme
			.woocommerce .track_order a.button, .woocommerce .track_order button.button, .woocommerce .track_order input.button, .woocommerce .track_order #respond input#submit, .woocommerce .woocommerce-order-details a.button, .woocommerce .woocommerce-order-details button.button, .woocommerce .woocommerce-order-details input.button, .woocommerce .woocommerce-order-details #respond input#submit
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.widget-testimonials.v2 .testimonials-body .testimonials-profile .name-client:before,
			.group-text.home_3 .signature .job:before,
			#reviews .review_form_wrapper #respond .form-submit input,
			.wpcf7-form input[type="submit"],
			.woocommerce .order-info mark, .woocommerce .order-info .mark,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, .yith-modal .yith-wcqv-wrapper .yith-wcqv-wrapper-content .carousel-controls-v3 .carousel-control, .yith-wcqv-wrapper .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, .yith-wcqv-wrapper .yith-wcqv-wrapper .yith-wcqv-wrapper-content .carousel-controls-v3 .carousel-control,
			#quickview-carousel .carousel-indicators li.active,
			body table.compare-list .add-to-cart td a,
			.topbar-device-mobile .device-cart .mobil-view-cart .mini-cart-items,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, .yith-modal .yith-wcqv-wrapper .yith-wcqv-wrapper-content .carousel-controls-v3 .carousel-control, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, #yith-quick-view-modal .yith-wcqv-wrapper .yith-wcqv-wrapper-content .carousel-controls-v3 .carousel-control
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			body.woocommerce-wishlist .footer-device-mobile>.device-wishlist a {

			}
			.widget-categoriestabs ul.nav-tabs > li.active, .widget_deals_products ul.nav-tabs > li.active,
			.woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a,
			.woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a:hover, .woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a:focus, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a:hover, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a:focus,
			.products-grid .product-category a.show-cat:hover,
			#quickview-carousel .carousel-indicators li
			{
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			
			
			.top-cart .dropdown-menu .product-details .product-name:hover,
			.tbay-category-fixed ul li a:hover, .tbay-category-fixed ul li a:active,
			.flex-control-nav .slick-arrow:hover.owl-prev:after, .flex-control-nav .slick-arrow:hover.owl-next:after,
			.woocommerce .archive-shop.col-lg-9 .products .row[data-xlgdesktop="4"] .product-block .groups-button .add-cart a:hover, .row[data-xlgdesktop="5"] .product-block .groups-button .add-cart a:hover, .row[data-xlgdesktop="6"] .product-block .groups-button .add-cart a:hover, .owl-carousel[data-large="5"] .product-block .groups-button .add-cart a:hover,
			.widget-products.widget-carousel .owl-carousel  .owl-nav .owl-prev:hover,
			.widget-products.widget-carousel .owl-carousel  .owl-nav .owl-next:hover,
			.wcfmmp_sold_by_container_advanced .wcfmmp_sold_by_wrapper .wcfmmp_sold_by_store a:hover,.wcfmmp_sold_by_wrapper a:hover {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			#tbay-header .search-form .btn,
			.tbay_custom_menu.treeview-menu .widget .widgettitle,
			.topbar-device-mobile .device-cart .mobil-view-cart .mini-cart-items,
			.yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control,
			.tbay-vertical-menu > .widget.widget_nav_menu > .widgettitle, .entry-tags-list a
			{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.btn-view-all:hover,
			.text-theme,
			.singular-shop div.product .information .compare:hover:before {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			/*Border-color*/
			.tabs-v1 ul.nav-tabs li:hover > a, .tabs-v1 ul.nav-tabs li.active > a,
			.tabs-v1 ul.nav-tabs li:hover > a:hover, .tabs-v1 ul.nav-tabs li:hover > a:focus, .tabs-v1 ul.nav-tabs li.active > a:hover, .tabs-v1 ul.nav-tabs li.active > a:focus,
			.btn-theme
			{
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			/*background color*/
			.archive-shop div.product .information .single_add_to_cart_button,
			.widget_price_filter .ui-slider-horizontal .ui-slider-range,
			.widget-categoriestabs ul.nav-tabs > li.active > a::after, .widget-categoriestabs ul.nav-tabs > li.active > a:hover::after, .widget-categoriestabs ul.nav-tabs > li.active > a:focus::after,
			.wpb_heading::before,
			.owl-dot.active span,
			.widget .widget-title::before, .widget .widgettitle::before, .widget .widget-heading::before,
			.navbar-nav.megamenu > li > a::before,
			.btn-theme,.bg-theme,
			.woocommerce .tb-cart-total a.checkout-button
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget_deals_products .products-carousel .widget-title::after{
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
			}

			@media (max-width: 768px) { 
				.singular-shop div.product .information .entry-summary.has-buy-now .tbay-buy-now.button:hover, .singular-shop div.product .information .entry-summary.has-buy-now .tbay-buy-now.button:focus,
				.singular-shop div.product .information .entry-summary.has-buy-now .single_add_to_cart_button:hover, .singular-shop div.product .information .entry-summary.has-buy-now .single_add_to_cart_button:focus {
					background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
					border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				}
			}

			<?php endif; ?>

			/***************************************************************/
			/* Top Bar *****************************************************/
			/***************************************************************/
			/* Top Bar Backgound */
			<?php $topbar_bg = greenmart_tbay_get_config('topbar_bg'); ?>
			<?php if ( !empty($topbar_bg) ) :
				$image = isset($topbar_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $topbar_bg['background-image']) : '';
				$topbar_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#tbay-topbar, #tbay-header.header-v2 #tbay-topbar,
				#tbay-header.header-v4 #tbay-topbar {
					<?php if ( isset($topbar_bg['background-color']) && $topbar_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $topbar_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-repeat']) && $topbar_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $topbar_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-size']) && $topbar_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $topbar_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-attachment']) && $topbar_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $topbar_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-position']) && $topbar_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $topbar_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $topbar_bg_image ): ?>
				    background-image: <?php echo esc_html( $topbar_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Top Bar Color */
			<?php if ( greenmart_tbay_get_config('topbar_text_color') != "" ) : ?>
				#tbay-topbar,
				#tbay-header.header-v2 #tbay-topbar,
				#tbay-header.header-v4 #tbay-topbar{
					color: <?php echo esc_html(greenmart_tbay_get_config('topbar_text_color')); ?>;
				}
			<?php endif; ?>
			/* Top Bar Link Color */
			<?php if ( greenmart_tbay_get_config('topbar_link_color') != "" ) : ?>
				#tbay-topbar a,
				#tbay-header.header-v2 #tbay-topbar a,
				#tbay-header.header-v4 #tbay-topbar a {
					color: <?php echo esc_html(greenmart_tbay_get_config('topbar_link_color')); ?>;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Header *****************************************************/
			/***************************************************************/
			/* Header Backgound */
			<?php $header_bg = greenmart_tbay_get_config('header_bg'); ?>
			<?php if ( !empty($header_bg) ) :
				$image = isset($header_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $header_bg['background-image']) : '';
				$header_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#tbay-header .header-main, #tbay-header.header-v3 .tbay-mainmenu {
					<?php if ( isset($header_bg['background-color']) && $header_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $header_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-repeat']) && $header_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $header_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-size']) && $header_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $header_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-attachment']) && $header_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $header_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-position']) && $header_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $header_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $header_bg_image ): ?>
				    background-image: <?php echo esc_html( $header_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Header Color */
			<?php if ( greenmart_tbay_get_config('header_text_color') != "" ) : ?>
				#tbay-header, #tbay-header.header-v3 .header-main,
				.list-inline.acount li .tit,
				.list-inline.acount li .user,
				#cart .mini-cart .sub-title,
				#tbay-header.header-v4 .header-main .top-contact .contact-layoutv4 li.black,
				#tbay-header.header-v4 .header-main .top-contact .contact-layoutv4 li,
				#tbay-header.header-v6 .category-v6 .category-inside-title,
				.header-v1 .header-main .header-inner .list-inline.acount li{
					color: <?php echo esc_html(greenmart_tbay_get_config('header_text_color')); ?>;
				}
				
			<?php endif; ?>
			/* Header Link Color */
			<?php if ( greenmart_tbay_get_config('header_link_color') != "" ) : ?>
				#tbay-header a, #tbay-header.header-v3 .header-main a,
				.list-inline.acount li a.login,
				#tbay-header.header-v4 .header-main .tbay-mainmenu .btn-offcanvas,
				#tbay-header.header-v6 .header-inner .right-item .list-inline.acount li a,
				#tbay-header.header-v5 .right-item .tbay-mainmenu .btn-offcanvas{
					color: <?php echo esc_html(greenmart_tbay_get_config('header_link_color'));?> ;
				}
			<?php endif; ?>
			/* Header Link Color Active */
			<?php if ( greenmart_tbay_get_config('header_link_color_active') != "" ) : ?>
				#tbay-header .active > a,
				#tbay-header a:active,
				#tbay-header a:hover {
					color: <?php echo esc_html(greenmart_tbay_get_config('header_link_color_active')); ?>;
				}
			<?php endif; ?>


			/* Menu Link Color */
			<?php if ( greenmart_tbay_get_config('main_menu_link_color') != "" ) : ?>
				.dropdown-menu .menu li a,
				.navbar-nav.megamenu .dropdown-menu > li > a,
				.navbar-nav.megamenu > li > a,
				.navbar-nav.megamenu > li > a .fa, .navbar-nav.megamenu > li > a img
				{
					color: <?php echo esc_html(greenmart_tbay_get_config('main_menu_link_color'));?> !important;
				}
			<?php endif; ?>
			/* Menu Link Color Active */
			<?php if ( greenmart_tbay_get_config('main_menu_link_color_active') != "" ) : ?>
				.navbar-nav.megamenu > li.active > a,
				.navbar-nav.megamenu > li > a:hover,
				.navbar-nav.megamenu > li > a:active,
				.navbar-nav.megamenu .dropdown-menu > li.active > a,
				.navbar-nav.megamenu .dropdown-menu > li > a:hover,
				.dropdown-menu .menu li a:hover,
				.dropdown-menu .menu li.active > a,
				.navbar-nav.megamenu > li:hover > a .fa, 
				.navbar-nav.megamenu > li:hover > a img,
				.navbar-nav.megamenu > li.active > a .fa, 
				.navbar-nav.megamenu > li.active > a img
				{
					color: <?php echo esc_html(greenmart_tbay_get_config('main_menu_link_color_active')); ?> !important;
					border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_menu_link_color_active') ) ?> !important;
				}
				
			<?php endif; ?>


			/***************************************************************/
			/* Footer *****************************************************/
			/***************************************************************/
			/* Footer Backgound */
			<?php $footer_bg = greenmart_tbay_get_config('footer_bg'); ?>
			<?php if ( !empty($footer_bg) ) :
				$image = isset($footer_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $footer_bg['background-image']) : '';
				$footer_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#tbay-footer, .bottom-footer {
					<?php if ( isset($footer_bg['background-color']) && $footer_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $footer_bg['background-color'] ) ?> !important;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-repeat']) && $footer_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $footer_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-size']) && $footer_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $footer_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-attachment']) && $footer_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $footer_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-position']) && $footer_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $footer_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $footer_bg_image ): ?>
				    background-image: <?php echo esc_html( $footer_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Footer Heading Color*/
			<?php if ( greenmart_tbay_get_config('footer_heading_color') != "" ) : ?>
				#tbay-footer h1, #tbay-footer h2, #tbay-footer h3, #tbay-footer h4, #tbay-footer h5, #tbay-footer h6 ,#tbay-footer .widget-title {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_heading_color')); ?> !important;
				}
			<?php endif; ?>
			/* Footer Color */
			<?php if ( greenmart_tbay_get_config('footer_text_color') != "" ) : ?>
				#tbay-footer, #tbay-footer .widget .description, .bottom-footer {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( greenmart_tbay_get_config('footer_link_color') != "" ) : ?>
				#tbay-footer a {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( greenmart_tbay_get_config('footer_link_color_hover') != "" ) : ?>
				#tbay-footer a:hover {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_link_color_hover')); ?>;
				}
			<?php endif; ?>




			/***************************************************************/
			/* Copyright *****************************************************/
			/***************************************************************/
			/* Copyright Backgound */
			<?php $copyright_bg = greenmart_tbay_get_config('copyright_bg'); ?>
			<?php if ( !empty($copyright_bg) ) :
				$image = isset($copyright_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $copyright_bg['background-image']) : '';
				$copyright_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				.bottom-footer {
					<?php if ( isset($copyright_bg['background-color']) && $copyright_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $copyright_bg['background-color'] ) ?> !important;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-repeat']) && $copyright_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $copyright_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-size']) && $copyright_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $copyright_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-attachment']) && $copyright_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $copyright_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-position']) && $copyright_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $copyright_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $copyright_bg_image ): ?>
				    background-image: <?php echo esc_html( $copyright_bg_image ) ?> !important;
				    <?php endif; ?>
				}
			<?php endif; ?>

			/* Footer Color */
			<?php if ( greenmart_tbay_get_config('copyright_text_color') != "" ) : ?>
				.bottom-footer {
					color: <?php echo esc_html(greenmart_tbay_get_config('copyright_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( greenmart_tbay_get_config('copyright_link_color') != "" ) : ?>
				.bottom-footer a {
					color: <?php echo esc_html(greenmart_tbay_get_config('copyright_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( greenmart_tbay_get_config('copyright_link_color_hover') != "" ) : ?>
				.bottom-footer a:hover {
					color: <?php echo esc_html(greenmart_tbay_get_config('copyright_link_color_hover')); ?>;
				}
			<?php endif; ?>

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
	            .logo-mobile-theme a img {
	               	max-width: <?php echo esc_html( $logo_tablet_img_width ); ?>px;
	            }     
	            <?php endif; ?>      

	            <?php if ( $logo_tablet_padding != "" ) : ?>
	            .logo-mobile-theme a img {
		            padding-top: <?php echo esc_html( $logo_tablet_padding['padding-top'] ); ?>;
		            padding-right: <?php echo esc_html( $logo_tablet_padding['padding-right'] ); ?>;
		            padding-bottom: <?php echo esc_html( $logo_tablet_padding['padding-bottom'] ); ?>;
		            padding-left: <?php echo esc_html( $logo_tablet_padding['padding-left'] ); ?>;
	            }
	            <?php endif; ?>

	         }	        

	         @media (max-width: 768px) {

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

		if( greenmart_is_woocommerce_activated() && class_exists( 'YITH_Woocompare' ) ) {
			wp_add_inline_style( 'greenmart-woocommerce', $custom_css );
		}
	}
}

?>
<?php add_action( 'wp_head', 'greenmart_tbay_custom_styles', 99 ); ?>