<?php if ( ! defined('GREENMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Prepare CSS selectors for theme settions (colors, borders, typography etc.)
 * ------------------------------------------------------------------------------------------------
 */

$output = array();
 
/*Header Mobile*/
$output['header_mobile_bg'] = array( 
	'background-color' => greenmart_texttrim('.topbar-device-mobile')
);
$output['header_mobile_color'] = array( 
	'color' => greenmart_texttrim('.topbar-device-mobile i, .topbar-device-mobile.active-home-icon .topbar-title')
);

return apply_filters( 'greenmart_get_output', $output);