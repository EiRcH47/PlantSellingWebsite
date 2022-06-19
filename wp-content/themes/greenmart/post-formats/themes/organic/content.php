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
					if ( has_post_thumbnail() ) {
						?>
						<figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">

							<span class="comments-link"><i class="<?php echo greenmart_get_icon('icon_comments'); ?>"></i> <?php comments_popup_link( esc_html__( '0', 'greenmart' ), esc_html__( '1', 'greenmart' ), esc_html__( '%', 'greenmart' ) ); ?></span>
							<?php greenmart_tbay_post_thumbnail(); ?>
						</figure>
						<?php
					}
					?> 
					<div class="entry-meta">
			            <?php
			                if (get_the_title()) {
			                ?>
			                    <h1 class="entry-title">
			                       <?php the_title(); ?>
			                    </h1>
			                <?php
			            	}
			            ?>
			        </div>
					<div class="meta-info">
						<span class="author"><?php echo get_avatar(get_the_author_meta( 'ID' ), 50); ?> <?php the_author_posts_link(); ?></span>

						<span class="entry-date"><i class="<?php echo greenmart_get_icon('icon_date'); ?>" aria-hidden="true"></i><?php echo greenmart_time_link(); ?></span>
						<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
						
						<?php endif; ?>
						
					</div>
				</div>

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
				
				<?php greenmart_tbay_post_share_box() ?>
			
		<?php endif; ?>
		
		
    <?php if ( ! is_single() ) : ?>
	
	<?php
	
	  ?>
	  <figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
	   <?php greenmart_tbay_post_thumbnail(); ?>
	   <div class="entry-meta">
            <?php
                if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
        </div>
	  </figure>
	  
	  <?php
	 
	 ?>
	
    <div class="entry-content <?php echo ( !has_post_thumbnail() ) ? 'no-thumb' : ''; ?>">
		<div class="entry">
		
			<div class="meta-info">
				<span class="author"><?php echo get_avatar(get_the_author_meta( 'ID' ), 50); ?> <?php the_author_posts_link(); ?></span>
				<span class="entry-date"><i class="<?php echo greenmart_get_icon('icon_date'); ?>" aria-hidden="true"></i><?php echo greenmart_time_link(); ?></span>
				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				
				<?php endif; ?>
				
			</div>
			<div class="entry-top">
				<?php
					if ( has_excerpt() ) {
							echo the_excerpt();
						} else {
							?>
								<div class="entry-description"><?php echo greenmart_tbay_substring( get_the_excerpt(), 20, '[...]' ); ?></div>
							<?php
						}
					?>
			</div>
			<div class="readmore">
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Read More', 'greenmart' ); ?>"><i class="<?php echo greenmart_get_icon('icon_readmore'); ?>"></i></a>
			</div>
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