<?php

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div <?php post_class('row'); ?> id="post-<?php the_ID(); ?>" >
    <div class="col-sm-9 col-xs-b30 col-sm-b0">
        <h2 class="h4 col-xs-b15"><?php the_title(); ?></h2>
        <div class="row col-xs-b15">
            <div class="col-sm-6">
                <div class="sa xsmall grey"><?php the_time("M / Y"); ?> <?php esc_html_e('  by ', 'ivy');?><?php echo get_the_author_meta(get_the_ID()); ?></div>
            </div>
            <div class="col-sm-6 col-sm-text-right">
                <div class="sa small grey blog-data">
                    <?php echo ivy_get_simple_likes_button(get_the_ID()); ?>
                    <i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number('0', '1', '%'); ?>
                </div>
            </div>
        </div>
        <div class="sa">
            <?php if (has_post_thumbnail()) { ?>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
            <?php } ?>
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>
        <div class="empty-space col-xs-b30"></div>
        <div class="row">
            <div class="col-sm-6 col-xs-b30 col-sm-b0">
                <?php ivy_tags(); ?>
            </div>
            <div class="col-sm-6 col-sm-text-right">
                <?php if(function_exists( 'ivy_plugin_load_scripts' )){ ?>
                    <div class="follow style-1">
                        <h6 class="title h6"><?php esc_html_e('Share', 'ivy' )?></h6>
                        <a class="entry" href="#"><span class='st_pinterest' ><i class="fa fa-pinterest"></i></span></a>
                        <a class="entry" href="#" target="_blank"><span class='st_facebook' ><i class="fa fa-facebook"></i></span></a>
                        <a class="entry" href="#" target="_blank"><span class='st_twitter' ><i class="fa fa-twitter"></i></span></a>
                        <a class="entry" href="#" target="_blank"><span class='st_plusone_large' ><i class="fa fa-google-plus"></i></span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="empty-space col-xs-b45 col-sm-b90"></div>

        <?php
        $query = new WP_Query(array('posts_per_page' => 2, 'post_type' => 'post'));
        if ( $query->have_posts() ) : ?>
        <h4 class="h4 blog-column-title"><?php esc_html_e('Related posts', 'ivy'); ?></h4>
        <div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-sm-6">
                <div class="blog-small-entry size-2">
                    <?php if(has_post_thumbnail())  { ?>
                        <a class="blog-small-preview mouseover-1" href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </a>
                    <?php } ?>
                    <div class="h6 blog-small-title"><span class="ht-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></div>
                    <div class="row col-xs-b5">
                        <div class="col-sm-8">
                            <div class="sa xsmall grey blog-small-data"><?php the_time("M / Y"); ?><?php esc_html_e('  by ', 'ivy');?><?php the_author(); ?></div>
                        </div>
                        <div class="col-sm-4 col-sm-text-right">
                            <div class="sa small grey blog-data">
                                <?php echo ivy_get_simple_likes_button( get_the_ID() ); ?>
                                <i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number('0', '1', '%'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="sa middle blog-small-description"><?php the_excerpt(); ?></div>
                    <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'ivy');?></a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <!--COMMENTS-->
        <?php if ( comments_open() or get_comments_number() ) {  ?>
            <div class="empty-sp-md-80 empty-sp-sm-60 empty-sp-xs-40"></div>
            <?php comments_template( '', true );  ?>
        <?php	}  ?>

    </div>
    <div class="col-sm-3">
        <?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'default-sidebar' ); ?>
        <?php endif; ?>
    </div>
</div>