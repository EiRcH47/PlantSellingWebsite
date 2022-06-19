<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Product_Flash_Sales') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

 
class Greenmart_Elementor_Product_Flash_Sales extends Greenmart_Elementor_Carousel_Base {

    public function get_name() {
        return 'tbay-product-flash-sales';
    }

    public function get_title() {
        return esc_html__( 'Greenmart Product Flash Sales', 'greenmart' );
    }

    public function get_categories() {
        return [ 'greenmart-elements', 'woocommerce-elements'];
    }

    public function get_icon() {
        return 'eicon-flash';
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
        return ['slick', 'greenmart-custom-slick', 'jquery-countdowntimer'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'product', 'products', 'Flash Sales', 'Flash' ];
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
        
        

      
        $this->register_control_main();

        $this->end_controls_section(); 

        $this->register_control_viewall();

        $this->add_control_responsive();

        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    private function register_control_main() {
        $prefix = 'main_';
        $this->add_control(
            $prefix .'advanced',
            [
                'label' => esc_html__('Main', 'greenmart'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'date_title',
            [
                'label' => esc_html__('Title Date', 'greenmart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deals end in:', 'greenmart'),
                'label_block' => true,
            ]
        );  

        $this->add_control(
            'date_title_ended',
            [
                'label' => esc_html__('Title deal ended', 'greenmart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deal ended.', 'greenmart'),
                'label_block' => true,
            ]
        );  


        $this->add_control(
            'end_date',
            [
                'label' => esc_html__('End Date', 'greenmart'),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
                'placeholder' => esc_html__( 'Choose the end time', 'greenmart' ),
            ]
        );  

        $this->add_control(
            'bg_top_flash_sale',
            [
                'label' => esc_html__('Background Top Flash Sale', 'greenmart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'greenmart'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'greenmart'), 
                    'carousel'  => esc_html__('Carousel', 'greenmart'), 
                ],
            ]
        ); 

        $this->add_control(
            'product_style',
            [
                'label' => esc_html__('Product Style', 'greenmart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'v1',
                'options' => $this->get_template_product(),
                'prefix_class' => 'elementor-product-',
            ]
        );

        $products = $this->get_available_on_sale_products();
        
        if (!empty($products)) {
            $this->add_control(
                $prefix .'products',
                [
                    'label'        => esc_html__('Products', 'greenmart'),
                    'type'         => Controls_Manager::SELECT2,
                    'options'      => $products,
                    'default'      => array_keys($products)[0],
                    'label_block' => true,
                    'multiple' => true,
                    'save_default' => true,
                    'description' => esc_html( 'Only search for sale products', 'greenmart' ),
                ]
            );
        } else {
            $this->add_control(
                $prefix .'html_products',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('You do not have any discount products. <br>Go to the <strong><a href="%s" target="_blank">Products screen</a></strong> to create one.', 'greenmart'), admin_url('edit.php?post_type=product')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'enable_readmore',
            [
                'label' => esc_html__( 'Enable Button "Read More" ', 'greenmart' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'padding_wrapper_heading',
            [ 
                'label' => esc_html__( 'Spacing Heading', 'greenmart' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    }

    protected function register_control_viewall() {
        $this->start_controls_section(
            'section_readmore',
            [
                'label' => esc_html__( 'Read More Options', 'greenmart' ),
                'type'  => Controls_Manager::SECTION,
                'condition' => [
                    'enable_readmore' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'readmore_text',
            [
                'label' => esc_html__('Button "Read More" Custom Text', 'greenmart'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'greenmart'),
                'label_block' => true,
            ]
        );  

        $pages = $this->get_available_pages();

        if (!empty($pages)) {
            $this->add_control(
                'readmore_page',
                [
                    'label'        => esc_html__('Page', 'greenmart'),
                    'type'         => Controls_Manager::SELECT2,
                    'options'      => $pages,
                    'default'      => array_keys($pages)[0],
                    'label_block' => true,
                    'save_default' => true,
                    'separator'    => 'after',
                ]
            );
        } else {
            $this->add_control(
                'readmore_page',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no pages in your site.</strong><br>Go to the <a href="%s" target="_blank">pages screen</a> to create one.', 'greenmart'), admin_url('edit.php?post_type=page')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->end_controls_section();
    }

    

    protected function render_btn_readmore() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !empty($readmore_page) ) {
            $link = get_permalink($readmore_page);
        }

        if( $enable_readmore && !empty($link) ) : ?>
            <a class="show-all" href="<?php echo esc_url($link); ?>" title="<?php esc_attr( $readmore_text ); ?>"><?php echo trim($readmore_text); ?></a>
        <?php endif;
    }


    public function render_content_main() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        

        $prefix = 'main_';

        $ids = ${$prefix.'products'};


        if( count($ids) === 0 ) {
            echo '<div class="not-product-flash-sales">'. esc_html__('Please select the show product', 'greenmart')  .'</div>';
            return;
        }

        $args = array(
            'post_type'            => 'product',
            'ignore_sticky_posts'  => 1,
            'no_found_rows'        => 1,
            'posts_per_page'       => -1,
            'orderby'              => 'post__in',
            'post__in'             => $ids,
        );

        if (version_compare(WC()->version, '2.7.0', '<')) {
            $args[ 'meta_query' ]   = isset($args[ 'meta_query' ]) ? $args[ 'meta_query' ] : array();
            $args[ 'meta_query' ][] = WC()->query->visibility_meta_query();
        } elseif (taxonomy_exists('product_visibility')) {
            $product_visibility_term_ids = wc_get_product_visibility_term_ids();
            $args[ 'tax_query' ]         = isset($args[ 'tax_query' ]) ? $args[ 'tax_query' ] : array();
            $args[ 'tax_query' ][]       = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => is_search() ? $product_visibility_term_ids[ 'exclude-from-search' ] : $product_visibility_term_ids[ 'exclude-from-catalog' ],
                'operator' => 'NOT IN',
            );
        }

        $loop = new WP_Query($args); 

        $end_date     = strtotime($end_date);
        if( !$loop->have_posts() ) return;

        $attr_row = $this->get_render_attribute_string('row');

        wc_get_template( 'layout-products/themes/fresh-el/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'flash_sales' => true, 'end_date' => $end_date, 'attr_row' => $attr_row) );
        
        $this->render_btn_readmore(); 
    }
    public function deal_end_class() {
        $settings = $this->get_settings_for_display();
        extract($settings);


        $class_deal_ended   = '';
        $end_date           = strtotime($end_date);
        $today              = strtotime("today");
        if ( !empty($end_date) &&  ($today > $end_date) ) {
            $class_deal_ended = 'deal-ended';
        }

        return $class_deal_ended;
    }

}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Product_Flash_Sales());