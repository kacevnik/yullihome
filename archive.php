<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 */

get_header();

				if ( is_category() ) {
					$title = single_cat_title( '', false );
				} elseif ( is_tag() ) {
					$title = single_tag_title( '', false );
				} elseif ( is_author() ) {
					$title = get_the_author();
				} elseif ( is_year() ) {
					$title = get_the_date( 'Y' );
				} elseif ( is_month() ) {
					$title = get_the_date( 'F Y' );
				} elseif ( is_day() ) {
					$title = get_the_date( 'F j, Y' );
				} elseif ( is_post_type_archive() ) {
					$title = post_type_archive_title( '', false );
				} elseif ( is_tax() ) {
					$tax = get_taxonomy( get_queried_object()->taxonomy );
					$title = $tax->labels->singular_name . ' ' . single_term_title( '', false );
				} elseif ( is_search() ) {
					$title = get_the_title( $post_id ) . ' ' . get_search_query();
				} else {
					$title = esc_html__( 'Archives', 'ivy' );
				}

?>

<div class="container">
    <div class="empty-space col-xs-b40 col-sm-b80"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <article class="sa">
                <h3><?php echo esc_html($title)?></h3>
            </article>
            <div class="empty-space col-xs-b35 col-sm-b70"></div>
        </div>
    </div>
		<!-- MAIN CONTENT BLOCK -->
    <?php get_template_part( 'content' ); ?>
</div>

<?php get_footer(); ?>
