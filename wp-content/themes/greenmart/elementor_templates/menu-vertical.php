<?php 
/**
 * Templates Name: Elementor
 * Widget: List Nav
 */

$available_menus = $this->get_available_menus();
if (!$available_menus) {
	return;
}


$settings = $this->get_active_settings();

extract( $settings );

?>
<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php $this->render_element_heading(); ?>
	<?php

	$_id = greenmart_tbay_random_key();

    $args = array(
        'menu' 			  => $menu,
        'container_class' => 'menu-vertical-container',
        'menu_class' => 'menu-vertical nav',
        'fallback_cb' => '',
		'before'          => '',
		'after'           => '',
		'echo'			  => false,
        'menu_id' => $menu.'-'.$_id,
    );

     echo trim(wp_nav_menu($args));
	?>

</div>