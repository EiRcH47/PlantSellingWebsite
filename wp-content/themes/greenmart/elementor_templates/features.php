<?php 
/**
 * Templates Name: Elementor
 * Widget: Feautures
 */
extract($settings);
if( empty($features) || !is_array($features) ) return;

$this->add_render_attribute('row', 'class', $this->get_name_template());
$this->add_render_attribute('item', 'class', 'item');

$this->settings_responsive($settings);

?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    <div <?php echo trim($this->get_render_attribute_string('row')) ?>>
        <?php foreach ( $features as $item ) : ?>

            <div <?php echo trim($this->get_render_attribute_string('item')); ?>>

                <?php $this->render_item($item); ?>
                
            </div>

        <?php endforeach; ?>
    </div>
</div>