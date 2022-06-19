<?php 
/**
 * Templates Name: Elementor
 * Widget: Heading
 */

extract($settings);

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php $this->render_element_heading(); ?>
</div>