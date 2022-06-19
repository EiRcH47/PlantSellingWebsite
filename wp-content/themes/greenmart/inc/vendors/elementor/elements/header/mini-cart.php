<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Mini_Cart') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
class Greenmart_Elementor_Mini_Cart extends Greenmart_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'tbay-mini-cart';
    }

    public function get_title() {
        return esc_html__('Greenmart Mini Cart', 'greenmart');
    }

    public function get_icon() {
        return 'eicon-cart-medium';
    }
    
    protected function get_html_wrapper_class() {
		return 'w-auto elementor-widget-' . $this->get_name();
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Mini Cart', 'greenmart'),
            ]
        );

        $this->add_control(
            'heading_mini_cart',
            [
                'label' => esc_html__('Mini Cart', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );   

        $this->add_control(
            'icon_mini_cart',
            [
                'label'              => esc_html__('Icon', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-shopping-cart',
					'library' => 'tbay-custom',
                ],                
            ]
        );
        $this->add_control(
            'icon_mini_cart_size',
            [
                'label' => esc_html__('Font Size Icon', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],  
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown .cart-icon i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} ',
					'{{WRAPPER}} .wrapper-title-cart' => 'line-height: {{SIZE}}{{UNIT}} ',
                ],
            ]
        );
        $this->add_control(
            'show_title_mini_cart',
            [
                'label'              => esc_html__('Display Title "Mini-Cart"', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes'        
            ]
        );
        $this->add_control(
            'title_mini_cart',
            [
                'label'              => esc_html__('"Mini-Cart" Title', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('My Shopping cart', 'greenmart'),
                'condition'          => [
                    'show_title_mini_cart' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'price_mini_cart',
            [
                'label'              => esc_html__('Show "Mini-Cart" Price', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'separator'    => 'after',
            ]
        );
        $this->add_control(
            'title_price_layout',
            [
                'label'              => esc_html__('Layout Title And Price', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'column'  => esc_html__('Column','greenmart'),
                    'row'  => esc_html__('Row','greenmart'),
                ],
                'default'            => 'column',
                'prefix_class'       => 'layout-wrapper-title-price-'
            ]
        );

        $this->add_control(
            'position_total',
            [
                'label'              => esc_html__('Position Total', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'absolute'  => esc_html__('Absolute','greenmart'),
                    'static'  => esc_html__('Static','greenmart'),
                ],
                'default'            => 'absolute',
                'prefix_class'       => 'position-total-',
            ]
        );


        $this->add_control(
            'title_price_align',
            [
                'label' => esc_html__('Align','greenmart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'flex-start' => esc_html__('Left','greenmart'),
                        'icon' => 'fas fa-align-left'
                    ],
                    'center' => [
                        'center' => esc_html__('Center','greenmart'),
                        'icon' => 'fas fa-align-center'
                    ],
                    'flex-end' => [
                        'flex-end' => esc_html__('Right','greenmart'),
                        'icon' => 'fas fa-align-right'
                    ],   
                ],
                'condition' => [
                    'title_price_layout' => 'column'
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .text-cart' => 'align-items: {{VALUE}}',
                ]
            ]
        );


        $this->end_controls_section();
        $skin = greenmart_tbay_get_theme();
        if ($skin === 'fresh-el') {
            $this->register_section_style_background();    
        }
        $this->register_section_style_icon();
        $this->register_section_style_text();
        $this->register_section_style_total();
        $this->register_section_style_popup_cart();
        $this->register_section_style_price();
        
    }

    protected function register_section_style_background() {
        $this->start_controls_section(
            'section_style_mini_cart',
            [
                'label' => esc_html__('Style Background', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->add_control(
            'bg_mini_cart',
            [
                'label'     => esc_html__('Background', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-mini-cart'    => 'background: {{VALUE}}',
                ],
            ]
        );   

        $this->add_control(
            'border_radius_mini_cart',
            [
                'label'     => esc_html__('Border Radius', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-element-mini-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ], 
            ]
        );  

        $this->add_control(
            'padding_mini_cart',
            [
                'label'     => esc_html__('Padding', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [ 
                    '{{WRAPPER}} .tbay-element-mini-cart .cart-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ], 
            ]
        );  


        $this->end_controls_section();

    }

    protected function register_section_style_icon() {
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Style Icon', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('tabs_style_icon');

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'greenmart'),
            ]
        );
        $this->add_control(
            'color_icon',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon'    => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_control(
            'bg_icon',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon'    => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'greenmart'),
            ]
        );
        $this->add_control(
            'hover_color_icon',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon:hover'    => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_control(
            'hover_bg_icon',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .cart-icon:hover'    => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function register_section_style_text() {
        
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Style Text', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title_mini_cart' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'font_size_text_cart',
            [
                'label' => esc_html__('Font Size', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 40,
					],
				],  
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown .text-cart' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                
            ]
        );
        $this->add_control(
            'margin_text_cart',
            [
                'label'     => esc_html__('Margin Text Cart', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cart-dropdown .text-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'padding_text_cart',
            [
                'label'     => esc_html__('Padding Text Cart', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '15',
                ],
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce .cart-popup .wrapper-title-cart, {{WRAPPER}} .cart-popup .wrapper-title-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->start_controls_tabs('tabs_style_text');

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => esc_html__('Normal', 'greenmart'),
            ]
        );
        $this->add_control(
            'color_text',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777',
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .text-cart, {{WRAPPER}} .cart-popup .wrapper-title-cart > span:after'    => 'color: {{VALUE}}',
                ],
            ]
        );   

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => esc_html__('Hover', 'greenmart'),
            ]
        );
        $this->add_control(
            'hover_color_text',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777',
                'selectors' => [
                    '{{WRAPPER}} .cart-dropdown .text-cart:hover' => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function register_section_style_popup_cart() {

        $this->start_controls_section(
            'section_style_popup_cart',
            [
                'label' => esc_html__('Style Popup', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_popup',
				'selector' => '{{WRAPPER}} .cart-popup.show .dropdown-menu',
			]
		);
        $this->add_control(
            'border_radius_popup_cart',
            [
                'label'     => esc_html__('Border Radius', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cart-popup.show .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );     
        $this->add_control(
            'position_popup_cart',
            [
                'label' => esc_html__('Position Popup', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .cart-popup.show .dropdown-menu'=> 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );    
       
        $this->end_controls_section();
    }
    protected function register_section_style_price() {
        $this->start_controls_section(
            'section_style_price_cart',
            [
                'label' => esc_html__('Style Price', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'price_mini_cart' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'color_cart_price',
			[
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#86bc42',
                'selectors' => [
                    '{{WRAPPER}} #cart .mini-cart .mini-cart-subtotal' => 'color: {{VALUE}}',
                ],
            ]
		);
        $this->add_control(
            'color_cart_price_hover',
			[
                'label'     => esc_html__('Color Hover', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #cart .mini-cart .mini-cart-subtotal:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'margin_price_cart',
            [
                'label'     => esc_html__('Margin', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .wrapper-title-cart .mini-cart-subtotal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        
        $this->end_controls_section();
    }

    private function register_section_style_total() {
        $this->start_controls_section(
            'section_style_total',
            [
                'label' => esc_html__('Style Total', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'position_top',
            [
                'label' => esc_html__('Top', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 50,
					],
				],  
				'selectors' => [
					'{{WRAPPER}} .cart-popup .mini-cart-items' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'          => [
                    'position_total' => 'absolute',
                ],
            ]
        );
        $this->add_control(
            'position_left',
            [
                'label' => esc_html__('Left', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 50,
					],
				],  
				'selectors' => [
					'{{WRAPPER}} .cart-popup .mini-cart-items' => 'left: {{SIZE}}{{UNIT}};',
                    '.rtl {{WRAPPER}} .cart-popup .mini-cart-items' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                ],
                'condition'          => [
                    'position_total' => 'absolute',
                ],
            ]
        );
        $this->add_control(
            'number_size',
            [
                'label' => esc_html__('Font Size', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 20,
					],
                ],
                'default' => [
                    'unit' => 'px',
					'size' => 11
                ],
                'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cart-popup .mini-cart-items,{{WRAPPER}} .cart-popup .mini-cart-items-static' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'number_font-weight',
            [
                'label' => esc_html__('Font Weight', 'greenmart'),
                'type' => Controls_Manager::SELECT,
				'options' => [
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                ],
                'default' => '600',
				'selectors' => [
					'{{WRAPPER}} .cart-popup .mini-cart-items,{{WRAPPER}} .cart-popup .mini-cart-items-static' => 'font-weight: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_number',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-popup .mini-cart-items,{{WRAPPER}} .cart-popup .mini-cart-items-static'    => 'color: {{VALUE}}',
                    
                ],
            ]
        );   
        
        $this->add_control(
            'bg_total',
            [
                'label'     => esc_html__('Background', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-popup .mini-cart-items,{{WRAPPER}} .cart-popup .mini-cart-items-static'    => 'background: {{VALUE}}',
                ],
            ]
        );   

        $this->add_control(
            'border_color_total',
            [
                'label'     => esc_html__('Border Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-popup .mini-cart-items'    => 'border-color: {{VALUE}}',
                ],
            ]
        );   

        $this->end_controls_section();
    }

    protected function render_woocommerce_mini_cart() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $args = [
            'icon_mini_cart'                 => $icon_mini_cart,
            'show_title_mini_cart'           => $show_title_mini_cart,
            'title_mini_cart'                => $title_mini_cart,
            'price_mini_cart'                => $price_mini_cart,
            'position_total'                 => $position_total
        ];
        
        greenmart_tbay_get_woocommerce_mini_cart_el($args);
        
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Mini_Cart());

