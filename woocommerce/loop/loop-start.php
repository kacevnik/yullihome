<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
$col = '9';
$clear = '3';
if ($sidebar_position == 'left') {
    $position = 'col-sm-push-3';
} elseif ($sidebar_position == 'right') {
    $col = '9';
} elseif ($sidebar_position == 'none') {
    $col = '12';
} elseif ($sidebar_position ='full') {
    $col = '12';
    $clear = '4';
}

?>
<div class="row">
    <div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($position); ?> col-xs-b30 col-sm-b0 clearLeft<?php echo esc_attr($clear);?>">
