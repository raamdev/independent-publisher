<?php
/**
 * A clean one-column page template without the navigation bar or site info
 *
 * Template Name: Archive Page
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>

						<h2><?php echo __('Search', 'independent_publisher'); ?></h2>
						<p>
							<?php get_search_form(); ?>
						</p>

						<div class="commonly-used-tags">
							<h2><?php echo __('Explore by Tag', 'independent_publisher'); ?></h2>
							<?php wp_tag_cloud('smallest=10&largest=22'); ?>
						</div>

						<h2><?php echo __('Category Archives', 'independent_publisher'); ?></h2>
						<ul>
							<?php wp_list_categories('title_li='); ?>
						</ul>

						<h2><?php echo __('Yearly Archives', 'independent_publisher'); ?></h2>
						<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option value=""><?php echo esc_attr( __( 'Select Year' ) ); ?></option>
							<?php wp_get_archives( array( 'type' => 'yearly', 'format' => 'option' ) ); ?>
						</select>

						<h2><?php echo __('Monthly Archives', 'independent_publisher'); ?></h2>
						<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option>
							<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option' ) ); ?>
						</select>

						<?php wp_link_pages( array( 'before' => '<div class="page-links-next-prev">', 'after' => '</div>', 'nextpagelink' => __( '<button class="next-page-nav">Next page &rarr;</button>', 'independent_publisher' ), 'previouspagelink' => __( '<button class="previous-page-nav">&larr; Previous page</button>', 'independent_publisher' ), 'next_or_number' => 'next' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<?php edit_post_link( __( 'Edit', 'publish' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>

		</div>
		<!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>