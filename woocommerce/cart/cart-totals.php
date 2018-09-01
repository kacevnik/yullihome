<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
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
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
    <?php do_action( 'woocommerce_before_cart_totals' ); ?>
    <div class="row">



    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

    <?php endif; ?>



        <div class="col-md-6">
            <h4 class="h4 col-xs-b25"><?php _e( 'Cart Totals', 'ivy' ); ?></h4>
            <div class="order-details-entry dark">
                <div class="row">
                    <div class="col-xs-6">
                        <?php _e( 'Cart subtotal', 'ivy' ); ?>
                    </div>
                    <div class="col-xs-6 col-xs-text-right">
                        <b><?php wc_cart_totals_subtotal_html(); ?></b>
                    </div>
                </div>
            </div>

            <div class="order-details-entry dark">
                <div class="row">

                    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

                    <div class="col-xs-6">
                        <?php esc_attr_e( 'Order total', 'ivy' ); ?>
                    </div>
                    <div class="col-xs-6 col-xs-text-right">
                        <b><?php wc_cart_totals_order_total_html(); ?></b>
                    </div>

                    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
                </div>
            </div>
            <?php if (WC()->cart->get_coupons()) : ?>
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
        </div>
    </div>
    <?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>



		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>(' . __( 'estimated for %s', 'ivy' ) . ')</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
						<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>


<div class="empty-space col-xs-b45 col-sm-b90"></div>