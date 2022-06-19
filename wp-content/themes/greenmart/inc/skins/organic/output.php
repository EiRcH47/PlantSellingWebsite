<?php if ( ! defined('GREENMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Prepare CSS selectors for theme settions (colors, borders, typography etc.)
 * ------------------------------------------------------------------------------------------------
 */

$output = array();
 
/*TopBar Color*/
$output['topbar_bg'] = array('#tbay-topbar, #tbay-header.header-v2 #tbay-topbar,
#tbay-header.header-v4 #tbay-topbar');
$output['topbar_text_color'] = array(
	'color' => greenmart_texttrim('#tbay-topbar,
	#tbay-header.header-v2 #tbay-topbar,
	#tbay-header.header-v4 #tbay-topbar')
);
$output['topbar_link_color'] = array(
	'color' => greenmart_texttrim('#tbay-topbar a,
	#tbay-header.header-v2 #tbay-topbar a,
	#tbay-header.header-v4 #tbay-topbar a')
);

/*Header Color*/
$output['header_bg'] = array('#tbay-header .header-main, #tbay-header.header-v3 .tbay-mainmenu');
$output['header_text_color'] = array(
	'color' => greenmart_texttrim('#tbay-header, #tbay-header.header-v3 .header-main,.list-inline.acount li .tit,.list-inline.acount li .user,#cart .mini-cart .sub-title,#tbay-header.header-v4 .header-main .top-contact .contact-layoutv4 li.black,#tbay-header.header-v4 .header-main .top-contact .contact-layoutv4 li,#tbay-header.header-v6 .category-v6 .category-inside-title,.header-v1 .header-main .header-inner .list-inline.acount li')
);
$output['header_link_color'] = array(
	'color' => greenmart_texttrim('#tbay-header a, #tbay-header.header-v3 .header-main a,.list-inline.acount li a.login,#cart .mini-cart .qty,#tbay-header.header-v4 .header-main .tbay-mainmenu .btn-offcanvas,#tbay-header.header-v6 .header-inner .right-item .list-inline.acount li a,#tbay-header.header-v5 .right-item .tbay-mainmenu .btn-offcanvas')
);
$output['header_link_color_active'] = array(
	'color' => greenmart_texttrim('#tbay-header .active > a,#tbay-header a:active,#tbay-header a:hover')
);

/*Menu Color */
$output['main_menu_link_color'] = array(
	'color' => greenmart_texttrim('.dropdown-menu .menu li a,
	.navbar-nav.megamenu .dropdown-menu > li > a,
	.navbar-nav.megamenu > li > a,
	.navbar-nav.megamenu > li > a .fa, .navbar-nav.megamenu > li > a img')
);

$main_menu_link_color_active = '#tbay-header .navbar-nav.megamenu > li.active > a,
#tbay-header .navbar-nav.megamenu > li > a:hover,
#tbay-header .navbar-nav.megamenu > li > a:active,
#tbay-header .navbar-nav.megamenu .dropdown-menu > li.active > a,
#tbay-header .navbar-nav.megamenu .dropdown-menu > li > a:hover,
#tbay-header .dropdown-menu .menu li a:hover,
#tbay-header .dropdown-menu .menu li.active > a,
#tbay-header .navbar-nav.megamenu > li:hover > a .fa, 
#tbay-header .navbar-nav.megamenu > li:hover > a img,
#tbay-header .navbar-nav.megamenu > li.active > a .fa, 
#tbay-header .navbar-nav.megamenu > li.active > a img';
$output['main_menu_link_color_active'] = array(
	'color' => greenmart_texttrim($main_menu_link_color_active),
	'border-bottom-color' => greenmart_texttrim($main_menu_link_color_active),
);

/*Footer Color */
$output['footer_bg'] = array('#tbay-footer, .bottom-footer');
$output['footer_heading_color'] = array(
	'color' => greenmart_texttrim('#tbay-footer h1, #tbay-footer h2, #tbay-footer h3, #tbay-footer h4, #tbay-footer h5, #tbay-footer h6 ,#tbay-footer .widget-title')
);
$output['footer_text_color'] = array(
	'color' => greenmart_texttrim('#tbay-footer')
);
$output['footer_link_color'] = array(
	'color' => greenmart_texttrim('#tbay-footer a,
	#tbay-footer .menu>li a')
);
$output['footer_link_color_hover'] = array(
	'color' => greenmart_texttrim('#tbay-footer a:hover,
	#tbay-footer .menu>li a:hover')
);

/*Copyright Color */
$output['copyright_bg'] = array('.tbay-copyright');
$output['copyright_text_color'] = array(
	'color' => greenmart_texttrim('.tbay-copyright')
);
$output['copyright_link_color'] = array(
	'color' => greenmart_texttrim('.tbay-copyright a')
);
$output['copyright_link_color_hover'] = array(
	'color' => greenmart_texttrim('.tbay-copyright a:hover')
);

return apply_filters( 'greenmart_get_output', $output);
