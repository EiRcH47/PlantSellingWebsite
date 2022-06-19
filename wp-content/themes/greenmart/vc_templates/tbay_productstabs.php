<?php

$align = $title_position = $title_bg = $nav_type = $pagi_type = $loop_type = $auto_type = $autospeed_type = $disable_mobile = '';

$rows = 1;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';
if( isset($title_position) && $title_position == 'left' ) {
    $el_class .= ' title-left';

    $el_class .= (isset($title_bg) && $title_bg == 'yes') ? ' title-bg' : '';
}

if ( $producttabs == '' ) return;

if (isset($categories) && !empty($categories)) {
    $categories = explode(',', $categories);
}

$_id = greenmart_tbay_random_key();
$_count = 1;

$list_query = $this->getListQuery( $atts );

if($responsive_type == 'yes') {
    $screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
    $screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
    $screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
    $screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;
} else {
    $screen_desktop          =     	$columns;
    $screen_desktopsmall     =      $columns;
    $screen_tablet           =      $columns;
    $screen_mobile           =      $columns;  
}

$active_theme = greenmart_tbay_get_part_theme();

$cat_operator = 'IN';

if( $ajax_tabs === 'yes' ) { 
    $el_class 	.= ' tbay-product-tabs-ajax ajax-active';

	if ( isset($categories) && !empty($categories) ) {
		$category_ajax 		= greenmart_tbay_get_category_by_id($categories);
	} elseif (isset($categories) && !empty($categories)) {
		$category_ajax 	= get_term_by('id', $categories, 'product_cat')->slug;
	} else {
		$category_ajax 	= '';
	}

	$responsive = array(
        'desktop'       => $screen_desktop,
        'desktopsmall'  => $screen_desktopsmall,
        'tablet'        => $screen_tablet,
        'mobile'        => $screen_mobile,
    );

	$data_carousel = array(
		'nav_type'          => $nav_type,
		'pagi_type'         => $pagi_type,
		'loop_type'         => $loop_type,
		'auto_type'         => $auto_type,
		'autospeed_type'    => $autospeed_type,
		'disable_mobile'    => $disable_mobile,
		'rows'              => $rows,
	);

    $json = array(
		'cat_operator'                  => $cat_operator,
        'number'                        => $number,
        'categories'                    => $category_ajax,
        'responsive'                    => $responsive, 
        'columns'                       => $columns, 
        'layout_type'                   => $layout_type,
        'data_carousel'                 => $data_carousel,
    ); 

	$json = apply_filters( 'greenmart_ajax_vc_productstabs', $json, 10, 1 );

    $encoded_settings  = wp_json_encode( $json );

    $tabs_data = 'data-atts="'. esc_attr( $encoded_settings ) .'"';
} else {
    $tabs_data = '';
}

if ( count($list_query) > 0 ) {
?>
	<div class="widget <?php echo esc_attr($align); ?> widget-products widget-product-tabs products <?php echo esc_attr($el_class); ?>">
		<div class="tabs-container tab-heading clearfix tab-v8">
			<?php if($title!=''):?>
				<h3 class="widget-title">
            		<span><span><?php echo esc_html( $title ); ?></span></span><?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
				</h3>
			<?php endif; ?>
			<ul class="product-tabs-title tabs-list nav nav-tabs nav" <?php echo trim($tabs_data); ?>>
				<?php $_count=0; ?>
				<?php foreach ($list_query as $key => $li) { ?>

						<?php 
							$class_li	= ($_count==0)?' class="active"':'';
						?>
						<li <?php echo trim($class_li); ?>><a href="#<?php echo esc_attr($key.'-'.$_id); ?>" data-toggle="tab"  data-value="<?php echo esc_attr($key); ?>" data-title="<?php echo esc_attr($li['title_tab']);?>"><?php echo trim( $li['title_tab'] );?></a></li>
					<?php $_count++; ?>
				<?php } ?>
			</ul> 
		</div>

		<?php if(  $layout_type == 'carousel' || $layout_type == 'carousel-special' ) { ?>

			<div class="widget-content tbay-addon-content tab-content woocommerce">
				<?php $_count=0; ?>
				<?php foreach ($list_query as $key => $li) { ?>
					<?php 
						$tab_active = ($_count == 0) ? ' active active-content current' : '';
					?>
					<div class="tab-pane<?php echo esc_attr( $tab_active ); ?>" id="<?php echo esc_attr($key).'-'.$_id; ?>">
						
						<?php if( $_count === 0 || $ajax_tabs !== 'yes' ) : ?>
							<?php
								if ( isset($categories) && is_array($categories) ) {
									$category 	= greenmart_tbay_get_category_by_id($categories);
									$loop      	= greenmart_get_query_products($category, $cat_operator, $key, $number);
								} else if( isset($categories) && !empty($categories) ) {
									$category 	= get_term_by( 'id', $categories, 'product_cat' )->slug;
									$loop      	= greenmart_get_query_products($category, $cat_operator, $key, $number);
								} else {
									$loop      	= greenmart_get_query_products('', $cat_operator, $key, $number);
								}
														
								if ( $loop->have_posts()) {

									wc_get_template( 'layout-products/'.$active_theme.'/'. $layout_type .'.php' , array( 'loop' => $loop, 'columns' => $columns, 'rows' => $rows, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number, 'loop_type' => $loop_type, 'auto_type' => $auto_type, 'autospeed_type' => $autospeed_type, 'disable_mobile' => $disable_mobile ) );
								}
							?>

						<?php endif; ?>

					</div> 
					<?php $_count++; ?>
				<?php } ?>
			</div>

		<?php } else { ?>

			<div class="widget-content tbay-addon-content tab-content woocommerce">
				<?php $_count=0; ?>
				<?php foreach ($list_query as $key => $li) { ?>
					<?php
						$tab_active = ($_count == 0) ? ' active active-content current' : '';
					?>
					<div class="tab-pane<?php echo esc_attr( $tab_active ); ?>" id="<?php echo esc_attr($key).'-'.$_id; ?>">
						
						<?php if( $_count === 0 || $ajax_tabs !== 'yes' ) : ?>
						<?php
							if ( isset($categories) && is_array($categories) ) {
								$category 	= greenmart_tbay_get_category_by_id($categories);
								$loop      	= greenmart_get_query_products($category, $cat_operator, $key, $number);
							} else if( isset($categories) && !empty($categories) ) {
								$category 	= get_term_by( 'id', $categories, 'product_cat' )->slug;
								$loop      	= greenmart_get_query_products($category, $cat_operator, $key, $number);
							} else {
								$loop      	= greenmart_get_query_products('', $cat_operator, $key, $number);
							}

							if ( $loop->have_posts() ) {
								
								wc_get_template( 'layout-products/'.$active_theme.'/'. $layout_type .'.php' , array( 'loop' => $loop, 'columns' => $columns, 'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number ) );
							}
						?>

						<?php endif; ?>
					</div>
					<?php $_count++; ?>
				<?php } ?>
			</div>			

		<?php } ?>

	</div>
<?php wp_reset_postdata(); ?>
<?php } ?>

