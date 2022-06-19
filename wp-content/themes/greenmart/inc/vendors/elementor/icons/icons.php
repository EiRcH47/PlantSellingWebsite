<?php

if ( ! function_exists( 'greenmart_elementor_icon_control_simple_line_icons' ) ) {
	add_action( 'elementor/icons_manager/additional_tabs', 'greenmart_elementor_icon_control_simple_line_icons' );
	function greenmart_elementor_icon_control_simple_line_icons( $tabs ) {
		$tabs['simple-line-icons'] = [
			'name'          => 'simple-line-icons',
			'label'         => esc_html__( 'Simple Line Icons', 'greenmart' ),
			'prefix'        => 'icon-',
			'displayPrefix' => 'icon-',
			'labelIcon'     => 'fa fa-font-awesome',
			'ver'           => '2.4.0',
			'fetchJson'     => get_template_directory_uri() . '/inc/vendors/elementor/icons/json/simple-line-icons.json', 
			'native'        => true,
		];

		return $tabs;
	}
}

if ( ! function_exists( 'greenmart_elementor_icon_control_tbay_custom' ) ) {
	add_action( 'elementor/icons_manager/additional_tabs', 'greenmart_elementor_icon_control_tbay_custom' );
	function greenmart_elementor_icon_control_tbay_custom( $tabs ) {
		$tabs['tbay-custom'] = [
			'name'          => 'tbay-custom',
			'label'         => esc_html__( 'Thembay Custom', 'greenmart' ),
			'prefix'        => 'tb-icon-',
			'displayPrefix' => 'tb-icon',
			'labelIcon'     => 'fa fa-font-awesome',
			'ver'           => '1.0.0',
			'fetchJson'     => get_template_directory_uri() . '/inc/vendors/elementor/icons/json/tbay-custom.json', 
			'native'        => true,
		];

		return $tabs;
	}
}