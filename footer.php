
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 *
 */
?>

<!-- FOOTER -->
<?php
$page_opt = get_post_meta(get_queried_object_id(), '_ivy_post_meta_opt', true);

$page_opt_footer = (isset($page_opt['footer_type'])) ? $page_opt['footer_type'] : 'hide';
$footer_type = ivy_get_option('footer_type');
$footer_type = !empty($page_opt_footer) ? $page_opt_footer : $footer_type;


if ( !empty( $footer_type ) ) {

    $footer_instagram   = ivy_get_option( 'footer_instagram' );
    $footer_facebook    = ivy_get_option( 'footer_facebook' );
    $footer_twitter     = ivy_get_option( 'footer_twitter' );
    $footer_google      = ivy_get_option( 'footer_google' );
    $footer_pinterest   = ivy_get_option( 'footer_pinterest' );
    $footer_linkedin    = ivy_get_option( 'footer_linkedin' );
    $footer_youtube     = ivy_get_option( 'footer_youtube' );
    $footer_reddit      = ivy_get_option( 'footer_reddit' );
    $footer_tumblr      = ivy_get_option( 'footer_tumblr' );

    $copyright = ivy_get_option( 'footer_copyright', '' );
    !empty( $copyright ) ? $copyright : '';

function social_links($footer_instagram='', $footer_facebook='', $footer_twitter='', $footer_google='', $footer_pinterest='', $footer_linkedin='', $footer_youtube='', $footer_reddit='', $footer_tumblr=''){
    $output ='<div class="follow style-1">';
    if (!empty($footer_instagram)) {
        $output .='<a class="entry" href="'.esc_url($footer_instagram).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    } if (!empty($footer_facebook)) {
        $output .= '<a class="entry" href="'.esc_url($footer_facebook).'" target="_blank"><i class="fa fa-vk"></i></a>';
    } if (!empty($footer_twitter)) {
        $output .= '<a class="entry" href="'.esc_url($footer_twitter).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    } if (!empty($footer_google)) {
        $output .= '<a class="entry" href="'.esc_url($footer_google).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    } if (!empty($footer_pinterest)) {
        $output .= '<a class="entry" href="'.esc_url($footer_pinterest).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    } if (!empty($footer_linkedin)) {
        $output .= '<a class="entry" href="'.esc_url($footer_linkedin).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    } if (!empty($footer_youtube)) {
        $output .= '<a class="entry" href="'.esc_url($footer_youtube).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    } if (!empty($footer_reddit)) {
        $output .= '<a class="entry" href="'.esc_url($footer_reddit).'" target="_blank"><i class="fa fa-reddit"></i></a>';
    } if (!empty($footer_tumblr)) {
        $output .= '<a class="entry" href="'.esc_url($footer_tumblr).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    }
    $output .= '</div>';
    return $output;
}

if ( function_exists( 'is_shop' ) && function_exists( 'is_product' ) && function_exists( 'is_single' )) {

if ($footer_type == 'type-1' or is_shop() or is_product() or is_single() or is_archive()) { ?>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-text-center col-md-text-left">
                <div class="copyright sa small"><?php echo wp_kses_post($copyright)?></div>
                <div class="col-xs-b15 visible-xs visible-sm"></div>
            </div>
            <div class="col-md-6 col-xs-text-center col-md-text-right">
                <?php echo social_links($footer_instagram, $footer_facebook, $footer_twitter, $footer_google,$footer_pinterest, $footer_linkedin, $footer_youtube, $footer_reddit, $footer_tumblr); ?>
            </div>
        </div>
    </div>
</footer>

<?php } elseif ($footer_type == 'type-2') { ?>
<footer class="type-1">
    <div class="container-fluid">
        <div class="col-xs-text-center col-md-text-left">
            <div class="copyright sa small"><?php echo wp_kses_post($copyright)?></div>
            <div class="col-xs-b15 visible-xs visible-sm"></div>
            <?php echo social_links($footer_instagram, $footer_facebook, $footer_twitter, $footer_google,$footer_pinterest, $footer_linkedin, $footer_youtube, $footer_reddit, $footer_tumblr); ?>
        </div>
    </div>
</footer>

<?php } elseif ($footer_type == 'type-3') { ?>
<footer class="type-1">
    <div class="container">
        <div class="col-xs-text-center">
            <div class="copyright sa small"><?php echo wp_kses_post($copyright)?></div>
        </div>
    </div>
</footer>
<?php } } }?>
</div>

