<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The main template file.
 *
 * It is used to show single post.
 *
 */

get_header();

$blog_title = ivy_get_option('blog_title');
!empty($blog_title) ? $blog_title : get_the_title();

$blog_subtitle = ivy_get_option('blog_subtitle');
!empty($blog_subtitle) ? $blog_subtitle : '';

?>
    <div class="container">
        <div class="empty-space col-xs-b40 col-sm-b80"></div>
        <div class="row">
            <div class="col-md-12 text-center">
                <article class="sa">
                    <h3><?php echo esc_html($blog_title); ?></h3>
                    <p><?php echo esc_html($blog_subtitle); ?></p>
                </article>
                <div class="empty-space col-xs-b35 col-sm-b70"></div>
            </div>
        </div>
        <?php get_template_part( 'content', 'single' ); ?>
        <div class="empty-space col-xs-b45 col-sm-b90"></div>
    </div>
<?php get_footer(); ?>