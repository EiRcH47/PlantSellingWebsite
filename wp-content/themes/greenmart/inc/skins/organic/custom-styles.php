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
			.tbay-filter .change-view.active,
			.readmore a:hover,
			.entry-create a,
			.entry-create,
			a:hover, a:focus,
			.top-cart .dropdown-menu .cart_list + .total .amount,
			.top-cart .dropdown-menu .product-details .woocommerce-Price-amount,
			.color,
			ul.list-category li a:hover,
			#tbay-header.header-v4 #cart .mini-cart .sub-title .amount,
			#tbay-header.header-v5 #cart .mini-cart .sub-title .amount,
			.navbar-nav.megamenu > li.active > a,
			#cart .mini-cart .qty,
			.widget-categoriestabs ul.nav-tabs > li.active > a i, .widget_deals_products ul.nav-tabs > li.active > a i,
			.widget-categoriestabs ul.nav-tabs > li.active > a, .widget_deals_products ul.nav-tabs > li.active > a,
			.name a:hover,
			.post-grid.vertical .entry-content .readmore a,
			.top-cart .dropdown-menu p.buttons a.view-cart:hover, .top-cart .dropdown-menu p.buttons a.checkout:hover,
			.group-text.home_3 .text-heading i,
			.group-text.home_3 .quote i,
			.top-cart .dropdown-menu p.buttons a.view-cart:hover:after, .top-cart .dropdown-menu p.buttons a.checkout:hover:after,
			.tbay-breadscrumb .breadscrumb-inner .tbay-woocommerce-breadcrumb li,
			.widget_price_filter .price_slider_amount .button:hover,
			#tbay-cart-modal .woocommerce-Price-amount,
			.tbay-search-form .button-search:hover,
			.post-grid.vertical .entry-content .entry-title a:hover,
			.flex-control-nav.slick-vertical .slick-arrow:hover.owl-prev:after, .flex-control-nav.slick-vertical .slick-arrow:hover.owl-next:after,
			.woocommerce .quantity input.minus:hover, .woocommerce-page .quantity input.minus:hover, .woocommerce .quantity input.plus:hover, .woocommerce-page .quantity input.plus:hover,
			.ui-autocomplete.ui-widget-content .woocommerce-Price-amount,
			.woocommerce table.wishlist_table td.product-add-to-cart a:hover:before, .woocommerce table.shop_table td.product-add-to-cart a:hover:before,
			.widget.yith-woocompare-widget a.compare:hover,
			body table.compare-list ins .woocommerce-Price-amount,
			.mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active > a, .mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active .mm-counter,
			.widget-custom-categories .item .cat-img:hover i,
			#cart .mini-cart .mini-cart-subtotal,
			.woocommerce ul.cart_list li a.remove:hover, .woocommerce ul.product_list_widget li a.remove:hover,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li.active > a, .tbay-vertical-menu > .widget.widget_nav_menu .menu > li:hover > a, #dokan-store-listing-filter-wrap .right .item:hover .dokan-store-list-filter-button, #dokan-store-listing-filter-wrap .right .toggle-view .active, ul.subsubsub li.active a, .dokan-dashboard .dokan-dashboard-content.dokan-settings-content .dokan-settings-area input[type="submit"]:focus, .dokan-dashboard .dokan-dashboard-content.dokan-settings-content .dokan-settings-area input[type="submit"]:active, .dokan-follow-store-button.dokan-follow-store-button-working:after, .dokan-dashboard h1 .dokan-right a:hover, .dokan-dashboard h1 .dokan-right a:focus, .dokan-dashboard header.dokan-dashboard-header h1 .dokan-right a:hover, .dokan-dashboard header.dokan-dashboard-header h1 .dokan-right a:focus, .testimonials-body .name-client,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .price ins, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .price ins, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .price ins, #yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .price ins,
			.singular-shop div.product .information .price, .singular-shop div.product .information .woocommerce-grouped-product-list-item__price,
			.woocommerce table.wishlist_table tbody td.product-price u span, .woocommerce table.wishlist_table tbody td.product-price ins span, .woocommerce table.wishlist_table tbody td.product-subtotal u span, .woocommerce table.wishlist_table tbody td.product-subtotal ins span, .woocommerce table.shop_table tbody td.product-price u span, .woocommerce table.shop_table tbody td.product-price ins span, .woocommerce table.shop_table tbody td.product-subtotal u span, .woocommerce table.shop_table tbody td.product-subtotal ins span
			{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			/*Greenmart Dokan Color*/
			input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme, #dokan-seller-listing-wrap .store-footer > a, #dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-footer .dokan-follow-store-button, #dokan-store-listing-filter-wrap .right .item:hover .dokan-icons > .dokan-icon-div, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover, #dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .item .dokan-toogle-checkbox:checked, .pagination-container ul.pagination > li > a:hover, .pagination-container ul.pagination > li > a:focus {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			.pagination-wrap ul.pagination > li.active a, .dokan-pagination-container .dokan-pagination > li.active a,.pagination-wrap ul.pagination > li > a:hover, .dokan-pagination-container .dokan-pagination > li > a:hover {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> ;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> ;
			}
			.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover,.dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> ;
			}
			/*Greenmart WC Vendor*/
			
			.wcvendors-pro-dashboard-wrapper .wcv-navigation ul.menu li.active a {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			.wcv_pagination ul > li > a:hover, .wcv_pagination ul > li > a.current, .wcv_pagination ul > li > a:active, .wcv_pagination ul > li > span:hover, .wcv_pagination ul > li > span.current, .wcv_pagination ul > li > span:active,.woocommerce .vendor_list a.button,.wcv-dashboard-navigation ul > li > a.button,.wcv-dashboard-navigation ~ form input[type="submit"], .wcvendors-pro-dashboard-wrapper a.button, .wcv-form .control-group .control > input.wcv-button:not(#clear_button) {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			.woocommerce .vendor_list a.button:hover,.wcv-dashboard-navigation ul > li > a.button:hover,.wcv-dashboard-navigation ~ form input[type="submit"]:hover, .wcv-dashboard-navigation ~ form input[type="submit"]:focus, .wcv-form .control-group .control > input.wcv-button:not(#clear_button):hover, .wcv-form .control-group .control > input.wcv-button:not(#clear_button):focus, .wcv-grid .wcv-button:hover, .wcvendors-pro-dashboard-wrapper a.button:hover {
				background: #fff !important;
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			/*Greenmart Add to cart form style popup*/
			.mobile-btn-cart-click #tbay-click-addtocart,
			.mobile-btn-cart-click #tbay-click-buy-now {
				background:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			/*Greenmart BUY NOW*/
			.singular-shop div.product .information .single_add_to_cart_button, 
			.singular-shop div.product .information .tbay-buy-now,
			.entry-summary.has-buy-now form.cart .tbay-buy-now {
				background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.singular-shop div.product .information .single_add_to_cart_button:hover, 
			.singular-shop div.product .information .tbay-buy-now:hover,
			.singular-shop div.product .information .single_add_to_cart_button:hover:before, 
			.singular-shop div.product .information .tbay-buy-now:hover:before,
			.entry-summary.has-buy-now form.cart .tbay-buy-now:hover:before,
			.entry-summary.has-buy-now form.cart .tbay-buy-now:hover,
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover, 
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover:before,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .price, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .price, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .price, #yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .price {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			#yith-wcwl-popup-message {
				background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}

			.widget.widget-brands .owl-carousel .owl-nav .owl-prev:hover, 
			.widget.widget-brands .owl-carousel .owl-nav .owl-next:hover {
				background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}

			/*Quick view*/
			#quickview-carousel .carousel-indicators li.active,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .carousel-controls-v3 .carousel-control, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control, #yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .carousel-controls-v3 .carousel-control {
				background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			#quickview-carousel .carousel-indicators li {
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button.added + .added_to_cart,
			#yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button + .added_to_cart,.yith-quick-view-content.woocommerce div.summary button.button.alt {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;		
			}

			/*YITH WFBT SECTION WOOCOMMERCE*/
			.yith-wfbt-section .yith-wfbt-form .yith-wfbt-submit-button {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.yith-wfbt-section .yith-wfbt-form .yith-wfbt-submit-button:hover,
			.yith-wfbt-section .yith-wfbt-items .price,.wcfm_popup_wrapper .wcfm_popup_button:hover {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.yith-wfbt-section .yith-wfbt-form .price_text .total_price {
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;		 
			 }
			/*End YITH WFBT*/
			.mm-menu .mm-panels > .mm-panel > .mm-navbar + .mm-listview li.active .mm-btn_next:after,
			.tawcvs-swatches .swatch.selected {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			/* Shop */
			.widget_price_filter .ui-slider .ui-slider-handle,
			#add_payment_method .wc-proceed-to-checkout a.checkout-button,
			.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
			#add_payment_method #payment div.form-row.place-order #place_order,
			.woocommerce-cart #payment div.form-row.place-order #place_order,
			.widget_price_filter .ui-slider .ui-slider-handle,
			.tp-bullets .tp-bullet.selected,
			.tp-bullets .tp-bullet:hover
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			.topbar-mobile-right .dropdown.open .btn,
			.topbar-mobile-right .dropdown .btn:hover,
			.topbar-mobile .active-mobile>a 
			 {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}

			/*fix 2.1.6*/
			.ui-autocomplete.ui-widget-content li.list-bottom a {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.ui-autocomplete.ui-widget-content li.list-bottom a:hover,
			.ui-autocomplete.ui-widget-content li.list-header .count,
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button:hover, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover, 
			#yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button:hover,
			#yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button:hover:before,
			.yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button:hover:before,
			.wcfmmp_sold_by_wrapper a:hover,.wcfmmp_sold_by_container_advanced .wcfmmp_sold_by_wrapper .wcfmmp_sold_by_store a:hover
			{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.ui-autocomplete.ui-widget-content li.list-bottom,
			.wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).image-variable-item:hover, .wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).image-variable-item.selected,
			.wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).button-variable-item:hover, .wvs-css .variable-items-wrapper .variable-item:not(.radio-variable-item).button-variable-item.selected {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}


			.widget_price_filter .price_slider_amount .button,
			.widget.yith-woocompare-widget a.compare,
			.pagination span.current, .pagination a.current, .tbay-pagination span.current, .tbay-pagination a.current,
			.tparrows:hover,
			.pagination a:hover, .tbay-pagination a:hover,
			.instagram-widget .owl-carousel .owl-nav .owl-next:hover, .instagram-widget .owl-carousel .owl-nav .owl-prev:hover,
			.widget-products.widget-product-tabs .owl-carousel .owl-nav .owl-prev:hover,
			.widget-products.widget-product-tabs .owl-carousel .owl-nav .owl-next:hover{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			body table.compare-list .add-to-cart td .add-cart a {
				color: #fff !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			body table.compare-list .add-to-cart td .add-cart a:hover {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				background: transparent !important;
			}
			.product-block .groups-button .yith-compare > a.added {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}

			.woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce table.shop_table td.product-add-to-cart a,
			#customer_login button.button,
			.woocommerce .woocommerce-ResetPassword input[type="submit"],
			.dokan-pagination-container .dokan-pagination li.active a,
			.woocommerce .checkout_coupon button.button,
			.woocommerce .lost_reset_password button[type="submit"],
			.yith-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, .yith-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button, #yith-quick-view-modal .yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button, #yith-quick-view-modal .yith-wcqv-wrapper .yith-quick-view-content .summary .single_add_to_cart_button
			 {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#customer_login button.button:hover,
			.woocommerce .woocommerce-ResetPassword input[type="submit"]:hover,
			.woocommerce .checkout_coupon button.button:hover,
			.woocommerce .lost_reset_password button[type="submit"]:hover
			 {
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#add_payment_method .wc-proceed-to-checkout a.checkout-button,
			.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
			#add_payment_method #payment div.form-row.place-order #place_order,
			.woocommerce-cart #payment div.form-row.place-order #place_order,
			#tbay-header.header-v4 .header-main .box-search-4 .tbay-search-form .button-search:hover,
			.widget-products.special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.widget-special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.carousel-special .product-block .caption .groups-button a.add_to_cart_button:hover, .widget-products.widget-carousel-special .product-block .caption .groups-button a.add_to_cart_button:hover
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.pagination a:hover, .tbay-pagination a:hover,
			.product-block .groups-button .add-cart .product_type_simple:hover,
			.product-block .groups-button .add-cart .product_type_simple:hover i{
				color: #fff !important;
			}
			/* Greenmart */ 
			.btn-slider.btn-color,
			.btn-slider:hover,
			.widget-categoriestabs .woocommerce .btn-view-all, .widget_deals_products .woocommerce .btn-view-all,
			.widget.widget-brands .owl-carousel .owl-nav .owl-prev:hover, .widget.widget-brands .owl-carousel .owl-nav .owl-next:hover,
			.widget-categoriestabs .woocommerce .owl-carousel .owl-nav .owl-next:hover, .widget-categoriestabs .woocommerce .owl-carousel .owl-nav .owl-prev:hover, .widget_deals_products .woocommerce .owl-carousel .owl-nav .owl-next:hover, .widget_deals_products .woocommerce .owl-carousel .owl-nav .owl-prev:hover,
			.product-block .groups-button .add-cart .product_type_external:hover, .product-block .groups-button .add-cart .product_type_grouped:hover, .product-block .groups-button .add-cart .add_to_cart_button:hover,
			.product-block .groups-button .yith-wcwl-wishlistexistsbrowse > a:hover, .product-block .groups-button .yith-wcwl-wishlistaddedbrowse > a:hover, .product-block .groups-button .yith-wcwl-add-to-wishlist > a:hover, .product-block .groups-button .yith-compare > a:hover, .product-block .groups-button .add_to_wishlist:hover, .product-block .groups-button .yith-wcqv-button:hover,
			.product-block .added_to_cart.wc-forward {
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: #fff !important;
			}
			.group-text > p:before,
			.post-grid:hover .entry-title,
			#search-form-modal .btn,
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:hover, #tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:active,
			.top-cart .dropdown-menu p.buttons,
			.categorymenu .widgettitle, .widget_tbay_custom_menu .widgettitle,
			#comments .form-submit input,
			.layout-blog .post-list > article.sticky .entry-title, .layout-blog .post-list > article.tag-sticky-2 .entry-title,
			.woocommerce table.wishlist_table tbody tr.mobile td a.button,
			.woocommerce-checkout #payment div.form-row.place-order #place_order,
			.singular-shop div.product .information .cart .button,
			.woocommerce .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce .woocommerce-MyAccount-navigation ul li:hover a, .woocommerce .woocommerce-MyAccount-navigation ul li:focus a,
			#tbay-header.header-v2 .header-search-v2 .btn-search-totop,
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li:hover > a, 
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li.active > a,
			.widget-products.carousel .owl-carousel .owl-nav .owl-next:hover, .widget-products.carousel .owl-carousel .owl-nav .owl-prev:hover, .widget-products.widget-carousel .owl-carousel .owl-nav .owl-next:hover, .widget-products.widget-carousel .owl-carousel .owl-nav .owl-prev:hover, .widget-products.carousel-special .owl-carousel .owl-nav .owl-next:hover, .widget-products.carousel-special .owl-carousel .owl-nav .owl-prev:hover, .widget-products.widget-carousel-special .owl-carousel  .owl-nav .owl-next:hover, .widget-products.widget-carousel-special .owl-carousel .owl-nav .owl-prev:hover, .post-list .post:hover .entry-title,
			.singular-shop div.product .information .single_add_to_cart_button.added + a
			{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.categorymenu .widgettitle:before, .widget_tbay_custom_menu .widgettitle:before{
				background-color: transparent !important;
			}
			.categorymenu .menu-category-menu-container ul li a:hover, .widget_tbay_custom_menu .menu-category-menu-container ul li a:hover{
				border-right-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			#tbay-header.header-v4 .header-main .tbay-mainmenu .btn-offcanvas:hover,
			#tbay-header.header-v5 .right-item .tbay-mainmenu .btn-offcanvas:hover{
				border-right-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			@media (max-width: 768px) {
				.singular-shop div.product .information .cart .button, #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
				.woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button, 
				#add_payment_method #payment div.form-row.place-order #place_order, .woocommerce-cart #payment div.form-row.place-order #place_order, 
				.woocommerce-checkout #payment div.form-row.place-order #place_order,
				.singular-shop div.product .information .entry-summary.has-buy-now .single_add_to_cart_button + .added_to_cart.wc-forward
				 {
					background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				}
				.entry-summary.has-buy-now form.cart .tbay-buy-now.button:hover, 
				.entry-summary.has-buy-now form.cart .tbay-buy-now.button:focus,	
				.singular-shop div.product .information .entry-summary.has-buy-now .tbay-buy-now.button:hover, .singular-shop div.product .information .entry-summary.has-buy-now .tbay-buy-now.button:focus,
				.singular-shop div.product .information .entry-summary.has-buy-now .single_add_to_cart_button:hover, .singular-shop div.product .information .entry-summary.has-buy-now .single_add_to_cart_button:focus {
					background-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
					border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				}
			}
			
			#tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:hover, #tbay-header.header-v3 .tbay-mainmenu .navbar-nav.megamenu > li > a:active,
			.widget-categoriestabs .woocommerce .btn-view-all:hover,
			.widget-categoriestabs .woocommerce .btn-view-all:hover i{
				color: #fff !important;
			}
			.top-footer .widget-newletter .input-group .btn.btn-default,
			.woocommerce .woocommerce-MyAccount-content .woocommerce-Button,
			.btn-default, 
			.btn-theme,
			#wcfmmp-store #reviews .add_review button,
			#wcfm-main-contentainer .wcfm_form_simple_submit_wrapper .wcfm_submit_button,
			.yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button,#wcmp-store-conatiner div.wcmp-pagination li > a:hover, #wcmp-store-conatiner div.wcmp-pagination li > a.current, #wcmp-store-conatiner div.wcmp-pagination li > span:hover, #wcmp-store-conatiner div.wcmp-pagination li > span.current,
			.btn-default, .btn-theme, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce-page .woocommerce-message .button, .woocommerce .woocommerce-form-login input[type="submit"], .woocommerce .checkout_coupon input[type="submit"], .woocommerce .return-to-shop a.button, .woocommerce .woocommerce-MyAccount-content a.button, .woocommerce-shipping-calculator .shipping-calculator-form button[type="submit"], .widget_wcmp_quick_info #respond input#submit, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input, #wcmp-store-conatiner input[type="submit"], .wcmp_regi_main .register button.button
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: #fff !important;
			}
			.btn-default:hover, .btn-default:focus, .woocommerce .woocommerce-MyAccount-content .woocommerce-Button:hover ,.btn-default:active, .btn-default.active, .btn-theme:hover, .btn-theme:focus, .btn-theme:active, .btn-theme.active,
			.yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover,
			.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-theme:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover, .woocommerce-page .woocommerce-message .button:hover, .woocommerce .woocommerce-form-login input[type="submit"]:hover, .woocommerce .checkout_coupon input[type="submit"]:hover, .woocommerce .return-to-shop a.button:hover, .woocommerce .woocommerce-MyAccount-content a.button:hover, .btn-theme:focus, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:focus, .woocommerce #payment #place_order:focus, .woocommerce-page #payment #place_order:focus, .woocommerce-page .woocommerce-message .button:focus, .woocommerce .woocommerce-form-login input[type="submit"]:focus, .woocommerce .checkout_coupon input[type="submit"]:focus, .woocommerce .return-to-shop a.button:focus, .woocommerce .woocommerce-MyAccount-content a.button:focus, .btn-theme:active, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:active, .woocommerce #payment #place_order:active, .woocommerce-page #payment #place_order:active, .woocommerce-page .woocommerce-message .button:active, .woocommerce .woocommerce-form-login input[type="submit"]:active, .woocommerce .checkout_coupon input[type="submit"]:active, .woocommerce .return-to-shop a.button:active, .woocommerce .woocommerce-MyAccount-content a.button:active, .btn-theme.active, .woocommerce-cart .wc-proceed-to-checkout a.active.checkout-button, .woocommerce #payment .active#place_order, .woocommerce-page #payment .active#place_order, .woocommerce-page .woocommerce-message .active.button, .woocommerce .woocommerce-form-login input.active[type="submit"], .woocommerce .checkout_coupon input.active[type="submit"], .woocommerce .return-to-shop a.active.button, .woocommerce .woocommerce-MyAccount-content a.active.button,
			.top-footer .widget-newletter .input-group .btn.btn-default:hover,
			#wcfm-main-contentainer .wcfm_form_simple_submit_wrapper .wcfm_submit_button:hover,
			#wcfm-main-contentainer .wcfm_form_simple_submit_wrapper #wcfm_membership_register_button:hover,
			.woocommerce-shipping-calculator .shipping-calculator-form button[type="submit"]:hover, .widget_wcmp_quick_info #respond input#submit:hover, .widget_wcmp_quick_info #respond input#submit:focus, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input:hover, .woocommerce #reviews #wcmp_vendor_reviews #respond .form-submit input:focus, #wcmp-store-conatiner input[type="submit"]:hover, #wcmp-store-conatiner input[type="submit"]:focus, .wcmp_regi_main .register button.button:hover, .wcmp_regi_main .register button.button:focus {
				background-color: #fff !important;
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget-testimonials.v2 .testimonials-body .description i,
			.vc_blog .title-heading-blog a,
			.meta-info span.author a,
			#tbay-footer .top-footer .txt2 strong,
			#tbay-footer .ft-contact-info .txt1 i,
			#tbay-footer .ft-contact-info .txt3,
			#tbay-footer .menu > li:hover > a,
			#wcfm_membership_container .terms_title a,
			.navbar-nav.megamenu > li.active > a i
			,#wcfmmp-store ins,
			.navbar-nav.megamenu > li > a:hover i, .navbar-nav.megamenu > li > a:active i,
			.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus,
			.navbar-nav.megamenu .dropdown-menu > li > a:hover, .navbar-nav.megamenu .dropdown-menu > li > a:active,
			.widget-features.style1 .fbox-image i, .widget-features.style1 .fbox-icon i,
			.categorymenu .menu-category-menu-container ul li a:hover i, .widget_tbay_custom_menu .menu-category-menu-container ul li a:hover i,
			#tbay-header.header-v4 .header-main .top-contact .contact-layoutv4 li i,
			.widget-features.style2 .fbox-image i, .widget-features.style2 .fbox-icon i,
			.tit_heading_v5 a,
			.singular-shop div.product .information .single_add_to_cart_button:hover:before,
			.singular-shop div.product .information .single_add_to_cart_button:hover,
			.widget_product_categories .product-categories .current-cat > a,
			.widget.woocommerce .woocommerce-Price-amount,
			.contactinfos li i,
			.page-404 .notfound-top h1,
			.product-block .button-wishlist .yith-wcwl-wishlistexistsbrowse.show a, .product-block .button-wishlist .yith-wcwl-wishlistaddedbrowse.show a,
			body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a,
			.footer-device-mobile > *.active a,
			.woocommerce table.shop_table_responsive tr.mobile td .woocommerce-Price-amount, .woocommerce-page table.shop_table_responsive tr.mobile td .woocommerce-Price-amount,
			.navbar-offcanvas .navbar-nav > li.active > a,
			.singular-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .singular-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a,
			.tbay-breadscrumb .breadscrumb-inner .breadcrumb a:hover,
			.yith-wcqv-wrapper #yith-quick-view-content .summary .price,
			.yith-wcqv-wrapper #yith-quick-view-content .summary .single_add_to_cart_button:hover:before,
			.tbay-breadscrumb .breadscrumb-inner .breadcrumb .active,
			#tbay-footer .menu > li:hover > a:before,
			.navbar-nav.megamenu .dropdown-menu .widget ul li.active a,
			.widget-categoriestabs ul.nav-tabs > li:hover a i, .widget_deals_products ul.nav-tabs > li:hover a i,
			.widget-categoriestabs ul.nav-tabs > li:hover a, .widget_deals_products ul.nav-tabs > li:hover a,
			.navbar-offcanvas .dropdown-menu .dropdown-menu-inner ul li.active a,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li.active > a i,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li:hover > a i,
			a.wcvendors_cart_sold_by_meta,
			.wcvendors_sold_by_in_loop a, 
			dl.variation .variation-SoldBy a:hover,
			.woocommerce form.register .wcfmmp_become_vendor_link a:hover,
			#wcfmmp-store .categories_list ul li.parent_cat a:hover,
			.widget-categoriestabs ul.nav-tabs > li.active > a, .widget_deals_products ul.nav-tabs > li.active > a, .widget-product-tabs ul.nav-tabs > li.active > a,
			.widget-categoriestabs ul.nav-tabs > li:hover a, .widget_deals_products ul.nav-tabs > li:hover a, .widget-product-tabs ul.nav-tabs > li:hover a,
			.woocommerce .track_order a.button:hover, .woocommerce .track_order button.button:hover, .woocommerce .track_order input.button:hover, .woocommerce .track_order #respond input#submit:hover,
			.singular-shop div.product .information .single_add_to_cart_button.added + a:hover,
			.singular-shop div.product .information .single_add_to_cart_button.added + a:hover:before, .product-block .image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a, .product-block .image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a, .product-block .image .yith-wcwl-add-to-wishlist > div.yith-wcwl-add-button a.delete_item, .singular-shop div.product .information .yith-wcwl-add-to-wishlist a.delete_item, #wcmp-store-conatiner .wcmp-store-list .wcmp-store-detail-wrap .wcmp-store-detail-list li .wcmp_vendor_detail, .wcmp_vendor_banner_template.template2 .wcmp_vendor_detail:hover
			{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			
			#tbay-header.header-v5 .box-search-5 .tbay-search-form .button-search:hover{
				background: #fff !important;
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.owl-carousel .owl-nav .owl-prev:hover, .owl-carousel .owl-nav .owl-next:hover{
				background:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.navbar-nav.megamenu > li > a:hover, .navbar-nav.megamenu > li > a:active{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget-testimonials.v2 .testimonials-body:hover,
			.post-grid:hover .entry,
			.product-block.grid:hover,
			.vc_category .box:hover img,
			.products-grid.products .list:hover,
			.singular-shop div.product .flex-control-thumbs .slick-list li img.flex-active,
			.tbay-search-form .button-search,
			.product-block.grid:hover .product-content,
			.owl-dot.active span,
			.post-grid:hover .entry, .post-grid:hover .entry-content,
			.widget-testimonials.v2 .testimonials-body:hover .testimonials-content,
			#tbay-header.header-v2 .header-search-v2 .btn-search-totop,
			.widget-categoriestabs ul.nav-tabs > li:hover, .widget_deals_products ul.nav-tabs > li:hover,
			.widget-categories .owl-carousel.categories .owl-item .item .cat-img:hover img,
			.tagcloud a:focus, .tagcloud a:hover,
			.tbay-vertical-menu > .widget.widget_nav_menu .menu > li a:hover,
			.tbay-search-result .ui-autocomplete.ui-widget-content li.list-bottom,
			.woocommerce table.wishlist_table td.product-add-to-cart a:hover, .woocommerce table.shop_table td.product-add-to-cart a:hover,
			.widget-categoriestabs ul.nav-tabs > li.active, .widget_deals_products ul.nav-tabs > li.active, .widget-product-tabs ul.nav-tabs > li.active,
			.widget-categoriestabs ul.nav-tabs > li:hover, .widget_deals_products ul.nav-tabs > li:hover, .widget-product-tabs ul.nav-tabs > li:hover
			{
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			.navbar-nav.megamenu>li.active>a {
				border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			
			.tbay-to-top a:hover, .tbay-to-top button.btn-search-totop:hover{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			body table.compare-list .add-to-cart td a:hover {
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
				color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.singular-shop div.product .information .single_add_to_cart_button,
			.tbay-offcanvas .offcanvas-head .btn-toggle-canvas,
			.tbay-offcanvas.v4 .offcanvas-head .btn-toggle-canvas, .tbay-offcanvas.v5 .offcanvas-head .btn-toggle-canvas,
			body table.compare-list .add-to-cart td a,
			.product-block .groups-button .add-cart .product_type_simple:hover,
			input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme
			.woocommerce .track_order a.button, .woocommerce .track_order button.button, .woocommerce .track_order input.button, .woocommerce .track_order #respond input#submit, .woocommerce .woocommerce-order-details a.button, .woocommerce .woocommerce-order-details button.button, .woocommerce .woocommerce-order-details input.button, .woocommerce .woocommerce-order-details #respond input#submit,
			.singular-shop div.product .information .single_add_to_cart_button.added + a, .wishlist_table.mobile .product-add-to-cart .add-cart a
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.widget-testimonials.v2 .testimonials-body .testimonials-profile .name-client:before,
			.widget_deals_products .tbay-countdown .times > div,
			.group-text.home_3 .signature .job:before,
			#reviews .review_form_wrapper #respond .form-submit input,
			.wpcf7-form input[type="submit"],
			.footer-device-mobile > * a span.icon span.count, .footer-device-mobile > * a span.icon .mini-cart-items,
			.woocommerce .order-info mark, .woocommerce .order-info .mark
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.readmore a{
				border-bottom-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget-categoriestabs ul.nav-tabs > li.active, .widget_deals_products ul.nav-tabs > li.active,
			.woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a,
			.woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a:hover, .woocommerce .woocommerce-tabs ul.wc-tabs li:hover > a:focus, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a:hover, .woocommerce .woocommerce-tabs ul.wc-tabs li.active > a:focus,
			.products-grid .product-category a.show-cat:hover, .post-list .post:hover .entry, .post-list .post:hover .entry-content
			{
				border-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			
			
			.top-cart .dropdown-menu .product-details .product-name:hover,
			.tbay-category-fixed ul li a:hover, .tbay-category-fixed ul li a:active,
			.flex-control-nav .slick-arrow:hover.owl-prev:after, .flex-control-nav .slick-arrow:hover.owl-next:after{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			#tbay-header .search-form .btn,
			.tbay_custom_menu.treeview-menu .widget .widgettitle,
			.widget-products.widget-carousel .owl-carousel  .owl-nav .owl-prev:hover,
			.widget-products.widget-carousel .owl-carousel  .owl-nav .owl-next:hover,
			.topbar-device-mobile .device-cart .mobil-view-cart .mini-cart-items,
			.yith-wcqv-wrapper #yith-quick-view-content .carousel-controls-v3 .carousel-control,
			.tbay-vertical-menu > .widget.widget_nav_menu > .widgettitle,
			.singular-shop div.product .tbay-single-time .times > div
			{
				background: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?>;
			}
			.btn-view-all:hover,
			.times > div,
			.text-theme,
			.singular-shop div.product .information .price,
			.singular-shop div.product .information .compare:hover:before,
			 .woocommerce div.product p.price ins span, .woocommerce div.product span.price ins span{
				color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			/*Border-color*/
			.tabs-v1 ul.nav-tabs li:hover > a, .tabs-v1 ul.nav-tabs li.active > a,
			.tabs-v1 ul.nav-tabs li:hover > a:hover, .tabs-v1 ul.nav-tabs li:hover > a:focus, .tabs-v1 ul.nav-tabs li.active > a:hover, .tabs-v1 ul.nav-tabs li.active > a:focus,
			.readmore a:hover,
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
			.tbay-search-form .button-search
			{
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
			}
			.widget_deals_products .products-carousel .widget-title::after{
				border-color:<?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
			}
			.tbay-loader-five .spinner-cube:before,.tbay-loader-five .spinner-cube:before {
				background-color: <?php echo esc_html( greenmart_tbay_get_config('main_color') ) ?> !important;
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
				#cart .mini-cart .qty,
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
				#tbay-footer {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( greenmart_tbay_get_config('footer_link_color') != "" ) : ?>
				#tbay-footer a,
				#tbay-footer .menu>li a {
					color: <?php echo esc_html(greenmart_tbay_get_config('footer_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( greenmart_tbay_get_config('footer_link_color_hover') != "" ) : ?>
				#tbay-footer a:hover,
				#tbay-footer .menu>li a:hover {
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
				.tbay-copyright {
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
				.tbay-copyright {
					color: <?php echo esc_html(greenmart_tbay_get_config('copyright_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( greenmart_tbay_get_config('copyright_link_color') != "" ) : ?>
				.tbay-copyright a {
					color: <?php echo esc_html(greenmart_tbay_get_config('copyright_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( greenmart_tbay_get_config('copyright_link_color_hover') != "" ) : ?>
				.tbay-copyright a:hover {
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