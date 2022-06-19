<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . trim($after_title);
}
$query = new WP_Query(array(
	'post_type'=>'post',
	'post__in' => $ids
));

if($query->have_posts()){
	 echo trim($before_widget);
?>
	<div class="post-widget media-post-layout widget-content">
	<?php while ( $query->have_posts() ): $query->the_post(); ?>
		<article class="item-post media">
			<?php
				if(has_post_thumbnail()){
			?>
			<a href="<?php the_permalink(); ?>" class="image pull-left">
				<?php the_post_thumbnail( 'widget' ); ?>
			</a>
			<?php } ?>
			<div class="media-body">
				<h6 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h6>
				<p>
					<span class="post-date">
						<i class="fa fa-calendar-o"></i>
						<?php the_time( 'd M Y' ); ?>
					</span>
					<span class="post-author">
						<i class="fa fa-user"></i> <?php the_author_posts_link(); ?>
					</span>
				</p>
			</div>
		</article>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	</div>
<?php echo trim($after_widget); ?>
<?php } ?>
