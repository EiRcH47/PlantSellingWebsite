<?php
$product_item = isset($product_item) ? $product_item : 'inner';
$columns = isset($columns) ? $columns : 4;
$rows_count = isset($rows) ? $rows : 1;


$screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
$screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
$screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
$screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;

$loop_type          	 =      isset($loop_type) ? $loop_type : '';
$auto_type          	 =      isset($auto_type) ? $auto_type : '';
$autospeed_type          =      isset($autospeed_type) ? $autospeed_type : '';
$disable_mobile          =      isset($disable_mobile) ? $disable_mobile : '';

$active_theme = greenmart_tbay_get_part_theme(); 

$nav_type 		= ($nav_type == 'yes') ? 'true' : 'false';
$pagi_type 		= ($pagi_type == 'yes') ? 'true' : 'false';
$loop_type 		= ($loop_type == 'yes') ? 'true' : 'false';
$auto_type 		= ($auto_type == 'yes') ? 'true' : 'false';
$disable_mobile = ($disable_mobile == 'yes') ? 'true' : 'false';

// Extra post classes
$classes = array('products-grid', 'product');
?>
<div class="owl-carousel scroll-init products" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($screen_desktop);?>" data-medium="<?php echo esc_attr($screen_desktopsmall); ?>" data-smallmedium="<?php echo esc_attr($screen_tablet); ?>" data-extrasmall="<?php echo esc_attr($screen_mobile); ?>" data-carousel="owl" data-pagination="<?php echo esc_attr( $pagi_type ); ?>" data-nav="<?php echo esc_attr( $nav_type ); ?>"  data-loop="<?php echo esc_attr( $loop_type ); ?>" data-auto="<?php echo esc_attr( $auto_type ); ?>" data-autospeed="<?php echo esc_attr( $autospeed_type ); ?>"  data-uncarouselmobile="<?php echo esc_attr( $disable_mobile ); ?>">
    <?php $count = 0; while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
	
			<?php if($count%$rows_count == 0){ ?>
				<div class="item">
			<?php } ?>
	
        
            <div <?php wc_product_class( $classes, $product ); ?>>
                <?php 
					$post_object = get_post( get_the_ID() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					wc_get_template_part( 'item-product/'.$active_theme.'/'.$product_item ); 
				?>
            </div>
		
			<?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
				</div>
			<?php }
			$count++; ?>
		
    <?php endwhile; ?>
</div> 
<?php wp_reset_postdata(); ?> 