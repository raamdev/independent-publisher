<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Independent Publisher
 * @since Independent Publisher 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

				<!-- START PING/TRACKBACKS LIST -->

				<?php if ( have_comments() ) : ?>
					<?php if ( count($wp_query->comments_by_type['pings'])) { ?>
						<ul class="pinglist">
							<li class="pinglist_title">Readers who shared this</li>
							<?php wp_list_comments('type=pings&callback=independent_publisher_ping'); ?>
						</ul>
					<?php } ?>
				<?php endif; ?>

				<!-- END PING/TRACKBACKS LIST -->

				<!-- START Efficient Related Posts LIST -->

				<?php if( is_single() ) : ?>
					<?php if( function_exists('wp_related_posts') ) : //Related Thoughts, Essays, and Journals?>
						<?php do_action('erp-show-related-posts', array('title'=>'', 'num_to_display'=>12, 'no_rp_text'=>'No Related Posts Found')); ?>
					<?php endif; ?>
				<?php endif; ?>

				<!-- END Efficient Related Posts LIST -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>