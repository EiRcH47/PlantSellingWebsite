<?php

if ( !function_exists('greenmart_tbay_load_private_woocommerce_element')) {
	function greenmart_tbay_load_private_woocommerce_element() {

		$add_param = array(
			array(
			    "type" => "dropdown",
				"heading" => esc_html__("Title Position", 'greenmart'),
				"param_name" => "title_position",
				'value'       => array(
							'Center'  	=> 'center',
							'Left'   	=> 'left'
				),
				"admin_label" => true,
				'weight' => 1,
			),
			array(
				"type" 			=> "checkbox",
				"heading" 		=> esc_html__( 'Title background?', 'greenmart' ),
				"description" 	=> esc_html__( 'Show/hidden title background', 'greenmart' ),
				"param_name" 	=> "title_bg",
                "value" 		=> array(
                		 			esc_html__('Yes', 'greenmart') =>'yes' ),
                'dependency' 	=> array(
						'element' 	=> 'title_position',
						'value' 	=> array (
							'left',
						),
				),
				'weight' => 1,
			),
		);

		/*Param woocomce*/
		vc_remove_param( 'tbay_products', 'align' );
		vc_add_params( 'tbay_products', $add_param );		

		vc_remove_param( 'tbay_product_countdown', 'align' );
		vc_add_params( 'tbay_product_countdown', $add_param );	

		vc_remove_param( 'tbay_productcategory', 'align' );
		vc_add_params( 'tbay_productcategory', $add_param );		

		vc_remove_param( 'tbay_list_categories', 'align' );
		vc_add_params( 'tbay_list_categories', $add_param );		

		vc_remove_param( 'tbay_productstabs', 'align' );
		vc_add_params( 'tbay_productstabs', $add_param );		

		/*End Param woocomce*/		

		/*Param Blog*/
		vc_remove_param( "tbay_features", "style" );

		vc_remove_param( 'tbay_testimonials', 'align' );
		vc_add_params( 'tbay_testimonials', $add_param );		

		vc_remove_param( 'tbay_instagram', 'align' );
		vc_add_params( 'tbay_instagram', $add_param );		

		vc_remove_param( 'tbay_gridposts', 'align' );
		vc_add_params( 'tbay_gridposts', $add_param );
		/*End Param Blog*/
		vc_remove_param( "tbay_title_heading", "style" );
		
		vc_add_param( 'tbay_gridposts', array(
			"type" => "dropdown",
			"heading" => esc_html__("Layout Type", 'greenmart'),
			"param_name" => "layout_type",
			"value" => array(
				esc_html__('Grid', 'greenmart') => 'grid',
				esc_html__('Carousel', 'greenmart') => 'carousel',
			),
			"admin_label" => true
		));

		vc_add_param( 'tbay_features', array(
		    "type" => "dropdown",
			"heading" => esc_html__("Style", 'greenmart'),
			"param_name" => "style",
			'value'       => array(
						esc_html__('Styel 1 ', 'greenmart') => 'style1', 
						esc_html__('Styel 2 ', 'greenmart') => 'style2',
					),
			'std' => ''
		));




		add_action( 'vc_after_init', 'add_column' ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */
		function add_column() {
		  //Get current values stored in the color param in "Call to Action" element

		  $columns_arrays =  array(
		  	'columns', 
		  	'screen_desktop',
		  	 'screen_desktopsmall',
		  	 'screen_tablet',
		  	 'screen_mobile',
		  );

		  foreach ($columns_arrays as $value) {
				$param = WPBMap::getParam( 'tbay_products', $value );
				//Append new value to the 'value' array
				$param['value'] = array(1,2,3,4,5,6);
				//Finally "mutate" param with new values
				vc_update_shortcode_param( 'tbay_products', $param );
		  }

		}

		add_action( 'vc_after_init', 'edit_layout_product' );
		function edit_layout_product() {
		  //Get current values stored in the color param in "Call to Action" element
		  $param = WPBMap::getParam( 'tbay_products', 'layout_type' );
		  //Append new value to the 'value' array
		  $param['value'] = array(	'Grid'=>'grid',
									'Carousel Vertical'=>'carousel-special',
									'Carousel'=>'carousel');
		  //Finally "mutate" param with new values
		  vc_update_shortcode_param( 'tbay_products', $param );
		} 

	} 
}

add_action( 'vc_after_set_mode', 'greenmart_tbay_load_private_woocommerce_element', 98 );