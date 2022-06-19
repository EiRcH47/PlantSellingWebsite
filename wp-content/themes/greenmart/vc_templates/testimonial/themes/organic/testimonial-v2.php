<?php
   $job = get_post_meta( get_the_ID(), 'tbay_testimonial_job', true );
   $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());

   $testimonial = get_post(get_the_ID());
?>
<div class="testimonials-body media v2">
   <div class="testimonials-content">
	   
	   <div class="description media-body">
		<i class="<?php echo greenmart_get_icon('icon_quote_left'); ?>"></i>
		<p>
			<?php echo apply_filters('the_content', $testimonial->post_content); ?>
		</p>
		</div>
		<div class="testimonials-profile"> 
		  <div class="testimonial-meta">
			 <span class="name-client"> <?php the_title(); ?></span>
			 <span class="job"><?php echo esc_html($job); ?></span>
		  </div> 
	   </div> 
   </div> 
</div>