<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
$args = array(
	'post_type' => 'tbay_brand',
	'posts_per_page' => $number
);
$loop = new WP_Query($args);
?>
<div class="widget widget-brands <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
    	<div class="clearfix">
        <h3 class="widget-title">
            <span><?php echo esc_html( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
        </div>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ( $loop->have_posts() ): ?>
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel scroll-init products" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="false" data-nav="true">
		    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		    			<div class="item">
			                <?php 
			                	$link = get_post_meta( get_the_ID(), 'tbay_brand_link', true); 
			                	$link = $link ? $link : '#';
			                	$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
			                ?>
							<a href="<?php echo esc_url($link); ?>" target="_blank"> 
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</a>
				        </div>
		    		<?php endwhile; ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
			                <?php 
			                	$link = get_post_meta( get_the_ID(), 'tbay_brand_link', true); 
			                	$link = $link ? $link : '#';
			                	$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
			                ?>
							<a href="<?php echo esc_url($link); ?>" target="_blank">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</a>
				        </div>
		    		<?php endwhile; ?>
	    		</div>
	    	<?php endif; ?>
    	<?php endif; ?>
    	<?php wp_reset_postdata(); ?>
    </div>
</div>