<div class="popup-wrapper">
    <div class="bg-layer"></div>

    <?php if(!is_user_logged_in()) { ?>
        <div class="popup-content" data-rel="1">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    <h3 class="h3 text-center"><?php esc_html_e('Log in', 'ivy')?></h3>
                    <div class="empty-space col-xs-b30"></div>
                    <form id="login" action="login" method="post">
                        <input type="hidden" name="redirect_to" value="<?php echo get_the_permalink() ?>" />
                        <input type="hidden" name="status" value="<?php echo esc_html('Checking information. Please expect.', 'ivy'); ?>" />
                        <p class="status"></p>
                        <div class="simple-input-wrapper">
                            <input class="simple-input" id="username" value="" type="text" placeholder="<?php esc_html_e('Your name/email', 'ivy')?>" />
                            <span></span>
                        </div>
                        <div class="simple-input-wrapper">
                            <input class="simple-input" id="password" type="password" value="" placeholder="<?php esc_html_e('Enter password', 'ivy')?>" />
                            <span></span>
                        </div>
                        <div class="empty-space col-xs-b10 col-sm-b20"></div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-b10 col-sm-b0">
                                <div class="empty-space col-sm-b5"></div>
                                <a class="simple-link" data-rel="3" href="<?php echo home_url("/").'my-account/lost-password/'?>"><?php esc_html_e('Forgot password?', 'ivy')?></a>
                                <div class="empty-space col-xs-b5"></div>
                                <a class="simple-link open-popup" data-rel="2"><?php esc_html_e('Register now', 'ivy')?></a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <div class="button"><?php esc_html_e('submit', 'ivy')?><input type="submit"/></div>
                            </div>
                        </div>
                        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                    </form>
                </div>
                <div class="button-close"></div>
            </div>
        </div>
    <?php } ?>

    <div class="popup-content" data-rel="2">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-align">
                <h3 class="h3 text-center"><?php esc_html_e('Register', 'ivy')?></h3>
                <div class="empty-space col-xs-b30"></div>
                <form class="registration-form" method="post">
                    <p class="indicator status"><?php esc_html_e('Checking information. Please expect.', 'ivy'); ?></p>
                    <p class="status result-message"></p>
                    <input type="hidden" name="status" value="<?php esc_html_e('Data taken. Redirecting ...', 'ivy'); ?>" />
                    <div class="simple-input-wrapper">
                        <input type="text" name="vb_name" required id="vb_name" value="" class="simple-input" placeholder="<?php esc_html_e('Your name', 'ivy')?>" />
                        <span></span>
                    </div>
                    <div class="simple-input-wrapper">
                        <input type="email" name="vb_email" required id="vb_email" value="" class="simple-input" placeholder="<?php esc_html_e('Your email', 'ivy')?>" />
                        <span></span>
                    </div>
                    <div class="simple-input-wrapper">
                        <input type="password" name="vb_pass" required id="vb_pass" value="" class="simple-input" placeholder="<?php esc_html_e('Enter password', 'ivy')?>" />
                        <span></span>
                    </div>
                    <div class="simple-input-wrapper">
                        <input type="password" name="vb_pass2" required id="vb_pass2" value="" class="simple-input" placeholder="<?php esc_html_e('Repeat password', 'ivy')?>" />
                        <span></span>
                    </div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <div>
                                <label class="sc">
                                    <input type="checkbox" name="vb_rules" id="vb_rules" class="vb_rules"><span>I agree with <a class="simple-link open-popup" data-rel="4">terms of use</a></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="button"><?php esc_html_e('register', 'ivy')?><input type="submit"/></div>
                        </div>
                    </div>
                    <?php wp_nonce_field('vb_new_user','vb_new_user_nonce', true, true ); ?>
                </form>
            </div>
            <div class="button-close"></div>
        </div>
    </div>

<!--    <div class="popup-content" data-rel="3">-->
<!--        <div class="layer-close"></div>-->
<!--        <div class="popup-container size-1">-->
<!--            <div class="popup-align">-->
<!--                <h3 class="h3 text-center">--><?php //esc_html_e('Reset your password', 'ivy'); ?><!--</h3>-->
<!--                <div class="empty-space col-xs-b30"></div>-->
<!--                    <form id="lostPasswordForm" method="post">-->
<!--                        <p class="indicator_lost status">--><?php //esc_html_e('Checking information. Please expect.', 'ivy'); ?><!--</p>-->
<!--                        <p class="status result-message_lost"></p>-->
<!--                        --><?php //wp_nonce_field( 'rs_user_lost_password_action', 'rs_user_lost_password_nonce' ); ?>
<!--                        <div class="simple-input-wrapper">-->
<!--                            <input class="simple-input" value="" type="text" placeholder="--><?php //esc_html_e('Your email', 'ivy'); ?><!--" />-->
<!--                            <span></span>-->
<!--                        </div>-->
<!--                        <div class="empty-space col-xs-b10 col-sm-b20"></div>-->
<!--                        <div class="text-center">-->
<!--                            <div class="button">--><?php //esc_html_e('reset', 'ivy'); ?><!--<input type="submit"/></div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--            </div>-->
<!--            <div class="button-close"></div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="popup-content" data-rel="4">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-align">
                <h3 class="h3 text-center"><?php esc_html_e('Terms of use', 'ivy'); ?></h3>
                <div class="empty-space col-xs-b30"></div>
                <div class="sa">
                    <?php $terms_of_use = ivy_get_option('terms_of_use');
                    $terms_of_use = !empty($terms_of_use) ? $terms_of_use : '';
                    echo esc_html($terms_of_use);
                    ?>
                </div>
                <div class="empty-space col-xs-b30"></div>
            </div>
            <div class="button-close"></div>
        </div>
    </div>

    <div class="popup-content video-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-3">
            <div class="embed-responsive embed-responsive-16by9 popup-iframe"></div>
            <div class="button-close"></div>
        </div>
    </div>
<div class="popuploader"><div></div></div>
</div>



<div class="phone-marker visible-xs"></div><div class="tablet-marker visible-sm"></div>

<?php wp_footer(); ?>
</body>
</html>
