<?php 
/**
 * Templates Name: Elementor
 * Widget: Product Recently Viewed
 */

extract( $settings );

if( isset($limit) && !((bool) $limit) ) return;

$this->add_render_attribute( 
	'wrapper',
	[
		'data-wrapper' => wp_json_encode( [
			'layout' => $position_displayed
		] ),
	]
);

if( $position_displayed === 'header' ) {
	$this->add_render_attribute( 
		'wrapper',
		[ 
			'data-column' => $header_column
		]
	);
}

$this->settings_layout();

$this->add_render_attribute('wrapper', 'class', $this->get_name_template() .'-'. $position_displayed);
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>

    <?php $this->render_content_header(); ?>    
    
	<?php $this->render_content_main(); ?>    

</div>