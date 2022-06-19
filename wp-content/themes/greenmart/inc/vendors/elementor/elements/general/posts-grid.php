<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Posts_Grid') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;


class Greenmart_Elementor_Posts_Grid extends Greenmart_Elementor_Carousel_Base {

    public function get_name() {
        return 'tbay-posts-grid';
    }

    public function get_title() {
        return esc_html__( 'Greenmart Posts Grid', 'greenmart' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_keywords() {
        return [ 'post-grid', 'blog', 'post' ];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['slick', 'greenmart-custom-slick'];
    }

    protected function register_controls() {
        $this->register_controls_heading();

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'greenmart' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of posts', 'greenmart'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number of posts to show ( -1 = all )', 'greenmart' ),
                'default' => 6,
                'min'  => -1
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'greenmart'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'carousel',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'greenmart'), 
                    'carousel'  => esc_html__('Carousel', 'greenmart'), 
                ],
            ]
        ); 

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => esc_html__('Date', 'greenmart'),
                    'post_title' => esc_html__('Title', 'greenmart'),
                    'menu_order' => esc_html__('Menu Order', 'greenmart'),
                    'rand'       => esc_html__('Random', 'greenmart'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__('ASC', 'greenmart'),
                    'desc' => esc_html__('DESC', 'greenmart'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => esc_html__('Categories', 'greenmart'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_post_categories(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label' => esc_html__('Category Operator', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'IN',
                'options' => [
                    'AND' => esc_html__('AND', 'greenmart'),
                    'IN' => esc_html__('IN', 'greenmart'),
                    'NOT IN' => esc_html__('NOT IN', 'greenmart'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => esc_html__('Style', 'greenmart'),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->get_template_post_type(),
                'default' => 'post-style-1',
                'prefix_class' => 'tbay-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content',
            [
                'label' => esc_html__( 'Content', 'greenmart' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->register_thumbnail_controls();
        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__('Substring Excerpt', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1,
						'max' => 100,
						'step' => 5,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
            ]
        );
        $this->end_controls_section();

        
        $this->register_design_image_controls();
        $this->register_design_content_controls();

        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
    }



    protected function register_thumbnail_controls() {
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'medium', 
                'exclude' => [ 'custom' ],
                'prefix_class' => 'elementor-posts--thumbnail-size-',
            ]
        );

    }
    
    

    public static function get_query_args($settings) {
        $query_args = [
            'post_type'           => 'post',
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish', // Hide drafts/private posts for admins
        ];
        

        if (!empty($settings['categories'])) {
            $categories = array();
            foreach ($settings['categories'] as $category) {
                $cat = get_term_by('slug', $category, 'category');
                if (!is_wp_error($cat) && is_object($cat)) {
                    $categories[] = $cat->term_id;
                }
            }

            if ($settings['cat_operator'] == 'AND') {
                $query_args['category__and'] = $categories;
            } elseif ($settings['cat_operator'] == 'IN') {
                $query_args['category__in'] = $categories;
            } else {
                $query_args['category__not_in'] = $categories;
            }
        }

        $query_args['posts_per_page'] = $settings['limit'];

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }


    protected function get_post_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'category',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    protected function register_design_image_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__( 'Image', 'greenmart' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .entry-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs( 'thumbnail_effects_tabs' );

        $this->start_controls_tab( 'normal',
            [
                'label' => esc_html__( 'Normal', 'greenmart' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'thumbnail_filters',
                'selector' => '{{WRAPPER}} .entry-thumb img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'greenmart' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'thumbnail_hover_filters',
                'selector' => '{{WRAPPER}} .entry-thumb:hover .entry-thumb img',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function register_design_content_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'greenmart' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'padding_content',
            [
                'label' => esc_html__( 'Padding', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => '0',
                    'right' => '23',
                    'bottom' => '20',
                    'left' => '23',
                    'unit' => 'px',
                ],
                'condition' => [
                    'style' => 'post-style-1',
                ],
                'selectors' => [
                    '{{WRAPPER}} .entry-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'title_tabs' );

        $this->start_controls_tab( 
            'title_normal',
            [
                'label' => esc_html__( 'Normal', 'greenmart' ),
            ]
        );

        $this->add_control(
            'heading_title_style',
            [
                'label' => esc_html__( 'Title', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg',
            [
                'label' => esc_html__( 'Background', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid .entry-title' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .entry-title a',
            ]
        );
        $this->add_control(
            'padding_title',
            [
                'label' => esc_html__( 'Padding', 'greenmart' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => '14',
                    'right' => '25',
                    'bottom' => '20',
                    'left' => '25',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'post-style-1',
                ],
            ]
        );
        $this->add_control(
            'heading_author_style',
            [
                'label' => esc_html__( 'Author', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'author_color',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid .author a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .post-grid .author a',
            ]
        );
        $this->add_responsive_control(
            'author_size',
            [
                'label' => esc_html__('Size Image', 'greenmart'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .meta-info .author .avatar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
            
        );
        

        $this->add_control(
            'heading_meta_style',
            [
                'label' => esc_html__( 'Meta', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-info > span, {{WRAPPER}} .meta-info > span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .meta-info > span a,{{WRAPPER}} .post .entry-date',
            ]
        );
        $this->add_control(
            'heading_excerpt_style',
            [
                'label' => esc_html__( 'Excerpt', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .entry-description',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
             'title_hover',
            [
                'label' => esc_html__( 'Hover', 'greenmart' ),
            ]
        );
        $this->add_control(
            'heading_title_style_hover',
            [
                'label' => esc_html__( 'Title', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-title a:hover,{{WRAPPER}} .post-grid:hover .entry-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg_hover',
            [
                'label' => esc_html__( 'Background', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid:hover .entry-title' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_author_style_hover',
            [
                'label' => esc_html__( 'Author', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'author_color_hover',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid .author a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_meta_style_hover',
            [
                'label' => esc_html__( 'Meta', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'meta_color_hover',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .meta-info > span a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_excerpt_style_hover',
            [
                'label' => esc_html__( 'Excerpt', 'greenmart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'excerpt_color_hover',
            [
                'label' => esc_html__( 'Color', 'greenmart' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-description:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    


    private function get_template_post_type() {
        $skin = greenmart_tbay_get_theme(); 
        $folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';
        $folderes = glob(GREENMART_THEMEROOT. '/vc_templates/post/themes/'.$folder_skin.'/*');
 
        $output = array();
       
        foreach ($folderes as $folder) {
            $folder = str_replace("item-", '', str_replace('.php', '', wp_basename($folder)));
            $value = str_replace('_', ' ', str_replace('-', ' ', ucfirst($folder)));
            $output[$folder] = $value;
        }

        return $output;
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Posts_Grid());