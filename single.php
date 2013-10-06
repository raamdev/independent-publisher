<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  				the_post_thumbnail( array(700, 700) );
  				} 
				?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
				?>

				<?php if ( is_single() && function_exists( 'wp_related_posts' ) ) : ?>
					<div id="further-reading">
						<?php do_action( 'erp-show-related-posts', array( 'title' => 'Further Reading', 'num_to_display' => 5, 'no_rp_text' => 'No Related Posts Found' ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( get_the_tag_list() ) : ?>
					<div id="taglist">
						<?php echo get_the_tag_list( '<ul class="taglist"><li class="taglist-title">Related Content by Tag</li><li>', '</li><li>', '</li></ul>' ); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</div>
		<!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>