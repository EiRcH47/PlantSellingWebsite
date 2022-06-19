<?php 
/**
 * Templates Name: Elementor
 * Widget: Products
 */

extract( $settings );

if( isset($limit) && !((bool) $limit) ) return;

$banner_id = $settings['banner_product']['id'];
$layout_product = $settings['layout_type'];
$this->settings_layout();

/** Get Query Products */
$loop = greenmart_get_query_products($categories,  $cat_operator, $product_type, $limit, $orderby, $order);

if( $layout_type === 'carousel' ) $this->add_render_attribute('row', 'class', ['rows-'.$rows]);
$this->add_render_attribute('row', 'class', ['products']);

$attr_row = $this->get_render_attribute_string('row');
$skin = greenmart_tbay_get_theme(); 
$folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
 
    <?php $this->render_element_heading(); ?>
    <?php
        if($layout_product === 'carousel') {
            $this->render_item_image($settings);
        }
    ?>
    <?php wc_get_template( 'layout-products/themes/'.$folder_skin.'/layout-products.php' , array( 'banner_id' => $banner_id, 'banner_url' => $this->get_url_banner(), 'enable_banner_link' => $enable_banner_link, 'layout_product' => $layout_product ,'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>
    <?php $this->render_item_button(); ?>
</div> 