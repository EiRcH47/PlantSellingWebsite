<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Products_Width_Banner') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;


class Greenmart_Elementor_Products_Width_Banner extends Greenmart_Elementor_Carousel_Base {

    public function get_name() {
        return 'tbay-products-width-banner';
    } 

    public function get_title() {
        return esc_html__( 'Greenmart Products Width Banner', 'greenmart' );
    }

    public function get_categories() {
        return [ 'greenmart-elements', 'woocommerce-elements'];
    }

    public function get_icon() {
        return 'eicon-products';
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
    public function get_script_depends()
    {
        return ['slick', 'greenmart-custom-slick'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'product', 'products' ];
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
                'label' => esc_html__('Number of products', 'greenmart'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number of products to show ( -1 = all )', 'greenmart' ),
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
            'banner_heading',
            [
                'label' => esc_html__('Banner', 'greenmart'),
                'separator'    => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'banner_product',
            [
                'label' => esc_html__('Banner Product','greenmart'),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'banner_product_width',
            [
                'label' => esc_html__('Width Banner Product','greenmart'),
                'type'  => Controls_Manager::SLIDER,
                'condition' => [
                    'layout_type' => 'carousel'
                ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ]
                ],
                'default' => [
					'unit' => '%',
					'size' => 20,  
				],
                'size_units' => [ 'px' ,'%'],
                'selectors' => [
                    '{{WRAPPER}} .image-products' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .image-products + div.products-width-banner' => 'width: calc(100% - {{SIZE}}{{UNIT}});', 
                ], 
                
            ]
        );

        $this->add_control(
            'enable_banner_link',
            [
                'label' => esc_html__('Enable custom banner link', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );
        
        $this->add_control(
            'banner_link',
            [
                'label' => esc_html__('Custom Banner Link','greenmart'),
                'type' => Controls_Manager::URL,
                'condition' => [
                    'enable_banner_link' => 'yes'
                ],
                'separator'    => 'after',
                'placeholder' => esc_html__( 'https://your-link.com', 'greenmart' ),
            ]
        );


       $this->register_woocommerce_order();

       $this->register_woocommerce_categories_operator();

        $this->add_control(
            'product_type',
            [
                'label' => esc_html__('Product Type', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => $this->get_product_type(),
            ]
        );

        $this->add_control(
            'product_style',
            [
                'label' => esc_html__('Product Style', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'v1',
                'options' => $this->get_template_product(),
                'prefix_class' => 'elementor-product-'
            ]
        );
        $this->add_control(
            'hidden_text_cart',
            [
                'label' => esc_html__('Hidden Text Cart', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [
                    'product_style!' => 'v2'
                ],
                'prefix_class' => 'hidden-text-cart-'
            ]
        );
        $this->add_control(
            'hidden_desc',
            [
                'label' => esc_html__('Hidden Description', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [
                    'product_style' => 'v3'
                ],
                'prefix_class' => 'hidden-desc-'
            ]
        );
        
        $this->register_button();

        $this->end_controls_section();

        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
    }
    protected function register_button() {
        $this->add_control(
            'show_more',
            [
                'label'     => esc_html__('Display Show More', 'greenmart'),
                'type'      => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );  
        $this->add_control(
            'text_button',
            [
                'label'     => esc_html__('Text Button', 'greenmart'),
                'type'      => Controls_Manager::TEXT,
                'default' => esc_html__('Show More', 'greenmart'),
                'condition' => [
                    'show_more' => 'yes'
                ]
            ]
        );  
        $this->add_control(
            'icon_button',
            [
                'label'     => esc_html__('Icon Button', 'greenmart'),
                'type'      => Controls_Manager::ICONS,
                'condition' => [
                    'show_more' => 'yes'
                ]
            ]
        );  
        $this->add_responsive_control(
            'button_show_align',
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
                'condition' => [
                    'show_more' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .readmore-wrapper' => 'text-align: {{VALUE}}',
                ]
            ]
        );

    }
    public function render_item_button() {
        $settings = $this->get_settings_for_display();
        extract( $settings );

        $url_category =  get_permalink(wc_get_page_id('shop'));
        if(isset($text_button) && !empty($text_button)) {?>
            <div>
                <a href="<?php echo esc_url($url_category)?>" class="show-all"><?php echo trim($text_button) ?>
                    <?php 
                        $this->render_item_icon($icon_button);
                    ?>
                    
                </a>
            </div>
            <?php
        }
        
    }

    public function get_url_banner() {
        $settings = $this->get_settings_for_display();

        if( $settings['enable_banner_link'] === 'yes' ) {
            $url = $this->get_custom_url_banner();
        } else {
            $url = $this->get_default_url_banner();
        }

        return $url;
    }

    public function get_default_url_banner() {
        $settings = $this->get_settings_for_display();

        if( is_countable($settings['categories']) && count($settings['categories']) === 1 ) {
            $category       = get_term_by( 'slug', $settings['categories'][0], 'product_cat' );
            $url            = get_term_link( $category->term_id, 'product_cat' );
        } else {
            $url            = get_permalink( wc_get_page_id( 'shop' ) );
        }

        return $url;
    }

    public function get_custom_url_banner() {
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['banner_link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['banner_link'] );

            $url = $this->get_render_attribute_string( 'url' );
		}

        return $url;
    }

    public function render_item_image($settings) {
        $image_id           = $settings['banner_product']['id'];
        $url                = $this->get_url_banner();

        if(empty($image_id)) {
            return;
        }
        ?>
            <div class="image-products">
                <?php 
                    if( $settings['enable_banner_link'] === 'yes' ) {
                        echo ( !empty($url) ) ? '<a '. $url .'>' : ''; 
                    } else {
                        echo ( !empty($url) ) ? '<a href="'. esc_url($url) .'">' : ''; 
                    }
                ?>
                <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                <?php echo ( !empty($url) ) ? '</a>' : ''; ?>
            </div>
        <?php
        
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Products_Width_Banner());