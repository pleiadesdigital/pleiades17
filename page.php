<?php //Template for displaying all pages ?>

<?php get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<h2>Template for PAGES</h2>
			<?php
			while (have_posts()) : the_post();
				get_template_part('template-parts/page/content', 'page');
				// comments
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
			endwhile;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();