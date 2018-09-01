<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    1.0 for parent theme buildcon for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
include( get_template_directory() . '/inc/tgm-activation/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'ivy_register_required_plugins' );
 function ivy_register_required_plugins() {

//    $ivy_plugins_paths ='http://ivy.qode.run/plugins/';
    $ivy_plugins_paths ='http://unionagency.one/ivy_wp/plugins/';

	$plugins = array(

		array(
            'name'			        => 'WPBakery Visual Composer', // The plugin name
            'slug'			        => 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> $ivy_plugins_paths . 'js_composer.zip',
            'required'			    => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		    => '', // If set, overrides default API URL and points to an external URL
        ),


		array(
			'name'     				=> 'Ivy Plugin', // The plugin name
			'slug'     				=> 'ivy', // The plugin slug (typically the folder name)
			'source'   				=> $ivy_plugins_paths . 'ivy-plugin.zip',
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => 'Yith Woocommerce Wishlist',
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
        ),

	);


	$config = array(
		'id'           => 'ivy',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	);

	tgmpa( $plugins, $config );
}

