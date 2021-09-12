<?php get_header(); ?>

<?php if (have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
        <?php if (is_front_page()): ?>
            <article>
                <div><?php the_content(); ?></div>
            </article>
        <?php else: ?>
            <article>
                <h1 class="text-center my-5"><?php the_title() ?></h1>
                <div><?php the_content(); ?></div>
            </article>
        <?php endif; ?>
    <?php endwhile; ?>
<?php else: ?>
    <p>Não há conteúdo ainda.</p>
<?php endif; ?>

<?php get_footer(); ?>