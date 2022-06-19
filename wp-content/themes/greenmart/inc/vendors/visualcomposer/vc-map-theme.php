<?php
if(!class_exists('WPBakeryShortCode')) return;

if ( !function_exists('greenmart_tbay_load_load_theme_element')) {
	function greenmart_tbay_load_load_theme_element() {
		$columns = array(1,2,3,4,6);
		$columns_isa 	= array(1,2,3,4,5,6,7,8);
		$rows 	 = array(1,2,3);
		// Heading Text Block
		vc_map( array(
			'name'        => esc_html__( 'Tbay Widget Heading','greenmart'),
			'base'        => 'tbay_title_heading',
			"icon"        => "vc-icon-tbay",
			"class"       => "",
			"category" => esc_html__('Tbay Elements', 'greenmart'),
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
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'greenmart' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'greenmart' )
			    ),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'greenmart'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Style Default', 'greenmart') => '',  
						esc_html__('Style2', 'greenmart') => 'style2',
						esc_html__('Style Small', 'greenmart') => 'stylesmall'
					),
					'std' => ''
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
		
		$fields = array();
		for ($i=1; $i <= 5; $i++) { 
			$fields[] = array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'greenmart').' '.$i,
				"param_name" => "title".$i,
				"value" => '',    "admin_label" => true,
			);
			$fields[] = array(
				"type" => "attach_image",
				"heading" => esc_html__("Photo", 'greenmart').' '.$i,
				"param_name" => "photo".$i,
				"value" => '',
				'description' => ''
			);
			$fields[] = array(
				"type" => "textarea",
				"heading" => esc_html__("information", 'greenmart').' '.$i,
				"param_name" => "information".$i,
				"value" => 'Your Description Here',
				'description'	=> esc_html__('Allow  put html tags', 'greenmart' )
			);
	    	$fields[] = array(
				"type" => "textfield",
				"heading" => esc_html__("Link Read More", 'greenmart').' '.$i,
				"param_name" => "link".$i,
				"value" => '',
			);
		}
		$fields[] = array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class name", 'greenmart'),
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
		);
		// Featured Box
		vc_map( array(
		    "name" => esc_html__("Tbay Featured Banner",'greenmart'),
		    "base" => "tbay_featurebanner",
		    "icon"        => "vc-icon-tbay",
		    "description"=> esc_html__('Decreale Service Info', 'greenmart'),
		    "class" => "",
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => $fields
		));
		
		// Tbay Counter
		vc_map( array(
		    "name" => esc_html__("Tbay Counter",'greenmart'),
		    "base" => "tbay_counter",
		    "icon"        => "vc-icon-tbay",
		    "class" => "",
		    "description"=> esc_html__('Counting number with your term', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'greenmart'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'greenmart'),
					"param_name" => "number",
					"value" => ''
				),
			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'greenmart'),
					"param_name" => "icon",
					"value" => '',
					'description' => esc_html__( 'This support display icon from FontAwsome, Please click', 'greenmart' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'greenmart' ) . '</a>'
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'greenmart'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'greenmart' )
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Color", 'greenmart'),
					"param_name" => "text_color",
					'value' 	=> '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));

		// Tbay Counter
		vc_map( array(
		    "name" => esc_html__("Tbay Brands",'greenmart'),
		    "base" => "tbay_brands",
		    "icon"        => "vc-icon-tbay",
		    "class" => "",
		    "description"=> esc_html__('Display brands on front end', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'greenmart'),
					"param_name" => "number",
					"value" => ''
				),
			 	array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'greenmart'),
					"param_name" => "layout_type",
					'value' 	=> array(
						esc_html__('Carousel', 'greenmart') => 'carousel', 
						esc_html__('Grid', 'greenmart') => 'grid'
					),
					'std' => ''
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','greenmart'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));
		
		vc_map( array(
		    "name" => esc_html__("Tbay Socials link",'greenmart'),
		    "base" => "tbay_socials_link",
		    "icon"        => "vc-icon-tbay",
		    "description"=> esc_html__('Show socials link', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'greenmart'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook Page URL", 'greenmart'),
					"param_name" => "facebook_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter Page URL", 'greenmart'),
					"param_name" => "twitter_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Youtube Page URL", 'greenmart'),
					"param_name" => "youtube_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest Page URL", 'greenmart'),
					"param_name" => "pinterest_url",
					"value" => '',
					"admin_label"	=> true 
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus Page URL", 'greenmart'),
					"param_name" => "google-plus_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Snapchat Page URL", 'greenmart'),
					"param_name" => "snapchat_url",
					"value" => '',
					"admin_label"	=> true
				),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Page URL", 'greenmart'),
					"param_name" => "instagram_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("LinkedIn Page URL", 'greenmart'),
					"param_name" => "linkedin_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));
		// newsletter
		vc_map( array(
		    "name" => esc_html__("Tbay Newsletter",'greenmart'),
		    "base" => "tbay_newsletter",
		    "icon"        => "vc-icon-tbay",
		    "class" => "",
		    "description"=> esc_html__('Show newsletter form', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'greenmart'),
					"param_name" => "description",
					"value" => '',
				),
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));
		// Testimonial
		vc_map( array(
            "name" => esc_html__("Tbay Testimonials",'greenmart'),
            "base" => "tbay_testimonials",
            "icon"        => "vc-icon-tbay",
            'description'=> esc_html__('Display Testimonials In FrontEnd', 'greenmart'),
            "class" => "",
            "category" => esc_html__('Tbay Widgets', 'greenmart'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
              	array(
	              	"type" => "textfield",
	              	"heading" => esc_html__("Number", 'greenmart'),
	              	"param_name" => "number",
	              	"value" => '4',
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','greenmart'),
	                "param_name" => 'columns',
	                'std'       => '4',
	                "value" => $columns
	            ),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Title, Navigation, Pagination align:', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					'param_name' 	=> 'align',
					'value'       	=> array(
						'Center'  	=> 'center',
						'Left'   	=> 'left',
						'Right'   	=> 'right'
					),
					'std'       => 'center',
					'save_always' => true,
				),	
				array(
					"type" 			=> "dropdown",
					"heading" 		=> esc_html__('Rows','greenmart'),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"param_name" 	=> 'rows',
					"value" 		=> $rows
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Navigation ", 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Navigation ', 'greenmart' ),
					"param_name" 	=> "nav_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),

				),					
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Pagination", 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Pagination', 'greenmart' ),
					"param_name" 	=> "pagi_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),
				),

				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( 'Loop Slider?', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Loop Slider', 'greenmart' ),
					"param_name" 	=> "loop_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),
				),					
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( 'Auto Slider?', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Auto Slider', 'greenmart' ),
					"param_name" 	=> "auto_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),
				),					
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( 'Auto Play Speed', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Auto Play Speed Slider', 'greenmart' ),
					"param_name" 	=> "autospeed_type",
					"value" 		=> '200',
					'dependency' 	=> array(
							'element' 	=> 'auto_type',
							'value' 	=> array (
								'yes',
							),
					),
				),

				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( 'Disable Carousel On Mobile', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'To help load faster in mmobile', 'greenmart' ),
					"param_name" 	=> "disable_mobile",
					"std"       	=> "",
					"value" 		=> array( esc_html__('Yes', 'greenmart') =>'yes' ),
					'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'carousel',
								'carousel-vertical',
							),
					),
				),

				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Show config Responsive", 'greenmart' ),
					"description" 	=> esc_html__( 'Show/hidden config Responsive', 'greenmart' ),
					"param_name" 	=> "responsive_type",
	                "value" 		=> array(
	                		 			esc_html__('Yes', 'greenmart') =>'yes' ),
				),
				array(
	                "type" 	  		=> "dropdown",
	                "heading" 		=> esc_html__('Number of columns screen desktop','greenmart'),
					"group" 		=> esc_html__('Responsive Settings', 'greenmart'),
	                "description" 	=> esc_html__( 'Screen is than 1200px', 'greenmart' ),
	                "param_name" 	=> 'screen_desktop',
	                "value" 		=> $columns,
	                'std'       	=> '4',
	                'dependency' 	=> array(
							'element' 	=> 'responsive_type',
							'value' 	=> 'yes',
					),
	            ),					
	            array(
	                "type" 			=> "dropdown",
	                "heading" 		=> esc_html__('Number of columns screen desktopsmall','greenmart'),
					"group" 		=> esc_html__('Responsive Settings', 'greenmart'),
	                "description" 	=> esc_html__( 'Screen area 768px to 1199px', 'greenmart' ),
	                "param_name" 	=> 'screen_desktopsmall',
	                "value" 		=> $columns,
	                'std'       	=> '3',
	                'dependency' 	=> array(
							'element' 	=> 'responsive_type',
							'value' 	=> 'yes',
					),
	            ),		           
	            array(
	                "type" 			=> "dropdown",
	                "heading" 		=> esc_html__('Number of columns screen tablet','greenmart'),
					"group" 		=> esc_html__('Responsive Settings', 'greenmart'),
	                "description" 	=> esc_html__( 'Screen area 480px to 767px', 'greenmart' ),
	                "param_name" 	=> 'screen_tablet',
	                "value" 		=> $columns,
	                'std'       	=> '3',
	                'dependency' 	=> array(
							'element' 	=> 'responsive_type',
							'value' 	=> 'yes',
					),
	            ),		            
	            array(
	                "type" 			=> "dropdown",
	                "heading" 		=> esc_html__('Number of columns screen mobile','greenmart'),
					"group" 		=> esc_html__('Responsive Settings', 'greenmart'),
	                "description" 	=> esc_html__( 'Screen smaller 480px', 'greenmart' ),
	                "param_name" 	=> 'screen_mobile',
	                "value" 		=> $columns,
	                'std'       	=> '1',
	                'dependency' 	=> array(
							'element' 	=> 'responsive_type',
							'value' 	=> 'yes',
					),
	            ),

	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','greenmart'),
	                "param_name" => 'style',
	                'value' 	=> greenmart_tbay_get_testimonials_layouts(),
					'std' => 'v1'
	            ),

	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
            )
        ));
        // Our Team
		vc_map( array(
            "name" => esc_html__("Tbay Our Team",'greenmart'),
            "base" => "tbay_ourteam",
            "icon"        => "vc-icon-tbay",
            'description'=> esc_html__('Display Our Team In FrontEnd', 'greenmart'),
            "class" => "",
            "category" => esc_html__('Tbay Widgets', 'greenmart'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'greenmart'),
					"param_name" => "image_icon",
					"value" => '',
					'heading'	=> esc_html__('Title Icon', 'greenmart' )
				),
              	array(
					'type' => 'param_group',
					'heading' => esc_html__('Members Settings', 'greenmart' ),
					'param_name' => 'members',
					'description' => '',
					'value' => '',
					'params' => array(
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Name','greenmart'),
			                "param_name" => "name",
			            ),
			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Job','greenmart'),
			                "param_name" => "job",
			            ),
						array(
							"type" => "attach_image",
							"heading" => esc_html__("Image", 'greenmart'),
							"param_name" => "image"
						),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Facebook','greenmart'),
			                "param_name" => "facebook",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Twitter Link','greenmart'),
			                "param_name" => "twitter",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Google plus Link','greenmart'),
			                "param_name" => "google",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Linkin Link','greenmart'),
			                "param_name" => "linkin",
			            ),

					),
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','greenmart'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
            )
        ));
        // Gallery Images
		vc_map( array(
            "name" => esc_html__("Tbay Gallery",'greenmart'),
            "base" => "tbay_gallery",
            "icon"        => "vc-icon-tbay",
            'description'=> esc_html__('Display Gallery In FrontEnd', 'greenmart'),
            "class" => "",
            "category" => esc_html__('Tbay Widgets', 'greenmart'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
              	array(
					"type" => "attach_images",
					"heading" => esc_html__("Images", 'greenmart'),
					"param_name" => "images"
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','greenmart'),
	                "param_name" => 'columns',
	                'value' 	=> array(1,2,3,4,6,7,8,9,10),
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
            )
        ));
        // Gallery Images
		vc_map( array(
            "name" => esc_html__("Tbay Video",'greenmart'),
            "base" => "tbay_video",
            "icon"        => "vc-icon-tbay",
            'description'=> esc_html__('Display Video In FrontEnd', 'greenmart'),
            "class" => "",
            "category" => esc_html__('Tbay Widgets', 'greenmart'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'greenmart' ),
					"param_name" => "description",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'greenmart' )
			    ),
              	array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Cover Image", 'greenmart'),
					"param_name" => "image"
				),
				array(
	                "type" => "textfield",
	                "heading" => esc_html__('Youtube Video Link','greenmart'),
	                "param_name" => 'video_link'
	            ),
	           	array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','greenmart'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default ', 'greenmart') => '', 
						esc_html__('Styel 1 ', 'greenmart') => 'style1'
					),
					'std' => ''
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
            )
        ));
        // Features Box
		vc_map( array(
            "name" => esc_html__("Tbay Features",'greenmart'),
            "base" => "tbay_features",
            "icon"        => "vc-icon-tbay",
            'description'=> esc_html__('Display Features In FrontEnd', 'greenmart'),
            "class" => "",
            "category" => esc_html__('Tbay Widgets', 'greenmart'),
            "params" => array(
            	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__('Members Settings', 'greenmart' ),
					'param_name' => 'items',
					'description' => '',
					'value' => '',
					'params' => array(
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Title','greenmart'),
			                "param_name" => "title",
			            ),
			            array(
			                "type" => "textarea",
			                "class" => "",
			                "heading" => esc_html__('Description','greenmart'),
			                "param_name" => "description",
			            ),
						array(
							"type" => "textfield",
							"heading" => esc_html__("FontAwsome Icon", 'greenmart'),
							"param_name" => "icon",
							"value" => '',
							'description' => esc_html__( 'This support display icon from FontAwsome, Please click', 'greenmart' )
											. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
											. esc_html__( 'here to see the list', 'greenmart' ) . '</a>'
						),
						array(
							"type" => "attach_image",
							"description" => esc_html__("If you upload an image, icon will not show.", 'greenmart'),
							"param_name" => "image",
							"value" => '',
							'heading'	=> esc_html__('Image', 'greenmart' )
						),
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Button Link','greenmart'),
			                "param_name" => "link",
			            ),
					),
				),
	           	array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','greenmart'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default ', 'greenmart') => 'default', 
						esc_html__('Styel 1 ', 'greenmart') => 'style1', 
						esc_html__('Styel 2 ', 'greenmart') => 'style2',
						esc_html__('Styel 3 ', 'greenmart') => 'style3'
					),
					'std' => ''
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
            )
        ));

		// Banner
		vc_map( array(
		    "name" => esc_html__("Tbay Banner",'greenmart'),
		    "base" => "tbay_banner",
		    "icon"        => "vc-icon-tbay",
		    "class" => "",
		    "description"=> esc_html__('Show Text Images', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'greenmart'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Images", 'greenmart'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", 'greenmart'),
					"param_name" => "link",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));

		// Banner
		vc_map( array(
		    "name" => esc_html__('Tbay Home Banner ','greenmart'),
		    "base" => "tbay_home_banner",
		    "icon" => "vc-icon-tbay",
		    "class" => "",
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__('Images Left', 'greenmart'),
					"param_name" => "image_left"
				),				
				array(
					"type" => "attach_image",
					"heading" => esc_html__('Images Right', 'greenmart'),
					"param_name" => "image_right"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__('Extra class name', 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'greenmart')
				)
		   	)
		));
		
		$custom_menus = array();
		if ( is_admin() ) {
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
			if ( is_array( $menus ) && ! empty( $menus ) ) {
				foreach ( $menus as $single_menu ) {
					if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
						$custom_menus[ $single_menu->name ] = $single_menu->slug;
					}
				}
			}
		}
		// Menu
		vc_map( array(
		    "name" => esc_html__("Tbay Custom Menu",'greenmart'),
		    "base" => "tbay_custom_menu",
		    "icon"        => "vc-icon-tbay",
		    "class" => "",
		    "description"=> esc_html__('Show Custom Menu', 'greenmart'),
		    "category" => esc_html__('Tbay Elements', 'greenmart'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'greenmart'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Menu', 'greenmart' ),
					'param_name' => 'nav_menu',
					'value' => $custom_menus,
					'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'greenmart' ) : esc_html__( 'Select menu to display.', 'greenmart' ),
					'admin_label' => true,
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Select menu style', 'greenmart' ),
					'param_name' => 'select_menu',
					'value'       => array(
						'Default'  		  => 'none',
						'Treeview Menu'   => 'treeview',
						'Vertical Menu'   => 'tbay-vertical'
					),
					'description' => esc_html__( 'Select the type of menu you want to display  ex: none, treeview, vertical', 'greenmart' ) ,
					'save_always' => true,
					'admin_label' => true,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'greenmart'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'greenmart')
				)
		   	)
		));
	}
}
add_action( 'vc_after_set_mode', 'greenmart_tbay_load_load_theme_element', 99 );

class WPBakeryShortCode_tbay_title_heading extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_banner_countdown extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_featurebanner extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_brands extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_socials_link extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_newsletter extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_banner extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_home_banner extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_testimonials extends WPBakeryShortCode {}

class WPBakeryShortCode_tbay_counter extends WPBakeryShortCode {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->load_scripts();
	}

	public function load_scripts() {
		$suffix 		= (greenmart_tbay_get_config('minified_js', false)) ? '.min' : GREENMART_MIN_JS;
		wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup' . $suffix . '.js', array('jquery'), false, true);
	}
}

class WPBakeryShortCode_tbay_ourteam extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_gallery extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_video extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_features extends WPBakeryShortCode {}
class WPBakeryShortCode_tbay_custom_menu extends WPBakeryShortCode {}