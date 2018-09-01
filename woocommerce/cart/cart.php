<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_script('sumoselect');
echo woocommerce_breadcrumb();
$cart_title = ivy_get_option('cart_title');
!empty($cart_title) ? $cart_title : get_the_title();

$cart_subtitle = ivy_get_option('cart_subtitle');
!empty($cart_subtitle) ? $cart_subtitle : '';
?>

<div class="row">
    <div class="col-md-12 text-center">
        <article class="sa">
            <h3><?php echo esc_html($cart_title); ?></h3>
            <p><?php echo esc_html($cart_subtitle); ?></p>
        </article>
        <div class="empty-space col-xs-b25 col-sm-b50"></div>
    </div>
</div>

<?php  wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>


<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>
<div class="table-responsive">
    <table class="cart-table shop_table shop_table_responsive cart" cellspacing="0">
        <thead>
            <tr>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name"><?php _e( 'Product Name', 'ivy' ); ?></th>
                <th class="product-price"><?php _e( 'Price', 'ivy' ); ?></th>
                <th class="product-quantity"><?php _e( 'Quantity', 'ivy' ); ?></th>
                <th class="product-subtotal"><?php _e( 'Total', 'ivy' ); ?></th>
                <th class="product-remove">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                        <td class="product-thumbnail" data-title=" ">
                            <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                if ( ! $product_permalink ) {
                                    echo $thumbnail;
                                } else {
                                    printf( '<a class="cart-entry-thumbnail" href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                }
                            ?>
                        </td>

                        <td class="product-name data-title=" "" data-title="<?php _e( 'Product', 'ivy' ); ?>">
                            <?php
                                if ( ! $product_permalink ) {
                                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
                                } else {
                                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
                                }

                                // Meta data
                                echo WC()->cart->get_item_data( $cart_item );

                                // Backorder notification
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'ivy' ) . '</p>';
                                }
                            ?>
                        </td>

                        <td class="product-price" data-title="<?php _e( 'Price', 'ivy' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            ?>
                        </td>

                        <td class="product-quantity" data-title="<?php _e( 'Quantity', 'ivy' ); ?>">
                            <?php
                                if ( $_product->is_sold_individually() ) {
                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
                                    $product_quantity = woocommerce_quantity_input( array(
                                        'input_name'  => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item['quantity'],
                                        'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                        'min_value'   => '0'
                                    ), $_product, false );
                                }

//                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
//                            ?>


                            <input step="1" min="0" max="<?php echo ( $_product->backorders_allowed() ? '' : $_product->get_stock_quantity() ) ?>" name="<?php echo "cart[{$cart_item_key}][qty]"; ?>" value="<?php echo $cart_item['quantity']?>" class="input-text qty text" size="4" type="hidden">

                            <div class="cart-quantity-select" >
                                <span class="cart-minus"></span>
                                <span class="cart-number"><?php echo $cart_item['quantity']?></span>
                                <span class="cart-plus"></span>
                            </div>
                        </td>

                        <td class="product-subtotal" data-title="<?php _e( 'Total', 'ivy' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                            ?>
                        </td>

                        <td class="product-remove">
                            <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="button-close remove" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'ivy' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }

            do_action( 'woocommerce_cart_contents' );
            ?>
        </tbody>
    </table>
</div>
    <div class="empty-space col-xs-b35"></div>
    <div class="row">
        <div class="col-sm-6 col-md-5 col-xs-b10 col-sm-b0">

            <?php if ( wc_coupons_enabled() ) { ?>
            <div class="simple-input-wrapper">
                <input type="text" name="coupon_code" class="simple-input input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter your coupon code', 'ivy' ); ?>" />
                <span></span>
            </div>
                <div class="button"><?php esc_attr_e( 'Submit code', 'ivy' ); ?><input type="submit" class="button" name="apply_coupon" value="" /></div>

                    <?php do_action( 'woocommerce_cart_coupon' ); ?>

            <?php } ?>
        </div>
        <div class="col-sm-6 col-md-7 col-sm-text-right">
            <div class="buttons-wrapper">
                <a class="button style-1"><input type="submit" name="update_cart"><?php esc_attr_e( 'Update Cart', 'ivy' ); ?></a>
                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_cart_actions' ); ?>

        <?php wp_nonce_field( 'woocommerce-cart' ); ?>
    </div>



            <?php do_action( 'woocommerce_after_cart_contents' ); ?>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>
<div class="empty-space col-xs-b35 col-md-b70"></div>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
