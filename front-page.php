<?php //Front Page Template file ?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<h2>Template for the HOME/FRONT	 PAGE</h2>
		<?php 
			if (have_posts()) : while (have_posts()) : the_post();
				get_template_part('template-parts/page/content', 'front-page');
				endwhile;
			else : 
				get_template_part('template-parts/post/content', 'none');
			endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
