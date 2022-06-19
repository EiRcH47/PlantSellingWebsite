<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"><?php comments_number( esc_html__('0 Comments', 'greenmart'), esc_html__('1 Comment', 'greenmart'), esc_html__('% Comments', 'greenmart') ); ?></h3>
		<?php greenmart_tbay_comment_nav(); ?>
		<ol class="comment-list">
			<?php wp_list_comments('callback=greenmart_tbay_list_comment'); ?>
		</ol><!-- .comment-list -->

		<?php greenmart_tbay_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'greenmart' ); ?></p>
	<?php endif; ?>

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> '<h4 class="title">'.esc_html__('Leave a Comment','greenmart').'</h4>',
                        'comment_field' => '<div class="form-group">
                                                <textarea rows="8" placeholder="'.esc_attr__('Comment...', 'greenmart').'" id="comment" class="form-control"  name="comment"'.$aria_req.'></textarea>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
	                    		array(
	                                'author' => '<div class="form-group ">
	                                            <input type="text" placeholder="'.esc_attr__('Name', 'greenmart').'"   name="author" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
	                                            </div>',
	                                'email' => ' <div class="form-group ">
	                                            <input id="email" placeholder="'.esc_attr__('Email', 'greenmart').'"  name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
	                                            </div>',
	                                'url' => '<div class="form-group ">
	                                            <input id="url" placeholder="'.esc_attr__('Website', 'greenmart').'" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
	                                            </div>',
	                            )
							),
	                        'label_submit' => esc_html__('Submit', 'greenmart'),
							'comment_notes_before' => '<div class="form-group h-info">'.esc_html__('Your email address will not be published.','greenmart').'</div>',
							'comment_notes_after' => '',
                        );
    ?>

	<?php greenmart_tbay_comment_form($comment_args); ?>
</div><!-- .comments-area -->
