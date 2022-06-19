<?php
/**
 *
 * The default template for displaying content
 * @since 1.0
 * @version 1.2.0
 *
 */

$thumbsize = isset($thumbsize) ? $thumbsize : 'full';
?>
<!-- /post-standard -->
<?php if ( ! is_single() ) : ?>
<div  class="post-list clearfix">
<?php endif; ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() ) : ?>
	<div class="entry-single">
<?php endif; ?>
		
        <?php
			if ( is_single() ) : ?>
	        	<div class="entry-header">
	        		<?php
		                if (get_the_title()) {
		                ?>
		                    <h1 class="entry-title">
		                        <?php the_title(); ?>
		                    </h1>
		                <?php
		            }
		            ?>
					<div class="meta-info">
						<span class="entry-date"><i class="<?php echo greenmart_get_icon('icon_date'); ?>" aria-hidden="true"></i><?php echo greenmart_time_link(); ?></span>
						<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
						   <span class="comments-link"><i class="icon-bubbles icons"></i> <?php comments_popup_link( esc_html__( '0 comments', 'greenmart' ), esc_html__( '1 comment', 'greenmart' ), esc_html__( '% comments', 'greenmart' ) ); ?></span>
						<?php endif; ?>
						<span class="entry-category"><i class="<?php echo greenmart_get_icon('icon_cate'); ?>"></i><?php esc_html_e('Posted in', 'greenmart'); the_category(' ,'); ?></span>
						
					</div>
					<?php greenmart_tbay_post_share_box() ?>
					<?php if ( has_excerpt() ) {
						echo the_excerpt();
				 	} ?>
				</div>
				<?php
				if ( has_post_thumbnail() ) {
					?>
					<figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
						<?php greenmart_tbay_post_thumbnail(); ?>
					</figure>
					<?php
				}
				?> 
				<div class="post-excerpt entry-content"><?php the_content( esc_html__( 'Read More', 'greenmart' ) ); ?></div><!-- /entry-content -->
				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'greenmart' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'greenmart' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
				<?php greenmart_tbay_post_tags(); ?>
				
		<?php endif; ?>
		
		
    <?php if ( ! is_single() ) : ?>
	
	<?php
	
	  ?>
	  <div class="row">
		  <figure class="entry-thumb col-md-5 <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
		   	<?php greenmart_tbay_post_thumbnail(); ?>
		  </figure>
		  
		  <?php
		 
		 ?>
		
	    <div class="entry-content col-md-7 <?php echo ( !has_post_thumbnail() ) ? 'no-thumb' : ''; ?>">
			<?php
                if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
			<div class="meta-info">
				<span class="entry-view"><i class="<?php echo greenmart_get_icon('icon_view'); ?>"></i><?php echo greenmart_get_post_views( get_the_ID(), esc_html__(' views', 'greenmart') ); ?></span>
				<span class="entry-date"><i class="<?php echo greenmart_get_icon('icon_date'); ?>" aria-hidden="true"></i><?php echo greenmart_time_link(); ?></span>
				<span class="entry-category"><i class="<?php echo greenmart_get_icon('icon_cate'); ?>"></i><?php esc_html_e('in', 'greenmart'); greenmart_tbay_get_random_blog_cat(); ?></span>
				
			</div>
			<?php
			if ( has_excerpt() ) { ?>
					<div class="entry-excerpt"><?php echo greenmart_tbay_substring( get_the_excerpt(), 20, '[...]' ); ?><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read More', 'greenmart' ); ?>"><?php esc_html_e( 'Read more', 'greenmart' ); ?></a></div>
				<?php } else {
					?>
						<div class="entry-description"><?php echo greenmart_tbay_substring( get_the_content(), 20, '[...]' ); ?><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read More', 'greenmart' ); ?>"><?php esc_html_e( 'Read more', 'greenmart' ); ?></a></div>
					<?php
				}
			?>
	    </div>
	</div>
    <?php endif; ?>
    <?php if ( is_single() ) : ?>
</div>
<?php endif; ?>
</article>

<?php if ( ! is_single() ) : ?>
</div>
<?php endif; ?>