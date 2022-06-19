<?php
$type = $title = $nav_menu = $el_class = $select_menu = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ($nav_menu) {
	$term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
}



$el_class = $this->getExtraClass( $el_class );

if(isset($select_menu) ) {
	$el_class .= ' '.$select_menu.'-menu';
}

$output = '<div class="tbay_custom_menu wpb_content_element' . esc_attr( $el_class ) . '">';
$output .= '<div class="widget widget_nav_menu">';

if( isset($title) && !empty($title) ) {
	$output .= '<h2 class="widgettitle">'. esc_html($title) .'</h2>';
}

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( !empty($term) ) {

	$_id = greenmart_tbay_random_key();

    $args = array(
        'menu' 			    => $nav_menu,
        'container_class'   => 'nav menu-category-menu-container',
        'menu_class'        => 'menu', 
        'fallback_cb'       => '',
		'before'            => '',
		'after'             => '',
		'echo'			    => false,
        'items_wrap'        => '<ul id="%1$s" class="%2$s" data-id="'. $nav_menu .'">%3$s</ul>',
        'menu_id'           => $nav_menu.'-'.$_id,
    );

    if( class_exists("Greenmart_Tbay_Custom_Nav_Menu") ){

        $args['walker'] = new Greenmart_Tbay_Custom_Nav_Menu();
    }

	$output .= '<nav class="menu">'. wp_nav_menu($args). '</nav>';

	$output .= '</div>';
	$output .= '</div>';

     echo trim($output);

} else {
	echo trim($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : tbay_custom_menu' ));
}

