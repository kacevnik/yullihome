<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 */

get_header(); ?>

    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
         endwhile; endif; ?>
    </div>
    <div class="row m0">
        <?php

        $terms = get_terms('portfolio_cats', array('hide_empty' => 1) );
        $curent_term_array = wp_get_post_terms(get_the_ID(), 'portfolio_cats', array("fields" => "ids"));
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio_cats',
                    'field' => 'id',
                    'terms' => $curent_term_array,
                ),
            ),
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            $portfolio_categories = wp_get_post_terms( get_the_ID(), 'portfolio_cats' );
            $display_cats = array();
            foreach ( $portfolio_categories as $single_cat ) {
                  $display_cats[] =  $single_cat->name;
            }
            $display_cats = implode( ' / ', $display_cats );

            // aq resizer
            $thumb = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
            $image = aq_resize( $img_url, '635', '455', true, true, true ); //resize & crop the image
        ?>
            <div class="col-sm-4">
                <a class="thumbnail-shortcode-3 mouseover-1" href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" />
                    <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" />
                    <span class="content">
            <span class="sl light"><?php echo $display_cats; ?></span>
            <span class="title h4 light"><?php the_title();?></span>
            </span>
                </a>
            </div>
        <?php endwhile; endif; ?>
    </div>

<?php get_footer(); ?>