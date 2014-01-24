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
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						if ( is_category() ) {
							printf( __( '%s', 'independent_publisher' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						}
						elseif ( is_tag() ) {
							printf( __( '%s', 'independent_publisher' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						}
						elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 */
							the_post();
							printf( __( '%s', 'independent_publisher' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );

							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						}
						elseif ( is_day() ) {
							printf( __( '%s', 'independent_publisher' ), '<span>' . get_the_date() . '</span>' );

						}
						elseif ( is_month() ) {
							printf( __( '%s', 'independent_publisher' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						}
						elseif ( is_year() ) {
							printf( __( '%s', 'independent_publisher' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						}
						else {
							_e( 'Archives', 'independent_publisher' );

						}
						?>
					</h1>
					<?php
					if ( is_category() ) {
						// Show an optional category description
						$category_description = category_description();

						// Get some stats about this taxonomy to include in the description
						$taxonomy_stats = apply_filters( 'independent_publisher_taxonomy_category_stats', independent_publisher_taxonomy_archive_stats( 'category' ) );

						if ( ! empty( $category_description ) ) { // show the description + the taxonomy stats
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . $taxonomy_stats . '</div>' );
						}
						else { // there was description set, so let's just show some stats
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $taxonomy_stats . '</div>' );
						}

					}
					elseif ( is_tag() ) {
						// Show an optional tag description
						$tag_description = tag_description();

						// Get some stats about this taxonomy to include in the description
						$taxonomy_stats = apply_filters( 'independent_publisher_taxonomy_tag_stats', independent_publisher_taxonomy_archive_stats( 'post_tag' ) );

						if ( ! empty( $tag_description ) ) { // show the description + the taxonomy stats
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . $taxonomy_stats . '</div>' );
						}
						else { // there was description set, so let's just show some stats
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $taxonomy_stats . '</div>' );
						}
					}
					elseif ( is_day() || is_month() || is_year() ) {
						echo independent_publisher_date_archive_description();
					}
					?>
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

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

		</div>
		<!-- #content .site-content -->
	</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>