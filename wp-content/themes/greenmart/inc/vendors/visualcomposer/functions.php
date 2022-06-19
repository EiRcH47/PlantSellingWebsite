<?php
/**
 * Custom parameters for visual composer
 */
if ( !function_exists('greenmart_tbay_custom_vc_params')) {
	function greenmart_tbay_custom_vc_params(){
		
		if( !greenmart_vc_is_activated() ) return;

		vc_add_param( 'vc_row', array(
		    "type" => "checkbox",
		    "heading" => esc_html__("Parallax", 'greenmart'),
		    "param_name" => "parallax",
		    "value" => array(
		        'Yes, please' => true
		    )
		));

		vc_add_param( 'vc_row', array(
		    "type" => "dropdown",
		    "heading" => esc_html__("Is Boxed", 'greenmart'),
		    "param_name" => "isfullwidth",
		    "value" => array(
				esc_html__('Yes, Boxed', 'greenmart') => '1',
				esc_html__('No, Wide', 'greenmart') => '0'
			)
		));

		// add param for image elements

		vc_add_param( 'vc_single_image', array(
		     "type" => "textarea",
		     "heading" => esc_html__("Image Description", 'greenmart'),
		     "param_name" => "description",
		     "value" => "",
		     'priority'	
		));
	}
}
add_action( 'after_setup_theme', 'greenmart_tbay_custom_vc_params', 99 );
 

if ( function_exists('tbay_framework_add_param') ) {
	tbay_framework_add_param();
}



function greenmart_tbay_translate_column_width_to_span( $width ) {
	preg_match( '/(\d+)\/(\d+)/', $width, $matches );

	if ( ! empty( $matches ) ) {
		$part_x = (int) $matches[1];
		$part_y = (int) $matches[2];
		if ( $part_x > 0 && $part_y > 0 ) {
			$value = ceil( $part_x / $part_y * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width = 'vc_col-md-' . $value;
			}
		}
	}

	return $width;
}