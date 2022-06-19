<?php 
/**
 * Templates Name: Elementor
 * Widget: Product Flash Sales
 */

extract( $settings );

$this->settings_layout();

$this->add_render_attribute('wrapper', 'class', [ $this->get_name_template(), $this->deal_end_class(), 'products' ]);
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<div class="top-flash-sale-wrapper">
    	<?php $this->render_element_heading();
		if( isset($end_date) && !empty($end_date) ) {
            greenmart_tbay_countdown_flash_sale($end_date, $date_title, $date_title_ended, true);
        } ?>
	</div> 

    <?php $this->render_content_main(); ?>

</div>