<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title p-name">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description p-summary">', '</div>' ); ?>
				<?php independent_publisher_content_nav( 'nav-above' ); ?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php independent_publisher_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main>
		<!-- #content .site-content -->
	</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
