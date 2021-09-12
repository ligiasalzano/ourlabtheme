<?php get_header(); ?>
    <div class="row">
        <section class="col-md-9">
            <div class="container">
                <?php if (have_posts()): ?>
                    <div class="row">
                        <?php while(have_posts()): the_post(); ?>
                            <?php get_template_part( 'template-parts/post/content', 'standard' ); ?>
                        <?php endwhile; ?>
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
                <?php else: ?>
                    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                <?php endif; ?>
            </div>
        </section>
        <aside class="col-md-3 mt-5">
            <?php
            if( is_active_sidebar('blog')){
                dynamic_sidebar('blog');
            }
            ?>
        </aside>
    </div>
<?php get_footer(); ?>