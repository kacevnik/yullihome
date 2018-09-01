<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

wp_enqueue_script('sumoselect');


$sidebar_position_product = ivy_get_option('sidebar_position_product');
$position = '';
$col = '9';

if (isset($_GET['sidebarDetail'])){
    $sidebar_position_product = $_GET['sidebarDetail'];
}

if ($sidebar_position_product == 'left') {
    $position = 'col-sm-push-3';
} elseif ($sidebar_position_product == 'right') {
    $position = '';
    $col = '9';
} elseif ($sidebar_position_product == 'none') {
    $col = '12';
}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($position); ?> col-xs-b30 col-sm-b0">

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>


<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
        <div class="col-sm-6">
            <div class="summary entry-summary">

                <?php
                    /**
                     * woocommerce_single_product_summary hook.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action( 'woocommerce_single_product_summary' );
                ?>

            </div><!-- .summary -->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="tabs-block">
            <?php
                /**
                 * woocommerce_after_single_product_summary hook.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>
    </div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
        </div>
    </div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php
$sidebar_position_product = ivy_get_option('sidebar_position_product');
$position = '';
$col = '3';
$visible = '';

if (isset($_GET['sidebarDetail'])){
    $sidebar_position_product = $_GET['sidebarDetail'];
}

if ($sidebar_position_product == 'left'){
    $position = 'col-sm-pull-9';
} elseif ($sidebar_position_product == 'right') {
    $col = '3';
} elseif ($sidebar_position_product == 'none') {
    $visible = "style=display:none;";
}
?>

<div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($position); ?>" <?php echo esc_attr($visible); ?>>
    <?php if ( is_active_sidebar( 'woocommerce-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
