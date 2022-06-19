<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$members = (array) vc_param_group_parse_atts( $members );
if ( !empty($members) ):
?>
	<div class="widget widget-ourteam no-margin <?php echo esc_attr($el_class); ?>">
	    <?php if ($title!=''): ?>
	    	<?php $img = wp_get_attachment_image_src($image_icon,'full'); ?>
	    	<div <?php if ( !empty($img) && isset($img[0]) ): ?> style="background: url(<?php echo esc_url_raw($img[0]); ?>) no-repeat center center;" <?php endif; ?>>
		        <h3 class="widget-title">
		            <span><?php echo esc_html( $title ); ?></span>
		        </h3>
	        </div>
	    <?php endif; ?>
	    <div class="widget-content"> 
			<div class="owl-carousel scroll-init products" data-navleft="<?php echo greenmart_get_icon('icon_owl_left'); ?>" data-navright="<?php echo greenmart_get_icon('icon_owl_right'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="false" data-nav="true" data-uncarouselmobile="false">
				<?php foreach ($members as $item): ?>
					<div class="item text-center ourteam-inner">
						<div class="avarta">
							<?php if ( isset($item['image']) && !empty($item['image']) ): ?>
								<?php $img = wp_get_attachment_image_src($item['image'],'full'); ?>
								<?php if ( !empty($img) && isset($img[0]) ): ?>
									<img src="<?php echo esc_url_raw($img[0]); ?>">
				                <?php endif; ?>
		                    <?php endif; ?>
		                    <ul class="social-link lighten">
			                    <?php if ( isset($item['facebook']) && !empty($item['facebook']) ): ?>
			                    	<li><a href="<?php esc_url( $item['facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li>
			                    <?php endif; ?>
			                    <?php if ( isset($item['twitter']) && !empty($item['twitter']) ): ?>
			                    	<li><a href="<?php esc_url( $item['twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li>
			                    <?php endif; ?>
			                    <?php if ( isset($item['google']) && !empty($item['google']) ): ?>
			                    	<li><a href="<?php esc_url( $item['google'] ); ?>"><i class="fa fa-google-plus"></i></a></li>
			                    <?php endif; ?>
			                    <?php if ( isset($item['linkin']) && !empty($item['linkin']) ): ?>
			                    	<li><a href="<?php esc_url( $item['linkin'] ); ?>"><i class="fa fa-linkedin"></i></a></li>
			                    <?php endif; ?>
		                    </ul>
	                    </div>
	                    <div class="info">
	                    <?php if ( isset($item['name']) && !empty($item['name']) ): ?>
	                    	<h3 class="name-team"><?php echo esc_html($item['name']); ?></h3>
	                    <?php endif; ?>

	                    <?php if ( isset($item['job']) && !empty($item['job']) ): ?>
	                    	<p class="job">
                    			<?php echo esc_html($item['job']); ?>
	                    	</p>
	                    <?php endif; ?>
	                    </div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>