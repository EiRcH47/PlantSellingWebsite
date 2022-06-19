<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Greenmart_Elementor_Home_Banner') ) {
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
class Greenmart_Elementor_Home_Banner extends  Greenmart_Elementor_Carousel_Base{
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
        return 'tbay-home-banner';
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
        return esc_html__( 'Greenmart Home Banner', 'greenmart' );
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
        return 'eicon-meta-data';
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

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'greenmart' ),
            ]
        );
 
       
        $this->add_control(
            'image_left',
            [
                'label' => esc_html__('Image Left','greenmart'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'image_right',
            [
                'label' => esc_html__('Image Right','greenmart'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        

        

        $this->end_controls_section();


    }

    protected function render_item($settings) {
        extract($settings);
        $image_id_left = $image_left['id'];
        $image_id_right = $image_right['id'];
        if( isset($image_id_left) && !empty($image_id_left) ) {
            ?>
                <div class="position-img-left">
                    <?php echo wp_get_attachment_image($image_id_left, 'full'); ?>
                </div>
            <?php
        }
        if( isset($image_id_right) && !empty($image_id_right) ) {
            ?>
                <div class="position-img-right">
                    <?php echo wp_get_attachment_image($image_id_right, 'full'); ?>
                </div>
            <?php
        }
        
    }      


}
$widgets_manager->register_widget_type(new Greenmart_Elementor_Home_Banner());
