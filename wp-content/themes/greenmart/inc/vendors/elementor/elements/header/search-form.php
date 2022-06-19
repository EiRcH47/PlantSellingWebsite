<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Search_Form') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;


class Greenmart_Elementor_Search_Form extends Greenmart_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'tbay-search-form';
    }

    public function get_title() {
        return esc_html__('Greenmart Search Form', 'greenmart');
    }
    
    public function get_icon() {
        return 'eicon-search';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Search Form', 'greenmart'),
            ]
        ); 
       
        $this->_register_form_search();
        $this->_register_button_search();
        $this->_register_category_search();

        $this->add_control(
            'advanced_show_result',
            [
                'label' => esc_html__('Show Result', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );
        $this->add_control(
            'show_image_search',
            [
                'label'   => esc_html__('Show Image of Search Result', 'greenmart'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_price_search',
            [
                'label'              => esc_html__('Show Price of Search Result', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        $this->register_section_style_search_form();
    }

    protected function register_section_style_search_form() {
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Style Search Form', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'search_form_line_height',
            [
                'label' => esc_html__('Line Height', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 39,
				],

                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .tbay-search,
                    {{WRAPPER}} .tbay-search-form .select-category,{{WRAPPER}} .tbay-search-form .button-search:not(.icon),
                    {{WRAPPER}} .tbay-search-form .select-category > select' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tbay-search-form .select-category,{{WRAPPER}} .tbay-search-form .button-search:not(.icon),
                    {{WRAPPER}} .tbay-preloader,{{WRAPPER}} .tbay-search-form .button-search:not(.icon) i,{{WRAPPER}} .tbay-search-form .SumoSelect' => 'line-height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );
        $this->add_control(
            'search_form_width',
            [
                'label' => esc_html__('Width', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                    ]
                ],
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .form-group .input-group,
                    {{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'border_style_tbay_search_form',
            [
                'label' => esc_html__( 'Border Type', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'greenmart' ),
                    'solid' => esc_html__( 'Solid', 'greenmart' ),
                    'double' => esc_html__( 'Double', 'greenmart' ),
                    'dotted' => esc_html__( 'Dotted', 'greenmart' ),
                    'dashed' => esc_html__( 'Dashed', 'greenmart' ),
                    'groove' => esc_html__( 'Groove', 'greenmart' ),
                ],
                'default'  => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .form-group .input-group' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'border_width_tbay_search_form',
            [
                'label' => esc_html__( 'Width', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => '1',
                    'right' => '1',
                    'bottom' => '1',
                    'left' => '1',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .form-group .input-group' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border_style_tbay_search_form!' => '',
                ],
            ]
        );
        $this->add_control(
            'border_color_tbay_search_form',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .form-group .input-group' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_tbay_search_form!' => '',
                ],
            ]
        );
        
        $this->add_control(
            'border_radius_tbay_search_form',
            [
                'label'     => esc_html__('Border Radius Search Form', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'condition' => [
                    'border_style_tbay_search_form!' => '',
                ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .form-group .input-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tbay-search-form .select-category.input-group-addon,{{WRAPPER}} .tbay-search-form .select-category .CaptionCont' => 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',                   
                ],
            ]
        ); 

        $this->add_control(
            'bg_form_search',
            [
                'label'     => esc_html__('Background', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form input'    => 'background: {{VALUE}}',
                ],
            ]
        ); 
       

        $this->add_control(
            'advanced_categories_search_style',
            [
                'label' => esc_html__('Categories Search', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
                'condition' => [
                    'enable_categories_search' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'bg_category_search',
            [
                'label'     => esc_html__('Background', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'enable_categories_search' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .select-category.input-group-addon'    => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'color_category_search',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'enable_categories_search' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .select-category>select'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'advanced_btn_search_style',
            [
                'label' => esc_html__('Button Search', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'padding_btn',
            [
                'label'     => esc_html__('Padding Button Search', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   
        $this->add_control(
            'margin_btn',
            [
                'label'     => esc_html__('Margin Button Search', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .button-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   

        $this->add_control(
            'border_style_btn',
            [
                'label' => esc_html__( 'Border Type', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'greenmart' ),
                    'solid' => esc_html__( 'Solid', 'greenmart' ),
                    'double' => esc_html__( 'Double', 'greenmart' ),
                    'dotted' => esc_html__( 'Dotted', 'greenmart' ),
                    'dashed' => esc_html__( 'Dashed', 'greenmart' ),
                    'groove' => esc_html__( 'Groove', 'greenmart' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon)' => 'border-style: {{VALUE}};',
                ],
                'default' => 'solid',
            ]
        );
        $this->add_control(
            'border_width_btn',
            [
                'label' => esc_html__( 'Width', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],

                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '1',
                    'right' => '1',
                    'bottom' => '1',
                    'left' => '1',
                ],
                'condition' => [
                    'border_style_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            'border_color_btn',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#86bc42',
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon)' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_btn!' => '',
                ],
            ]
        );
        
        $this->add_control(
            'border_radius_btn',
            [
                'label'     => esc_html__('Border Radius', 'greenmart'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .button-group,
                    {{WRAPPER}} .tbay-search-form .button-search:not(.icon)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                ],
                'condition' => [
                    'border_style_btn!' => '',
                ],
            ]
        ); 

        $this->add_control(
            'bg_btn',
            [
                'label'     => esc_html__('Background Button', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#86bc42',
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon)'    => 'background: {{VALUE}}',
                ],
            ]
        );   
        $this->add_control(
            'bg_btn_hover',
            [
                'label'     => esc_html__('Background Button Hover', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .button-search:not(.icon):hover'    => 'background: {{VALUE}}',
                ],
            ]
        );  
        $this->add_control(
            'color_icon_btn',
            [
                'label'     => esc_html__('Color Icon Button', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .button-search i,{{WRAPPER}} .tbay-search-form .button-group:before'    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'color_icon_btn_hover',
            [
                'label'     => esc_html__('Color Icon Button Hover', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#86bc42',
                'selectors' => [
                    '{{WRAPPER}} .button-search:hover i'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'color_text_btn',
            [
                'label'     => esc_html__('Color Text Button', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .button-search .text'    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'color_text_btn_hover',
            [
                'label'     => esc_html__('Color Text Button Hover', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#86bc42',
                'selectors' => [
                    '{{WRAPPER}} .button-search:hover .text'    => 'color: {{VALUE}}',
                ],
            ]
        );
       
        $this->add_control(
            'advanced_input_search_style',
            [
                'label' => esc_html__('Input Search', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'bg_input',
            [
                'label'     => esc_html__('Background Input Search', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .tbay-search'    => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'color_input',
            [
                'label'     => esc_html__('Color Input Search', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-search-form .tbay-search'    => 'color: {{VALUE}}',
                    '{{WRAPPER}} .form-control::placeholder'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'input_search_padding',
            [
                'label'      => esc_html__( 'Padding', 'greenmart' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-search-form .tbay-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
    }

    protected function _register_form_search() {
        $this->add_control(
            'advanced_type_search',
            [
                'label' => esc_html__('Form', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'search_type',
            [
                'label'              => esc_html__('Search Result', 'greenmart'),
                'type'               => Controls_Manager::SELECT,
                'default' => 'product',
                'options' => [
                    'product'  => esc_html__('Product','greenmart'),
                    'post'  => esc_html__('Blog','greenmart')
                ]
            ]
        );

        
        $this->add_control(
            'autocomplete_search',
            [
                'label'              => esc_html__('Auto-complete Search', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes', 
            ]
        );
        $this->add_control(
            'placeholder_text',
            [
                'label'              => esc_html__('Placeholder Text', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('I’m searching for...', 'greenmart'),
            ]
        );  
        $this->add_control(
            'vali_input_search',
            [
                'label'              => esc_html__('Text Validate Input Search', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('Enter at least 2 characters', 'greenmart'),
            ]
        );
        $this->add_control(
            'min_characters_search',
            [
                'label'              => esc_html__('Search Min Characters', 'greenmart'),
                'type'               => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                    
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
            ]
        );
        $this->add_control(
            'search_max_number_results',
            [
                'label'              => esc_html__('Max Number of Search Results', 'greenmart'),
                'type'               => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 10,
                        'step' => 1,
                    ],
                    
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
            ]
        );

    }

    protected function _register_button_search() {
        $this->add_control(
            'advanced_button_search',
            [
                'label' => esc_html__('Button Search', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'text_button_search',
            [
                'label'              => esc_html__('Button Search Text', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'default' => 'SEARCH',
            ]
        );
        $this->add_control(
            'icon_button_search',
            [
                'label'              => esc_html__('Button Search Icon', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
                'default' => [
                    'library' => 'tb-icon',
                    'value'   => 'tb-icon tb-icon-search-2'
                ],
            ]
        );
        $this->add_control(
            'icon_button_search_size',
            [
                'label' => esc_html__('Font Size Icon', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 14,
				],
                'selectors' => [
                    '{{WRAPPER}} .button-search i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
    }

    protected function _register_category_search() {
        $this->add_control(
            'advanced_categories_search',
            [
                'label'         => esc_html__('Categories Search', 'greenmart'),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before',
            ]
        );
        $this->add_control(
            'enable_categories_search',
            [
                'label'              => esc_html__('Enable Categories in Search', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control(
            'text_categories_search',
            [
                'label'              => esc_html__('Categories in Search "Text"', 'greenmart'),
                'type'               => Controls_Manager::TEXT,
                'default'            =>  esc_html__('All Categories', 'greenmart'),
                'condition' => [
                    'enable_categories_search' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'divider_categories_search',
            [
                'label'              => esc_html__('Categories in Search "Divider"', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'no',
                'prefix_class' => 'divider-category-',
                'condition' => [
                    'enable_categories_search' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'color_divider',
            [
                'label'     => esc_html__('Color', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.divider-category-yes .select-category:after'    => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'divider_categories_search' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'height_divider',
            [
                'label' => esc_html__('Height', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}}.divider-category-yes .select-category:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'divider_categories_search' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'count_categories_search',
            [
                'label'              => esc_html__('Show count Categories', 'greenmart'),
                'type'               => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_categories_search' => 'yes'
                ]
            ]
        );
    }
    public function get_script_depends() {
        return ['jquery-sumoselect'];
    }
    public function get_style_depends() {
        return ['sumoselect'];
    }
    

    public function render_search_form() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $_id = greenmart_tbay_random_key();
        $class_active_ajax = ( greenmart_switcher_to_boolean($autocomplete_search) ) ? 'greenmart-ajax-search' : '';

        $this->add_render_attribute(
            'search_form',
            [
                'class' => [
                    $class_active_ajax,
                    'searchform'
                ],
                'data-thumbnail' => greenmart_switcher_to_boolean($show_image_search),
                'data-appendto' => '.search-results-'.$_id,
                'data-price' => greenmart_switcher_to_boolean($show_price_search),
                'data-minChars' => $min_characters_search['size'],
                'data-post-type' => $search_type,
                'data-count' => $search_max_number_results['size'],
            ]
        );
        ?>
            <div class="tbay-search-form">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" <?php echo trim($this->get_render_attribute_string( 'search_form' )); ?> >
                    <div class="form-group">
                        <div class="input-group">
                            <?php if ( $enable_categories_search === 'yes' ): ?>
                                <div class="select-category input-group-addon">
                                    <?php if ( class_exists( 'WooCommerce' ) && $search_type === 'product' ) :
                                        $args = array(
                                            'show_option_none'   => $text_categories_search,
                                            'show_count' => greenmart_switcher_to_boolean($count_categories_search),
                                            'hierarchical' => true,
                                            'id' => 'product-cat-'.$_id,
                                            'show_uncategorized' => 0
                                        );
                                    ?> 
                                    <?php wc_product_dropdown_categories( $args ); ?>
                                    
                                    <?php elseif ( $search_type === 'post' ):
                                        $args = array(
                                            'show_option_all' => $text_categories_search,
                                            'show_count' => greenmart_switcher_to_boolean($count_categories_search),
                                            'hierarchical' => true,
                                            'show_uncategorized' => 0,
                                            'name' => 'category',
                                            'id' => 'blog-cat-'.$_id,
                                            'class' => 'postform dropdown_product_cat',
                                        );
                                    ?>
                                        <?php wp_dropdown_categories( $args ); ?>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                                <input data-style="right" type="text" placeholder="<?php echo esc_attr($placeholder_text); ?>" name="s" required oninvalid="this.setCustomValidity('<?php echo esc_attr($vali_input_search) ?>')" oninput="setCustomValidity('')" class="tbay-search form-control input-sm"/>

                                <div class="search-results-wrapper">
                                    <div class="greenmart-search-results search-results-<?php echo esc_attr( $_id );?>" ></div>
                                </div>
                                <div class="button-group input-group-addon">
                                    <button type="submit" class="button-search btn btn-sm>">
                                        <?php $this->render_item_icon($icon_button_search) ?>
                                        <?php if(!empty($text_button_search) && isset($text_button_search) ) {
                                            ?>
                                                <span class="text"><?php echo trim($text_button_search); ?></span>
                                            <?php
                                        } ?>
                                    </button>
                                    <div class="tbay-preloader"></div>
                                </div>

                                <input type="hidden" name="post_type" value="<?php echo esc_attr($search_type); ?>" class="post_type" />
                        </div>
                        
                    </div>
                </form>
            </div>
        <?php
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Search_Form());

