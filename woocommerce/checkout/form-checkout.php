<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'ivy' ) );
	return;
}
wp_enqueue_script('sumoselect');
echo woocommerce_breadcrumb();

$checkout_title = ivy_get_option('checkout_title');
!empty($checkout_title) ? $checkout_title : get_the_title();

$checkout_subtitle = ivy_get_option('checkout_subtitle');
!empty($checkout_subtitle) ? $checkout_subtitle : '';

?>

<div class="row">
    <div class="col-md-12 text-center">
        <article class="sa">
            <h3><?php echo esc_html($checkout_title); ?></h3>
            <p><?php echo esc_html($checkout_subtitle); ?></p>
        </article>
        <div class="empty-space col-xs-b25 col-sm-b50"></div>
    </div>
</div>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
    <div class="row">
        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <div id="customer_details">
            <div class="col-md-6 col-xs-b50 col-md-b0">
                <?php do_action( 'woocommerce_checkout_billing' ); ?>

                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php endif; ?>

<!--    <h3 id="order_review_heading">--><?php //_e( 'Your order', 'ivy' ); ?><!--</h3>-->

        <div class="col-md-6">
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
    </div>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
