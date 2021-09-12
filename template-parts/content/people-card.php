<?php /** @var $post WP_Post */ ?>
<article class="col-md-4 mb-3">
    <div class="card person text-center">
        <div class="card-header">
            <?php the_title(); ?>
        </div>
        <div class="card-body">
            <?php the_post_thumbnail('thumbnail'); ?>
            <p class="card-text keywords mt-3">
                <?php
                $keywords = get_the_terms($post->ID, 'keywords');
                $i = 1;
                foreach ( $keywords as $keyword ){
                    echo $keyword->name;
                    echo $i < count($keywords) ? ", " : "";
                    $i++;
                }
                ?>
            </p>
        </div>
        <div class="card-footer bg-transparent border-0">
            <a class="btn btn-primary" href="<?php the_permalink(); ?>">meet</a>
        </div>
    </div>
</article>