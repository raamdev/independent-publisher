<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( array( 700, 700 ) ); ?>
	<?php endif; ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links-next-prev">', 'after' => '</div>', 'nextpagelink' => '<button class="next-page-nav">' . __( 'Next page &rarr;', 'independent_publisher' ) . '</button>', 'previouspagelink' => '<button class="previous-page-nav">' . __( '&larr; Previous page', 'independent_publisher' ) . '</button>', 'next_or_number' => 'next' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-meta">
		<?php do_action( 'independent_publisher_entry_meta_top' ); ?>

		<?php if ( comments_open() ) : ?>
			<div id="share-comment-button">
				<button><i class="share-comment-icon"></i><?php echo independent_publisher_comments_call_to_action_text() ?></button>
			</div>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
