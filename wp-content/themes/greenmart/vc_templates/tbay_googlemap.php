<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = greenmart_tbay_random_key();
$lat_lng = explode(',', $lat_lng);
if (count($lat_lng) == 2) {
	$lat = $lat_lng[0];
	$lng = $lat_lng[1];
?>
	<div class="widget-googlemap <?php echo esc_attr($el_class); ?>">
	    <?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_html( $title ); ?></span>
	            <?php if ( isset($subtitle) && $subtitle ): ?>
	                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
	            <?php endif; ?>
	        </h3>
	    <?php endif; ?>
		<div class="widget-content">
			<div id="tbay_gmap_canvas_<?php echo esc_attr( $_id ); ?>" class="map_canvas tbay-google-map" style="width:100%; height:<?php echo esc_attr( $height ); ?>px;" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>" data-zoom="<?php echo esc_attr($zoom); ?>">
				</div>
		</div>
	</div>
<?php }