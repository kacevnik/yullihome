<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
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

global $post, $product;

if ( ! $post->post_excerpt ) {
	return;
}

	// Availability
	$availability      = $product->get_availability();
    if ($availability['class'] == 'in-stock'){
        $avalible = '<b style="color: #20a711;">'.esc_html__(' YES', 'ivy').'</b>';
    } else {
        $avalible = '<b style="color: #be0000;">'.esc_html__(' NO', 'ivy').'</b>';
    }
?>

<div itemprop="description">
    <div class="detail-info-background">
        <div class="row">
            <div class="col-sm-6">
                <?php if($product->get_sku()) : ?>
                    <div class="sa dark col-xs-b5"><?php esc_attr_e('ITEM NO.:', 'ivy'); ?> <b><?php echo $product->get_sku(); ?></b></div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 col-sm-text-right">
                <div class="sa dark col-xs-b20"><?php esc_html_e('AVAILABLE.:', 'ivy');?> <?php echo wp_kses_post($avalible); ?></div>
            </div>
        </div>
        <div class="sa small"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>
    </div>
</div>