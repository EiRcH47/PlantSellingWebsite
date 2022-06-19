<?php

if ( !function_exists('greenmart_before_render_sticky_header')) {
    function greenmart_before_render_sticky_header( $widget ) {
          
        $settings = $widget->get_settings_for_display();
 
        if( !isset($settings['enable_sticky_headers']) ) return;

        if( $settings['enable_sticky_headers'] === 'yes' ) {
            $widget->add_render_attribute('_wrapper', 'class', 'element-sticky-header');
        }

    }

    add_action('elementor/frontend/section/before_render', 'greenmart_before_render_sticky_header', 10, 2 );
}

