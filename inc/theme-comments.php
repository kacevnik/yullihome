<?php
//if ( ! defined( 'ABSPATH' ) ) exit;
//
//-----reorder fields
add_filter('comment_form_fields', 'ivy_reorder_comment_fields' );
function ivy_reorder_comment_fields( $fields ){

	$new_fields = array();

	$myorder = array('author','email','comment');

	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}
//------comment form comment
//add_filter( 'comment_form_field_comment', 'ivy_comment_form_comment' );
//function ivy_comment_form_comment($field){
//    return '
//    <div class="simple-input-wrapper">
//		<textarea class="simple-input" placeholder="'.esc_html__( "Type your text", 'ivy'  ) .'" id="comment" name="comment"  rows="5" maxlength="65525" aria-required="true" required="required"></textarea>
//		<span></span>
//	</div>
//	<div class="empty-space col-xs-b10"></div>
//';
//}
//-----comment submit
add_filter( 'comment_form_submit_button', 'ivy_comment_form_submit' );
function ivy_comment_form_submit($btn){
    return '
	<div class="button">'.esc_html__('Submit', 'ivy').'<input id="submit" type="submit" name="submit" /></div>
	';
}

//------Comments form fields
add_filter( 'comment_form_default_fields', 'ivy_comment_form_fields' );
if ( ! function_exists( 'ivy_comment_form_fields' ) ) {
	function ivy_comment_form_fields ( $fields ) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' =>'

			<div class="row m35">
				<div class="col-sm-6">
					<div class="simple-input-wrapper">
						<input id="author" placeholder="'.esc_html__( "Name", 'ivy'  ). ( $req ? '*' : '' ) .'" class="simple-input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ).'"' .  $aria_req . ' >
                        <span></span>
					</div>
				</div>
			',

			'email'  => '
				<div class="col-sm-6">
					<div class="simple-input-wrapper">
						<input id="email" class="simple-input" name="email" placeholder="' . esc_html__( 'Email', 'ivy'  ) . ( $req ? '*' : '' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] )  .'"'. $aria_req . ' >
					<span></span>
					</div>
				</div>
			</div>
			',
			'url'    => ''
		);
		return $fields;
	}
}

    if ( ! function_exists( 'ivy_comment' ) ) {
    function ivy_comment( $comment, $args, $depth )
    {
    $GLOBALS['comment'] = $comment;

    switch ( $comment->comment_type ):
    case 'pingback':
    case 'trackback': ?>
    <div class="pingback">
        <?php esc_html_e( 'Pingback:', 'ivy' ); ?> <?php comment_author_link(); ?>
        <?php edit_comment_link( esc_html__( '(Edit)', 'ivy' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
<?php
break;
default: ?>
<div <?php comment_class('ct-part'); ?> id="comment-<?php comment_ID(); ?>">
    <div class="" id="comment-<?php comment_ID(); ?>">
        <div class="comment-preview">
            <?php echo get_avatar( $comment, 80 ); ?>
        </div>
        <div class="comment-content">

            <div class="float-fix">
                <div class="row col-xs-b15">
                    <div class="col-sm-8">
                        <h6 class="h6"><?php comment_author(); ?></h6>
                    </div>
                    <div class="col-sm-4 col-sm-text-right">
                        <div class="sa xsmall grey"><?php echo esc_html(get_comment_date("F / Y")) . esc_html(' at ', 'ivy')?><?php the_date("H.i"); ?></div>
                    </div>
                </div>
                <div class="sa middle comment-text"><?php comment_text(); ?></div>
                <div class="button style-1">
                <?php comment_reply_link(
                        array_merge( $args,
                            array(
                                'reply_text' => esc_html__( 'Reply', 'ivy' ),
                                'depth' 	 => $depth,
                                'max_depth'  => $args['max_depth']
                            )
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
break;
endswitch;
}
}