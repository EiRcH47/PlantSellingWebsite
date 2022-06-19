<?php
if ( !function_exists('greenmart_settings_layout_section_advanced')) {
    function greenmart_settings_layout_section_advanced( $widget, $args ) {

        $widget->update_responsive_control(
            'container_width',
            [  
                'default' => [
					'size' => '1200',
				],
                'description' => esc_html__( 'Sets the default width of the content area (Default: 1200)', 'greenmart' ),
                'selectors' => [
					'.elementor-section.elementor-section-boxed > .elementor-container' => 'max-width: {{SIZE}}{{UNIT}} !important',
				],
            ]
        );
        
        $widget->update_control(
            'page_title_selector',
            [  
                'default' => 'h1.page-title',
                'placeholder' => 'h1.page-title',
                'description' => esc_html__( 'Elementor lets you hide the page title. This works for themes that have "h1.page-title" selector. If your theme\'s selector is different, please enter it above.', 'greenmart' ),
            ]
        );

    }

    add_action( 'elementor/element/kit/section_settings-layout/before_section_end', 'greenmart_settings_layout_section_advanced', 10, 2 );
} 

