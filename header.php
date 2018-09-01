<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <?php
    $fi = ivy_get_option('favicon_url', '');
    if(function_exists('wp_site_icon')) {
        if(! has_site_icon() and !empty($fi)) {
            update_option('site_icon', $fi['id']);
        }
        wp_site_icon();
    }elseif(!empty($fi)){ ?>
        <link rel="shortcut icon" href="<?php echo esc_url($fi['url']) ?>"/>
    <?php } ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>

<!-- LOADER -->
<div id="loader-wrapper"></div>

<!-- HEADER -->
<?php
    //page settings
    $page_opt = get_post_meta(get_queried_object_id(), '_ivy_post_meta_opt', true);

    //global settings
    $header_instagram = ivy_get_option('header_instagram');
    $header_facebook = ivy_get_option('header_facebook');
    $header_twitter = ivy_get_option('header_twitter');
    $header_google = ivy_get_option('header_google');

    $header_type = ivy_get_option('header_type');
    $header_type = !empty($page_opt['header_type']) ? $page_opt['header_type'] : $header_type;

    $transparent_page = (isset($page_opt['header_transparent'])) ? $page_opt['header_transparent'] : '';
    if ($transparent_page == true) {
        $transparent = 'transparent';
        $logo = ivy_get_option('logo2', null);
    } else {
        $transparent = '';
        $logo = ivy_get_option('logo', null);
    }
    if ( function_exists( 'is_shop' ) ) {
        if ( is_shop() ){ 
            $transparent = 'transparent'; 
            $logo = ivy_get_option('logo2', null);
            if( ivy_get_option('shop_header_img_show') == 'hide' ){
                $transparent = ''; 
                $logo = ivy_get_option('logo1', null);
            }
        }
    }

    if ( is_single( $post ) ) {
        $transparent = '';
        $logo = ivy_get_option('logo1', null);
    }

    if ( is_singular( 'portfolio' ) ) {
        $transparent = 'transparent';
        $logo = ivy_get_option('logo2', null);
    }
?>

<header class="<?php echo esc_attr($header_type); ?> <?php echo esc_attr($transparent); ?>">
    <div class="header-wrapper">
        <?php $img_alt = (isset($logo["id"])) ? get_post_meta( $logo["id"], '_wp_attachment_image_alt', true) : '';
        if (isset($logo['url']) and !empty($logo['url'])) { ?>
            <a id="logo" href="<?php echo esc_url(home_url('/'))?>"><img src="<?php echo esc_url($logo['url'])?>" alt="<?php print esc_attr($img_alt); ?>" /></a>
        <?php } else { ?>
            <a id="logo" href="<?php echo esc_url(home_url('/'))?>"><img src="<?php echo THEME_URI?>/assets/img/logo.png" alt="<?php print esc_attr('logo' )?>" /></a>
        <?php } ?>

        <div class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <?php
        $output ='<div class="follow style-1">';
        if (!empty($header_instagram)) {
            $output .='<a class="entry" href="'.esc_url($header_instagram).'" target="_blank"><i class="fa fa-instagram"></i></a>';
        } if (!empty($header_facebook)) {
            $output .= '<a class="entry" href="'.esc_url($header_facebook).'" target="_blank"><i class="fa fa-facebook"></i></a>';
        } if (!empty($header_twitter)) {
            $output .= '<a class="entry" href="'.esc_url($header_twitter).'" target="_blank"><i class="fa fa-twitter"></i></a>';
        } if (!empty($header_google)) {
            $output .= '<a class="entry" href="'.esc_url($header_google).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
        }
            $output .= '</div>';
        echo wp_kses_post($output);
        ?>
    </div>
    <div class="navigation-wrapper">
        <nav>
                <?php
                if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array('container' => 'ul', 'theme_location' => 'primary', ) );
                } else {
                    echo '<div class="sa">';
                        esc_html_e('Please assign primary menu in wp-admin->Appearance->Menus', 'ivy');
                    echo '</div>';
                } ?>
        </nav>
    </div>
</header>

<div id="content-block">
