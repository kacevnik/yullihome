<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
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
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
	return;
}
wp_enqueue_script('sumoselect');
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<div class="col-md-6 col-xs-b50 col-md-b0">

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

                    <h4 class="h4 col-xs-b25"><?php _e( 'Calculate Shipping', 'ivy' ); ?></h4>
                        <select name="calc_shipping_country" id="calc_shipping_country" class="SlectBox country_to_state" rel="calc_shipping_state">
                            <option value=""><?php _e( 'Select a country&hellip;', 'ivy' ); ?></option>
                            <?php
                            foreach( WC()->countries->get_shipping_countries() as $key => $value )
                                echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>'; ?>
                        </select>

                    <div class="row m10">
                        <div class="col-sm-6">
                            <div class="simple-input-wrapper">
                            <?php
                            $current_cc = WC()->customer->get_shipping_country();
                            $current_r  = WC()->customer->get_shipping_state();
                            $states     = WC()->countries->get_states( $current_cc );

                            // Hidden Input
                            if ( is_array( $states ) && empty( $states ) ) { ?>
                                <input type="hidden" class="SlectBox simple-input" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county', 'ivy' ); ?>" />

                                <?php // Dropdown Input
                            } elseif ( is_array( $states ) ) { ?>
                                <select class="SlectBox" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'ivy' ); ?>">
							<option value=""><?php _e( 'Select a state&hellip;', 'ivy' ); ?></option>
                                    <?php
                                    foreach ( $states as $ckey => $cvalue )
                                        echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) .'</option>';
                                    ?>
						        </select>
                                <?php
                                // Standard Input
                            } else {
                                ?><input type="text" class="simple-input input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / county', 'ivy' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><span></span><?php

                            }
                            ?>
                            </div>
                        </div>

                        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
                        <div class="col-sm-6">
                            <div class="simple-input-wrapper" id="calc_shipping_postcode_field">
                                <input type="text" class="simple-input" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'ivy' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
                                <span></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
                        <div class="col-sm-6">
                            <div class="simple-input-wrapper">
                                <div class="simple-input-wrapper" id="calc_shipping_city_field">
                                    <input type="text" class="simple-input" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'ivy' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                    <a class="button"><button type="submit" name="calc_shipping" value="1" class="button update-totals"><?php _e( 'Update Totals', 'ivy' ); ?></button></a>
                    <?php wp_nonce_field( 'woocommerce-cart' ); ?>
</form>

</div>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
