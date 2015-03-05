<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() && ! independent_publisher_hide_comments() ) {
					comments_template( '', true );
				}
				?>

				<?php do_action( 'independent_publisher_before_post_bottom_tag_list' ); ?>

				<?php if ( get_the_tag_list() ) : ?>
					<?php $tag_list_title = apply_filters( 'independent_publisher_tag_list_title', __( 'Related Content by Tag', 'independent-publisher' ) ); ?>
					<?php $tag_list = (string)get_the_tag_list( '<ul class="taglist"><li class="taglist-title">' . $tag_list_title . '</li><li>', '</li><li>', '</li></ul>' ); ?>
					<div id="taglist">
						<?php echo $tag_list; ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</main>
		<!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>