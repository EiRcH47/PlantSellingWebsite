<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Product_Categories_Tabs') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Greenmart_Elementor_Product_Categories_Tabs extends  Greenmart_Elementor_Carousel_Base{
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
        return 'tbay-product-categories-tabs';
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
        return esc_html__( 'Greenmart Product Categories Tabs', 'greenmart' );
    }
    public function get_categories() {
        return [ 'greenmart-elements', 'woocommerce-elements'];
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
        return 'eicon-product-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function get_script_depends()
    {
        return ['slick', 'greenmart-custom-slick'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'product-categories' ];
    }

    protected function register_controls() {
        $this->register_controls_heading();
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'Product Categories', 'greenmart' ),
            ]
        );        

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of products', 'greenmart'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number of products to show ( -1 = all )', 'greenmart' ),
                'default' => 6,
                'min'  => -1,
            ]
        );

        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->register_woocommerce_order();
        $this->add_control(
            'product_type',
            [   
                'label'   => esc_html__('Product Type','greenmart'),
                'type'     => Controls_Manager::SELECT,
                'options' => $this->get_product_type(),
                'default' => 'newest'
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
            'ajax_tabs',
            [
                'label' => esc_html__( 'Ajax Categories Tabs', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => esc_html__( 'Show/hidden Ajax Categories Tabs', 'greenmart' ), 
            ]
        );

        $repeater = $this->register_category_repeater();
        $this->add_control(
            'categories_tabs',
            [
                'label' => esc_html__( 'Categories Items', 'greenmart' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'categories_field' => '{{{ categories }}}',
            ]
        );   

        $this->add_control(
            'product_style',
            [
                'label' => __('Product Style', 'greenmart'),
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
        $this->register_style_heading();
    }

    private function register_category_repeater() {
        $repeater = new \Elementor\Repeater();
        $categories = $this->get_product_categories();

        $repeater->add_control (
            'category', 
            [
                'label' => esc_html__( 'Select Category', 'greenmart' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => array_keys($categories)[0],
                'label_block' => true,
                'options'   => $categories,   
            ] 
        );
        
        $repeater->add_control (
            'icon_category',
            [
                'label'              => esc_html__('Icon', 'greenmart'),
                'type'               => Controls_Manager::ICONS,
            ]
        );
        return $repeater;
    }

    protected function register_style_heading() {
        $this->start_controls_section(
            'section_style_heading_categories_tab',
            [
                'label' => esc_html__('Heading Product Categories Tabs', 'greenmart'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'heading_categories_tab_align',
            [
                'label' => esc_html__('Alignment', 'greenmart'),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .heading-product-category-tabs .tabs-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
     

        $this->add_control(
            'heading_categories_tab_background',
            [
                'label'     => esc_html__('Background', 'greenmart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading-product-category-tabs'    => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_categories_tab_padding',
            [
                'label'      => esc_html__( 'Padding', 'greenmart' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .heading-product-category-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

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
   

    public function get_template_product() {
        return apply_filters( 'greenmart_get_template_product', 'v1' );
    }

    public function render_tabs_title($categories_tabs, $random_id) {
        $settings = $this->get_settings_for_display();
        $cat_operator = $product_type = $limit = $orderby = $order = '';
        extract($settings);

        if ($ajax_tabs === 'yes') {
            $this->add_render_attribute('row', 'class', ['products']);
            $attr_row = $this->get_render_attribute_string('row'); 

            $json = array(
                'product_type'                  => $product_type,
                'cat_operator'                  => $cat_operator,
                'limit'                         => $limit,
                'orderby'                       => $orderby,
                'order'                         => $order,
                'product_style'                 => $product_style,
                'attr_row'                      => $attr_row, 
            ); 

            $encoded_settings  = wp_json_encode( $json );

            $tabs_data = 'data-atts="'. esc_attr( $encoded_settings ) .'"';
        } else {
            $tabs_data = '';
        }
        ?>
            <div class="heading-product-category-tabs">
            <?php
                if(!empty($title_cat_tab) || !empty($sub_title_cat_tab) ) {
                    ?>
                    <h3 class="heading-tbay-title">
                        <?php if( !empty($title_cat_tab) ) : ?>
                            <span class="title"><?php echo trim($title_cat_tab); ?></span>
                        <?php endif; ?>	    	
                        <?php if( !empty($sub_title_cat_tab) ) : ?>
                            <span class="subtitle"><?php echo trim($sub_title_cat_tab); ?></span>
                        <?php endif; ?>
                    </h3>
                    <?php
                }
            ?>

            <ul class="product-categories-tabs-title tabs-list nav nav-tabs" <?php echo trim($tabs_data); ?>>
                <?php $_count = 0; ?>
                
                <?php foreach ( $categories_tabs as $item ) : ?>
                    
                    <?php $this->render_product_tab($item['category'], $item['_id'], $_count,$item['icon_category'], $random_id); ?>
                    <?php $_count++; ?>
                <?php endforeach; ?>
                
            </ul>
            
        </div>
        <?php
    }
    
    public function render_product_tab($item, $_id, $_count, $icon, $random_id) {
        ?>
        <?php 
            $active = ($_count == 0) ? 'active' : '';
            $category = get_term_by( 'slug', $item, 'product_cat' );
            $title = $category->name;
        ?>
        <li >
            <a class="<?php echo esc_attr( $active ); ?>" data-value="<?php echo esc_attr($item); ?>" href="#<?php echo esc_attr($item.'-'. $random_id .'-'.$_id); ?>" data-toggle="tab" aria-controls="<?php echo esc_attr($item.'-'. $random_id .'-'.$_id); ?>">
            <?php $this->render_item_icon($icon); echo trim($title);?></a>
        </li>

       <?php
    }
    public function render_product_tabs_content($categories_tabs, $random_id) {
        $settings = $this->get_settings_for_display();
        ?>
            <div class="content-product-category-tab">
                <div class="tbay-addon-content tab-content woocommerce">
                <?php 
                $_count = 0;
                foreach ($categories_tabs as $key ) {
                    $tab_active = ($_count == 0) ? ' active show active-content current' : '';
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($tab_active); ?>" id="<?php echo esc_attr($key['category'].'-'. $random_id .'-'.$key['_id']); ?>"> 
                    <?php
                        if( $_count === 0 || $settings['ajax_tabs'] !== 'yes' ) {
                            $this->render_content_tab($key['category']);
                        }
                        $_count++; 
                    ?>
                    </div>
                <?php } ?> 
                </div>
            </div>
        <?php
    } 

    private function  render_content_tab( $key ) {
        $settings = $this->get_settings_for_display();
        $cat_operator = $product_type = $limit = $orderby = $order = '';
        extract( $settings );
        $skin = greenmart_tbay_get_theme(); 
        $folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';
        
        /** Get Query Products */
        $loop = greenmart_get_query_products($key,  $cat_operator, $product_type, $limit, $orderby, $order);

        if( $layout_type === 'carousel' ) $this->add_render_attribute('row', 'class', ['rows-'.$rows]);
        $this->add_render_attribute('row', 'class', ['products']);

        $attr_row = $this->get_render_attribute_string('row');
        
        wc_get_template( 'layout-products/themes/'.$folder_skin.'/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) );
    }
    
    public function render_item_button() {
        $settings = $this->get_settings_for_display();
        extract( $settings );
        $url_category =  get_permalink(wc_get_page_id('shop'));
        if(isset($text_button) && !empty($text_button)) {?>
            <div class="readmore-wrapper"><a href="<?php echo esc_url($url_category)?>" class="btn show-all"><?php echo trim($text_button) ?>
                <?php 
                    $this->render_item_icon($icon_button);
                ?>
            </a></div>
            <?php
        }
        
    }

}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Product_Categories_Tabs());
