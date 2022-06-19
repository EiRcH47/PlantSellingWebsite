<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Nav_Menu') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Greenmart_Elementor_Nav_Menu extends Greenmart_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'tbay-nav-menu';
    }

    public function get_title() {
        return esc_html__('Greenmart Nav Menu', 'greenmart');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_script_depends() {
        $script = [];

        $script[]   = 'jquery-treeview';

        return $script;
    }

    public function on_export($element) {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    protected function register_controls() {
        $skin = greenmart_tbay_get_theme();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'greenmart'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label'        => esc_html__('Menu', 'greenmart'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'greenmart'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'greenmart'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'layout',
            [
                'label'              => esc_html__('Layout Menu', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'horizontal',
                'options'            => [
                    'horizontal' => esc_html__('Horizontal', 'greenmart'),
                    'vertical'   => esc_html__('Vertical', 'greenmart'),
                    'treeview'   => esc_html__('Tree View', 'greenmart'),
                ],
                'frontend_available' => true,
            ]
        );

        if( $skin === 'organic-el' ) {
            $this->add_control(
                'style_horizontal',
                [
                    'label'              => esc_html__('Style Layout Horizontal', 'greenmart'),
                    'type'               => Controls_Manager::SELECT,
                    'default'            => 'no-style',
                    'options'            => [
                        'v1' => esc_html__('Style 1', 'greenmart'),
                        'v2'   => esc_html__('Style 2', 'greenmart'),
                        'v3'   => esc_html__('Style 3', 'greenmart'),
                        'no-style'   => esc_html__('No Style', 'greenmart'),
                    ],
                    'condition' => [
                        'layout'  => 'horizontal',
                    ],
                    'prefix_class' => 'style-horizontal-',
                ]
            );
        } else {
            $this->add_control(
                'hidden_border_item_menu',
                [
                    'label'        => esc_html__('Enable Border Item Menu', 'greenmart'),
                    'type'         => Controls_Manager::SWITCHER,
                    'default'      => '',
                    'prefix_class' => 'border-item-menu-',
                    'condition' => [
                        'layout' => 'horizontal'
                    ],
                ]
            );
        }

        $this->add_responsive_control(
            'align_items', 
            [ 
                'label'        => esc_html__('Align', 'greenmart'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'    => [ 
                        'title' => esc_html__('Start', 'greenmart'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [ 
                        'title' => esc_html__('Center', 'greenmart'),
                        'icon'  => 'fa fa-align-center',
                    ], 
                    'flex-end'   => [ 
                        'title' => esc_html__('End', 'greenmart'),
                        'icon'  => 'fa fa-align-right',
                    ], 
                ],
                'prefix_class' => 'elementor-nav-menu%s__align-',
                'default'      => '',
                'condition' => [
                    'layout' => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu' => 'justify-content: {{VALUE}} !important',
                ]
            ]
        );

        $this->add_control(
            'hidden_indicator',
            [
                'label'        => esc_html__('Hidden Submenu Indicator', 'greenmart'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'prefix_class' => 'hidden-indicator-',
                'condition' => [
                    'layout!' => 'treeview'
                ],
            ]
        );

        $this->add_control(
            'type_menu',
            [
                'label'              => esc_html__('Type Menu', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'none',
                'options'            => [
                    'none'      => esc_html__('None', 'greenmart'),
                    'toggle'    => esc_html__('Toggle Menu', 'greenmart'),
                    'canvas'    => esc_html__('Canvas Menu', 'greenmart'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'show_canvas_menu_class',
            [
                'label' => esc_html__( 'Show Canvas Menu Class', 'greenmart' ),
                'type' => Controls_Manager::HIDDEN,
                'prefix_class' => 'width-auto-',
                'default' => 'yes', 
                 'condition' => [
                    'type_menu' => 'canvas',
                ],
            ]
        );
        

        $this->end_controls_section();

        $this->register_section_toggle_menu();

        $this->register_section_vertical_menu();
        $this->register_section_canvas_menu();

        $this->register_section_style_main_menu();
        $this->register_section_style_menu_dropdown();
        $this->register_section_style_menu_canvas();
    }

    private function register_section_style_main_menu() {
        $condition_skin = ( greenmart_tbay_get_theme() === 'organic-el' ) ? ['style_horizontal' => 'no-style'] : '';

        $this->start_controls_section(
            'section_style_main_menu',
            [
                'label' => esc_html__('Main Menu', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => $condition_skin,
            ]
        );

        $this->add_control(
            'bg_menu',
            [
                'label'     => esc_html__('Background Color Full', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu'    => 'background-color: {{VALUE}}',
                ],
            ]
        );     

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a',
            ]
        );

        $this->start_controls_tabs('tabs_menu_item_style');

        $this->start_controls_tab(
            'tab_menu_item_normal',
            [
                'label' => esc_html__('Normal', 'greenmart'),
            ]
        );

        $this->add_control(
            'color_menu_item',
            [
                'label'     => esc_html__('Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a'=> 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li > a i'=> 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> .caret:before'  => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'menu_item_box_shadow',
                'selector'  => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a',
                'condition' => [
                    'layout' => 'horizontal',
                ],
            ]
        );


        $this->end_controls_tab();


        

        $this->start_controls_tab(
            'tab_menu_item_hover',
            [
                'label' => esc_html__('Hover', 'greenmart'),
            ]
        );
        $this->add_control(
            'bg_menu_item_hover',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li > a:focus,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li.active > a'    => 'background-color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'color_menu_item_hover',
            [
                'label'     => esc_html__('Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li:hover> a >.caret,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li:focus> a >.caret,
                    {{WRAPPER}} .tbay-element-nav-menu .elementor-nav-menu--main >ul > li.active> a >.caret,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a:focus i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li> a.active i,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li > a:focus,
                    {{WRAPPER}} .elementor-nav-menu--main >ul > li.active > a'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'menu_item_box_shadow_hover',
                'selector'  => '{{WRAPPER}} .elementor-nav-menu--main >ul > li> a:hover',
                'condition' => [
                    'layout' => 'horizontal',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'padding_menu_item',
            [
                'label'     => esc_html__('Padding', 'greenmart'),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main .elementor-item'        => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'no_padding_menu_item_first_item',
            [
                'label'        => esc_html__( 'No Padding-Left First Item', 'greenmart' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Off', 'greenmart' ),
                'label_on'  => esc_html__( 'On', 'greenmart' ),
                'default'   => '',
                'condition' => [
                    'layout' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main > .megamenu > li:first-child >.elementor-item' => 'padding-left: 0',
                ],
            ] 
        );  

        $this->add_responsive_control(
            'margin_menu_item',
            [
                'label'     => esc_html__('Margin', 'greenmart'),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-nav-menu--main > .navbar-nav > li > .elementor-item'        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_menu_canvas() {
        $this->start_controls_section(
            'section_style_canvas',
            [
                'label'     => esc_html__('Canvas', 'greenmart'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'type_menu' => 'canvas',
                ],
            ]
        );

        $this->add_responsive_control(
			'toggle_canvas_icon_padding',
			[
				'label' => esc_html__( 'Padding Icon', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .btn-canvas-menu i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
            'toggle_canvas_icon_color',
            [
                'label' => esc_html__('Color Icon', 'greenmart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'toggle_canvas_icon_bg',
            [
                'label' => esc_html__('Background Icon', 'greenmart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'toggle_canvas_icon_color_hv',
            [
                'label' => esc_html__('Color Icon Hover', 'greenmart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'toggle_canvas_icon_bg_hv',
            [
                'label' => esc_html__('Background Icon Hover', 'greenmart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-canvas-menu i:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_menu_dropdown() {
        $this->start_controls_section(
            'section_style_dropdown',
            [
                'label'     => esc_html__('Dropdown', 'greenmart'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style_horizontal' => 'no-style'
                ],
            ]
        );

        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'dropdown_typography',
                'exclude'   => ['line_height'],
                'selector'  => '{{WRAPPER}} .navbar-nav .dropdown-menu > li > a',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'dropdown_Heading',
            [
                'label'     => esc_html__('Heading sub title megamenu', 'greenmart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .active-mega-menu .elementor-widget-wp-widget-nav_menu > .elementor-widget-container > h5'       => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->start_controls_tabs('tabs_dropdown_item_style');

        $this->start_controls_tab(
            'tab_dropdown_item_normal',
            [
                'label' => esc_html__('Normal', 'greenmart'),
            ]
        );

        $this->add_control(
            'color_dropdown_item',
            [
                'label'     => esc_html__('Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li > a, 
                    {{WRAPPER}} .active-mega-menu .elementor-nav-menu > li > a, 
                    {{WRAPPER}} .active-mega-menu .menu > li> a' => 'color: {{VALUE}}',
                ],
            ]
        ); 

        $this->add_control(
            'background_color_dropdown_item',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [ 
                    '{{WRAPPER}} .active-mega-menu > .dropdown-menu, 
                    {{WRAPPER}} .elementor-nav-menu > li.dropdown > .dropdown-menu' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_hover',
            [
                'label' => esc_html__('Hover', 'greenmart'),
            ]
        );

        $this->add_control(
            'color_dropdown_item_hover',
            [
                'label'     => esc_html__('Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li > a:hover, 
                    {{WRAPPER}} .dropdown-menu > li:hover > a,
                    {{WRAPPER}} .active-mega-menu .menu > li> a:hover,
                    {{WRAPPER}} .active-mega-menu .menu > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color_dropdown_item_hover',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li:hover,
                    {{WRAPPER}} .active-mega-menu .menu > li:hover' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

         $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dropdown_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .navbar-nav li:hover > .dropdown-menu',
            ]
        );

        $this->add_responsive_control(
            'padding_horizontal_dropdown_item',
            [
                'label'     => esc_html__('Horizontal Padding', 'greenmart'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li, {{WRAPPER}} .active-mega-menu .menu > li'       => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',

            ]
        );

        $this->add_responsive_control(
            'padding_vertical_dropdown_item',
            [
                'label'     => esc_html__('Vertical Padding', 'greenmart'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dropdown-menu > li, {{WRAPPER}} .active-mega-menu .menu > li'       => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control( 
            'dropdown_padding',
            [
                'label'      => esc_html__('Padding', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dropdown-menu, {{WRAPPER}} .active-mega-menu .menu'       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_toggle_menu() {

        $this->start_controls_section(
            'section_toggle_menu',
            [
                'label' => esc_html__( 'Toggle Menu', 'greenmart' ),
                'condition' => [
                    'type_menu' => 'toggle',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_menu_align',
            [
                'label' => esc_html__('Alignment', 'greenmart'),
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
                    'justify' => [
                        'title' => esc_html__('Justified', 'greenmart'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .toggle-menu-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'toggle_menu_title_heading',
            [
                'label' => esc_html__('Title', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );        

        $this->add_control(
            'toggle_menu_title',
            [
                'label' => esc_html__('Title', 'greenmart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'greenmart' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'toggle_menu_title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'toggle_menu_title_style',
                'selector' => '{{WRAPPER}} .toggle-menu-title span',
            ]
        );

        if( greenmart_tbay_get_theme() === 'fresh-el' ) {   
            
            $this->add_control(
                'toggle_menu_inside_title_enable',
                [
                    'label' => esc_html__( 'Enable Title Inside', 'greenmart' ),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before',
                    'default' => '',
                ]
            );

            $this->add_control(
                'toggle_menu_inside_title_heading',
                [
                    'label' => esc_html__('Title Inside', 'greenmart'),
                    'separator' => 'before',
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'type' => Controls_Manager::HEADING,
                ]
            );     

            $this->add_control(
                'toggle_menu_inside_title',
                [
                    'label' => esc_html__('Title Inside Content', 'greenmart'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Title Inside Content', 'greenmart' ),
                    'label_block' => true,
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'toggle_menu_inside_title_tag',
                [
                    'label' => esc_html__( 'Title Inside HTML Tag', 'greenmart' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h4',
                ]
            );

            $this->add_responsive_control(
                'toggle_menu_inside_title_padding',
                [
                    'label' => esc_html__( 'Title Inside Padding', 'greenmart' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .category-inside-content .inside-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'toggle_menu_inside_title_margin',
                [
                    'label' => esc_html__( 'Title Inside Margin', 'greenmart' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .category-inside-content .inside-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'toggle_menu_inside_title_style',
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .category-inside-content .inside-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'        => 'toggle_menu_inside_title_border',
                    'placeholder' => '1px',
                    'condition' => [
                        'toggle_menu_inside_title_enable' => 'yes'
                    ],
                    'selector'    => '{{WRAPPER}} .category-inside-content .inside-title',
                ]
            );
        }  

        $this->add_control(
            'toggle_content_menu',
            [
                'label' => esc_html__( 'Toggle content menu', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'prefix_class' => 'elementor-toggle-content-menu-',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_content_menu',
            [
                'label' => esc_html__( 'Show content menu', 'greenmart' ),
                'description' => esc_html__('Show content menu on home page', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'condition' => [
                    'toggle_content_menu!' => '', 
                ],
            ]
        );

        $this->add_control(
            'ajax_toggle',
            [
                'label' => esc_html__( 'Ajax Toggle Menu', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => esc_html__( 'Show/hidden Ajax Toggle Menu', 'greenmart' ), 
                'condition' => [
                    'toggle_content_menu' => 'yes',
                    'show_content_menu!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_toggle_menu_icon',
            [
                'label' => esc_html__( 'Show Icon', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'toggle_menu_icon_heading',
            [
                'label' => esc_html__('Icon', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );    

        $this->add_responsive_control(
            'toggle_menu_icon',
            [
                'label' => esc_html__('Icon', 'greenmart'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'toggle_menu_icon_size',
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
					'{{WRAPPER}} .toggle-menu-title i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_toggle_menu_icon!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->register_section_style_toggle_menu();
    }

    private function register_section_vertical_menu() {

        $this->start_controls_section(
            'section_vertical_menu',
            [
                'label' => esc_html__( 'Vertical Menu', 'greenmart' ),
                'condition' => [
                    'layout' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_vertical_submenu_align',
            [
                'label' => esc_html__('Alignment Sub Menu', 'greenmart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'greenmart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'greenmart'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_canvas_menu() {

        $this->start_controls_section(
            'section_canvas_menu',
            [
                'label' => esc_html__( 'Canvas Menu', 'greenmart' ),
                'condition' => [
                    'type_menu' => 'canvas',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_icon_heading',
            [
                'label' => esc_html__('Icon', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );  

        $this->add_responsive_control(
            'toggle_canvas_menu_icon',
            [
                'label' => esc_html__('Icon Open', 'greenmart'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
				'default' => [
					'value' => 'tb-icon tb-icon-navigation-menu',
					'library' => 'tbay-custom',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_icon_size',
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
					'{{WRAPPER}} .btn-canvas-menu i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'close_canvas_menu_icon',
            [
                'label' => esc_html__('Icon Close', 'greenmart'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
				'default' => [
					'value' => 'tb-icon tb-icon-close',
					'library' => 'tbay-custom',
                ],
            ]
        );

        $this->add_control(
            'close_canvas_icon_size',
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
					'{{WRAPPER}} .toggle-canvas-close i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_canvas_content_align',
            [
                'label' => esc_html__('Positioning Content', 'greenmart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'greenmart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'greenmart'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '', 
                'prefix_class' => 'canvas-position-',
            ]
        );        

        $this->add_control(
            'toggle_canvas_title_heading',
            [
                'label' => esc_html__('Title Content', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );        

        $this->add_control(
            'toggle_canvas_title',
            [
                'label' => esc_html__('Title', 'greenmart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'greenmart' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'toggle_canvas_title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'ajax_canvas',
            [
                'label' => esc_html__( 'Ajax canvas Menu', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Show/hidden Ajax canvas Menu', 'greenmart' ), 
                'default' => 'no',
                'condition' => [ 
                    'type_menu' => 'canvas',
                    'layout!' => 'horizontal',
                ],
            ]
        );


        $this->add_responsive_control(
            'toggle_canvas_title_size',
            [
                'label' => esc_html__('Font Size Title', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-canvas-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'toggle_canvas_title_line_height',
            [
                'label' => esc_html__('Line Height Title', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .toggle-canvas-title' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_section_style_toggle_menu() {
        $this->start_controls_section(
            'section_style_toggle_menu',
            [
                'label' => esc_html__( 'Toggle Menu', 'greenmart' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'type_menu' => 'toggle',
                    'layout!' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'style_toggle_menu',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title'    => 'background-color: {{VALUE}}',
                ],
            ]
        );     

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'style_toggle_menu_typography',
                'selector' => '{{WRAPPER}} .toggle-menu-title span',
            ]
        );

        
        $this->add_control(
            'toggle_menu_color',
            [
                'label'     => esc_html__('Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title, {{WRAPPER}} .toggle-menu-title > *'=> 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'toggle_menu_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .toggle-menu-title:hover, {{WRAPPER}} .toggle-menu-title a:hover,
                    {{WRAPPER}} .open .toggle-menu-title a'=> 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
			'toggle_menu_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'toggle_menu_padding',
			[
				'label' => esc_html__( 'Padding', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'toggle_menu_margin',
			[
				'label' => esc_html__( 'Margin', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .toggle-menu-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->end_controls_section();
    }

    public function render_get_toggle_menu() {
        $settings = $this->get_settings();

        extract( $settings );

        $ouput = '';

        if( $layout === 'horizontal' || $type_menu !== 'toggle' ) return;

        if( empty($toggle_menu_title) && !$show_toggle_menu_icon ) return;

        $ouput .= '<'. $toggle_menu_title_tag .'  class="toggle-menu-title category-inside-title">';

            if( !empty($toggle_content_menu) ) {
                $ouput .= '<a href="javascript:void(0);" class="click-show-menu menu-click">';
            }

                if( $show_toggle_menu_icon ) {
                    $ouput .= '<i class="'. $toggle_menu_icon['value'] .'"></i>';
                }
 
                if( !empty($toggle_menu_title) )  $ouput .= '<span>'. $toggle_menu_title .'</span>';

            if( !empty($toggle_content_menu) ) {
                $ouput .= '</a>';
            }
        
        $ouput .= '</'. $toggle_menu_title_tag .'>';

        return $ouput;
    }

    public function render_canvas_button_menu() {
        $settings = $this->get_settings();
        extract($settings);

        $ouput = '';

        if( $layout === 'horizontal' || $type_menu !== 'canvas' ) return; 

        $ouput .= '<div class="canvas-menu-btn-wrapper">';
            $ouput .= '<a href="javascript:void(0);" class="btn-canvas-menu menu-click"><i class="'. $toggle_canvas_menu_icon['value'] .'"></i></a>';
        $ouput .= '</div>';
        $ouput .= '<div class="canvas-overlay-wrapper"></div>';
      
        return $ouput;
    }

    public function render_get_toggle_canvas_menu() {
        $settings = $this->get_settings();

        extract( $settings );

        $close = '<button class="toggle-canvas-close">'.'<i class=" '.$close_canvas_menu_icon['value'].' ">'.'</i>'.'</button>';

        $ouput = '';

        if( $layout === 'horizontal' || $type_menu !== 'canvas' ) return; 

        if( empty($toggle_canvas_title) ) return;

        $ouput .= '<'. $toggle_canvas_title_tag .'  class="toggle-canvas-title">';

 
        $ouput .= $toggle_canvas_title;
        $ouput .= $close;

        
        $ouput .= '</'. $toggle_canvas_title_tag .'>';

        return $ouput; 
    }

    
    public function render_get_inside_title_menu() {
        $settings = $this->get_settings();

        extract( $settings );

        $ouput = '';

        if( greenmart_tbay_get_theme() !== 'fresh-el' || $layout === 'horizontal' || $type_menu !== 'toggle' ) return; 

        if( empty($toggle_menu_inside_title) ) return;

        $ouput .= '<'. $toggle_menu_inside_title_tag .'  class="inside-title">';

 
        $ouput .= $toggle_menu_inside_title;

        
        $ouput .= '</'. $toggle_menu_inside_title_tag .'>';

        return $ouput; 
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Nav_Menu());

