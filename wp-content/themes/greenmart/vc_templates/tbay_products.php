<?php
$align = $title_position = $title_bg = $nav_type = $pagi_type = $loop_type = $auto_type = $autospeed_type = $disable_mobile = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$cat_operator = 'IN';
extract( $atts );

$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';
if( isset($title_position) && $title_position == 'left' ) {
    $el_class .= ' title-left';

    $el_class .= (isset($title_bg) && $title_bg == 'yes') ? ' title-bg' : '';
}

if ( $type == '' ) return;

if (isset($categories) && !empty($categories)) {
    $categories = explode(',', $categories);
    $data_categories = $categories;
}

$active_theme = greenmart_tbay_get_part_theme();

$_id = greenmart_tbay_random_key();
$_count = 1;

$categories = greenmart_tbay_get_category_by_id($categories);

$loop      = greenmart_get_query_products($categories, $cat_operator, $type, $number);

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
<div class="widget widget-<?php echo esc_attr($layout_type); ?> <?php echo esc_attr($align); ?> widget-products products <?php echo esc_attr($el_class); ?>">

	<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_html( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>

	<?php if ( $loop->have_posts() ) : ?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">

                <?php  wc_get_template( 'layout-products/'.$active_theme.'/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'rows' => $rows, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number, 'loop_type' => $loop_type, 'auto_type' => $auto_type, 'autospeed_type' => $autospeed_type, 'disable_mobile' => $disable_mobile ) ); ?>

			</div>
		</div>
	<?php endif; ?>
    <?php if(isset($show_button) && $show_button == 'yes') : ?>
        <div id="show-view-all<?php echo esc_attr($_id); ?>" class="show-view-all">


            <?php 
                if( empty($data_categories) ) {
                    $url = get_permalink( wc_get_page_id( 'shop' ) );
                } else if( is_array($data_categories) ) {
                    $category   = get_term_by( 'slug', $data_categories['0'], 'product_cat' );
                    $url = get_term_link( $category->term_id, 'product_cat' );
                } else {
                    $url  = get_term_link($categories, 'product_cat');
                }

            ?>

            <a href="<?php echo esc_url($url); ?>">
                <?php echo esc_html($button_text); ?>
            </a>

        </div>
    <?php endif; ?>   
</div>
