<?php
   $job = get_post_meta( get_the_ID(), 'tbay_testimonial_job', true );
   $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());

   $testimonial = get_post(get_the_ID());
?>
<div class="testimonials-body media">
   <div class="testimonials-profile"> 
      <div class="wrapper-avatar">
         <div class="testimonial-avatar">
            <?php the_post_thumbnail('greenmart_avatar_post_carousel') ?>
         </div>
      </div>
      <div class="testimonial-meta">
         <span class="name-client"> <?php the_title(); ?></span>
         <span class="job"><?php echo esc_html($job); ?></span>
      </div> 
   </div> 
   <div class="description media-body">
      <?php echo apply_filters('the_content', $testimonial->post_content); ?>
	</div>
</div>