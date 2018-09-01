<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Page Template
 *
 */
	get_header(); ?>
    <div class="empty-sp-sm-20 empty-sp-xs-10"></div>
    <div class="empty-sp-sm-100 empty-sp-xs-30"></div>
<!-- MAIN CONTENT BLOCK -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="container" id="page-<?php the_ID(); ?>">
            <!-- <div class="sa"> -->
            <?php the_content();
            wp_link_pages()
            ?>
            <!-- </div> -->
            <?php if ( comments_open() or get_comments_number()) {  ?>
                <div class="empty-sp-md-80 empty-sp-sm-60 empty-sp-xs-40"></div>
                    <?php comments_template( '', true ); ?>
                <div class="empty-space col-xs-b45 col-sm-b90"></div>
            <?php } ?>
        </div>
    <?php endwhile; endif;?>
<?php get_footer(); ?>