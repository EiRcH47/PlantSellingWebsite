<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Widget_Image') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Greenmart_Element_Site_Logo extends Greenmart_Elementor_Widget_Image {

    public function get_name() {
        // `theme` prefix is to avoid conflicts with a dynamic-tag with same name.
        return 'greenmart-site-logo';
    }

    public function get_title() {
        return esc_html__( 'Greenmart Site Logo', 'greenmart' );
    }

    public function get_keywords() {
        return [ 'header', 'logo' ];
    }
    
    public function get_icon() {
        return 'eicon-site-logo';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'greenmart' ),
            ]
        );

        $this->add_control(
            'image_logo',
            [
                'label' => esc_html__( 'Choose Image', 'greenmart' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->end_controls_section();
        

        parent::register_controls();
        $this->remove_control('image'); 
        $this->remove_control('section_style_image'); 
        $this->remove_control('caption_source'); 
        $this->remove_control('image_size');        

        $this->update_control(
            'link_to',
            [
                'default' => 'home', 
                'options' => [ 
                    'none' => esc_html__( 'None', 'greenmart' ),
                    'home' => esc_html__( 'Home Page', 'greenmart' ),
                    'custom' => esc_html__( 'Custom URL', 'greenmart' ),
                ],
            ]
        ); 
 

        $this->update_control(
            'link',
            [
                'placeholder' => site_url(),
            ]
        );
        $this->register_style_logo();

    }

    /**
     * Get default image logo source.
     *
     * Retrieve the source of the placeholder image.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return string The source of the default placeholder image used by Elementor.
     */
    public function register_style_logo() {
        $this->start_controls_section(
            'section_style_logo',
            [
                'label' => esc_html__( 'Logo', 'greenmart' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
			'width_logo',
			[
				'label' => esc_html__( 'Max Width', 'greenmart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 400,
					],
					
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->end_controls_section();

    }
    public static function get_logo_default_image_src() {
        $logo_image = GREENMART_IMAGES . '/logo.svg';

        /**
         * Get default image logo source.
         *
         * Filters the source of the default placeholder image used by Elementor.
         *
         * @since 1.0.0
         *
         * @param string $logo_image The source of the default placeholder image.
         */
        $logo_image = apply_filters( 'elementor/header/get_logo_default_image_src', $logo_image );

        return $logo_image;
    }

    protected function get_html_wrapper_class() {
        return parent::get_html_wrapper_class() . ' elementor-widget-' . parent::get_name();
    }
 
    protected function get_link_url( $settings ) {

        if ( 'none' === $settings['link_to'] ) {  
            return false;
        } 

        if ( 'home' === $settings['link_to'] ) {
            $settings['link']['url'] = apply_filters( 'wpml_home_url', site_url() );

            return $settings['link'];  
        }        

        if ( 'custom' === $settings['link_to'] ) {
            return $settings['link'];
        } 
    }

    protected function content_template() {
        return;
    }
}
$widgets_manager->register_widget_type(new Greenmart_Element_Site_Logo());