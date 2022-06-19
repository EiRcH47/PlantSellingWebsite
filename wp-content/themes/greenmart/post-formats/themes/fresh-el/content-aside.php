<?php
/**
 *
 * The default template for displaying content
 * @since 1.0
 * @version 1.2.0
 *
 */

$thumbsize = isset($thumbsize) ? $thumbsize : 'full';

$date 						= greenmart_tbay_get_boolean_query_var('enable_date');
$author 					= greenmart_tbay_get_boolean_query_var('enable_author');
$categories 				= greenmart_tbay_get_boolean_query_var('enable_categories');
$comments 					= greenmart_tbay_get_boolean_query_var('enable_comment');
$comments_text 				= greenmart_tbay_get_boolean_query_var('enable_comment_text');
$short_descriptions 		= greenmart_tbay_get_boolean_query_var('enable_short_descriptions');
$read_more 					= greenmart_tbay_get_boolean_query_var('enable_readmore');
$custom_readmore			= greenmart_tbay_get_config('text_readmore', esc_html__('Continue Reading', 'greenmart'));
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

					<div class="entry-meta-wrapper">
						<?php greenmart_post_meta(array(
							'date'     		=> 1,
							'author'   		=> 1,
							'comments' 		=> 1,
							'comments_text' => 1,
							'tags'     		=> 0,
							'cats'     		=> 1,
							'edit'     		=> 0,
						)); ?>

						<?php greenmart_tbay_post_share_box() ?>
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
				
				<div class="tags-wrapper">
					<span class="tag-title"><?php esc_html_e('Tags:', 'greenmart'); ?></span>
					<?php greenmart_tbay_post_tags(); ?>
				</div>
			
		<?php endif; ?>

    <?php if ( ! is_single() ) : ?>
	
	<?php
	
	  ?>
	  <figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
	   <?php greenmart_tbay_post_thumbnail(); ?>
	    <div class="entry-meta">
			<?php if( $categories ) : ?>
				<div class="categories"><?php greenmart_the_post_category_full(false); ?></div>
			<?php endif; ?>

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

			<?php greenmart_post_meta(array(
				'date'     		=> $date,
				'author'   		=> $author,
				'comments' 		=> $comments,
				'comments_text' => $comments_text,
				'tags'     		=> 0,
				'cats'     		=> 0,
				'edit'     		=> 0,
			)); ?>

			<?php greenmart_the_post_short_descriptions($short_descriptions); ?>
			<?php greenmart_the_post_read_more($read_more, $custom_readmore); ?>
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