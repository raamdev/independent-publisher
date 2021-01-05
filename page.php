<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment and comments are not hidden, or
				//   if we have webmentions and webmentions are not hidden, 
				//     load up the comment template
				if ( ( comments_open() || '0' != get_comments_number() && !independent_publisher_hide_comments() ) ||
				( independent_publisher_comment_count_mentions() > 0 && !independent_publisher_hide_mentions() ) ) {
					comments_template( '', true );
				}
				?>

			<?php endwhile; // end of the loop. ?>

		</main>
		<!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
