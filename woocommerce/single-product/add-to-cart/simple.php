<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() ) {
	 			woocommerce_quantity_input( array(
	 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
	 			) );
	 		}
	 	?>

    <div class="row m5 col-xs-b40">
        <div class="col-sm-6 col-xs-b10 col-sm-b0">
            <a class="button block style-2 add-to-cart " href="#" data-product_id="<?php echo $product->id; ?>" data-quantity="1"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php esc_html_e('add to cart', 'ivy' )?></a>
        </div>
        <div class="col-sm-6 add-to-favourites">
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
        </div>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>


<?php if(function_exists( 'ivy_plugin_load_scripts' )){ ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="h6 detail-data-title size-2"><?php esc_html_e('Share:', 'ivy' )?></div>
        </div>
        <div class="col-sm-9">
            <div class="follow style-1">
                <a class="entry" href="#"><span class='st_pinterest' ><i class="fa fa-pinterest"></i></span></a>
                <a class="entry" href="#" target="_blank"><span class='st_facebook' ><i class="fa fa-facebook"></i></span></a>
                <a class="entry" href="#" target="_blank"><span class='st_twitter' ><i class="fa fa-twitter"></i></span></a>
                <a class="entry" href="#" target="_blank"><span class='st_plusone_large' ><i class="fa fa-google-plus"></i></span></a>
            </div>
        </div>
    </div>
<?php } ?>
