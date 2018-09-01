<?php get_header(); ?>
<!-- MAIN CONTENT BLOCK -->

<div class="container">
    <div class="empty-space col-xs-b40 col-sm-b80"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <article class="sa">
                <h3><?php esc_html_e('Page not found!', 'ivy');?></h3>
                <p><?php esc_html_e('404', 'ivy');?></p>
            </article>
            <div class="empty-space col-xs-b35 col-sm-b70"></div>
                <p>
                    <a href="<?php echo esc_url(home_url('/'))?>" class="button">
                        <?php esc_html_e('Home', 'ivy');?>
                    </a>
                </p>
            <div class="empty-space col-xs-b35 col-sm-b70"></div>
        </div>
    </div>
</div>
<?php get_footer(); ?>


