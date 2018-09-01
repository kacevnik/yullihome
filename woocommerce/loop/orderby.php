<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sidebar_position = ivy_get_option('sidebar_position');

if(!empty($_GET['sidebar'])){
   $sidebar_position = $_GET['sidebar'];
}

$sorting = 'text-right';
$position = '';
$col = '9';
if ($sidebar_position == 'left'){
    $position = 'col-sm-push-3';
} elseif ($sidebar_position == 'none') {
    $col = '12';
    $sorting = 'text-left';
} elseif ($sidebar_position == 'right') {
    $col = '9';
    $sorting = 'text-left';
} elseif ($sidebar_position == 'full') {
    $col = '12';
    $sorting = 'text-left';
}

?>

    <div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($position); ?> col-xs-b30 col-sm-b0">
        <div class="filters-line">

            <div class="filters-mode-wrapper">
                <div class="toggle-mode mode-1 active">
                    <img src="<?php echo THEME_URI ?>/assets/img/icon-7.png" alt="" />
                    <img src="<?php echo THEME_URI ?>/assets/img/icon-8.png" alt="" />
                </div>
                <div class="toggle-mode mode-2">
                    <img src="<?php echo THEME_URI ?>/assets/img/icon-9.png" alt="" />
                    <img src="<?php echo THEME_URI ?>/assets/img/icon-10.png" alt="" />
                </div>
            </div>

            <div class="align-wrapper <?php echo esc_attr($sorting); ?>">
                <div class="align-item size-1">
                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby SlectBox">
                            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                            // Keep query string vars intact
                            foreach ( $_GET as $key => $val ) {
                                if ( 'orderby' === $key || 'submit' === $key ) {
                                    continue;
                                }
                                if ( is_array( $val ) ) {
                                    foreach( $val as $innerVal ) {
                                        echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                                    }
                                } else {
                                    echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                                }
                            }
                        ?>
                    </form>
                </div>

                <?php
                    $post_pages = ivy_get_option('ppp');                  
                    $post_pages = explode(',' ,$post_pages);
                    array_unshift($post_pages, get_option( 'posts_per_page' ));
                    sort($post_pages);
                ?>
                
                <div class="align-item size-2">
                    <div class="filter-text"><b><?php esc_html_e('View', 'ivy')?></b></div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>/shop/" method="get" id="product_ppp">
                        <select class="SlectBox" name="ppp">
                            <?php foreach ($post_pages as $post_page) { ?>
                                <option value="<?php echo esc_attr($post_page); ?>"<?php if ( isset($_GET['ppp']) && $post_page == $_GET['ppp']) echo 'selected'; ?>><?php if ($post_page == '-1') $post_page = 'All'; echo esc_attr($post_page); ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit"/>
                    </form>
                    <div class="filter-text"><b><?php esc_html_e('per page', 'ivy')?></b></div>
                </div>
            </div>
        </div>
    </div>



