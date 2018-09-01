<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>

<div class="empty-space col-xs-b50"></div>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title h6 col-xs-b5"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'ivy' ), $count, '<span>', get_the_title(), '</span>' );
			else
				_e( 'Reviews', 'ivy' );
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

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

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'ivy' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( '<div class="h6 col-xs-b5">Add a review</div>', 'ivy' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'ivy' ), get_the_title() ),
						'title_reply_to'       => __( '<div class="h6 col-xs-b5">Leave a Reply to %s</div>', 'ivy' ),
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '
<div class="row"><div class="col-sm-6"><div class="simple-input-wrapper"><p class="comment-form-author">' . '<span class="required"></span>' .
										'<input id="author" name="author" type="text" class="simple-input" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'ivy' ) . ' " size="30" aria-required="true" required /><span></span></div></div></p>',
							'email'  => '<div class="col-sm-6"><div class="simple-input-wrapper"><p class="comment-form-email"><span class="required"></span>' .
										'<input id="email" name="email" type="email" class="simple-input" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'ivy' ) . '" size="30" aria-required="true" required /><span></span></p></div></div></div>',
						),
						'label_submit'  => __( 'Submit', 'ivy' ),
						'logged_in_as'  => __('', 'ivy'),
						'comment_field' => __('', 'ivy')
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'ivy' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( '<div class="h6 col-xs-b5">Your Rating</div>', 'ivy' ) .'</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . __( 'Rate&hellip;', 'ivy' ) . '</option>
							<option value="5">' . __( 'Perfect', 'ivy' ) . '</option>
							<option value="4">' . __( 'Good', 'ivy' ) . '</option>
							<option value="3">' . __( 'Average', 'ivy' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'ivy' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'ivy' ) . '</option>
						</select></p>';
					}

					$comment_form['comment_field'] .= '<div class="simple-input-wrapper"><p class="comment-form-comment"><span class="required"></span><textarea class="simple-input" id="comment" name="comment" placeholder="' . __( 'Your Review', 'ivy' ) . ' " cols="45" rows="8" aria-required="true" required></textarea><span></span></p></div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'ivy' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
