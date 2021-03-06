<?php// The template for displaying all single posts ?>

<?php get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
			
			<?php 
			the_post_navigation(array(
				'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'pleiades17') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'pleiades17') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . pleiades17_get_svg(array('icon' => 'arrow-left')) . '</span>%title</span>',
				'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'pleiades17') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'pleiades17') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . pleiades17_get_svg(array('icon' => 'arrow-right')) . '</span></span>',
			));
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
