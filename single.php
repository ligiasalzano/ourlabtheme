<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<article class="col-md-9">
				<header class="entry-header alignwide my-5">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>
				<?php
				while(have_posts()): the_post();
				the_content();
				endwhile;
				?>
			</article>
			<aside class="col-md-3 mt-5">
				<?php
				if( is_active_sidebar('blog')){
					dynamic_sidebar('blog');
				}
				?>
			</aside>
		</div>
	</div>
<?php get_footer(); ?>