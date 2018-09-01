<?php
if ( ! defined( 'ABSPATH' ) ) exit;



/*-----------------------------------------------------------------------------------*/
/* Theme essentials! */
/*-----------------------------------------------------------------------------------*/

set_transient( '_redux_activation_redirect', false, 30 );
delete_transient( '_dslc_activation_redirect_1' );


global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	flush_rewrite_rules();
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_all=(
		is_plugin_active( 'js_composer/js_composer.php' )
		and is_plugin_active( 'ivy/ivy.php' )
	);
	if(!$plugin_all ) ivy_activate_redirect();
}

function ivy_activate_redirect() {

	header( 'Location: ' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) );
}


if ( ! function_exists( 'ivy_sidebar_init' ) ) {
	function ivy_sidebar_init() {
		if ( ! function_exists( 'register_sidebar' ) )
			return;

        register_sidebar( array(
            'id'            => 'default-sidebar',
            'name'          => 'Sidebar ( Default )',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="title">',
            'after_title'   => '</h4>',
            'description'   => 'Drag the widgets for sidebars.'
        ) );

        register_sidebar( array(
            'id'            => 'woocommerce-sidebar',
            'name'          => 'Sidebar ( Woocommerce )',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="title">',
            'after_title'   => '</h4>',
            'description'   => 'Drag the widgets for sidebars.'
        ) );

	}
}

add_action( 'widgets_init', 'ivy_sidebar_init' );

function ivy_fonts_url() {
	$font_url = '';
	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'ivy' ) ) {
        $fonts='';
        $fonts.='Playfair Display:400,700,900';
		$font_url = add_query_arg( 'family', urldecode($fonts) , "//fonts.googleapis.com/css" );
	}
	return $font_url;
}

//--remove woocommerce css--//
add_filter( 'woocommerce_enqueue_styles', '__return_false' );



if ( ! function_exists( 'ivy_load_scripts' ) ) {
	function ivy_load_scripts() {
		wp_enqueue_script( "comment-reply" );

		// Scripts

        //only for map
        $google_api_key = ivy_get_option('google_api_key');
        wp_register_script( 'goog_maps', 'http://maps.googleapis.com/maps/api/js?key='.$google_api_key.'', '', null, true );
        wp_register_script( 'map', THEME_URI . '/assets/js/map.js', '', null, true );

        // all
        wp_enqueue_script( 'instafeed',       THEME_URI . '/assets/js/instafeed.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'swiper',          THEME_URI . '/assets/js/swiper.jquery.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'isotope',         THEME_URI . '/assets/js/isotope.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'global',          THEME_URI . '/assets/js/global.js', array('jquery'), null, true );
        wp_enqueue_script( 'simple-lightbox', THEME_URI . '/assets/js/simple-lightbox.min.js', array('jquery'), null, true  );
        //only shop(woocomerce)
        wp_register_script( 'jquery-ui',      THEME_URI . '/assets/js/jquery-ui.min.js', array('jquery'), null, true  );
        wp_register_script( 'touch-punch',    THEME_URI . '/assets/js/jquery.ui.touch-punch.min.js', array('jquery'), null, true  );
        wp_register_script( 'sumoselect',     THEME_URI . '/assets/js/jquery.sumoselect.min.js', array('jquery'), null, true  );
        //only for slider 3
        wp_register_script( 'mousewheel',     THEME_URI . '/assets/js/jquery.mousewheel.min.js', array('jquery'), null, true  );
        wp_register_script( 'sliceslider',    THEME_URI . '/assets/js/sliceslider.jquery.js', array('jquery'), null, true  );
        //Share
        wp_enqueue_script( 'sharethis','http://w.sharethis.com/button/buttons.js',  '', null, true );
        wp_add_inline_script( 'sharethis', 'stLight.options({publisher: "cbf95bf6-a66c-4e9f-b681-eba65a73a3df", doNotHash: false, doNotCopy: false, hashAddressBar: false});' );

        $js = ivy_get_option('custom_js','');
        if(!empty($js)) {
            wp_add_inline_script('ivy_main_js', $js);
        }

		// Styles
        wp_enqueue_style( 'google_fonts', ivy_fonts_url() , '', null );

        wp_enqueue_style( 'bootstrap-min',       THEME_URI . 'assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'bootstrap-extension', THEME_URI . 'assets/css/bootstrap.extension.css' );
        wp_enqueue_style( 'simplelightbox',      THEME_URI . 'assets/css/simplelightbox.css' );
        wp_enqueue_style( 'custom-style',        THEME_URI . 'assets/css/style.css' );
        wp_enqueue_style( 'sumoselect',          THEME_URI . 'assets/css/sumoselect.css' );
        wp_enqueue_style( 'swiper',              THEME_URI . 'assets/css/swiper.css' );
        wp_enqueue_style( 'ivy_custom_style',    THEME_URI . 'style.css', '', null );
        wp_enqueue_style( 'font-awesome',        THEME_URI . 'assets/fonts/awesome/css/font-awesome.min.css' );

		$css = ivy_get_option('custom_css','');
		if(!empty($css)) {
			wp_add_inline_style('ivy_custom_style', $css);
		}

	}
	add_action( 'wp_enqueue_scripts', 'ivy_load_scripts' );
}
