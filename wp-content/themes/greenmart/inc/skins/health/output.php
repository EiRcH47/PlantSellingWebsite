<?php if ( ! defined('GREENMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Prepare CSS selectors for theme settions (colors, borders, typography etc.)
 * ------------------------------------------------------------------------------------------------
 */

$output = array();
 
/*TopBar Color*/
$output['topbar_bg'] = array('#tbay-topbar, #tbay-header.header-v2 #tbay-topbar');
$output['topbar_text_color'] = array(
    'color' => greenmart_texttrim('#tbay-topbar, #tbay-header.header-v2 #tbay-topbar')
);
$output['topbar_link_color'] = array(
    'color' => greenmart_texttrim('#tbay-topbar a, #tbay-header.header-v2 #tbay-topbar a')
);

/*Header Color*/
$output['header_bg'] = array('#tbay-header .header-top, #tbay-header.header-v3 .tbay-mainme');
$output['header_text_color'] = array(
    'color' => greenmart_texttrim('#tbay-header, #tbay-header.header-v3 .header-main,.list-inline.acount li .tit,.list-inline.acount li .user,#cart .mini-cart .sub-title,.header-v1 .header-main .header-inner .list-inline.acount li, .header-v1 .header-main .header-inner .list-inline.acount li')
);
$output['header_link_color'] = array(
    'color' => greenmart_texttrim('#tbay-header a, #tbay-header.header-v3 .header-main a, .list-inline.acount li a.login, #tbay-header .header-top .navbar-nav.megamenu > li:hover > a, #tbay-header .header-top .navbar-nav.megamenu > li.active > a')
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

$main_menu_link_color_active = '
#tbay-header .navbar-nav.megamenu > li.active > a,
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
$output['footer_bg'] = array('#tbay-footer, .bottom-footer, .footer-content, .footer-top');
$output['footer_heading_color'] = array(
    'color' => greenmart_texttrim('#tbay-footer h1, #tbay-footer h2, #tbay-footer h3, #tbay-footer h4, #tbay-footer h5, #tbay-footer h6 ,#tbay-footer .widget-title')
);
$output['footer_text_color'] = array(
    'color' => greenmart_texttrim('#tbay-footer, #tbay-footer .widget .description, .bottom-footer, #tbay-footer p, #tbay-footer ul.ft-contact-info li')
);
$output['footer_link_color'] = array(
    'color' => greenmart_texttrim('#tbay-footer a, #tbay-footer .footer-content a')
);
$output['footer_link_color_hover'] = array(
    'color' => greenmart_texttrim('#tbay-footer a:hover, #tbay-footer .footer-content a:hover')
);

/*Copyright Color */
$output['copyright_bg'] = array('.bottom-footer');
$output['copyright_text_color'] = array(
    'color' => greenmart_texttrim('.bottom-footer')
);
$output['copyright_link_color'] = array(
    'color' => greenmart_texttrim('.bottom-footer a')
);
$output['copyright_link_color_hover'] = array(
    'color' => greenmart_texttrim('.bottom-footer a:hover')
);

return apply_filters( 'greenmart_get_output', $output);
