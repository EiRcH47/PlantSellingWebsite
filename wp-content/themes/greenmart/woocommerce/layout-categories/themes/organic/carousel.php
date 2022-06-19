<?php

$taxonomy     = 'product_cat';
$orderby      = 'name';  
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 1;

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


$pagi_type 			= 	($pagi_type == 'yes') ? 'true' : 'false';
$nav_type 			= 	($nav_type == 'yes') ? 'true' : 'false';
$loop_type 			= 	($loop_type == 'yes') ? 'true' : 'false';
$auto_type 			= 	($auto_type == 'yes') ? 'true' : 'false';
$disable_mobile 	= 	($disable_mobile == 'yes') ? 'true' : 'false';
?>
<div class="owl-carousel scroll-init categories" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($screen_desktop);?>" data-medium="<?php echo esc_attr($screen_desktopsmall); ?>" data-smallmedium="<?php echo esc_attr($screen_tablet); ?>" data-extrasmall="<?php echo esc_attr($screen_mobile); ?>" data-carousel="owl" data-pagination="<?php echo esc_attr( $pagi_type ); ?>" data-nav="<?php echo esc_attr( $nav_type ); ?>" data-loop="<?php echo esc_attr( $loop_type ); ?>" data-auto="<?php echo esc_attr( $auto_type ); ?>" data-autospeed="<?php echo esc_attr( $autospeed_type )?>"  data-uncarouselmobile="<?php echo esc_attr( $disable_mobile ); ?>">
    <?php 
     $count = 0;
     foreach ($all_categories as $cat) {
	    if($cat->category_parent == 0) {
	        $cat_id 	= 	$cat->term_id;    
	        $cat_count 	= 	$cat->count;    
	        $cat_name 	= 	$cat->name;    
	        $cat_slug 	= 	$cat->slug;  

			$thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
	        ?> 

	        <?php if( isset($cat_count) && $cat_count > 0 ) : ?>
			<?php if($count%$rows_count == 0){ ?> 
				<div class="item">
			<?php } ?>


					<div class="item-cat">
						<?php if ( $image ) { ?>
							<a class="cat-img" href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>">
								<img src="<?php echo esc_url($image); ?>">
							</a>
						<?php } ?>

						<a class="cat-name" href="<?php echo get_term_link($cat_slug, 'product_cat'); ?>">
							<?php echo esc_html($cat_name); ?>
						</a>
					</div>


			<?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
				</div>
			<?php }
			$count++;
			?>
			<?php endif; ?>
	        <?php 

	        $args2 = array(
	                'taxonomy'     => $taxonomy,
	                'child_of'     => 0,
	                'parent'       => $cat_id,
	                'orderby'      => $orderby,
	                'number'       => $number,
	                'pad_counts'   => $pad_counts,
	                'hierarchical' => $hierarchical,
	                'title_li'     => $title,
	                'hide_empty'   => $empty
	        );

	        $sub_cats = get_categories( $args2 );
	        if($sub_cats) {
	            foreach($sub_cats as $sub_category) {
			        $cat_id 	= 	$sub_category->term_id;    
			        $cat_name 	= 	$sub_category->name;    
			        $cat_count 	= 	$sub_category->count;    
			        $cat_slug 	= 	$sub_category->slug;     
					$thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
					$image_sub = wp_get_attachment_url( $thumbnail_id );

	            	?> 
	            		<?php if( isset($cat_count) && $cat_count > 0 ) : ?>
						<?php if($count%$rows_count == 0){ ?> 
							<div class="item">
						<?php } ?>

								<div class="item-cat">
									<?php if ( $image_sub ) { ?>
										<a class="cat-img" href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>">
											<img src="<?php echo esc_url($image); ?>">
										</a>
									<?php } ?>

									<a class="cat-name" href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>">
										<?php echo esc_html($sub_category->name); ?>
									</a>
								</div>

						<?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
							</div>
						<?php }
						$count++;
						?>
						<?php endif; ?>
			        <?php 
	            }   
	        }
	    }       
	}

    ?>
</div> 
<?php wp_reset_postdata(); ?>