<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Account') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Greenmart_Elementor_Account extends Greenmart_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'tbay-account';
    }

    public function get_title() {
        return esc_html__('Greenmart Account', 'greenmart');
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    protected function get_html_wrapper_class() {
		return 'w-auto elementor-widget-' . $this->get_name();
    }
    
    public function get_keywords() {
        return ['account', 'login'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Account', 'greenmart'),
            ]
        );
        $this->add_control(
            'show_icon',
            [
                'label'              => esc_html__('Show Icon', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'no',
            ]
        );
        $this->add_control(
            'icon_account',
            [
                'label'              => esc_html__('Icon', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
                
                'default' => [
                    'value' => 'tb-icon tb-icon-user-male',
					'library' => 'tbay-custom',
                ],                
                'condition'          => [
                    'show_icon'      => 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'show_text_account',
            [
                'label'              => esc_html__('Display Text Account', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes'        
            ]
        );
       
        $this->add_control(
            'text_before',
            [
                'label'              => esc_html__('Text Before Login', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'condition'          => [
                    'show_text_account' => 'yes'
                ]     
            ]
        );
        $this->add_control(
            'text_after',
            [
                'label'              => esc_html__('Text After Login', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'condition'          => [
                    'show_text_account' => 'yes'
                ]        
            ]
        );
        $this->add_control(
            'type_account',
            [
                'label'              => esc_html__('Layout', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'row'            => esc_html__('Row','greenmart'),
                    'column'         => esc_html__('Column','greenmart'),
                ],
                'default'            => 'column',
                'prefix_class'       => 'layout-account-'      
            ]
        );

        $this->add_control(
            'show_sub_account',
            [
                'label'              => esc_html__('Display Sub Menu', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'sub_menu_account',
                [
                    'label'        => esc_html__('Choose Menu', 'greenmart'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'condition'    => [
                        'show_sub_account'  => 'yes'
                    ],
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'greenmart'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'sub_menu_account',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'greenmart'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
       
        $this->end_controls_section();
        $this->register_section_style_icon();
        $this->register_section_style_text();
    }
    protected function register_section_style_icon() {
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Style Icon', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'          => [
                    'show_icon'      => 'yes'
                ],
            ]
        );
        $this->add_control(
            'icon_account_size',
            [
                'label' => esc_html__('Font Size', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tbay-login a i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'padding_icon_account',
            [
                'label'     => esc_html__('Padding Icon Account', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-login a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .tbay-login a i'    => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_control(
            'bg_icon',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-login a i'    => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .tbay-login a i:hover'    => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_control(
            'hover_bg_icon',
            [
                'label'     => esc_html__('Background Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-login a i:hover'    => 'background-color: {{VALUE}}',
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
                    'show_text_account' => 'yes',
                ]
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
            'register_text_general',
            [
                'label'     => esc_html__('General', 'greenmart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .text-account, {{WRAPPER}} .title-account',
            ]
        );
        $this->add_control(
            'color_text',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-account,{{WRAPPER}} .title-account' => 'color: {{VALUE}}',
                ],
            ]
        );   

        $this->add_control(
            'register_title_general',
            [
                'label'     => esc_html__('Title', 'greenmart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title-account',
            ]
        );
        $this->add_control(
            'color_title',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-account' => 'color: {{VALUE}}',
                ],
            ]
        );   

        $this->add_responsive_control(
            'spacing_title',
            [
                'label' => esc_html__('Spacing Title','greenmart'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ], 
                'default'   => [
                    'top' => '0',
                    'right' => '5',
                    'bottom' => '0',
                    'left' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-account' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'register_text_general_hover',
            [
                'label'     => esc_html__('General', 'greenmart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'color_text_hover',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-account:hover,{{WRAPPER}} .title-account:hover' => 'color: {{VALUE}}',
                ],
            ]
        );   

        $this->add_control(
            'register_title_general_hover',
            [
                'label'     => esc_html__('Title', 'greenmart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        
        $this->add_control(
            'color_title_hover',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-account:hover' => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'register_style_sub_menu',
            [
                'label'     => esc_html__('Submenu', 'greenmart'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'show_sub_account' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'sub_menu_padding',
            [
                'label' => esc_html__('Pading', 'greenmart'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'show_sub_account' => 'yes'
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbay-login .account-menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sub_menu_width',
            [
                'label' => esc_html__('Width', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'show_sub_account' => 'yes'
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tbay-login .account-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sub_menu_right',
            [
                'label' => esc_html__('Right', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'condition' => [
                    'show_sub_account' => 'yes'
                ],
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .tbay-login .account-menu' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sub_menu_top',
            [
                'label' => esc_html__('Top', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'condition' => [
                    'show_sub_account' => 'yes'
                ],
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .tbay-login .account-menu' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function is_user_logged_in() {
		$user = wp_get_current_user();

		return $user->exists();
    }
    
    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    public function check_login_organic_el($show_icon, $show_text_account,$text_after,$text_before,$icon_account) {
        if(!empty($text_after)) {
            $title = $text_after;
        }else {
            $title = esc_html__('Hello','greenmart');
        }
        if(is_user_logged_in()) {
            $current_user 	= wp_get_current_user(); 
            $name = $current_user->display_name;
        }
        else {
            if(!empty($text_before)) {
                $name = $text_before;
            }else {
                $name = esc_html__('Login','greenmart');
            }
        }


        if ($show_text_account === 'yes' || $show_icon === 'yes') {
           
            ?>
            <span class="title-account"><?php $this->render_item_icon($icon_account); ?><?php echo trim($title) ?></span>
            <span class="text-account"> <?php echo trim($name); ?> </span><?php
        }
    }

    public function check_login_fresh_el($show_icon, $show_text_account,$text_after,$text_before,$icon_account) {
        if(!empty($text_after)) {
            $title = $text_after;
        }else {
            $title = esc_html__('Account','greenmart');
        }
        if(is_user_logged_in()) {
            $current_user 	= wp_get_current_user(); 
            $name = $current_user->display_name;
        }
        else {
            if(!empty($text_before)) {
                $name = $text_before;
            }else {
                $name = esc_html__('Login/Register','greenmart');
            }
        }

        if( $show_text_account !== 'yes' ) {
            $title = $name = '';
        }


        if ($show_text_account === 'yes' || $show_icon === 'yes') {
            ?>
            <span class="title-account">
                <?php $this->render_item_icon($icon_account); ?>
                <?php 
                    if( $show_text_account === 'yes' ) echo trim($title);
                ?>
            </span>
            <?php

            if( $show_text_account === 'yes' ) echo '<span class="text-account">' .trim($name). '</span>'; 
        }
    }

    public function render_item_account() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( greenmart_tbay_get_theme() === 'organic-el' ) {
            $this->check_login_organic_el($show_icon, $show_text_account,$text_after,$text_before,$icon_account);
        } else {
            $this->check_login_fresh_el($show_icon, $show_text_account,$text_after,$text_before,$icon_account);
        }

    }
    
    public function render_sub_menu() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        $args = [
            'menu'        => $sub_menu_account,
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id()
        ];
        $menu_html = wp_nav_menu($args);
        echo trim($menu_html);
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Account());

