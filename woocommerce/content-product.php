<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
wp_enqueue_script('sumoselect');
$sidebar_position = ivy_get_option('sidebar_position');

if(!empty($_GET['sidebar'])){
   $sidebar_position = $_GET['sidebar'];
}

$lg = '';
if ($sidebar_position == 'full') {
    $lg = 'col-lg-3';
}
?>
    <div <?php post_class("col-sm-6 col-md-4 {$lg} product-shortcode-column"); ?>">
        <div class="product-shortcode">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
    /**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
    echo '<div class="h6 title"><span class="ht-2"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></span></div>';

    $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
    echo $product->get_categories( ', ', '<div class="description"><div class="text"><div class="sa small">' . _n( '', '', $cat_count, 'ivy' ) . ' ', '</div></div></div>' );
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
//	do_action( 'woocommerce_after_shop_loop_item' );
	?>
    </div>
</div>
