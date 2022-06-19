<?php

$count = 0;
 
?>
<?php 
    foreach ($categoriestabs as $tab) {

     	$cat = get_term_by( 'id', $tab['category'], 'product_cat' );

        $cat_id 		= 	$tab['image'];    
        $image = $iconfont  = '';


        if( isset($cat) && $cat ) {
			$cat_name 		= 	$cat->name;    
			$cat_slug 		= 	$cat->slug;   
			$cat_link 		= 	get_term_link($cat->slug, 'product_cat');   
			$cat_count 		= 	$cat->count;   	

			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$cat_image = wp_get_attachment_url( $thumbnail_id );
        } else {
        	$cat_name = esc_html__('Shop', 'greenmart');
        	$cat_link 		= 	get_permalink( wc_get_page_id( 'shop' ) );;   
			$cat_count 		= 	greenmart_total_product_count();   	
        }

       	if( isset($tab['check_custom_link']) &&  $tab['check_custom_link'] == 'yes' && isset($tab['custom_link']) && !empty($tab['custom_link']) ) {
        	$cat_link = $tab['custom_link'];
        } 

        if( isset($tab['image']) && $tab['image'] ) {
        	$image 		   = wp_get_attachment_url( $cat_id );
        }

        if(isset($tab['icon_font']) && $tab['icon_font']) {
        	$iconfont		   = 	$tab['icon_font'];
        }
        

        ?> 

			<div class="item">

				<div class="item-cat">
					<?php if ( !empty($image) ) { ?>
						<a class="cat-img" href="<?php echo esc_url($cat_link); ?>">
							<img src="<?php echo esc_url($image); ?>">
						</a>
					<?php } else if( !empty($iconfont) ) { ?>
						<a class="cat-img" href="<?php echo esc_url($cat_link); ?>">
							<i class="<?php echo esc_attr( $iconfont ) ?>"></i>
						</a>
					<?php } else if( !empty($cat_image) ) { ?>
						<a class="cat-img" href="<?php echo esc_url($cat_link); ?>">
							<img src="<?php echo esc_url($cat_image); ?>">
						</a>
					<?php } ?>

					<a class="cat-name" href="<?php echo esc_url($cat_link); ?>">
						<?php echo esc_html($cat_name); ?>

						<span class="count-item">(<?php echo esc_html($cat_count).' '.esc_html__('items','greenmart'); ?>)</span>
					</a>


				</div>

			</div>
		<?php 
		$count++;
		?>
        <?php     
	}
?>

<?php wp_reset_postdata(); ?>