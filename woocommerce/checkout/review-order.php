<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
?>

    <h5 class="h5 col-xs-b25"><?php esc_html_e( 'Your order', 'ivy' ); ?></h5>
            <?php
            do_action( 'woocommerce_review_order_before_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    ?>
            <div class="cart-entry clearfix <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <a class="cart-entry-thumbnail" id="<?php echo $_product->id;?>" href="<?php echo get_the_permalink($_product->id);?>"><img src="<?php echo get_the_post_thumbnail_url($_product->id)?>" alt=""></a>
                <div class="cart-entry-description">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="h6"><a href="<?php echo get_the_permalink($_product->id);?>"><span class="ht-2"><?php echo get_the_title($_product->id); ?></span></a></div>
                                    <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <div class="sa size-1">' . sprintf( 'Quantity: %s', $cart_item['quantity'] ) . '</div>', $cart_item, $cart_item_key ); ?>
                                </td>
                                <td>
                                    <div class="sa large"> <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
                                    <div class="sa large"><?php echo esc_html_e('Total:' ,'ivy'); ?> <b><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></b></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <?php
                }
            }
            ?>



    <div class="empty-space col-xs-b30"></div>
    <div class="order-details-entry dark">
        <div class="row">
            <div class="col-xs-6">
                <?php esc_html_e( 'Cart subtotal', 'ivy' ); ?>
            </div>
            <div class="col-xs-6 col-xs-text-right">
                <b><?php wc_cart_totals_subtotal_html(); ?></b>
            </div>
        </div>
    </div>

    <?php if ( WC()->cart->get_coupons() ) : ?>
        <div class="order-details-entry dark">
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="row cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <div class="col-xs-6">
                        <?php wc_cart_totals_coupon_label( $coupon ); ?>
                    </div>
                    <div class="col-xs-6 col-xs-text-right">
                        <b><?php wc_cart_totals_coupon_html( $coupon ); ?></b>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="order-details-entry dark">
        <div class="row">

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                <?php wc_cart_totals_shipping_html(); ?>

                <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

            <?php endif; ?>

        </div>
    </div>
    <div class="order-details-entry dark">
        <div class="row">
            <div class="col-xs-6">
                <?php esc_html_e( 'Order total', 'ivy' ); ?>
            </div>
            <div class="col-xs-6 col-xs-text-right">
                <b><?php echo wc_cart_totals_order_total_html(); ?></b>
            </div>
        </div>
    </div>


    <div class="empty-space col-xs-b50"></div>

    <?php do_action( 'woocommerce_review_order_after_cart_contents' ); ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>


		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
