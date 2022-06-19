<?php 
/**
 * Templates Name: Elementor
 * Widget: Greenmart List Tags
 */
extract( $settings );

$this->add_render_attribute('item', 'class', 'item');


$tags_default = $this->get_woocommerce_tags();

?>
<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    <?php $this->render_element_heading(); ?>
    
    <?php if( is_array($tags_default) && count($tags_default) !== 0 ) : ?>

        <div <?php echo trim($this->get_render_attribute_string('row')) ?>>
                <?php foreach ( $tags as $item ) : ?>
                    
                    <div <?php echo trim($this->get_render_attribute_string('item')); ?>>
                        
                        <?php $this->render_item( $item); ?>

                    </div>

                <?php endforeach; ?>
        </div>
    <?php else: ?>

        <?php echo '<div class="error-tags">'. esc_html__('Please go to the product save to get the tag.', 'greenmart') .'</div>'; ?>

    <?php endif; ?>


</div>