<?php /** @var $post WP_Post */ ?>
<article class="row my-3">
    <div class="col-md-2 mb-3 mb-md-0"><?php the_post_thumbnail('thumbnail'); ?></div>
    <div class="col-md-10">
        <h5><?php the_title(); ?></h5>
        <div><?php the_content(); ?></div>
    </div>
</article>