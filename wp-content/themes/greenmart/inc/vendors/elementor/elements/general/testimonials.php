<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Testimonials') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Greenmart_Elementor_Testimonials extends  Greenmart_Elementor_Carousel_Base{
    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tbay-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Greenmart Testimonials', 'greenmart' );
    }

    public function get_script_depends() {
        return [ 'greenmart-custom-slick', 'slick' ];
    } 
 
    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->register_controls_heading();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'greenmart' ),
            ]
        );
 
        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'greenmart'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'carousel',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'greenmart'), 
                    'carousel'  => esc_html__('Carousel', 'greenmart'), 
                ],
            ]
        );   
        $this->add_control(
            'testimonials_align',
            [
                'label' => esc_html__('Align','greenmart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left','greenmart'),
                        'icon' => 'fas fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__('Center','greenmart'),
                        'icon' => 'fas fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__('Right','greenmart'),
                        'icon' => 'fas fa-align-right'
                    ],   
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item .testimonials-body'  => 'text-align: {{VALUE}} !important',
                ]
            ]
        );  
        $this->add_responsive_control(
			'testimonial_padding',
			[
				'label' => esc_html__( 'Padding "Name"', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $repeater = $this->register_testimonials_repeater();

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials Items', 'greenmart' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => $this->register_set_testimonial_default(),
                'testimonials_field' => '{{{ testimonial_name }}}',
            ]
        ); 
        
        $skin = greenmart_tbay_get_theme();

        $option_style = [
            'style-icon' => esc_html__('Style Icon','greenmart'),
            'style-image' => esc_html__('Style Image','greenmart'),
        ];
        $style_rating =  [];
        $default_style = 'style-icon';
        if ($skin === 'fresh-el') {
            $style_rating = [
                'style-rating' => esc_html__('Style Rating','greenmart'),
            ];
            $default_style = 'style-rating';
        }
        

        $option_style = array_merge( $option_style, $style_rating );


        $this->add_control(
            'testimonials_style',
            [
                'label' => esc_html__( 'Style', 'greenmart' ),
                'type' => Controls_Manager::SELECT,
                'options' => $option_style,
                'default' => $default_style, 
                'prefix_class' => 'testi-' 
            ]
        );
        $this->end_controls_section();
        $this->register_style_testimonials();

        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);

    }

    private function register_testimonials_repeater() {
        $repeater = new \Elementor\Repeater();
        $skin = greenmart_tbay_get_theme();
        $repeater->add_control (
            'testimonial_type',
            [
                'label' => esc_html__( 'Display Type', 'greenmart' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'icon',
                'options' => [
                    'image' => [
                        'title' => esc_html__('Image', 'greenmart'),
                        'icon' => 'fa fa-image',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'greenmart'),
                        'icon' => 'fa fa-info',
                    ],
                ],
                'default' => 'icon',
            ]
        );
        $repeater->add_control(
            'testimonial_icon',
            [
                'label' => esc_html__('Choose Icon','greenmart'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-quote-left',
					'library' => 'tbay-custom',
                ],
                'condition' => [
                    'testimonial_type' => 'icon'
                ]
            ]
        );
        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image','greenmart'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'testimonial_type' => 'image'
                ]
            ]
        );   
        
        $repeater->add_control (
            'testimonial_name', 
            [
                'label' => esc_html__( 'Name', 'greenmart' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        if($skin === 'fresh-el') {
            $repeater->add_control (
                'testimonial_date', 
                [
                    'label' => esc_html__( 'Date', 'greenmart' ),
                    'type' => Controls_Manager::TEXT,   
                ]
            );
        } 
        $repeater->add_control ( 
            'testimonial_job', 
            [
                'label' => esc_html__( 'Job', 'greenmart' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control (
            'testimonial_excerpt', 
            [
                'label' => esc_html__( 'Excerpt', 'greenmart' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        return $repeater;
    }

    private function register_set_testimonial_default() {
        $defaults = [
            [
                'testimonial_icon' => [
                    'value' => 'tb-icon tb-icon-quote-left',
					'library' => 'tbay-custom',
                ],
                'testimonial_name' => esc_html__( 'Name 1', 'greenmart' ), 
                'testimonial_job' => esc_html__( 'Job 1', 'greenmart' ),
                'testimonial_date' => esc_html__( '22 Oct, 2020', 'greenmart' ),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'greenmart'),
            ],
            [
                'testimonial_icon' => [
                    'value' => 'tb-icon tb-icon-quote-left',
					'library' => 'tbay-custom',
                ],
                'testimonial_name' => esc_html__( 'Name 2', 'greenmart' ),
                'testimonial_job' => esc_html__( 'Job 2', 'greenmart' ),
                'testimonial_date' => esc_html__( '22 Oct, 2020', 'greenmart' ),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'greenmart'),
            ],
            [
                'testimonial_icon' => [
                    'value' => 'tb-icon tb-icon-quote-left',
					'library' => 'tbay-custom',
                ],
                'testimonial_name' => esc_html__( 'Name 3', 'greenmart' ),
                'testimonial_job' => esc_html__( 'Job 3', 'greenmart' ),
                'testimonial_date' => esc_html__( '22 Oct, 2020', 'greenmart' ),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'greenmart'),
            ],
            [
                'testimonial_icon' => [
                    'value' => 'tb-icon tb-icon-quote-left',
					'library' => 'tbay-custom',
                ],
                'testimonial_name' => esc_html__( 'Name 4', 'greenmart' ),
                'testimonial_job' => esc_html__( 'Job 4', 'greenmart' ),
                'testimonial_date' => esc_html__( '22 Oct, 2020', 'greenmart' ),
                'testimonial_excerpt' => 'Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque',
            ],
        ];

        return $defaults;
    }

    private function register_style_testimonials() {
        $this->start_controls_section(
            'section_style_testimonials',
            [
                'label' => esc_html__( 'Style Content', 'greenmart' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'padding_content',
			[
				'label' => esc_html__( 'Padding Content', 'greenmart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .tbay-element-testimonials .testimonials-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
            'width_icon',
            [
                'label'      => esc_html__( 'Width Icon', 'greenmart' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                ],
                
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tbay-element-testimonials .testimonials-body i' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'heading_testimonials_name',
            [
                'label' => esc_html__('Title', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );  
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonials_name',
                'selector' => '{{WRAPPER}} .tbay-element-testimonials .testimonial-meta .name',
            ]
        );
        $this->add_control(
            'testimonials_name_color',
            [
                'label' => esc_html__('Color','greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-testimonials .testimonial-meta .name'    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'heading_testimonials_job',
            [
                'label' => esc_html__('Job', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );  
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonials_job',
                'selector' => '{{WRAPPER}} .tbay-element-testimonials .testimonial-meta .job',
            ]
        );
        $this->add_control(
            'testimonials_job_color',
            [
                'label' => esc_html__('Color','greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-testimonials .testimonial-meta .job'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render_item( $item,$settings ) {
        ?> 
        <div class="testimonials-content">
            <?php
                if(isset($item['testimonial_image']) && !empty($item['testimonial_image']) && $settings['testimonials_style'] ==='style-image'  ) {
                    echo trim($this->get_widget_field_img($item['testimonial_image']));
                }
            ?>
            <div class="testimonials-body"> 
                <?php
                    if(isset($item['testimonial_icon']) && !empty($item['testimonial_icon']) && $settings['testimonials_style'] ==='style-icon' ) {
                        $this->render_item_icon($item['testimonial_icon']);
                    }
                ?>
                <?php $this->render_item_excerpt( $item ); ?>
            </div>
            <div class="testimonial-meta">
                <?php 
                    $this->render_item_name( $item );
                    $this->render_item_job( $item );
                    $this->render_item_date( $item );
                ?>
            </div>
        </div>
        <?php
    }    
    
    
    private function render_item_name( $item ) {
        $testimonial_name  = $item['testimonial_name'];
        if(isset($testimonial_name) && !empty($testimonial_name)) {
            ?>
                <span class="name"><?php echo trim($testimonial_name) ?></span>
            <?php
        }
    }
    private function render_item_job( $item ) {
        $testimonial_job  = $item['testimonial_job'];

        if(isset($testimonial_job) && !empty($testimonial_job)) {
            ?>
                <span class="job"><?php echo trim($testimonial_job) ?></span>
            <?php
        }
    } 
    private function render_item_date( $item ) {
        $skin = greenmart_tbay_get_theme();
        if( $skin !== 'fresh-el' ) return;

        $testimonial_date  = $item['testimonial_date'];

        if(isset($testimonial_date) && !empty($testimonial_date)) {
            ?>
                <span class="date"><?php echo trim($testimonial_date) ?></span>
            <?php
        }
    }

    private function render_item_excerpt( $item ) {
        $testimonial_excerpt  = $item['testimonial_excerpt'];

        if(isset($testimonial_excerpt) && !empty($testimonial_excerpt)) {
            ?>
                <span class="excerpt"><?php echo trim($testimonial_excerpt) ?></span>
            <?php
        }
    }

}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Testimonials());
