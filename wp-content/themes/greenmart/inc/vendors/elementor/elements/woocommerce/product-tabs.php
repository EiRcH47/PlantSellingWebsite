<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Product_Tabs') ) {
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
class Greenmart_Elementor_Product_Tabs extends  Greenmart_Elementor_Carousel_Base{
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
        return 'tbay-product-tabs';
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
        return esc_html__( 'Greenmart Product Tabs', 'greenmart' );
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
        return 'eicon-tabs';
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
        return [ 'woocommerce-elements', 'product', 'products', 'tabs' ];
    }

    protected function register_controls() {
        $this->register_controls_heading();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'Product Tabs', 'greenmart' ),
            ]
        );
        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of products ( -1 = all )', 'greenmart'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min'  => -1
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout', 'greenmart'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'greenmart'), 
                    'carousel'  => esc_html__('Carousel', 'greenmart'), 
                ],
            ]
        ); 
        $this->register_woocommerce_categories_operator();

        $this->add_control(
            'ajax_tabs',
            [
                'label' => esc_html__( 'Ajax Product Tabs', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => esc_html__( 'Show/hidden Ajax Product Tabs', 'greenmart' ), 
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
        $this->register_controls_product_tabs();
        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => $this->get_woo_order_by(),
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'asc',
                'options' => $this->get_woo_order(),
            ]
        );
        
        $this->end_controls_section();
        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
        $this->register_style_heading();
    }

    public function register_controls_product_tabs() {
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'product_tabs_title',
            [
                'label' => esc_html__( 'Title', 'greenmart' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'product_tabs',
            [
                'label' => esc_html__('Show Tabs', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_product_type(),
                'default' => 'newest',
            ]
        );  
        $this->add_control(
            'list_product_tabs',
            [
                'label' => esc_html__('Tab Item','greenmart'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ product_tabs_title }}}',
            ]
        );
        
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tbay-element-product-tabs > ul' => 'justify-content: {{VALUE}};',
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
                    '{{WRAPPER}} .tbay-element-product-tabs > ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

    }
    public function get_template_product() {
        return apply_filters( 'greenmart_get_template_product', 'v1' );
    }

    public function render_product_tabs($product_tabs, $key_id, $random_id, $title, $active)
    {
       ?>
            <li>
                <a href="#<?php echo esc_attr($product_tabs.'-'.$random_id .'-'.$key_id); ?>" data-value="<?php echo esc_attr($product_tabs); ?>" class="<?php echo esc_attr( $active ); ?>" data-toggle="tab" data-title="<?php echo esc_attr($title);?>" ><?php echo trim($title)?></a>
            </li>

       <?php

    }
    public function  render_content_tab( $product_tabs ) {

        $settings = $this->get_settings_for_display();
        $skin = greenmart_tbay_get_theme(); 
        $folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';
        extract( $settings );
        
        $this->add_render_attribute('row', 'class', $this->get_name_template());

        if( isset($rows) && !empty($rows) ) {
            $this->add_render_attribute( 'row', 'class', 'row-'. $rows);
        }

        $product_type = $product_tabs;

        /** Get Query Products */
        $loop = greenmart_get_query_products($categories,  $cat_operator, $product_type, $limit, $orderby, $order);
        
        if( $layout_type === 'carousel' ) $this->add_render_attribute('row', 'class', ['rows-'.$rows]);
        $this->add_render_attribute('row', 'class', ['products']);

        $attr_row = $this->get_render_attribute_string('row');
        
        wc_get_template( 'layout-products/themes/'.$folder_skin.'/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); 
    }

    public function render_product_tabs_content($list_product_tabs, $random_id)
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        ?>
        <div class="tbay-addon-content tab-content woocommerce">
            <?php $_count = 0;?>
            <?php foreach ($list_product_tabs as $index => $key) {
                    $tab_active = ($_count==0)? 'active active-content current':'';
                    $product_tabs = $key['product_tabs'];
                    ?>
                    <div class="tab-pane animated fadeIn <?php echo esc_attr($tab_active); ?>" id="<?php echo esc_attr($product_tabs.'-'.$random_id .'-'.$key['_id']); ?>">
                        <?php
                        if( $_count === 0 || $settings['ajax_tabs'] !== 'yes' ) {
                            $this->render_content_tab($product_tabs);
                        }
                        $_count++;
                        ?>
                    </div>
                    <?php
                }
            ?> 
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Product_Tabs());
