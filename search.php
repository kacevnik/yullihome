<?php get_header(); ?>

<!-- MAIN CONTENT BLOCK -->





<div class="container">
    <div class="empty-space col-xs-b40 col-sm-b80"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <article class="sa">
                <h3><?php esc_html_e( 'Search Results For: ', 'ivy' );?></h3>
                <p><?php the_search_query();?></p>
            </article>
            <div class="empty-space col-xs-b35 col-sm-b70"></div>
        </div>
    </div>
			<!-- MAIN CONTENT BLOCK -->

			<?php get_template_part( 'content' ); ?>

</div>

<?php get_footer(); ?>








