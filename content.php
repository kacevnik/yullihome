<?php

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="row">
    <div class="col-sm-9 col-xs-b30 col-sm-b0">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            $post_opt = get_post_meta(get_the_ID(), '_ivy_post_meta_opt', true);
            $thumbnail = get_the_post_thumbnail_url();
            $permalink = get_the_permalink();
            $title = get_the_title();
            $output ='';
            if (!empty($post_opt)) {
                if (has_post_thumbnail() && $post_opt['_single_thumb_type'] == 'image') {
                    $output = '<div class="blog-preview blog-blockquote" style="background-image: url('. $thumbnail .');">';
                    $output .= '<div class="text-align">';
                    $output .= '<div class="text-content h3 light">' . $post_opt['_single_title'] . '</div>';
                    $output .= '</div></div>';
                } elseif ($post_opt['_single_thumb_type'] == 'vimeo') {
                    $output = '<div class="blog-preview embed-responsive embed-responsive-16by9">';
                    $output .= '<iframe src="https://player.vimeo.com/video/' . $post_opt['_single_vimeo'] . '"></iframe></div>';
                } elseif ($post_opt['_single_thumb_type'] == 'youtube') {
                    $output = '<a class="blog-preview mouseover-1">';
                    $output .= '<img src="' . $thumbnail . '" alt="' . $title . '" />';
                    $output .= '<img src="' . $thumbnail . '" alt="' . $title . '" />';
                    $output .= '<div class="play-button open-video" data-src="https://www.youtube.com/embed/'. $post_opt['_single_youtube'] .'?autoplay=1&amp;loop=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=light&amp;wmode=transparent"></div></a>';
                } elseif (has_post_thumbnail() && $post_opt['_single_thumb_type'] == 'std') {
                    $output =   '<a class="blog-preview mouseover-1" href="'. $permalink .'">';
                    $output .=   '<img src="'. $thumbnail .'" alt="'. $title .'" />';
                    $output .=   '<img src="'. $thumbnail .'" alt="'. $title .'" /></a>';
                }
            }
            ?>

            <div <?php post_class('blog-landing-entry'); ?> id="post-<?php the_ID(); ?>">
            <?php if (!empty($post_opt)){
                echo ivy_content($output);
            }  ?>
                <div class="row vertical-aligned-columns">
                    <div class="col-sm-3 text-center">
                        <div class="h3 blog-day"><?php the_time("d"); ?></div>
                        <div class="h6 blog-date"><?php the_time("M / y"); ?></div>
                        <div class="sa xsmall grey"><?php esc_html_e('by ', 'ivy');?><?php the_author(); ?></div>
                    </div>
                    <div class="col-sm-9">
                        <div class="sa small grey blog-data">
                            <?php echo ivy_get_simple_likes_button(get_the_ID()); ?>
                            <i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number('0', '1', '%'); ?>
                        </div>
                        <div class="h4 blog-title"><span class="ht-2"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span></div>
                        <div class="sa middle blog-description">
                            <?php the_excerpt(); ?>
                        </div>
                        <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('read more', 'ivy'); ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <!-- Post Pagination -->
            <?php pagination(); ?>
        <!-- end Post Pagination -->
    </div>
    <div class="col-sm-3">
        <?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'default-sidebar' ); ?>
        <?php endif; ?>
    </div>
</div>

    <div class="empty-space col-xs-b45 col-sm-b90"></div>

