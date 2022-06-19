<?php

$taxonomy     = 'product_cat';
$orderby      = 'name';  
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 1;

$columns = isset($columns) ? $columns : 4;

$class_columns = 12/$columns;

$count = 0;


?>
<?php 
     foreach ($all_categories as $cat) {
	    if($cat->category_parent == 0) {
	        $cat_id 	= 	$cat->term_id;
	        $cat_count 	= 	$cat->count;        
	        $cat_name 	= 	$cat->name;    
	        $cat_slug 	= 	$cat->slug;    

			$thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
	        ?> 
				<div class="item col-xs-6 col-sm-4 col-md-<?php echo esc_attr($class_columns); ?>">

					<div class="item-cat">
						<?php if ( $image ) { ?>
							<a class="cat-img" href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>">
								<img src="<?php echo esc_url($image); ?>">
							</a>
						<?php } ?>

						<a class="cat-name" href="<?php echo get_term_link($cat_slug, 'product_cat'); ?>">
							<?php echo esc_html($cat_name); ?>
						</a>
						<span class="count-item">(<?php echo esc_html($cat_count).' '.esc_html__('items','greenmart'); ?>)</span>
					</div>

				</div>
			<?php 
			$count++;
			?>
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
						<div class="item col-xs-6 col-md-<?php echo esc_attr($class_columns); ?>">

								<div class="item-cat">
									<?php if ( $image_sub ) { ?>
										<a class="cat-img" href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>">
											<img src="<?php echo esc_url($image_sub); ?>">
										</a>
									<?php } ?>

									<a class="cat-name" href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>">
										<?php echo esc_html($sub_category->name); ?>
									</a>
								</div>

						</div>
						<?php
						$count++;
						?>
						<?php endif; ?>
			        <?php 
	            }   
	        }
	    }       
	}
?>

<?php wp_reset_postdata(); ?>