<?php /** @var $post WP_Post */ ?>
<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>
<?php $people_meta_data = get_post_meta( $post->ID ); ?>
    <div class="row">
        <header class="py-4 text-center border-top">
            <h2><?php the_title(); ?></h2>
        </header>
    </div>
    <div class="row">
        <aside class="text-center col-md-4">
            <div class="post-thumbnail-medium">
                <?php the_post_thumbnail('medium',['class' => 'img-fluid']); ?>
            </div>
            <section class="person-page-links mt-3">
                <ul class="list-group list-group-flush">
                    <?php
                    $url_site =  $people_meta_data['site_id'][0];
                    if(!empty($url_site)): ?>
                        <a class="list-group-item list-group-item-action" href="<?php echo $url_site; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri() . '/images/site.jpg' ?>" alt="Website">
                            <span>Website</span>
                        </a>
                    <?php endif; ?>
                    <?php $url_site2 =  $people_meta_data['site2_id'][0];
                    if(!empty($url_site2)): ?>
                        <a class="list-group-item list-group-item-action" href="<?php echo $url_site2; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri() . '/images/site.jpg' ?>" alt="Website">
                            <span>Website</span>
                        </a>
                    <?php endif; ?>
                    <?php
                    $url_lattes =  $people_meta_data['lattes_id'][0];
                    if(!empty($url_lattes)): ?>
                        <a class="list-group-item list-group-item-action" href="<?php echo $url_lattes; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri() . '/images/lattes_logo.png' ?>" alt="Lattes">
                            <span>Lattes</span>
                        </a>
                    <?php endif; ?>
                    <?php
                    $url_google =  $people_meta_data['google_id'][0];
                    if(!empty($url_google)): ?>
                        <a class="list-group-item list-group-item-action" href="<?php echo $url_google; ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri() . '/images/google_citation.jpg' ?>" alt="Google Citation">
                            <span>Google Citation</span>
                        </a>
                    <?php endif; ?>
                </ul>
            </section>
        </aside>
        <article class="personal-page col-md-8">
            <main class="person-main-info">
                <div class="person-page-data">
                    <?php $bio = $people_meta_data['bio_id'][0]; ?>
                    <?php if(!empty($bio) ): ?>
                        <p><?php echo nl2br($bio) ?></p>
                    <?php endif; ?>
                    <?php $project = $people_meta_data['project_id'][0]; ?>
                    <?php if(!empty($project) ): ?>
                        <p class="m-0"><strong>Project: </strong></p>
                        <p><?php echo nl2br($project) ?></p>
                    <?php endif; ?>
                    <?php $grants = $people_meta_data['grants_funding'][0]; ?>
                    <?php if(!empty($grants) ): ?>
                        <p class="m-0"><strong>Grants and Funding: </strong></p>
                        <p><?php echo nl2br($grants) ?></p>
                    <?php endif; ?>
					<?php $email = $people_meta_data['email_id'][0]; ?>
					<?php if(!empty($email) ): ?>
                        <p><strong>E-mail: </strong><?php echo $email; ?></p>
                    <?php endif; ?>
                </div>
                <div class="person-page-data">
                    <?php
                    $hist = $people_meta_data['hist_id'][0];
                    if(!empty($hist)): ?>
                        <p class="m-0"><strong>Concluded research: </strong></p>
                        <p><?php echo nl2br($hist) ?></p>
                    <?php endif; ?>
                </div>
            </main>
        </article>
    </div>
<?php endwhile; ?>
    <div class="row">
        <footer class="mt-5">
            <a href="/who-is-who/" class="btn btn-secondary btn-return"><< Return</a>
        </footer>
    </div>
<?php get_footer(); ?>