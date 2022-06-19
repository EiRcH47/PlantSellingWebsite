<?php
$align = $title_position = $title_bg = $nav_type = $pagi_type = $loop_type = $auto_type = $autospeed_type = $disable_mobile = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$cat_operator = 'IN';
$product_type = 'newest';
extract( $atts );

$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';
if( isset($title_position) && $title_position == 'left' ) {
    $el_class .= ' title-left';

    $el_class .= (isset($title_bg) && $title_bg == 'yes') ? ' title-bg' : '';
}

if ( isset($category) || !empty($category) ):
	$loop      	= greenmart_get_query_products($category, $cat_operator, $product_type, $number);

if($responsive_type == 'yes') {
    $screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
    $screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
    $screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
    $screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;
} else {
    $screen_desktop          =     $columns;
    $screen_desktopsmall     =      3;
    $screen_tablet           =      3;
    $screen_mobile           =      1;  
}

$active_theme = greenmart_tbay_get_part_theme();

$cat_array = array();
$args = array(
    'type' => 'post',
    'child_of' => 0,
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'hierarchical' => 1,
    'taxonomy' => 'product_cat'
);
$categories = get_categories( $args );
greenmart_tbay_get_category_childs( $categories, 0, 0, $cat_array );

$cat_array_id   = array();
foreach ($cat_array as $key => $value) {
    $cat_array_id[]   = $value;
}

if( !in_array($category, $cat_array_id) ) {
	$loop      		= greenmart_get_query_products('', $cat_operator, $product_type, $number);
} else {
	$cat_category 	= get_term_by( 'id', $category, 'product_cat' );
	$slug 		  	= $cat_category->slug;
	$loop      		= greenmart_get_query_products($slug, $cat_operator, $product_type, $number);
}

?>
	<div class="widget widget-products <?php echo esc_attr($align); ?> <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
		<?php if ($title!=''): ?>
            <h3 class="widget-title">
                <span><?php echo esc_html( $title ); ?></span>
                <?php if ( isset($subtitle) && $subtitle ): ?>
                    <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?> 



		<?php if(  $layout_type == 'carousel' || $layout_type == 'carousel-special' ) { ?>

			<div class="widget-content">
				<?php if ( $loop->have_posts() ): ?>
					<div class="products grid-wrapper woocommerce">
						<?php if ($image_cat): ?>
							<div class="widget-banner">
								<?php echo wp_get_attachment_image( $image_cat , 'full'); ?>
							</div>
						<?php endif ?>

						<?php wc_get_template( 'layout-products/'.$active_theme.'/'. $layout_type .'.php' , array( 'loop' => $loop, 'columns' => $columns, 'rows' => $rows,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type, 'loop_type' => $loop_type, 'auto_type' => $auto_type, 'autospeed_type' => $autospeed_type, 'disable_mobile' => $disable_mobile ) ); ?>
	                 
					</div>
				<?php endif; ?>
			</div>

		<?php } else { ?>

			<div class="widget-content">
				<?php if ( $loop->have_posts() ): ?>
					<div class="products grid-wrapper woocommerce"> 
						<?php if ($image_cat): ?>
							<div class="widget-banner">
								<?php echo wp_get_attachment_image( $image_cat , 'full'); ?>
							</div>
						<?php endif ?>

						<?php wc_get_template( 'layout-products/'.$active_theme.'/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile ) ); ?>
					</div>
				<?php endif; ?>
			</div>

		<?php } ?>

	</div>
<?php endif; ?>