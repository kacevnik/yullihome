<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* Load the files for theme, with support for overriding the widget via a child theme.
/*-----------------------------------------------------------------------------------*/
include( get_template_directory() . '/inc/theme-essentials.php');  // Theme Essentials
include( get_template_directory() . '/inc/theme-options.php');     // Theme options
include( get_template_directory() . '/inc/theme-metabox.php');     // Theme Metaboxes
include( get_template_directory() . '/inc/theme-widgets.php');     // Theme widgets
include( get_template_directory() . '/inc/theme-comments.php');    // Theme comments
include( get_template_directory() . '/inc/post-like.php');         // Theme like
include( get_template_directory() . '/inc/aq_resizer.php');         // aq_resizer
/**
 * TGM class for plugin includes.
 */
if( is_admin() ){
	if (!( class_exists( 'TGM_Plugin_Activation' ) ))
		include( get_template_directory() . '/inc/tgm-activation/ivy-plugins.php');
}


if ( ! isset( $content_width ) )
	$content_width = 1140;


/**
 * Basic Theme Setup
 */

if ( ! function_exists( 'ivy_theme_setup' ) ) {

	function ivy_theme_setup() {

		// Load the translations
		load_theme_textdomain( 'ivy', get_template_directory() . '/lang' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( "custom-header" );

		// Add admin editor style.
		add_editor_style( 'inc/editor-style.css' );

		// Add custom background support.
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );

		// Enable Post Thumbnails ( Featured Image )
		add_theme_support( 'post-thumbnails' );

		// Title tag support
		add_theme_support( 'title-tag' );

		// Register Navigation Menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'ivy' ),
		) );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );

	}

} add_action( 'after_setup_theme', 'ivy_theme_setup' );

