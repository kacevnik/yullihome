<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* This file hooks the metaboxes to Metabox system powered by TT FW plugin.
/*-----------------------------------------------------------------------------------*/

// remove metaoptions for CPT from the plugin.
remove_filter( 'cs_metabox_options', 'tempteam_metas_opt', 20 ); // remove the plugin team opts, if exists.
remove_filter( 'cs_metabox_options', 'tempportfolio_metas_opt', 20 ); // remove the plugin team opts, if exists.

/*-----------------------------------------------------------------------------------*/
/* CS meta boxes override                                                            */
/*-----------------------------------------------------------------------------------*/
// framework options filter example
if( !function_exists( 'ivy_metas_opt' )) {
	function ivy_metas_opt( $options ) {
		$post_meta =  array(
			// begin: a section
			array(
				'name'   => 'section_1',
				'title'  => '',
				'icon'   => 'fa fa-cog',
				// begin: fields
				'fields' => array(
					array(
                        'id'       => '_single_thumb_type',
                        'type'     => 'select',
                        'title' => esc_html__( 'Select thumbnail type', 'ivy' ),
                        'desc' => esc_html__( '', 'ivy' ),
                        'options'  => array(
                            'std'      => esc_html__( 'Standard', 'ivy' ),
                            'image'      => esc_html__( 'Thumbnail with text', 'ivy' ),
                            'vimeo'   => esc_html__( 'Vimeo Video', 'ivy' ),
                            'youtube'    => esc_html__( 'Youtube video', 'ivy' ),
                        ),
                        'default'  => 'std',
                    ),

                    array(
                        'id'            => '_single_title',
                        'type'          => 'text',
                        'title'         => esc_html__( 'Post title', 'ivy' ),
                        'desc'          => esc_html__( '', 'ivy' ),
                        'attributes'    => array(
                            'rows'        => '2',
                        ),
                        'dependency'   => array( '_single_thumb_type', '==', 'image' ),
                    ),

                    array(
                        'id'         => '_single_vimeo',
                        'type'       => 'text',
                        'title'      => esc_html__( 'Vimeo video ID', 'ivy' ),
                        'desc'      => esc_html__( 'Example: 18554749', 'ivy' ),
                        'dependency'   => array( '_single_thumb_type', '==', 'vimeo' ),
                    ),

                    array(
                        'id'         => '_single_youtube',
                        'type'       => 'text',
                        'title'      => esc_html__( 'Youtube video ID', 'ivy' ),
                        'desc'      => esc_html__( 'Example: REqZelREwM8', 'ivy' ),
                        'dependency'   => array( '_single_thumb_type', '==', 'youtube' ),
                    ),

				), // end: fields
			) // end: a section
		);

		$page_meta =  array(
			// begin: a section
			array(
				'name'   => 'section_2',
				'title'  => '',
				'icon'   => 'fa fa-cog',
				// begin: fields
				'fields' => array(
					array(
                        'id'       =>'header_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select header type', 'ivy'),
                        'desc'     => esc_html__('', 'ivy'),
                        'options'  => array(
                            'type-1' => esc_html__( 'Type 1', 'ivy' ),
                            'type-2' => esc_html__( 'Type 2', 'ivy' ),
                            'type-3' => esc_html__( 'Type 3', 'ivy' ),
                        ),
                        'default'  => 'type-3',
                    ),

                    array(
                        'id' => 'header_transparent',
                        'type'     => 'checkbox',
                        'title' => esc_html__( 'Transparent header', 'ivy' ),
                        'desc' => esc_html__( "Only for Header Type 3", 'ivy' ),
                        'default'  => '',
                    ),

                    array(
                        'id'       =>'footer_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Select footer type', 'ivy'),
                        'desc'     => esc_html__('', 'ivy'),
                        'options'  => array(
                            'hide' => esc_html__( 'None', 'ivy' ),
                            'type-1' => esc_html__( 'Type 1', 'ivy' ),
                            'type-2' => esc_html__( 'Type 2', 'ivy' ),
                            'type-3' => esc_html__( 'Type 3', 'ivy' ),
                        ),
                        'default'  => 'type-1',
                    ),
				), // end: fields
			) // end: a section
		);


        $portfolio_meta =  array(
            // begin: a section
            array(
                'name'   => 'section_3',
                'title'  => '',
                'icon'   => 'fa fa-cog',
                // begin: fields
                'fields' => array(
                    array(
                        'id'       => 'portfolio_letter',
                        'type'     => 'text',
                        'title' => esc_html__( 'Letter', 'ivy' ),
                        'desc' => esc_html__( 'The "Letter" only for Portfolio Style 3. Enter one letter. Example: A', 'ivy' ),
                        'default'  => '',
                    ),
                    array(
                        'id'       => 'portfolio_label',
                        'type'     => 'text',
                        'title' => esc_html__( 'Label', 'ivy' ),
                        'desc' => esc_html__( 'The "Label" only for Portfolio Style 3. Enter one letter. Example: For: Typocity Studio', 'ivy' ),
                        'default'  => '',
                    ),
                ), // end: fields
            ) // end: a section
        );

		$options = array(); // remove old options

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------

		 $options[] = array(
		 	'id'        => '_ivy_post_meta_opt',
		 	'title'     => 'Post Options',
		 	'post_type' => 'post',
		 	'context'   => 'normal',
		 	'priority'  => 'default',
		 	'sections'  => $post_meta
		 );

		$options[] = array(
			'id'        => '_ivy_post_meta_opt',
			'title'     => 'Page Options',
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'default',
			'sections'  => $page_meta
		);

        $options[] = array(
            'id'        => '_ivy_portfolio_meta_opt',
            'title'     => 'Portfolio Options',
            'post_type' => 'portfolio',
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => $portfolio_meta
        );

		return $options;

	}

	add_filter( 'cs_metabox_options', 'ivy_metas_opt' );

}


