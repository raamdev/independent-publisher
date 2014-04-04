<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main">

			<section class="error-404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'independent-publisher' ); ?></h1>
				</header>
				<!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'independent-publisher' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( independent_publisher_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
						<div class="widget widget_categories">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'independent-publisher' ); ?></h2>
						<ul>
							<?php wp_list_categories( array( 'orderby'    => 'count',
															 'order'      => 'DESC',
															 'show_count' => 1,
															 'title_li'   => '',
															 'number'     => 10
								)
							); ?>
						</ul>
					</div>
					<!-- .widget -->
					<?php endif; ?>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'independent-publisher' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div>
				<!-- .entry-content -->
			</section>
			<!-- .error-404 -->

		</main>
		<!-- #main -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>