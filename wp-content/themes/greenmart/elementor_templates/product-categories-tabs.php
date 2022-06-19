<?php 
/**
 * Templates Name: Elementor
 * Widget: Product Categories Tabs
 */

extract( $settings );

$random_id = greenmart_tbay_random_key();

$this->settings_layout();

if( $ajax_tabs === 'yes' ) {
    $this->add_render_attribute('wrapper', 'class', ['tbay-product-categories-tabs-ajax', 'ajax-active']); 
}
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    <?php 
        $this->render_element_heading(); 
        if( !empty($categories_tabs) ) {
            $this->render_tabs_title($categories_tabs, $random_id);
            $this->render_product_tabs_content($categories_tabs, $random_id);
            $this->render_item_button();
        }
        
    ?>
</div>