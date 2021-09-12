<?php
/* Template Name: Research */
$args = [
    'post_type' => 'research',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
    'tax_query' => [
        [
            'taxonomy' => 'research_category',
            'field'    => 'slug',
            'terms'    => '',
        ]
    ]
];
get_header();
?>
    <section class="container">
        <div class="mb-3"><?php the_post_thumbnail('full'); ?></div>
        <div><?php the_content(); ?></div>
    </section>
    <div class="row">
        <section class="container">
            <article class="row mt-5">
                <?php
                $args['tax_query'][0]['terms'] = 'research-topic';
                $posts_query = new WP_Query( $args );
                if($posts_query->have_posts()){
                    while($posts_query->have_posts()){
                        $posts_query->the_post();
                        get_template_part( 'template-parts/content/research-item' );
                    }
                }else{
                    echo "<p>Not found.</p>";
                }
                wp_reset_query();
                ?>
            </article>
        </section>
    </div>
    <div class="row">
        <section class="container">
            <article class="row mt-5">
                <p>We developed the projects:</p>
                <?php
                $args['tax_query'][0]['terms'] = 'developed-project';
                $posts_query = new WP_Query( $args );
                if($posts_query->have_posts()){
                    while($posts_query->have_posts()){
                        $posts_query->the_post();
                        get_template_part( 'template-parts/content/research-item' );
                    }
                }else{
                    echo "<p>Not found.</p>";
                }
                wp_reset_query();
                ?>
            </article>
        </section>
    </div>
<?php get_footer(); ?>