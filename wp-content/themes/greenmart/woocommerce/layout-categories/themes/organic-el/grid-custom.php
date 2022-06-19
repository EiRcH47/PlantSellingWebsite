<?php

$columns = isset($columns) ? $columns : 4;

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

$classes = 'col-xlg-'.$largedesktop.' col-lg-'.$desktop.' col-xs-'. $mobile .' col-md-'.$desktopsmall.' col-sm-'.$tablet;

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

			<div class="item <?php echo (isset($classes)) ? esc_attr($classes) : ''; ?>">

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