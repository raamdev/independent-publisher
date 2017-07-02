<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
				?>

				<header class="archive-header">
				<?php the_archive_title( '<h1 class="page-title p-name">', '</h1>' ); ?>
				</header><!-- .archive-header -->

				<?php get_template_part( 'author-bio' ); ?>

				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php independent_publisher_content_nav( 'nav-below' ); ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		<!-- #content -->
	</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
