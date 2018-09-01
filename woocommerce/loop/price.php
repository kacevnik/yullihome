<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<div class="price">

    <?php if ( $price_html = $product->get_price_html() ) :
        $sale           = get_post_meta( $product->id, '_sale_price', true);
        $regular        = get_post_meta( $product->id, '_regular_price', true);
        if( $sale ){
            $price = '<div class="sa dark"><b>'.wc_price($sale).'</b>&nbsp;&nbsp;<span class="line-through">'.wc_price($regular).'</span></div>';
        } else {
            $price = $regular;
        }
        echo $price;
    endif; ?>
</div>