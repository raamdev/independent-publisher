<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php $search_stats = apply_filters( 'independent_publisher_search_stats', independent_publisher_search_stats() ); ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'independent-publisher' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php echo apply_filters( 'search_meta', '<div class="search-stats-description">' . $search_stats . '</div>' ); ?>
					<?php independent_publisher_content_nav( 'nav-above' ); ?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

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