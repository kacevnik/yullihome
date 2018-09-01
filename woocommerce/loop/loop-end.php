<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
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
$sidebar_position = ivy_get_option('sidebar_position');

if(!empty($_GET['sidebar'])){
   $sidebar_position = $_GET['sidebar'];
}

$position = '';
$col = '3';
$visible = '';
if ($sidebar_position == 'left') {
    $position = 'col-sm-pull-9';
} elseif ($sidebar_position == 'none') {
    $col = '12';
    $visible = "style=display:none;";
} elseif ($sidebar_position == 'full') {
    $col = '12';
    $visible = "style=display:none;";
}

?>
        </div>

<div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($position); ?>" <?php echo esc_attr($visible); ?>>
    <?php if ( is_active_sidebar( 'woocommerce-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
    <?php endif; ?>
</div>
    </div>
