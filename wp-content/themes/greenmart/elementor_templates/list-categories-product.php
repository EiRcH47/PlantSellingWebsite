<?php 
/**
 * Templates Name: Elementor
 * Widget: Products Category
 */
$layout_type = $settings['layout_type'];
$this->settings_layout();
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php $this->render_element_heading(); ?>
    <div <?php echo trim($this->get_render_attribute_string('row')); ?> > 
        <?php $this->render_list_category(); ?>
    </div>
    <?php $this->render_item_button() ?>
</div>