<article class="col-12 mt-5">
    <?php the_title( sprintf( '<h2 class="entry-title">
                                <a href="%s" class="text-decoration-none link-dark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    <small class="my-2">Posted in <?php echo get_the_date() ?><br>
        Categories: <?php the_category(' '); ?><br>
        <?php the_tags('Tags: ',', '); ?></small>
    <div class="my-2"><?php the_excerpt(); ?></div>
</article>