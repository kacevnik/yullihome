<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
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


<div class="wc_payment_method payment_method_<?php echo $gateway->id; ?> order-details-entry dark">

    <label for="payment_method_<?php echo $gateway->id; ?>" class="sc">
        <input id="payment_method_<?php echo $gateway->id; ?>" name="payment_method" class="simple-text input-radio" type="radio" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?>><span><?php echo $gateway->get_title(); ?></span>
    </label>

	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="sa small cart-entry payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</div>
