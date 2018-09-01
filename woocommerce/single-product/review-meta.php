<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment, $product;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>
    <p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'ivy' ); ?></em></p>
<?php } else { ?>
    <div class="row col-xs-b20">
        <div class="col-xs-8">
            <strong itemprop="author" class="h6 col-xs-b5"><?php comment_author(); ?></strong>
            <?php if ( $rating_html = $product->get_rating_html() ) : ?>
                <?php echo $rating_html; ?>
            <?php endif; ?>
        </div>
        <div class="col-xs-4 text-right">
            <div class="meta">
            <?php if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                    echo '<em class="verified">(' . esc_attr__( 'verified owner', 'ivy' ) . ')</em> ';
            } ?>
            <div class="sa size-1 grey">
                <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
            </div>
            </div>
        </div>
    </div>

<?php }
