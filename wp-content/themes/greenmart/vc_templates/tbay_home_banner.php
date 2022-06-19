<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="tbay-home-banner <?php echo esc_attr($el_class); ?>">

    <?php $img_left = wp_get_attachment_image_src($image_left,'full'); ?>
    <?php if ( !empty($img_left) && isset($img_left[0]) ): ?>
            <div class="position-img-left no-hover">
                <img src="<?php echo esc_url_raw($img_left[0]); ?>">
            </div>
    <?php endif; ?>

	<?php $img_right = wp_get_attachment_image_src($image_right,'full'); ?>
	<?php if ( !empty($img_right) && isset($img_right[0]) ): ?>
			<div class="position-img-right no-hover">
                <img src="<?php echo esc_url_raw($img_right[0]); ?>">
        	</div>
    <?php endif; ?>

</div>