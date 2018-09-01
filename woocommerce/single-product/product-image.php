<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;
?>
<div class="col-sm-6 col-xs-b30 col-sm-b0">
    <div class="main-product-slider-wrapper swipers-couple-wrapper">
        <?php
        if ( has_post_thumbnail() ) {
            $attachment_ids = $product->get_gallery_attachment_ids(); ?>
            <div class="swiper-container swiper-control-top">
                    <div class="swiper-button-prev hidden"></div>
                    <div class="swiper-button-next hidden"></div>
                    <div class="swiper-wrapper">
                       <?php foreach ($attachment_ids as $attachment_id) {
                           $image_link = wp_get_attachment_image_url($attachment_id, '', true); ?>
                            <div class="swiper-slide">
                            <div class="swiper-lazy-preloader"></div>
                            <div class="product-big-preview-entry swiper-lazy" data-background="<?php echo esc_url($image_link); ?>"></div></div>
                    <?php } ?>
                    </div>
                </div>
                <div class="empty-space col-xs-b15 col-sm-b30"></div>
                <div class="swiper-container swiper-control-bottom" data-breakpoints="1" data-xs-slides="3" data-sm-slides="3" data-md-slides="4" data-lt-slides="4" data-slides-per-view="5" data-center="1" data-clickedslide="1">
                    <div class="swiper-button-prev hidden"></div>
                    <div class="swiper-button-next hidden"></div>
                    <div class="swiper-wrapper">
                <?php foreach ($attachment_ids as $attachment_id) {
                     $image_link = wp_get_attachment_image_url($attachment_id, '', true);
                     $item = '<div class="swiper-slide">';
                     $item .= '<div class="product-small-preview-entry" style="background-image: url(' . esc_url($image_link) . ');"><div class="content"></div></div></div>';
                     echo $item;
                }?>

                    </div>
                </div>
        <?php } else { echo wc_placeholder_img_src(); } ?>
    </div>
</div>