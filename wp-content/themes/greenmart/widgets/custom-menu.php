<?php
extract( $args );
extract( $instance );

$output = '';

if ($nav_menu) {
	$term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
}

$el_class = ' treeview-menu';

$output = '<div class="tbay_custom_menu wpb_content_element' . esc_attr( $el_class ) . '">';
$output .= '<div class="widget">';

if( isset($title) && !empty($title) ) {
	$output .= '<h2 class="widgettitle">'. esc_html($title) .'</h2>';
}
      
$output .= '<nav class="tbay_custom_menu-nav">';

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( !empty($term) ) {

	$_id = greenmart_tbay_random_key();

    $args = array(
        'menu' 			  => $nav_menu,
        'container_class' => 'menu-category-menu-container',
        'menu_class'      => 'menu', 
        'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'echo'			  => false,   
        'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $nav_menu .'" data-format="no-builder">%3$s</ul>',
        'menu_id' => $nav_menu.'-'.$_id,
    );

    if( class_exists("Greenmart_Tbay_Custom_Nav_Menu") ){

        $args['walker'] = new Greenmart_Tbay_Custom_Nav_Menu();
    }

	$output .= wp_nav_menu($args);

    $output .= '</nav>';
	$output .= '</div>';
	$output .= '</div>';

    echo trim($output);

} else {
    $output .= '</nav>';
	$output .= '</div>';
	$output .= '</div>';

    echo esc_html__( 'Not found in custom menu', 'greenmart' );
}

