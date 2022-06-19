<?php 
/**
 * Templates Name: Elementor
 * Widget: Product Flash Sales
 */

extract( $settings );

$this->settings_layout();

$this->add_render_attribute('wrapper', 'class', [ $this->get_name_template() ]);
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<div class="countdown-wrapper">
    	<?php $this->render_element_heading(); ?>
	</div>

    <?php $this->render_content_main(); ?>

</div>