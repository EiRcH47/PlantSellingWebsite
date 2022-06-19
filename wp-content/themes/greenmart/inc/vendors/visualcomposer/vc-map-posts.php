<?php
if(!class_exists('WPBakeryShortCode')) return;

if ( !function_exists('greenmart_tbay_load_post_element')) {

	if ( !function_exists('greenmart_tbay_post_get_categories') ) {
	    function greenmart_tbay_post_get_categories() {
	        $return = array( esc_html__('--- Choose a Category ---', 'greenmart') );

	        $args = array(
	            'type' => 'post',
	            'child_of' => 0,
	            'orderby' => 'name',
	            'order' => 'ASC',
	            'hide_empty' => false,
	            'hierarchical' => 1,
	            'taxonomy' => 'category'
	        );

	        $categories = get_categories( $args );

	        greenmart_post_tbay_get_category_childs( $categories, 0, 0, $return );



	        return $return;
	    }
	}

	if ( !function_exists('greenmart_post_tbay_get_category_childs') ) {
	    function greenmart_post_tbay_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                greenmart_post_tbay_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	function greenmart_tbay_load_post_element() {
		$categories = greenmart_tbay_post_get_categories();
		$layouts = array(
			esc_html__('Grid', 'greenmart') => 'grid',
			esc_html__('List', 'greenmart') => 'list',
			esc_html__('Carousel', 'greenmart') => 'carousel',
			esc_html__('Carousel Vertical', 'greenmart') => 'carousel-vertical'
		);
		$columns = array(1,2,3,4,6);
		$rows 	 = array(1,2,3);
		vc_map( array(
			'name' => esc_html__( 'Tbay Grid Posts', 'greenmart' ),
			'base' => 'tbay_gridposts',
			'icon'        => 'vc-icon-tbay',
			'category' => esc_html__('Tbay Post', 'greenmart'),
			'description' => esc_html__( 'Create Post having blog styles', 'greenmart' ),
			 
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'greenmart' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'greenmart' ),
					"admin_label" => true
				),
				array(
	                "type" => "textfield",
	                "class" => "",
	                "heading" => esc_html__('Sub Title','greenmart'),
	                "param_name" => "subtitle",
	            ),
		   		array(
					"type" => "dropdown",
					"heading" => esc_html__("Categories",'greenmart'),
					"param_name" => "category",
					"value" => $categories,
					"admin_label" => true
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'greenmart' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'greenmart' ),
						'std'       => 'thumbnail',
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','greenmart'),
	                "param_name" => 'columns',
	                "value" => $columns,
	                'std'   => '4',
	                'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'carousel',
								'carousel-vertical',
								'masonry',
								'grid',
							),
					),
	            ),
            	array(
					"type" => "textfield",
					"heading" => esc_html__("Number of post to show",'greenmart'),
					"param_name" => "number",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'greenmart'),
					"param_name" => "layout_type",
					"value" => $layouts,
					"admin_label" => true
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
					'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'carousel',
								'carousel-vertical',
							),
					),
				),	 
				array(
	                "type" 			=> "dropdown",
	                "heading" 		=> esc_html__('Rows','greenmart'),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
	                "param_name" 	=> 'rows',
	                "value" 		=> $rows,
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
					"heading" 		=> esc_html__( "Navigation ", 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Navigation ', 'greenmart' ),
					"param_name" 	=> "nav_type",
	                "value" 		=> array(
	                		 			esc_html__('Yes', 'greenmart') =>'yes' ),
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
					"heading" 		=> esc_html__( "Pagination", 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Pagination', 'greenmart' ),
					"param_name" 	=> "pagi_type",
	                "value" 		=> array(
	                		 			esc_html__('Yes', 'greenmart') =>'yes' ),
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
					"heading" 		=> esc_html__( 'Loop Slider?', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Loop Slider', 'greenmart' ),
					"param_name" 	=> "loop_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),
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
					"heading" 		=> esc_html__( 'Auto Slider?', 'greenmart' ),
					"group" 		=> esc_html__('Carousel Settings', 'greenmart'),
					"description" 	=> esc_html__( 'Show/hidden Auto Slider', 'greenmart' ),
					"param_name" 	=> "auto_type",
					"value" 		=> array(
										esc_html__('Yes', 'greenmart') =>'yes' ),
					'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'carousel',
								'carousel-vertical',
							),
					),
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
					"std"       	=> "yes",
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
	                'dependency' 	=> array(
							'element' 	=> 'layout_type',
							'value' 	=> array (
								'carousel',
								'carousel-vertical',
								'grid',
							),
					),
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

	            // Data settings
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'greenmart' ),
					'param_name' => 'orderby',
					'admin_label' => true,
					'value' => array(
						esc_html__( 'Date', 'greenmart' ) => 'date',
						esc_html__( 'Order by post ID', 'greenmart' ) => 'ID',
						esc_html__( 'Author', 'greenmart' ) => 'author',
						esc_html__( 'Title', 'greenmart' ) => 'title',
						esc_html__( 'Last modified date', 'greenmart' ) => 'modified',
						esc_html__( 'Random order', 'greenmart' ) => 'rand',
					),
					'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'greenmart' ),
					'group' => esc_html__( 'Data Settings', 'greenmart' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Sort order', 'greenmart' ),
					'param_name' => 'order',
					'admin_label' => true,
					'group' => esc_html__( 'Data Settings', 'greenmart' ),
					'value' => array(
						esc_html__( 'Descending', 'greenmart' ) => 'DESC',
						esc_html__( 'Ascending', 'greenmart' ) => 'ASC',
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'description' => esc_html__( 'Select sorting order.', 'greenmart' ),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'greenmart' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'greenmart' )
				)
			)
		) );
	}
}
add_action( 'vc_after_set_mode', 'greenmart_tbay_load_post_element', 99 );

class WPBakeryShortCode_tbay_gridposts extends WPBakeryShortCode {}