<?php
//if ( ! defined( 'ABSPATH' ) ) exit;
///**
// * Comments Template
// *
// */
//
// Do not delete these lines
//if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
//	die ( 'Please do not load this page directly. Thanks!' );
//    }
//if ( post_password_required() ) {
//	return;
//}
//
//?>
<!---->
<!--<div class="empty-space col-xs-b45 col-sm-b90"></div>-->
<!--<h4 class="h4 blog-column-title">--><?php //esc_html_e('Comments', 'ivy')?><!--</h4>-->
<!--<div class="h6">-->
<!--	--><?php //if ( have_comments() ) { ?>
<!--		--><?php //wp_list_comments( 'callback=ivy_custom_comment&end-callback=ivy_custom_comment_end&type=all&style=div&max_depth=5' ); ?>
<!--			<div class="">-->
<!--				<div class="fl">--><?php //previous_comments_link();?><!--</div>-->
<!--				<div class="fr">--><?php //next_comments_link();?><!--</div>-->
<!--			</div>-->
<!--		--><?php //} else { echo  esc_html__('Not yet commented', 'ivy');} ?>
<!--</div>-->
<!---->
<!--	--><?php
//
//	 if ( comments_open() )
//		comment_form(array(
//            'title_reply'=>esc_html__('Leave a comment', 'ivy'),
//            'must_log_in'=>'<p class="sl-must-login">' .  esc_html__( 'You must be logged in to post a comment.','ivy' ) . '</p>',
//            'logged_in_as'=>'',
//            'comment_notes_before'=>'',
//			'class_form'=>'contact-form ',//.esc_attr($anm),
//			'id_form'=>'contact-form',
//			'title_reply_before' =>'<div class="sidebar-title h6">',
//			'title_reply_after' =>'</div>',
//        ));
//?>
<!---->


<?php

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'Please do not load this page directly. Thanks!' );
}
if ( post_password_required() ) {
    return;
}

if ( post_password_required() ) { return; } ?>

<div class="empty-space col-xs-b45 col-sm-b90"></div>
    <div class="comments-wrapper">
        <?php if ( have_comments() ) { ?>
            <div class="comments">
                <h4 class="comment-entry h4 blog-column-title"><?php comments_number( esc_html__( '0', 'ivy' ), esc_html__( '1', 'ivy' ), esc_html__( '%', 'ivy' ) );  esc_html_e( ' Comments ', 'ivy' ); ?></h4>
                <div class="comment-entry"><?php wp_list_comments( array( 'callback' => 'ivy_comment' ) ); ?></div>
                <div id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'ivy' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'ivy' ) ); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php
if ( comments_open() )
		comment_form(array(
            'title_reply'=>esc_html__('Leave a comment', 'ivy'),
            'must_log_in'=>'<p class="sl-must-login">' .  esc_html__( 'You must be logged in to post a comment.','ivy' ) . '</p>',
            'logged_in_as'=>'',
            'comment_notes_before'=>'',
			'class_form'=>'contact-form ',
			'id_form'=>'contact-form',
			'title_reply_before' =>'<div class="sidebar-title h6">',
			'title_reply_after' =>'</div>',
        ));

?>


