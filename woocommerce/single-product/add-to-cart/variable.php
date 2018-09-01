<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $woocommerce;

// get product variation
$_product_variation = wc_get_product( $product->id );

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
        <?php do_action( 'woocommerce_before_variations_form' ); ?>

        <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
            <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'ivy' ); ?></p>
        <?php else : ?>

        <?php if($attributes) : ?>
<!--             <div class="row col-xs-b40">
                <div class="col-sm-3">
                    <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                        <div class="attr-name-variation h6 detail-data-title size-1"><?php echo wc_attribute_label( $attribute_name ); ?>:</div>
                    <?php endforeach;?>
                </div>

                <div class="col-sm-9">
                    <select class="SlectBox variation-data">
                        <option disabled="disabled" selected="selected"><?php esc_html_e('Choose an option', 'ivy')?></option>
                        <?php $available_variations = $_product_variation->get_available_variations();
                        foreach ($available_variations as $prod_variation) : ?>
                            <?php foreach ($prod_variation['attributes'] as $attr_name => $attr_value) : ?>
                                <option value="<?php echo esc_attr($prod_variation['variation_id']); ?>"><?php echo esc_html($attr_value); ?></option>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </select>
                </div>
            </div> -->

        <?php endif; ?>
        
        <table class="variations" cellspacing="0">
            <tbody>
                <?php foreach ( $attributes as $attribute_name => $options ) : ?> 
                    <tr>
                        <td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ) . ':'; ?></label></td>
                        <td class="value">
                            <?php
                                $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                                wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                            ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

            <div class="single_variation_wrap">
                <?php
                /**
                 * woocommerce_before_single_variation Hook.
                 */
                do_action( 'woocommerce_before_single_variation' );

                /**
                 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );

                /**
                 * woocommerce_after_single_variation Hook.
                 */
                do_action( 'woocommerce_after_single_variation' );
                ?>
            </div>

            <div class="row m5 col-xs-b40">
                <div class="col-sm-6 col-xs-b10 col-sm-b0">
                    <a class="button block style-2 add-to-cart add-to-cart-variable disabled" data-variation_id="0" data-product_id="<?php echo $product->id; ?>" data-quantity="1" data-value=""><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php esc_html_e('add to cart', 'ivy' )?></a>
                </div>
                <div class="col-sm-6 add-to-favourites">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                </div>
            </div>

            <?php if(function_exists( 'ivy_load_scripts' )){ ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="h6 detail-data-title size-2"><?php esc_html_e('Share:', 'ivy' )?></div>
                    </div>
                    <div class="col-sm-9">
                        <div class="follow style-1">
                            <h6 class="title h6"></h6>
                            <a class="entry" href="#"><span class='st_pinterest' st_title="<?php echo get_the_title($product_id);?>" st_url="<?php echo get_the_permalink($product_id); ?>" ><i class="fa fa-pinterest"></i></span></a>
                            <a class="entry" href="#" target="_blank"><span class='st_facebook' st_title="<?php echo get_the_title($product_id);?>" st_url="<?php echo get_the_permalink($product_id); ?>"><i class="fa fa-facebook"></i></span></a>
                            <a class="entry" href="#" target="_blank"><span class='st_twitter' st_title="<?php echo get_the_title($product_id);?>" st_url="<?php echo get_the_permalink($product_id); ?>"><i class="fa fa-twitter"></i></span></a>
                            <a class="entry" href="#" target="_blank"><span class='st_plusone_large' st_title="<?php echo get_the_title($product_id);?>" st_url="<?php echo get_the_permalink($product_id); ?>"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_variations_form' ); ?>
    </form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
