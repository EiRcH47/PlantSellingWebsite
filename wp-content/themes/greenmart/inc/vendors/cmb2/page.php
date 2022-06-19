<?php
if (!function_exists('greenmart_tbay_page_metaboxes')) {
    function greenmart_tbay_page_metaboxes()
    {
        global $wp_registered_sidebars;
        $sidebars = array();

        if (!empty($wp_registered_sidebars)) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge(array('global' => esc_html__('Global Setting', 'greenmart')), greenmart_tbay_get_header_layouts());
        $footers = array_merge(array('global' => esc_html__('Global Setting', 'greenmart')), greenmart_tbay_get_footer_layouts());
         
        $prefix = 'tbay_page_';

        $cmb2 = new_cmb2_box( array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'greenmart' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
        ) );

        $cmb2->add_field( array(
            'name' => esc_html__( 'Select Layout', 'greenmart' ),
            'id'   => $prefix.'layout',
            'type' => 'select',
            'options' => array(
                'main' => esc_html__('Main Content Only', 'greenmart'),
                'left-main' => esc_html__('Left Sidebar - Main Content', 'greenmart'),
                'main-right' => esc_html__('Main Content - Right Sidebar', 'greenmart'),
                'left-main-right' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'greenmart')
            )
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'fullwidth',
            'type' => 'select',
            'name' => esc_html__('Is Full Width?', 'greenmart'),
            'default' => 'no',
            'options' => array(
                'no' => esc_html__('No', 'greenmart'),
                'yes' => esc_html__('Yes', 'greenmart')
            )
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'left_sidebar',
            'type' => 'select',
            'name' => esc_html__('Left Sidebar', 'greenmart'),
            'options' => $sidebars
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'right_sidebar',
            'type' => 'select',
            'name' => esc_html__('Right Sidebar', 'greenmart'),
            'options' => $sidebars
        ) );

        
        $cmb2->add_field( array(
            'id' => $prefix.'show_title',
            'type' => 'select',
            'name' => esc_html__('Show Title Page?', 'greenmart'),
            'options' => array(
                'no' => esc_html__('No', 'greenmart'),
                'yes' => esc_html__('Yes', 'greenmart')
            ),
            'default' => 'yes',
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'show_breadcrumb',
            'type' => 'select',
            'name' => esc_html__('Show Breadcrumb?', 'greenmart'),
            'options' => array(
                'no' => esc_html__('No', 'greenmart'),
                'yes' => esc_html__('Yes', 'greenmart')
            ),
            'default' => 'yes',
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'breadcrumb_color',
            'type' => 'colorpicker',
            'name' => esc_html__('Breadcrumb Background Color', 'greenmart')
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'breadcrumb_image',
            'type' => 'file',
            'name' => esc_html__('Breadcrumb Background Image', 'greenmart')
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'header_type',
            'type' => 'select',
            'name' => esc_html__('Header Layout Type', 'greenmart'),
            'description' => esc_html__('Choose a header for your website.', 'greenmart'),
            'options' => $headers,
            'default' => 'global'
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'footer_type',
            'type' => 'select',
            'name' => esc_html__('Footer Layout Type', 'greenmart'),
            'description' => esc_html__('Choose a footer for your website.', 'greenmart'),
            'options' => $footers,
            'default' => 'global'
        ) );

        $cmb2->add_field( array(
            'id' => $prefix.'extra_class',
            'type' => 'text',
            'name' => esc_html__('Extra Class', 'greenmart'),
            'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'greenmart')
        ) );
    }
    add_action( 'cmb2_admin_init', 'greenmart_tbay_page_metaboxes', 10 );
}

if ( !function_exists( 'greenmart_tbay_cmb2_style' ) ) {
	function greenmart_tbay_cmb2_style() {
		wp_enqueue_style( 'greenmart-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
	}
    add_action( 'admin_enqueue_scripts', 'greenmart_tbay_cmb2_style' );
}


