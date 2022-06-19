<?php

$title = $descript = $font_color = $style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>

<div class="widget widget-text-heading <?php echo esc_attr($align); ?> <?php echo esc_attr($el_class.' '.$style); ?>">
	<?php if($title!=''): ?>
        <h3 class="widget-title" <?php if($font_color!=''): ?> style="color: <?php echo esc_attr( $font_color ); ?>;"<?php endif; ?>>
           <span><?php echo esc_html( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <?php if(trim($descript)!=''){ ?>
        <div class="description">
            <?php echo trim( $descript ); ?>
        </div>
    <?php } ?>
</div>