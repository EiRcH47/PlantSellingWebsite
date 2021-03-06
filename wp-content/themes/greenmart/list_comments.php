<?php

$GLOBALS['comment'] = $comment;
$add_below = '';

?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment media">
		<?php if( !empty(get_avatar(get_the_author_meta( 'ID' ), 92)) ) :?>
			<div class="avatar">
				<?php echo get_avatar($comment, 54); ?>
				<span class="author"><?php echo get_comment_author_link() ?></span>
				<span class="date"><i class="<?php echo greenmart_get_icon('icon_date'); ?>" aria-hidden="true"></i> <?php comment_date(); ?></span>
				<?php edit_comment_link(esc_html__(' - Edit', 'greenmart'),'  ','') ?>
				<span class="reply"><?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__('Reply', 'greenmart'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			</div>
		<?php endif; ?>

		<div class="comment-box media-body">
			
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'greenmart') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
		</div>
	</div>