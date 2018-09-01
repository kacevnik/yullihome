<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* This file hooks the redux options panel.
/*-----------------------------------------------------------------------------------*/


add_filter('redux/options/ivy_redux_opt/sections', 'ivy_redux_options');

if ( ! function_exists( 'ivy_redux_options' ) ) {
    function ivy_redux_options( $sections ) {

    $sections = array();

	$shortname = 'ivy';
    $sections[] = array(
        'title'  => esc_html__( 'General Settings', 'ivy' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'General Settings.', 'ivy' ),
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'    => $shortname . '_favicon_url',
                'type'  => 'media',
                'url'      => true,
                'readonly'    => false,
                'title' => esc_html__( 'Favicon Icon', 'ivy' ),
                'desc'  => esc_html__( 'Upload a favicon if you are running below WP 4.3. Please go to Appearance-> customise -> site identity to upload favicon if you are running WordPress version 4.3 or above.', 'ivy' ),
            ),

            array(
                'id'    => $shortname . '_terms_of_use',
                'type'  => 'text',
                'readonly'    => false,
                'title' => esc_html__( 'Terms of use', 'ivy' ),
                'desc'  => esc_html__( '', 'ivy' ),
            ),

            array(
                'id'    => $shortname . '_google_api_key',
                'type'  => 'text',
                'readonly'    => false,
                'title' => esc_html__( 'Google API key', 'ivy' ),
                'desc'  => esc_html__( 'For google maps', 'ivy' ),
            ),
        )
    );
