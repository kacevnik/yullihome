<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The main template file.
 *
 *
 */

 get_header();
$blog_head_title = ivy_get_option('blog_title');
$blog_head_title = !empty($blog_head_title) ? $blog_head_title : '';

$blog_head_subtitle = ivy_get_option('blog_subtitle');
$blog_head_subtitle = !empty($blog_head_subtitle) ? $blog_head_subtitle : '';
?>
<div class="container">
    <div class="empty-space col-xs-b40 col-sm-b80"></div>

    <div class="row">
        <div class="col-md-12 text-center">
            <article class="sa">
                <h3><?php echo esc_html($blog_head_title); ?></h3>
                <p><?php echo esc_html($blog_head_subtitle); ?></p>
            </article>
            <div class="empty-space col-xs-b35 col-sm-b70"></div>
        </div>
    </div>
<!-- MAIN CONTENT BLOCK -->
<?php get_template_part( 'content' ); ?>
</div>
<?php get_footer(); ?>