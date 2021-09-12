<?php
/* Template Name: People */
$people_categories = get_terms([
    'taxonomy' => 'people',
    'orderby' => 'term_id',
    'order' => 'ASC',
]);
$args = [
    'post_type' => 'people',
    'posts_per_page' => -1,
    'order' => 'ASC',
	'orderby' => 'title',
    'tax_query' => [
        [
            'taxonomy' => 'people',
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
        <div class="list-group list-group-flush sticky-md-top ">
        <?php foreach ($people_categories as $people_category): ?>
            <a class="list-group-item list-group-item-action" href="#<?php echo $people_category->slug ?>"><?php echo $people_category->name ?></a>
        <?php endforeach; ?>
        </div>
    </aside>
    <section class="col-md-9">
        <?php foreach ($people_categories as $people_category): ?>
            <section id="<?php echo $people_category->slug ?>" class="container">
                <div class="row mt-5 mb-3"><h3 class="widget-title"><?php echo $people_category->name ?></h3></div>
                <div class="row">
                    <?php
                    $args['tax_query'][0]['terms'] = $people_category->slug;
                    $posts_query = new WP_Query( $args );
                    if($posts_query->have_posts()){
                        while($posts_query->have_posts()){
                            $posts_query->the_post();
                            get_template_part( 'template-parts/content/people-card' );
                        }
                    }else{
                        echo "<p>Not found.</p>";
                    }
                    wp_reset_query();
                    ?>
                </div>
            </section>
        <?php endforeach; ?>
    </section>
</div>
<?php get_footer(); ?>