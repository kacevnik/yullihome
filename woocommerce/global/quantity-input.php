<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
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
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="quantity row col-xs-b40">
    <div class="col-sm-3">
        <div class="h6 detail-data-title size-1"><?php esc_html_e('Quantity:', 'ivy'); ?></div>
    </div>
    <div class="col-sm-9">
        <div class="quantity-select">
            <span class="minus"></span>
            <span class="number"><?php esc_html_e('1', 'ivy'); ?></span>
            <span class="plus"></span>
        </div>
    </div>
</div>