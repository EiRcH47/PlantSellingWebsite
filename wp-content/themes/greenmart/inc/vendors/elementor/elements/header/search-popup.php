<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Search_Popup') ) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;


class Greenmart_Elementor_Search_Popup extends Greenmart_Elementor_Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'tbay-search-popup';
    }

    public function get_title() {
        return esc_html__('Greenmart Search Popup', 'greenmart');
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
        $this->_register_form_search_popup();
        $this->add_responsive_control(
            'popup_search_height',
            [
                'label' => esc_html__('Height Button', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toogle-btn-search' => 'height: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'popup_search_width',
            [
                'label' => esc_html__('Width Button', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .toogle-btn-search' => 'width: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        
        $this->_register_icon_search_popup();
        $this->_register_button_search();

        $this->end_controls_section();
    }
    protected function _register_form_search_popup() {
        
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
    }

    protected function _register_form_search() {
        $this->add_control(
            'advanced_type_search',
            [
                'label' => esc_html__('Search Form', 'greenmart'),
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

    }
    protected function _register_icon_search_popup() {
        $this->add_control(
            'icon_popup',
            [
                'label' => esc_html__('Icon Popup', 'greenmart'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'icon_popup_open',
            [
                'label'              => esc_html__('Icon Open', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
                'default' => [
                    'library' => 'tb-icon',
                    'value'   => 'tb-icon tb-icon-search-2'
                ],
                'separator'    => 'before',
            ]
        );
        $this->add_control(
            'icon_popup_close',
            [
                'label'              => esc_html__('Icon Close', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
                'default' => [
                    'library' => 'tb-icon',
                    'value'   => 'tb-icon tb-icon-close'
                ],
                'separator'    => 'before',
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
     
    }

   
    public function get_script_depends() {
        return ['jquery-sumoselect'];
    }
    public function get_style_depends() {
        return ['sumoselect'];
    }
    

    public function render_search_popup() {
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
            <button class="toogle-btn-search">
                <?php $this->render_item_icon($icon_popup_open) ?>
                <?php $this->render_item_icon($icon_popup_close) ?>
            </button>
            
            <div class="tbay-search-form">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" <?php echo trim($this->get_render_attribute_string( 'search_form' )); ?> >
                    <div class="form-group">
                        <div class="input-group">
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
$widgets_manager->register_widget_type(new Greenmart_Elementor_Search_Popup());

