<?php

$title_position = $title_bg = $nav_type = $pagi_type = $loop_type = $auto_type = $autospeed_type = $disable_mobile = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';
if( isset($title_position) && $title_position == 'left' ) {
    $el_class .= ' title-left';

    $el_class .= (isset($title_bg) && $title_bg == 'yes') ? ' title-bg' : '';
}


$active_theme = greenmart_tbay_get_part_theme();

$taxonomy     = 'product_cat';
$orderby      = 'name';  
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 0;

$args = array(
     'taxonomy'     => $taxonomy,
     'orderby'      => $orderby,
     'number'       => $number,
     'pad_counts'   => $pad_counts,
     'hierarchical' => $hierarchical,
     'title_li'     => $title,
     'parent'       => 0,
     'hide_empty'   => $empty
);
$all_categories = get_categories( $args );


$_id = greenmart_tbay_random_key();
$_count = 1;

if($responsive_type == 'yes') {
    $screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
    $screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
    $screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
    $screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;
} else {
    $screen_desktop          =      $columns;
    $screen_desktopsmall     =      $columns;
    $screen_tablet           =      $columns; 
    $screen_mobile           =      $columns;  
}

?>
<div class="widget widget-<?php echo esc_attr($layout_type); ?> widget-categories categories <?php echo esc_attr($el_class); ?>">

	<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_html( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>

	<?php if ( $all_categories ) : ?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">

                <?php if( $layout_type == 'carousel' ) : ?>


                    <?php  wc_get_template( 'layout-categories/'. $active_theme .'/'. $layout_type .'.php' , array( 'all_categories' => $all_categories, 'columns' => $columns, 'rows' => $rows,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type, 'loop_type' => $loop_type, 'auto_type' => $auto_type, 'autospeed_type' => $autospeed_type, 'disable_mobile' => $disable_mobile ) ); ?>

                <?php else : ?>

                    <?php

                    $data_responsive = '';
                    if( isset($responsive_type) && $responsive_type === 'yes' ) { 

                        $data_responsive .= ' data-xlgdesktop='. $columns .'';
                        $data_responsive .= ' data-desktop='. $screen_desktop .'';
                        $data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';
                        $data_responsive .= ' data-tablet='. $screen_tablet .'';
                        $data_responsive .= ' data-mobile='. $screen_mobile .'';

                    }

                    ?>
                    <div class="products products-grid">
                        <div class="row" <?php echo esc_attr($data_responsive); ?>>
                            <?php  wc_get_template( 'layout-categories/'. $active_theme .'/'. $layout_type .'.php' , array( 'all_categories' => $all_categories, 'columns' => $columns, 'number' => $number ) ); ?>
                        </div>
                    </div>
                <?php endif; ?>


			</div>
		</div>
	<?php endif; ?>

</div>
