<?php

$el_class = $css = $css_animation = $disable_mobile = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$loop_type = $auto_type = $autospeed_type = '';
extract( $atts );

if (isset($categoriestabs) && !empty($categoriestabs)) {
    $categoriestabs = (array) vc_param_group_parse_atts( $categoriestabs );
}

$_id = greenmart_tbay_random_key();

if(isset($responsive_type) && $responsive_type == 'yes') {
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

$active_theme = greenmart_tbay_get_part_theme();

$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';


$class_to_filter = 'widget widget-categories widget-'. $layout_type .' widget-custom-categories categories ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr($css_class); ?>">

    <?php if( (isset($subtitle) && $subtitle) || (isset($title) && $title)  ): ?>
        <h3 class="widget-title">
            <?php if ( isset($title) && $title ): ?>
                <span><?php echo esc_html( $title ); ?></span>
            <?php endif; ?>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>

	<?php if ( isset($categoriestabs) && $categoriestabs ) : ?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">

                <?php if( isset($layout_type) && $layout_type == 'carousel' ) : ?>

             
                    <?php  wc_get_template( 'layout-categories/'.  $active_theme .'/'.  $layout_type .'-custom.php' , array( 'categoriestabs' => $categoriestabs, 'columns' => $columns, 'rows' => $rows, 'data_loop' => $loop_type, 'data_auto' => $auto_type, 'data_autospeed' => $autospeed_type, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'disable_mobile' => $disable_mobile ) ); ?>

                <?php else : ?>

                    <?php

                    $data_responsive = '';
                    
                    if( isset($responsive_type) && $responsive_type === 'yes' ) {  

                        $data_responsive .= ' data-xlgdesktop='. $columns .'';
                        $data_responsive .= ' data-desktop='. $screen_desktop .'';
                        $data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';
                        $data_responsive .= ' data-tablet='. $screen_tablet .'';
                        $data_responsive .= ' data-mobile='. $screen_mobile .'';

                    } else {
                        $data_responsive .= ' data-xlgdesktop="4"';
                        $data_responsive .= ' data-desktop="4"';
                        $data_responsive .= ' data-desktopsmall="3"';
                        $data_responsive .= ' data-tablet="2"';
                        $data_responsive .= ' data-mobile="2"';    
                    }

                    ?>

                    <div class="row" <?php echo esc_attr($data_responsive); ?>>
                        <?php  wc_get_template( 'layout-categories/'.  $active_theme .'/'.  $layout_type .'-custom.php' , array( 'categoriestabs' => $categoriestabs, 'columns' => $columns , 'screen_desktop' => $screen_desktop, 'screen_desktopsmall' => $screen_desktopsmall, 'screen_tablet' => $screen_tablet, 'screen_mobile' => $screen_mobile ) ); ?>
                    </div>


                <?php endif; ?>



			</div>
		</div>
	<?php endif; ?>

</div>
