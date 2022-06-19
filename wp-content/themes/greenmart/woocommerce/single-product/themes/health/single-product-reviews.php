<?php 

global $product;

?>
<div id="reviews"  class="widget-primary widget-reviews">
<div class="comments-content">
	<div class="reviews-summary">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 media reviews-col1">
				<h5><?php esc_html_e('Customer reviews', 'greenmart'); ?></h5>
				<ul class="list-unstyled">
					<li class="review-summary-total pull-left">
						<div class="review-summary-result">
							<strong><?php echo floatval($average); ?></strong>
						</div>
						<?php printf( esc_html__( '%s ratings','greenmart'),$count )  ; ?>
					</li>	
					<li class="media-body"><div class="review-summary-detal ">
						<?php foreach( array_reverse($counts) as $key => $value ):  $pc = ($count == 0 ? 0: ( ($value/$count)*100  ) );
						?>
							<div class="review-summery-item row">
								<div class="col-sm-1 col-lg-1 hidden-xs"></div>
								<?php $key = 5 - $key; ?>
								<div class="review-label col-sm-2 col-lg-2 col-xs-3"> <?php echo esc_html($key); ?> <?php 
								 ($key == 1) ? esc_html_e('Star','greenmart') : esc_html_e('Stars','greenmart'); ?></div> 
								<div class="col-sm-9 col-lg-9 col-xs-9">	
									<div class="progress">
									  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr($pc);?>%;">
									    <?php echo round($pc,0);?>%
									  </div>
									</div>
								</div>	
						 

							</div>
						<?php endforeach; ?>
					</div></li>	
				</ul>
				<div id="comments" class="comments">
					<h5><?php
						if ( $count && wc_review_ratings_enabled() ) {
							/* translators: 1: reviews count 2: product name */
							$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'greenmart' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
							echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
						} else {
							esc_html_e( 'Reviews', 'greenmart' );
						}
					?></h5>

					<?php if ( have_comments() ) : ?>

						<ul class="commentlist list-unstyled">
							<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
						</ul>

						<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
							echo '<nav class="woocommerce-pagination">';
							paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							) ) );
							echo '</nav>';
						endif; ?>

					<?php else : ?>

						<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'greenmart' ); ?></p>

					<?php endif; ?>
				</div>

			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 reviews-col2">

				<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

					<div id="review_form_wrapper" class="review_form_wrapper">
						<div id="review_form">
							<?php
								$commenter = wp_get_current_commenter();

								$comment_form = array(
									'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'greenmart' ) : esc_html__( 'Be the first to review', 'greenmart' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
									'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'greenmart' ),
									'comment_notes_before' => '',
									'comment_notes_after'  => '',
									'label_submit'  => esc_html__( 'Submit', 'greenmart' ),
									'logged_in_as'  => '',
									'comment_field' => ''
								);

								$name_email_required = (bool) get_option( 'require_name_email', 1 );
								$fields              = array(
									'author' => array(
										'type'     			=> 'text',
										'icon'				=> '<span class="fa fa-user"></span>',
										'placeholder'		=> esc_attr__('Name', 'greenmart'),
										'value'    			=> $commenter['comment_author'],
										'required' 			=> $name_email_required,
									),
									'email' => array(
										'type'     			=> 'email',
										'icon'				=> '<span class="fa fa-envelope"></span>',
										'placeholder'		=> esc_attr__('Email', 'greenmart'),
										'value'    			=> $commenter['comment_author_email'],
										'required' 			=> $name_email_required,
									),
								);
				
								$comment_form['fields'] = array();
				
								foreach ( $fields as $key => $field ) {
									$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
				
									if ( $field['icon'] ) {
										$field_html .= $field['icon']; 
									}

									$placeholder = ( !empty($field['placeholder']) ) ? 'placeholder="'. esc_attr($field['placeholder']) .'"' : '';
				
									$field_html .= '<input placeholder="'. esc_attr($field['placeholder']) .'" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';
				
									$comment_form['fields'][ $key ] = $field_html;
								}


								$account_page_url = wc_get_page_permalink( 'myaccount' );
								if ( $account_page_url ) {
									$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'greenmart' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
								}
								  
								if ( wc_review_ratings_enabled() ) {
									$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'greenmart' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
									<option value="">' . esc_html__( 'Rate&hellip;', 'greenmart' ) . '</option>
									<option value="5">' . esc_html__( 'Perfect', 'greenmart' ) . '</option>
									<option value="4">' . esc_html__( 'Good', 'greenmart' ) . '</option>
									<option value="3">' . esc_html__( 'Average', 'greenmart' ) . '</option>
									<option value="2">' . esc_html__( 'Not that bad', 'greenmart' ) . '</option>
									<option value="1">' . esc_html__( 'Very Poor', 'greenmart' ) . '</option>
									</select></div>';
								}

								$comment_form['comment_field'] .= '<p class="comment-form-comment form-group"><label class="control-label">' . esc_html__( 'Comment:', 'greenmart' ) .'</label><textarea id="comment" placeholder="'. esc_html('Type...', 'greenmart') .'"   class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

								comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
							?>
						</div>
					</div>

				<?php else : ?>

					<h4 class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'greenmart' ); ?></h4>

				<?php endif; ?>


			</div>
		</div>
	</div>	


	<div class="clear"></div>
</div>
</div>