<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && !independent_publisher_has_full_width_featured_image() ) : ?>
		<?php the_post_thumbnail( 'independent_publisher_post_thumbnail', array( 'itemprop' => 'image' ) ); ?>
	<?php endif; ?>
	<header class="entry-header">
		<?php if ( !independent_publisher_post_has_post_cover_title() ): ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php if (function_exists('wp_pagenavi')) : // WP-PageNavi support ?>

			<?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?>

		<?php else : ?>

			<?php wp_link_pages(
				array(
					'before'           => '<div class="page-links-next-prev">',
					'after'            => '</div>',
					'nextpagelink'     => '<button class="next-page-nav">' . __( 'Next page &rarr;', 'independent-publisher' ) . '</button>',
					'previouspagelink' => '<button class="previous-page-nav">' . __( '&larr; Previous page', 'independent-publisher' ) . '</button>',
					'next_or_number'   => 'next'
				)
			); ?>
			<?php wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'independent-publisher' ),
					'after'  => '</div>'
				)
			); ?>
		<?php endif; ?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-meta">
		<?php do_action( 'independent_publisher_entry_meta_top' ); ?>

		<?php if ( comments_open() && !independent_publisher_hide_comments() ) : ?>
			<div id="share-comment-button">
				<button>
					<i class="share-comment-icon"></i><?php echo independent_publisher_comments_call_to_action_text() ?>
				</button>
			</div>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent-publisher' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
