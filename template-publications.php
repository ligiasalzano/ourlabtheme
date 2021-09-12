<?php
/* Template Name: Publications */
$production_categories = get_terms([
    'taxonomy' => 'production_category',
    'orderby' => 'term_id',
    'order' => 'DESC',
]);
$args = [
    'post_type' => 'production',
    'posts_per_page' => -1,
    'orderby' => ['meta_value' => 'DESC', 'title' => 'ASC'],
    'meta_key' => 'prod_year',
    'tax_query' => [
        [
            'taxonomy' => 'production_category',
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
        <aside class="col-md-3 mt-5">
            <h6 class="widget-title">Search by category:</h6>
            <div class="list-group list-group-flush sticky-md-top ">
                <?php foreach ($production_categories as $production_category): ?>
                    <a class="list-group-item list-group-item-action" href="#<?php echo $production_category->slug ?>"><?php echo $production_category->name ?></a>
                <?php endforeach; ?>
            </div>
        </aside>
        <section class="col-md-9">
            <div class="container">
                <?php foreach ($production_categories as $production_category): ?>
                    <article class="row mt-5">
                        <header id="<?php echo $production_category->slug ?>"><h3><?php echo $production_category->name ?></h3></header>
                        <?php
                        $args['tax_query'][0]['terms'] = $production_category->slug;
                        $posts_query = new WP_Query( $args );
                        if($posts_query->have_posts()){
                            while($posts_query->have_posts()){
                                $posts_query->the_post();
                                get_template_part( 'template-parts/content/production-item' );
                            }
                        }else{
                            echo "<p>Not found.</p>";
                        }
                        wp_reset_query();
                        ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
<?php get_footer(); ?>