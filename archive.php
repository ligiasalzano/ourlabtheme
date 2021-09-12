<?php
get_header(); ?>
    <div class="row">
        <?php if ( have_posts() ) : ?>
            <header class="page-header text-center my-5">
                <?php
                the_archive_title( '<h2 class="page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header -->
        <?php endif; ?>

        <?php
        if ( have_posts() ) :
            ?>
            <div class="row">
                <?php
                // Start the Loop.
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that
                     * will be used instead.
                     */
                    get_template_part( 'template-parts/post/content', 'standard' );

                endwhile; ?>
            </div>
            <div class="row">
                <div class="my-3 d-flex justify-content-center align-items-center">
                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text'          => '<<< <span class="screen-reader-text">' . __( 'Previous page', 'ourlabtheme' ) . '</span>',
                            'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'ourlabtheme' ) . '</span> >>>',
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ourlabtheme' ) . ' </span>',
                        )
                    );
                    ?>
                </div>
            </div>
        <?php
        else :
            get_template_part( 'template-parts/post/content', 'none' );
        endif;
        ?>
    </div>
<?php
get_footer();
