<?php 
/**
 * Templates Name: Elementor
 * Widget: Testimonials
 */
extract($settings);
if( empty($testimonials) || !is_array($testimonials) ) return;

$this->add_render_attribute('item', 'class', 'item');

$this->settings_layout();
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>

    <?php $this->render_element_heading(); ?>
    <div <?php echo trim($this->get_render_attribute_string('row')) ?>>
        <?php foreach ( $testimonials as $item ) : ?>
        
            <div <?php echo trim($this->get_render_attribute_string('item')); ?>>
                <?php $this->render_item( $item,$settings ); ?>
            </div>

        <?php endforeach; ?>
    </div>
</div>