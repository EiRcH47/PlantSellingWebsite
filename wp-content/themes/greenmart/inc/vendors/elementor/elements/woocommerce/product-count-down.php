<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Product_Count_Down') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

 
class Greenmart_Elementor_Product_Count_Down extends Greenmart_Elementor_Carousel_Base {

    public function get_name() {
        return 'tbay-product-count-down';
    }

    public function get_title() {
        return esc_html__( 'Greenmart Product Count Down', 'greenmart' );
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
        return [ 'woocommerce-elements', 'product', 'products', 'Count Down' ];
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


        $this->add_control_responsive();

        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    

    private function register_control_main() {
        $prefix = 'main_';
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
            'hidden_text_cart',
            [
                'label' => esc_html__('Hidden Text Cart', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                
                'prefix_class' => 'hidden-text-cart-'
            ]
        );
        $this->add_control(
            'hidden_desc',
            [
                'label' => esc_html__('Hidden Description', 'greenmart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                
                'prefix_class' => 'hidden-desc-'
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
                    'description' => esc_html__( 'Only search for sale products', 'greenmart' ),
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

    }


    public function render_content_main() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        $skin = greenmart_tbay_get_theme(); 
        $folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';

        $prefix = 'main_';

        $ids = ${$prefix.'products'};


        if( count($ids) === 0 ) {
            echo '<div class="not-product-count-down">'. esc_html__('Please select the show product', 'greenmart')  .'</div>';
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

        if( !$loop->have_posts() ) return;

        if( $layout_type === 'carousel' ) $this->add_render_attribute('row', 'class', ['rows-'.$rows]);
        $this->add_render_attribute('row', 'class', ['products']);

        $attr_row = $this->get_render_attribute_string('row');
        
        wc_get_template( 'layout-products/themes/'.$folder_skin.'/layout-products.php' , array( 'loop' => $loop, 'product_style' => 'v1', 'flash_sales' => true, 'attr_row' => $attr_row) );
        
    }
    

} 
$widgets_manager->register_widget_type(new Greenmart_Elementor_Product_Count_Down());