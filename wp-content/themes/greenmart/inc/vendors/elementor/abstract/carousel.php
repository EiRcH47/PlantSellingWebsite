<?php
if (!defined('ABSPATH') || function_exists('Greenmart_Elementor_Carousel_Base') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

abstract class Greenmart_Elementor_Carousel_Base extends Greenmart_Elementor_Responsive_Base {

    public function get_name() {
        return 'tbay-carousel';
    }

    private function get_rows() {

        $value = apply_filters( 'greenmart_admin_elementor_rows', [
            1 => 1,
            2 => 2,
            3 => 3
        ] ); 

        return $value;
    } 

    protected function add_control_carousel($condition = array()) {
        $this->register_section_carousel_options($condition);
        $this->register_section_style_navigation($condition);
        $this->register_section_style_pagination($condition);
    }

    private function register_section_carousel_options( $condition = array() ) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label' => esc_html__( 'Carousel Options', 'greenmart' ),
                'type'  => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'default' => 1,
                'options' => $this->get_rows()
            ]
        );  
        
        
        $this->add_control(
            'speed', 
            [
                'label' => esc_html__( 'Speed', 'greenmart' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'description' => esc_html__( 'Slide/Fade animation speed', 'greenmart' ),
            ]
        );
       
        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Navigation', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => esc_html__( 'Show/hidden Navigation', 'greenmart' ),
            ]
        );        

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'description' => esc_html__( 'Show/hidden Pagination', 'greenmart' ),
            ]
        );

        $this->add_control(
            'loop',
            [ 
                'label' => esc_html__( 'Infinite Loop', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'description' => esc_html__( 'Show/hidden Infinite Loop', 'greenmart' ),
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => esc_html__( 'Autoplay', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => esc_html__( 'Show/hidden Autoplay', 'greenmart' ),
            ]
        );

        $this->add_control(
            'autospeed', 
            [
                'label' => esc_html__( 'Autoplay Speed', 'greenmart' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'auto' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'disable_mobile',
            [
                'label' => esc_html__( 'Disable Carousel On Mobile', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => esc_html__( 'To help load faster in mmobile', 'greenmart' ), 
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_navigation( $condition = array() ) {
        $condition['navigation'] = 'yes';

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => esc_html__( 'Navigation', 'greenmart' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => $condition,
            ]
        );

        $this->add_responsive_control(
            'arrows_width', 
            [
                'label' => esc_html__( 'Width', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow' => 'width: {{SIZE}}{{UNIT}}',
                ], 
                'condition' => [
                    'navigation' => [ 'yes' ],
                ],
            ]
        );        

        $this->add_responsive_control(
            'arrows_height', 
            [
                'label' => esc_html__( 'Height', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],   
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow i' => 'line-height: {{SIZE}}{{UNIT}};',
                ], 
                'condition' => [
                    'navigation' => [ 'yes' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size_icon',
            [
                'label' => esc_html__( 'Size Icon', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
                ], 
                'condition' => [
                    'navigation' => [ 'yes' ],
                ],
            ]
        );        

        $this->add_responsive_control(
            'position_nav',
            [
                'label' => esc_html__( 'Position Navigation', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'absolute' => esc_html__('Absolute','greenmart'),
                    'normal' => esc_html__('Normal','greenmart'),
                ],
                'default' => 'normal',
                'condition' => [
                    'navigation' => 'yes'
                ],
                'prefix_class' => 'tbay-nav-'
            ]
        );
        $this->add_responsive_control(
            'align_nav',
            [
                'label' => esc_html__( 'Align Navigation', 'greenmart' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'greenmart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'greenmart'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'greenmart'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'condition' => [
                    'position_nav' => 'absolute'
                ],
                'default'  => 'center',
                'prefix_class' => 'align-nav%s-'
            ]
        );

        $this->add_responsive_control(
            'custom_top',
            [
                'label' => esc_html__( 'Top', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 100, 
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => -30,
				],
                'condition' => [
                    // 'choose_custom_top_bottom' => 'top',
                    'position_nav' => 'absolute',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-arrow.slick-prev,{{WRAPPER}} .slick-arrow.slick-next' => 'top: {{SIZE}}{{UNIT}};bottom:auto',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_radius',
            [
                'label' => esc_html__( 'Border Radius', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS, 
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_text_color',
            [
                'label' => esc_html__( 'Text Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow i' => 'color: {{VALUE}};',
                ],
            ]
        );        

        $this->add_control(
            'arrows_text_color_hover',
            [
                'label' => esc_html__( 'Text Color Hover', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-arrow:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function register_section_style_pagination( $condition = array() ) {
        $condition['pagination'] = 'yes';

        $this->start_controls_section(
            'section_style_pagination',
            [
                'label' => esc_html__( 'Pagination', 'greenmart' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => $condition,
            ]
        );

        $this->add_responsive_control(
            'pagination_width',
            [
                'label' => esc_html__( 'Width', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}',
                ], 
            ]
        );

        $this->add_responsive_control(
            'pagination_height',
            [
                'label' => esc_html__( 'Height', 'greenmart' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                ], 
            ]
        );
        $this->add_responsive_control(
            'align_pagination',
            [
                'label' => esc_html__( 'Align Pagination', 'greenmart' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'greenmart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'greenmart'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'greenmart'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
              
                'default'  => 'center',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider .slick-dots' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => esc_html__( 'Spacing', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS, 
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_radius',
            [
                'label' => esc_html__( 'Border Radius', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS, 
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-element .owl-carousel .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
}