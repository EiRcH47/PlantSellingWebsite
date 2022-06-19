<?php
$align  = $orderby = $order = $title_position = $title_bg = $nav_type = $pagi_type = $loop_type = $auto_type = $autospeed_type = $disable_mobile = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';
if( isset($title_position) && $title_position == 'left' ) {
    $el_class .= ' title-left';

    $el_class .= (isset($title_bg) && $title_bg == 'yes') ? ' title-bg' : '';
}

$args = array(
    'posts_per_page' =>     $number,
    'post_status'    =>    'publish',
    'orderby'        =>     $orderby,
    'order'          =>     $order,
    'taxonomy'       =>    'category',
); 

if( $category && ($category != esc_html__('--- Choose a Category ---', 'greenmart')) ) {
	$args['cat'] = $category;
}

$loop = new WP_Query($args);

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

$data_responsive  = ' data-xlgdesktop='. $columns .'';

$data_responsive .= ' data-desktop='. $screen_desktop .'';

$data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';

$data_responsive .= ' data-tablet='. $screen_tablet .'';

$data_responsive .= ' data-mobile='. $screen_mobile .'';

$rows_count = isset($rows) ? $rows : 1;
set_query_var( 'thumbsize', $thumbsize );

$active_theme = greenmart_tbay_get_part_theme();

?>

<div class="widget widget-blog <?php echo esc_attr($align); ?> <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_html( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span> 
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content"> 
        <?php $post_item = '_single'; ?>
        <?php if ( $layout_type == 'carousel' ): ?> 


            <?php 
                $pagi_type      = (isset($pagi_type) && $pagi_type== 'yes' ) ? 'true' : 'false';
                $nav_type       = (isset($nav_type) && $nav_type== 'yes' ) ? 'true' : 'false';
                $loop_type      = ($loop_type == 'yes') ? 'true' : 'false';
                $auto_type      = ($auto_type == 'yes') ? 'true' : 'false';
                $disable_mobile = ($disable_mobile == 'yes') ? 'true' : 'false';
            ?>
            <div class="owl-carousel scroll-init posts" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($screen_desktop);?>" data-medium="<?php echo esc_attr($screen_desktopsmall); ?>" data-smallmedium="<?php echo esc_attr($screen_tablet); ?>" data-extrasmall="<?php echo esc_attr($screen_mobile); ?>" data-carousel="owl" data-pagination="<?php echo esc_attr( $pagi_type ); ?>" data-nav="<?php echo esc_attr( $nav_type ); ?>" data-loop="<?php echo esc_attr( $loop_type ); ?>" data-auto="<?php echo esc_attr( $auto_type ); ?>" data-autospeed="<?php echo esc_attr( $autospeed_type )?>"  data-uncarouselmobile="<?php echo esc_attr( $disable_mobile ); ?>">
                <?php $count = 0; while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>

                    <?php if($count%$rows_count == 0){ ?>
                        <div class="item">
                    <?php } ?>

                        <?php 
                            get_template_part( 'vc_templates/post/'.$active_theme.'/_single_carousel'); 

                        ?>

                <?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
                    </div>
                <?php }
                $count++; ?>   

                <?php endwhile; ?>
            </div>

        <?php elseif ( $layout_type == 'carousel-vertical' ): ?>

            <?php 
                $pagi_type      = (isset($pagi_type) && $pagi_type== 'yes' ) ? 'true' : 'false';
                $nav_type       = (isset($nav_type) && $nav_type== 'yes' ) ? 'true' : 'false';
                $loop_type      = ($loop_type == 'yes') ? 'true' : 'false';
                $auto_type      = ($auto_type == 'yes') ? 'true' : 'false';
                $disable_mobile = ($disable_mobile == 'yes') ? 'true' : 'false';
            ?>
            <div class="owl-carousel scroll-init posts" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($screen_desktop);?>" data-medium="<?php echo esc_attr($screen_desktopsmall); ?>" data-smallmedium="<?php echo esc_attr($screen_tablet); ?>" data-extrasmall="<?php echo esc_attr($screen_mobile); ?>" data-carousel="owl" data-pagination="<?php echo esc_attr( $pagi_type ); ?>" data-nav="<?php echo esc_attr( $nav_type ); ?>" data-loop="<?php echo esc_attr( $loop_type ); ?>" data-auto="<?php echo esc_attr( $auto_type ); ?>" data-autospeed="<?php echo esc_attr( $autospeed_type )?>"  data-uncarouselmobile="<?php echo esc_attr( $disable_mobile ); ?>">
                <?php $count = 0; while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>

                    <?php if($count%$rows_count == 0){ ?>
                        <div class="item">
                    <?php } ?>

                        <?php get_template_part( 'vc_templates/post/'.$active_theme.'/_single_carousel_vertical'); ?>

                <?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
                    </div>
                <?php }
                $count++; ?>   

                <?php endwhile; ?>
            </div>

        <?php elseif ( $layout_type == 'grid' ): ?>

            <div class="layout-blog" >
                <div class="row" <?php echo esc_attr($data_responsive); ?>>

                    <?php 


                        if($columns == 5) {
                            $largedesktop = '2-4';
                        }else {
                            $largedesktop = 12/$columns;
                        }

                        if( isset($screen_desktop) &&  $screen_desktop == 5) {
                            $desktop = '2-4';
                        } elseif( isset($screen_desktop) ) {
                            $desktop = 12/$screen_desktop;
                        }

                        if( isset($screen_desktopsmall) &&  $screen_desktopsmall == 5) {
                            $desktopsmall = '2-4';
                        } elseif( isset($screen_desktopsmall) ) {
                            $desktopsmall = 12/$screen_desktopsmall;
                        }

                        if( isset($screen_tablet) &&  $screen_tablet == 5) {
                            $tablet = '2-4';
                        } elseif( isset($screen_tablet) ) {
                            $tablet = 12/$screen_tablet;
                        }

                        if( isset($screen_mobile) &&  $screen_mobile == 5) {
                            $mobile = '2-4';
                        } elseif( isset($screen_mobile) ) {
                            $mobile = 12/$screen_mobile;
                        }

                        $columns_class = 'col-xlg-'.$largedesktop.' col-lg-'.$desktop .' col-md-'.$desktopsmall.' col-sm-'. $tablet .' col-xs-'. $mobile;
                        
                    ?>

                    <?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <div class="<?php echo esc_attr($columns_class); ?>">
                            <?php get_template_part( 'vc_templates/post/'.$active_theme.'/_single' ); ?>
                        </div>

                        <?php $count++; ?>
                    <?php endwhile; ?>
                </div>
            </div>

        <?php else: ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <?php get_template_part( 'vc_templates/post/'.$active_theme.'/_single_list' ); ?>
                <?php endwhile; ?>
            
        <?php endif; ?>
    </div>

</div>
<?php wp_reset_postdata(); ?>