/*-----------------------------------------------------------------------------------*/
/* Header Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Header/Menu', 'ivy' ),
        'id'               => 'layout-options',
        'desc'   => esc_html__( 'Layout Settings for Header.', 'ivy' ),
        'icon'   => 'el el-photo ',
        'customizer_width' => '400px',
        'fields'           => array(

            array(
                'id' => $shortname . '_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload Main Logo', 'ivy' ),
                'readonly'    => false,
                'subtitle'     => esc_html__( 'Upload a logo for your theme, or specify an image URL directly. For retina friendliness you can upload 2x logo and set desired dimension in retina ready graphics option below.', 'ivy' ),
                'desc' => esc_html__( 'Ideal size of the logo depends on the header layout you are using.', 'ivy' ),
            ),

            array(
                'id' => $shortname . '_logo2',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload Main Logo 2', 'ivy' ),
                'readonly'    => false,
                'subtitle'     => esc_html__( 'Only Header type 3 (Transparent)', 'ivy' ),
                'desc' => esc_html__( '', 'ivy' ),
            ),
            array(
                'id' => $shortname . '_header_menu_color',
                'type'     => 'color',
                'output'   => array( 'color'=>'nav ul a' ),
                'title'    => esc_html__( 'Header Menu Color', 'ivy' ),
                'desc'   =>  esc_html__( 'Default: leave blank', 'ivy' ) ,
                'default'  =>'',
            ),


            array(
                'id' => $shortname . '_header_bg_color',
                'type'     => 'background',
                'output'   => array( 'header:not(.scrolled)' ),
                'title'    => esc_html__( 'Header Menu Background Color', 'ivy' ),
                'subtitle' => esc_html__( '', 'ivy' ),
                'desc'     => esc_html__( 'Default: leave blank.', 'ivy' ),
                'default'  => '#fff',
                'background-repeat' =>false,
                'background-attachment' =>false,
                'background-position' =>false,
                'background-image' =>false,
                'background-size' =>false,
                'preview' =>false,
            ),
            array(
                'id' => $shortname . '_header_fix_bg_color',
                'type'     => 'background',
                'output'   => array( 'header(.scrolled)' ),
                'title'    => esc_html__( 'Header Fixed Menu Background Color', 'ivy' ),
                'subtitle' => esc_html__( '', 'ivy' ),
                'desc'     => esc_html__( 'Default: leave blank.', 'ivy' ),
                'default'  => '#fff',
                'background-repeat' =>false,
                'background-attachment' =>false,
                'background-position' =>false,
                'background-image' =>false,
                'background-size' =>false,
                'preview' =>false,
            ),

            array(
                'id'       => $shortname.'_header_type',
                'type'     => 'select',
                'title'    => esc_html__('Header type', 'ivy'),
                'subtitle' => esc_html__('', 'ivy'),
                'desc'     => esc_html__('', 'ivy'),
                'options'  => array(
                    'type-1' => esc_html__( 'Type 1', 'ivy' ),
                    'type-2' => esc_html__( 'Type 2', 'ivy' ),
                    'type-3' => esc_html__( 'Type 3', 'ivy' ),

                ),
                'default'  => 'type-3',
            ),

            array(
                'id' => $shortname.'_header_menu_section_hide',
                'type'     => 'checkbox',
                'title' => esc_html__( 'Login hide', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_header_instagram',
                'type'     => 'text',
                'title' => esc_html__( 'Instagram link', 'ivy' ),
                'subtitle' => esc_html__( "Only for Header Type 1", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_header_facebook',
                'type'     => 'text',
                'title' => esc_html__( 'Facebook link', 'ivy' ),
                'subtitle' => esc_html__( "Only for Header Type 1", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_header_twitter',
                'type'     => 'text',
                'title' => esc_html__( 'Twitter link', 'ivy' ),
                'subtitle' => esc_html__( "Only for Header Type 1", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_header_google',
                'type'     => 'text',
                'title' => esc_html__( 'Google+ link', 'ivy' ),
                'subtitle' => esc_html__( "Only for Header Type 1", 'ivy' ),
                'default'  => '',
            ),




        )
    );

/*-----------------------------------------------------------------------------------*/
/* Footer Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Footer ', 'ivy' ),
        'id'               => 'footer-settings',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => $shortname.'_footer_type',
                'type'     => 'select',
                'title'    => esc_html__('Footer type', 'ivy'),
                'subtitle' => esc_html__('', 'ivy'),
                'desc'     => esc_html__('', 'ivy'),
                'options'  => array(
                    '' => esc_html__( 'None', 'ivy' ),
                    'type-1' => esc_html__( 'Type 1 - Standart', 'ivy' ),
                    'type-2' => esc_html__( 'Type 2 - Social icons left', 'ivy' ),
                    'type-3' => esc_html__( 'Type 3 - Copyright center', 'ivy' ),

                ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_instagram',
                'type'     => 'text',
                'title' => esc_html__( 'Instagram link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_facebook',
                'type'     => 'text',
                'title' => esc_html__( 'Facebook link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_twitter',
                'type'     => 'text',
                'title' => esc_html__( 'Twitter link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_google',
                'type'     => 'text',
                'title' => esc_html__( 'Google+ link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_pinterest',
                'type'     => 'text',
                'title' => esc_html__( 'Pinterest link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_linkedin',
                'type'     => 'text',
                'title' => esc_html__( 'Linkedin link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_youtube',
                'type'     => 'text',
                'title' => esc_html__( 'Youtube link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_reddit',
                'type'     => 'text',
                'title' => esc_html__( 'Reddit link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_tumblr',
                'type'     => 'text',
                'title' => esc_html__( 'Tumblr link', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

            array(
                'id' => $shortname.'_footer_copyright',
                'type'     => 'editor',
                'title' => esc_html__( 'Footer Copyright', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),

        )
    );

/*-----------------------------------------------------------------------------------*/
/* Blog Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Blog Settings', 'ivy' ),
        'id'               => 'blog-settings',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id' => $shortname.'_blog_title',
                'type'     => 'text',
                'title' => esc_html__( 'Header Title', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname.'_blog_subtitle',
                'type'     => 'text',
                'title' => esc_html__( 'Header Subtitle', 'ivy' ),
                'subtitle' => esc_html__( "", 'ivy' ),
                'default'  => '',
            ),
        )
    );


/*-----------------------------------------------------------------------------------*/
/* Woocommerce Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

$sections[] = array(
    'title' => esc_html__( 'Woocommerce ', 'ivy' ),
    'id'               => 'woocommerce-settings',
    'customizer_width' => '450px',
    'fields'           => array(

//        array(
//            'id'       => $shortname.'_footer_type',
//            'type'     => 'select',
//            'title'    => esc_html__('Footer type', 'ivy'),
//            'subtitle' => esc_html__('', 'ivy'),
//            'desc'     => esc_html__('', 'ivy'),
//            'options'  => array(
//                '' => esc_html__( 'None', 'ivy' ),
//                'type-1' => esc_html__( 'Type 1 - Standart', 'ivy' ),
//                'type-2' => esc_html__( 'Type 2 - Social icons left', 'ivy' ),
//                'type-3' => esc_html__( 'Type 3 - Copyright center', 'ivy' ),
//
//            ),
//            'default'  => '',
//        ),
        array(
            'id'    => $shortname . '_ppp',
            'type'  => 'text',
            'readonly'    => false,
            'title' => esc_html__( 'List of dropdown options', 'ivy' ),
            'desc'  => esc_html__( 'Seperated by "," (-1 for all products)', 'ivy' ),
        ),

        array(
            'id' => $shortname.'_sidebar_position',
            'type'     => 'select',
            'title' => esc_html__( 'Sidebar position Shop', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'options'  => array(
                'none' => esc_html__( 'No sidebar', 'ivy' ),
                'left' => esc_html__( 'Left', 'ivy' ),
                'right' => esc_html__( 'Right', 'ivy' ),
                'full' => esc_html__( 'Full Width', 'ivy' ),
            ),
            'default'  => 'none',
        ),

        array(
            'id' => $shortname.'_sidebar_position_product',
            'type'     => 'select',
            'title' => esc_html__( 'Sidebar position Product Detail', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'options'  => array(
                'none' => esc_html__( 'No sidebar', 'ivy' ),
                'left' => esc_html__( 'Left', 'ivy' ),
                'right' => esc_html__( 'Right', 'ivy' ),
            ),
            'default'  => 'none',
        ),

        array(
            'id' => $shortname.'_shop_title_header',
            'type'     => 'text',
            'title' => esc_html__( 'Shop Title Header', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),
        array(
            'id' => $shortname.'_shop_header_img',
            'type'     => 'media',
            'title' => esc_html__( 'Shop header Image', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),
        array(
            'id' => $shortname.'_shop_header_img_border',
            'type'     => 'media',
            'title' => esc_html__( 'Shop header Image border', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_shop_header_img_show',
            'type'     => 'select',
            'title' => esc_html__( 'Show or hide header image for Shop page', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'options'  => array(
                'show' => esc_html__( 'Show', 'ivy' ),
                'hide' => esc_html__( 'Hide', 'ivy' ),
            ),
            'default'  => 'show',
        ),

        array(
            'id' => $shortname.'_shop_title',
            'type'     => 'text',
            'title' => esc_html__( 'Shop Title', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_shop_subtitle',
            'type'     => 'text',
            'title' => esc_html__( 'Shop Subtitle', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_cart_title',
            'type'     => 'text',
            'title' => esc_html__( 'Cart Title', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_header_cart_hide',
            'type'     => 'checkbox',
            'title' => esc_html__( 'Cart hide', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
            ),

        array(
            'id' => $shortname.'_cart_subtitle',
            'type'     => 'text',
            'title' => esc_html__( 'Cart Subtitle', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_checkout_title',
            'type'     => 'text',
            'title' => esc_html__( 'Checkout Title', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),

        array(
            'id' => $shortname.'_checkout_subtitle',
            'type'     => 'text',
            'title' => esc_html__( 'Checkout Subtitle', 'ivy' ),
            'subtitle' => esc_html__( "", 'ivy' ),
            'default'  => '',
        ),
    )
);
        $sections[] = array(
            'title'            => esc_html__( 'Typography', 'ivy' ),
            'id'               => 'typography-options',
            'customizer_width' => '450px',
            'fields'           => array(
                array(
                    'id'          => $shortname . '_typography',
                    'type'        => 'typography', 
                    'title'       => __('Typography', 'ivy'),
                    'google'      => true, 
                    'font-backup' => false,
                    'font-size'   => false,
                    'line-height' => false,
                    'text-align'  => false,
                    'font-weight' => false,
                    'subsets'     => false,
                    'output'      => array('.breadcrumbs','.row .h5', '.sa h6', '.page-numbers', '.text', '.title', '.sa h3', '.sl', 'h3', '.h6', '.h4', 'h4.title', '.widget', '.sa', '.menu a', 'h1.h1', '.button', 'form input', '.ht-2', '.text-center'),
                    'units'       =>'px',
                    'subtitle'    => __('Typography option with each property can be called individually.', 'ivy'),
                    'default'     => array(
                        'font-style'  => '700',  
                        'google'      => true,
                    ),
                ),
            )
        );
        $sections[] = array(
            'title'            => esc_html__( 'Custom CSS/Javascript', 'ivy' ),
            'id'               => 'css-options',
            'customizer_width' => '450px',
            'fields'           => array(

                array(
                    'id' => $shortname . '_custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom CSS', 'ivy' ),
                    'subtitle' => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'ivy' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'  => ''
                ),
                array(
                    'id' => $shortname . '_custom_js',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom Javascript', 'ivy' ),
                    'subtitle' => esc_html__( 'Quickly add some Javascript to your theme by adding it to this block.', 'ivy' ),
                    'mode'     => 'javascript',
                    'theme'    => 'monokai',
                    'default'  => ''
                ),
            )
        );


    return $sections;

    }
}

