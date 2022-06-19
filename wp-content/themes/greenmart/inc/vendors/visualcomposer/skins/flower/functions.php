<?php

if ( !function_exists('greenmart_tbay_load_private_woocommerce_element')) {
	function greenmart_tbay_load_private_woocommerce_element() {

		vc_remove_param( "tbay_features", "style" );
		vc_remove_param( "tbay_features", "align" );
		vc_remove_param( "tbay_testimonials", "align" );
		vc_remove_param( "tbay_productcategory", "align" );
		vc_remove_param( "tbay_gridposts", "align" );
		vc_remove_param( "tbay_gridposts", "style" );
		vc_remove_param( "tbay_product_countdown", "layout_type" );
		vc_remove_param( "tbay_products", "layout_type" );
		vc_remove_param( "tbay_products", "el_class" );

		add_action( 'vc_after_init', 'add_column' ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */
		function add_column() {
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

		vc_add_param( 'tbay_product_countdown', array(
		    "type" => "dropdown",
			"heading" => esc_html__("Layout Type", 'greenmart'),
			"param_name" => "layout_type",
			'value'       => array(
						'Grid'  	=> 'grid',
						'Carousel'   	=> 'carousel'
					),
			"admin_label" => true,
			'weight' => 1,
		));
		vc_add_params( 'tbay_products', 
			array(
				array(
				    "type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'greenmart'),
					"param_name" => "layout_type",
					'value'       => array(
								'Grid'  	=> 'grid',
								'Carousel'   	=> 'carousel'
							),
					"admin_label" => true,
					'weight' => 1,
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( 'Display Show More?', 'greenmart' ),
					"description" 	=> esc_html__( 'Show/hidden Show More', 'greenmart' ),
					"param_name" 	=> "show_button",
	                "value" 		=> array(
	                		 			esc_html__('Yes', 'greenmart') =>'yes' ),
	                'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'grid',
							),
					),
					'weight' => 1,
				),
				array(
					"type" 		=> "textfield",
					"class" 	=> "",
					"heading" 	=> esc_html__('Text Button', 'greenmart'),
					"param_name" => "button_text",
					"value" 	=> '',
					'std'       => esc_html__('Show more', 'greenmart'),
					'dependency' 	=> array(
							'element' 	=> 'show_button',
							'value' 	=> array (
								'yes',
							),
					),
					'weight' => 1,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__('Extra class name','greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','greenmart')
				)
			)
		);
		vc_add_param( 'tbay_gridposts', array(
		    "type" => "dropdown",
			"heading" => esc_html__("Layout Type", 'greenmart'),
			"param_name" => "layout_type",
			'value'       => array(
						'Grid'  	=> 'grid',
						'Carousel'   	=> 'carousel'
					),
			"admin_label" => true
		));
		
		vc_map( array(
			'name'        => esc_html__( 'Tbay Flower Widget Heading','greenmart'),
			'base'        => 'tbay_flower_title_heading',
			"icon"        => "vc-icon-tbay",
			"class"       => "",
			"category" => esc_html__('Flower', 'greenmart'),
			'description' => esc_html__( 'Create title for one Widget', 'greenmart' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'greenmart' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'greenmart' ),
					'description' => esc_html__( 'Enter heading title.', 'greenmart' ),
					"admin_label" => true
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'greenmart' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'greenmart' )
				),
				array(
	                "type" => "textfield",
	                "class" => "",
	                "heading" => esc_html__('Sub Title','greenmart'),
	                "param_name" => "subtitle",
	                "admin_label" => true
	            ),
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'greenmart' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'greenmart' )
			    ),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Title align:', 'greenmart' ),
					'param_name' => 'align',
					'value'       => array(
						'Center'  	=> 'center',
						'Left'   	=> 'left',
						'Right'   	=> 'right'
					),
					'std'       => 'center',
					'save_always' => true,
				),	
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'greenmart' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'greenmart' )
				)

			),
		));
	}
}

add_action( 'vc_after_set_mode', 'greenmart_tbay_load_private_woocommerce_element', 98 );

class WPBakeryShortCode_tbay_flower_title_heading extends WPBakeryShortCode {}