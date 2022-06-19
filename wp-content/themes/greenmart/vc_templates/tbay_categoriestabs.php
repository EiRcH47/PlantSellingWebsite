<?php

$align = $show_button = $title_position = $title_bg = $nav_type = $pagi_type = $loop_type  = $auto_type  = $autospeed_type = $disable_mobile = '';

$cat_operator = 'IN';
$rows = 1;
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = greenmart_tbay_random_key();

if (isset($categoriestabs) && !empty($categoriestabs)):
    $categoriestabs = (array) vc_param_group_parse_atts( $categoriestabs );
    $i = 0;

if($responsive_type == 'yes') {
    $screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
    $screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
    $screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
    $screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;
} else {
    $screen_desktop          =     $columns;
    $screen_desktopsmall     =      3;
    $screen_tablet           =      3;
    $screen_mobile           =     1;  
}

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

$active_theme = greenmart_tbay_get_part_theme();

if( $ajax_tabs === 'yes' ) { 
    $el_class           .= ' tbay-product-categories-tabs-ajax ajax-active';

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
        'responsive'                    => $responsive, 
        'columns'                       => $columns, 
        'layout_type'                   => $layout_type,
        'data_carousel'                 => $data_carousel,
    ); 

    $json = apply_filters( 'greenmart_ajax_vc_categoriestabs', $json, 10, 1 );

    $encoded_settings  = wp_json_encode( $json );

    $tabs_data = 'data-atts="'. esc_attr( $encoded_settings ) .'"';
} else {
    $tabs_data = '';
}
?>

    <div class="widget widget-products widget-categoriestabs <?php echo esc_attr($align); ?> <?php echo esc_attr($el_class); ?>">
        <?php if ($title!=''): ?>
            <h3 class="widget-title">
                <span><?php echo esc_html( $title ); ?></span>
                <?php if ( isset($subtitle) && $subtitle ): ?>
                    <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
        <div class="widget-content woocommerce">
            <ul role="tablist" class="product-categories-tabs-title tabs-list nav nav-tabs" <?php echo trim($tabs_data); ?>>
                <?php foreach ($categoriestabs as $tab) : ?>
                    <?php 

                        if( !in_array($tab['category'], $cat_array_id) ) {
                            $cat_category    = esc_html__('all-categories','greenmart');
                            $cat_name        = esc_html__('All Categories','greenmart');
                            $slug            = '';
                        } else {
                            $cat_category    = $tab['category'];
                            $category        = get_term_by( 'id', $cat_category, 'product_cat' );
                            $cat_name        = $category->name;
                            $slug            = greenmart_get_transliterate($category->slug);
                        }

                        $class_li = ($i == 0 ? ' class="active"' : '');
                    ?>
                    <li <?php echo trim($class_li); ?>>
                        <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" data-toggle="tab" data-value="<?php echo esc_attr($slug); ?>" class="<?php echo (isset($tab['icon']) || isset($tab['icon_font']) ? 'has-icon' : 'no-icon'); ?>">
                            <?php if ( isset($tab['icon']) && !empty($tab['icon']) ): ?>
                                <?php $img = wp_get_attachment_image_src($tab['icon'], 'full'); ?>
                                <?php if ( isset($img[0]) ) { ?>
                                    <img src="<?php echo esc_url( $img[0] );?>" alt="<?php echo esc_attr( $title ); ?>"  />
                                <?php } ?>
                            <?php elseif ( isset($tab['icon_font']) && $tab['icon_font'] ): ?>
                                <i class="<?php echo esc_attr($tab['icon_font']); ?>"></i>
                            <?php endif; ?>
                            <?php echo esc_html($cat_name); ?>
                        </a>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>
            <div class="widget-inner">
                <?php if( !empty($image_cat) ) : ?>
                    <?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs <?php echo esc_attr( $image_float );?>">
                        <img src="<?php echo esc_url_raw($img[0]); ?>">
                    </div>
                <?php endif; ?>
                <div class="tab-content-wrapper <?php echo !empty($image_cat) ? 'col-lg-9 col-xs-12' : ''; ?>">
                    <div class="tbay-addon-content tab-content">
                        <?php $_count = 0; foreach ($categoriestabs as $tab) : ?>

                            <?php 
                                $tab_active = ($_count == 0) ? ' active active-content current' : '';
                            ?>

                            <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($_count); ?>" class="tab-pane <?php echo esc_attr( $tab_active ); ?>">

                                <?php if( $_count === 0 || $ajax_tabs !== 'yes' ) : ?>

                                <?php 
                                    if( !in_array($tab['category'], $cat_array_id) ) {
                                        $cat_category    = esc_html__('all-categories','greenmart');
                                        $loop      	     = greenmart_get_query_products('', $cat_operator, $type, $number);
                                        $link            = get_permalink( wc_get_page_id( 'shop' ) );
                                    } else {
                                        $category       = get_term_by( 'id', $tab['category'], 'product_cat' );
                                        $cat_category   = $category->slug;
                                        $loop      	     = greenmart_get_query_products($cat_category, $cat_operator, $type, $number);
                                        $link           = get_term_link( $category->term_id, 'product_cat' );
                                    }    
                                ?>

								<?php wc_get_template( 'layout-products/'.$active_theme.'/'. $layout_type .'.php' , array( 'loop' => $loop, 'columns' => $columns, 'rows' => $rows, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number, 'loop_type' => $loop_type, 'auto_type' => $auto_type, 'autospeed_type' => $autospeed_type, 'disable_mobile' => $disable_mobile ) ); ?>

                                <?php endif; ?>

                                <a href="<?php echo esc_url( $link ); ?>" class="btn btn-block btn-view-all"><?php echo esc_html__('view all', 'greenmart'); ?><i class="<?php echo greenmart_get_icon('icon_owl_right'); ?>"></i></a>
                            </div>
                        <?php $_count++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>