<?php 
/**
 * Templates Name: Elementor
 * Widget: Products
 */

extract( $settings );

if( isset($limit) && !((bool) $limit) ) return;

$this->settings_layout();

/** Get Query Products */
$loop = greenmart_get_query_products($categories,  $cat_operator, $product_type, $limit, $orderby, $order);

$skin = greenmart_tbay_get_theme(); 
$folder_skin = ($skin === 'fresh-el') ? 'fresh-el' : 'organic-el';

if( $layout_type === 'carousel' ) $this->add_render_attribute('row', 'class', ['rows-'.$rows]);
$this->add_render_attribute('row', 'class', ['products']);

$attr_row = $this->get_render_attribute_string('row');

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>

    <?php wc_get_template( 'layout-products/themes/'.$folder_skin.'/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'attr_row' => $attr_row) ); ?>
    <?php $this->render_item_button(); ?>
</div>