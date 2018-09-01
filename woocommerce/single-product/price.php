<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <div class="row col-xs-b25">
        <!--start row col-xs-b25 || single-product/rating end-->
    <div class="col-sm-6 variationPrice sa large dark">
    <?php

        $sale           = get_post_meta( $product->id, '_sale_price', true);
        $regular        = get_post_meta( $product->id, '_regular_price', true);
         if( $sale ){
        $price = '<div class="sa large dark"><b>'.wc_price($sale).'</b></span>&nbsp&nbsp&nbsp&nbsp<span class="line-through">'.wc_price($regular).'</span>';
        } else {
        $price = wc_price($regular);
        }
        if ($product->is_type( 'variable' )){$price= '<div class="col-sm-6">';}
        echo $price;
    ?>
    </div>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
