<?php
$style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$current_theme = greenmart_tbay_get_theme();
$items = (array) vc_param_group_parse_atts( $items );
$count = count($items);
if ( !empty($items) ):
?>
	<div class="widget widget-features <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
	    <div class="space-25">
	        <h3 class="widget-title">
	            <span><?php echo esc_html( $title ); ?></span>
	        </h3>
	    </div>
	    <?php endif; ?>
	    <div class="widget-content feature-box-group" data-count="<?php echo esc_attr($count); ?>"> 
			<?php foreach ($items as $item): ?>
				<div class="feature-box">
					<?php if ( isset($item['image']) && $item['image'] ): ?>
						<?php $img = wp_get_attachment_image_src($item['image'],'full'); ?>
						<?php if (isset($img[0]) && $img[0]) { ?>
					    	<div class="fbox-image">
					    		<div class="image-inner">
									<img src="<?php echo esc_url_raw($img[0]);?>" alt="<?php echo esc_attr($title); ?>" />
					    		</div>
					    	</div>
						<?php } ?>
					<?php endif; ?>
					<?php if (isset($item['icon']) && $item['icon']) { ?>
				        <div class="fbox-icon">
				        	<div class="icon-inner">
				            	<i class="fa <?php echo esc_attr($item['icon']); ?>"></i>
				            </div>
				        </div>
				    <?php } ?>
				    <div class="fbox-content">  
				        <h3 class="ourservice-heading"><?php echo esc_html($item['title']); ?></h3>                     
				        <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
				            <p class="description"><?php echo trim( $item['description'] );?></p>  
				        <?php } ?> 
 						<?php if( $current_theme != 'health' ) { 
					        if (isset($item['link']) && trim($item['link'])!='') { ?>
					            <a class="btn btn-link btn-xs" href="<?php echo esc_url($item['link']); ?>"><?php esc_html_e('Learn More ', 'greenmart'); ?><i class="fa fa-arrow-right"></i></a>  
					        <?php } 
				        } else {
				        	if (isset($item['link']) && trim($item['link'])!='') { ?>
					            <a class="more" href="<?php echo esc_url($item['link']); ?>"><?php esc_html_e('Read more ', 'greenmart'); ?></i></a>  
					        <?php }
				        } ?>
				    </div>      
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>