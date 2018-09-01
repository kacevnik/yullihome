<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

$sidebar_position = ivy_get_option('sidebar_position');

if(!empty($_GET['sidebar'])){
   $sidebar_position = $_GET['sidebar'];
}

$container = 'container';
if ($sidebar_position == 'full'){
    $container = 'container-fluid';
    $visible = "style=display:none;";
}

if( ivy_get_option('shop_header_img_show') == 'show' ){
	$shop_title_header = ivy_get_option('shop_title_header');
	$shop_title_header = !empty($shop_title_header) ? $shop_title_header : '';

	$shop_header_img = ivy_get_option('shop_header_img');
	$shop_header_img = !empty($shop_header_img) ? $shop_header_img['url'] : '';

	$shop_header_img_border = ivy_get_option('shop_header_img_border');
	$shop_header_img_border = !empty($shop_header_img_border) ? $shop_header_img_border['url'] : '';
	?>

	<div class="fixed-background" style="background-image: url(<?php echo esc_url($shop_header_img); ?>);">
	    <div class="banner-shortcode">
	        <div class="banner-frame border-image" style="border-image-source: url(<?php echo esc_url($shop_header_img_border); ?>);"></div>
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="align">
	                        <h1 class="h1 light"><?php echo esc_html($shop_title_header); ?></h1>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php } ?>

<div class="<?php echo esc_attr($container); ?>">
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
            $shop_title = ivy_get_option('shop_title');
            !empty($shop_title) ? $shop_title : woocommerce_page_title();

            $shop_subtitle = ivy_get_option('shop_subtitle');
            !empty($shop_subtitle) ? $shop_subtitle : '';
            ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <article class="sa">
                        <h3><?php echo esc_html($shop_title); ?></h3>
                        <p><?php echo esc_html($shop_subtitle); ?></p>
                    </article>
                    <div class="empty-space col-xs-b35 col-sm-b70"></div>
                </div>
            </div>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );

			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );

	?>
</div>
<?php get_footer(); ?>
