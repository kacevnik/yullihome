<?php
if ( ! defined( 'ABSPATH' ) ) exit;

//--Instagram
//INSTAGRAM WIDGET
class Ivy_Instagram_Widget extends WP_Widget {

// Create Widget
    function __construct() {
        parent::__construct(false, $name = 'IVY Instagram widget', array('description' => 'Widget with Instagram images.'));
    }


// Widget Content
    function widget($args, $instance) {
        extract( $args );
        $instagram_userid = strip_tags($instance['instagram_userid']);
        $instagram_access_token = strip_tags($instance['instagram_access_token']);
        $inst_id = uniqid();
        $img_limit = strip_tags($instance['img_limit']);
        $title = strip_tags($instance['title']);
        $profile_link = strip_tags($instance['profile_link']);
        ?>


        <div class="sidebar-entry mb0">
            <div class="sidebar-title h6"><?php print esc_html($title); ?></div>
            <div class="sidebar-photos">
                <div class="row m7" id="<?php echo $inst_id;?>">
                    <!--item photo-->
                </div>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                //Instagram
                try{Typekit.load();}catch(e){}
                var feed = new Instafeed({
                    get: 'user',
                    userId: '<?php echo $instagram_userid; ?>',
                    'limit': '<?php echo $img_limit; ?>',
                    accessToken: '<?php echo $instagram_access_token; ?>',
                    template: '<div class="col-xs-4" ><a class="mouseover-1" href="{{link}}" target="_blank"><img src="{{image}}"/><img src="{{image}}"/></a></div>',
                    target: '<?php echo $inst_id;?>',
                    resolution: 'standard_resolution',
                    after: function() {
                    }
                });

                feed.run();


            });

        </script>

        <?php
    }

    // Update and save the widget
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    // If widget content needs a form
    function form($instance) {
        //widgetform in backend
        $instagram_userid = (isset($instance['instagram_userid'])) ? strip_tags($instance['instagram_userid']) : '';
        $instagram_access_token = (isset($instance['instagram_access_token'])) ? strip_tags($instance['instagram_access_token']) : '';
        $img_limit = (isset($instance['img_limit'])) ? strip_tags($instance['img_limit']) : '';
        $title = (isset($instance['title'])) ? strip_tags($instance['title']) : '';
        $profile_link = (isset($instance['profile_link'])) ? strip_tags($instance['profile_link']) : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php  esc_html_e('Instagram title: ', 'ivy'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            <label for="<?php echo $this->get_field_id('profile_link'); ?>"><?php  esc_html_e('Link to Instagram user profile: ', 'ivy'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('profile_link'); ?>" name="<?php echo $this->get_field_name('profile_link'); ?>" type="text" value="<?php echo esc_attr($profile_link); ?>" />
            <label for="<?php echo $this->get_field_id('instagram_userid'); ?>"><?php  esc_html_e('Instagram user ID: ', 'ivy'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram_userid'); ?>" name="<?php echo $this->get_field_name('instagram_userid'); ?>" type="text" value="<?php echo esc_attr($instagram_userid); ?>" />
            <label for="<?php echo $this->get_field_id('instagram_access_token'); ?>"><?php  esc_html_e('Instagram access token: ', 'ivy'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram_access_token'); ?>" name="<?php echo $this->get_field_name('instagram_access_token'); ?>" type="text" value="<?php echo esc_attr($instagram_access_token); ?>" />
            <label for="<?php echo $this->get_field_id('img_limit'); ?>"><?php  esc_html_e('Instagram image limit: ', 'ivy'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_limit'); ?>" name="<?php echo $this->get_field_name('img_limit'); ?>" type="text" value="<?php echo esc_attr($img_limit); ?>" />
        </p>

        <?php
    }
}


//Youtube
//YOUTOBE WIDGET
class Ivy_Youtube_Widget extends WP_Widget{
    function __construct() {
        parent::__construct(false, $name = 'IVY Youtube widget', array('description' => 'Widget Youtube'));
    }

    function widget($args, $instance) {
        extract($args);
        extract($instance);

        $title = esc_attr($title);
        $desc = esc_attr($desc);
        $image = esc_url($image);
        $video = esc_url($video);


        ?>


                <div class="sidebar-entry">
                    <div class="sidebar-title h6"><?php echo esc_html($title); ?></div>
                    <div class="blog-small-entry size-1">
                        <div class="blog-small-preview mouseover-1">
                            <img src="<?php echo esc_url($image)?>"/>
                            <img src="<?php echo esc_url($image)?>"/>
                            <div class="play-button open-video" data-src="<?php echo esc_url($video); ?>"></div>
                        </div>
                        <div class="sa xsmall grey blog-small-data"><?php the_time("M / Y"); ?> <?php esc_html_e('  by ', 'ivy');?><?php the_author(); ?></div>
                        <div class="h6 blog-small-title"><span class="ht-2"><a><?php echo esc_html($desc); ?></a></span></div>
                    </div>
                </div>


        <div class="emptySpace50 emptySpace-sm30"></div>
    <?php    }

    function form($instance){
        extract($instance);
        $title = (isset($title)) ? $title : '';
        $desc = (isset($desc)) ? $desc : '';
        $image = (isset($image)) ? $image : '';
        $video = (isset($video)) ? $video : '';
        ?>
        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'ivy'); ?></lable>
            <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('Description: ', 'ivy'); ?></lable>
            <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" value="<?php echo esc_attr($desc); ?>">
        </p>

        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image background ', 'ivy'); ?></lable>
            <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($image); ?>">
        </p>

        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('video')); ?>"><?php esc_html_e('Video link: ', 'ivy'); ?></lable>
            <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('video')); ?>" id="<?php echo esc_attr($this->get_field_id('video')); ?>" value="<?php echo esc_attr($video); ?>">
        </p>
        <?php
    }
}

//--Popular Posts
//Popular Posts
class Ivy_Popular_Posts_Widget extends WP_Widget{
    function __construct() {
        parent::__construct(false, $name = 'IVY Popular Posts widget', array('description' => 'Popular Posts Widget'));
    }

    function widget($args, $instance) {
        extract($args);
        extract($instance);

        $title = esc_attr($title);
        $count = esc_attr($count);

        $popular_args = array(
            'post_type' => 'post',
            'meta_key' => 'wpb_post_views_count',
            'posts_per_page' => $count,
            'order' => 'DESC',
            'orderby' => 'meta_value_num',
        );
        $popular_query = new WP_Query($popular_args); ?>
        <?php if ($popular_query->have_posts()) : ?>
            <div class="sidebar-entry">
                <div class="sidebar-title h6"><?php echo esc_html($title); ?></div>
                <?php while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>
                <div class="blog-small-entry size-1">
                    <a class="blog-small-preview mouseover-1" href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url( array( 262, 262) ); ?>"/>
                        <img src="<?php the_post_thumbnail_url( array( 262, 262) ); ?>"/>
                    </a>
                    <div class="sa xsmall grey blog-small-data"><?php the_time("M / Y"); ?> <?php esc_html_e('  by ', 'ivy');?><?php the_author(); ?></div>
                    <div class="h6 blog-small-title"><span class="ht-2"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span></div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
    <?php    }

    function form($instance){
        extract($instance);
        $title = (isset($title)) ? $title : '';
        $count = (isset($count)) ? $count : '';
        ?>
        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'ivy'); ?></lable>
            <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <lable for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of posts to show:', 'ivy'); ?></lable>
            <input type="number" class="tiny-text" name="<?php echo esc_attr($this->get_field_name('count')); ?>" id="<?php echo esc_attr($this->get_field_id('count')); ?>" value="<?php echo esc_attr($count); ?>">
        </p>
        <?php
    }
}

function register_ivy_widgets() {
    register_widget( 'Ivy_Popular_Posts_Widget' );
    register_widget( 'Ivy_Youtube_Widget' );
    register_widget( 'Ivy_Instagram_Widget' );
}
add_action( 'widgets_init', 'register_ivy_widgets' );