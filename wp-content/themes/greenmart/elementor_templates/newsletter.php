<?php 
/**
 * Templates Name: Elementor
 * Widget: Newsletter
 */
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php
        if (function_exists('mc4wp_show_form')) {
        	try {
                $form = mc4wp_get_form();
                echo do_shortcode('[mc4wp_form id="'. $form->ID .'"]');
            } catch (Exception $e) {
                esc_html_e('Please create a newsletter form from Mailchip plugins', 'greenmart');
            }
        }
    ?>
</div>