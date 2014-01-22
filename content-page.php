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
		<?php wp_link_pages( array( 'before' => '<div class="page-links-next-prev">', 'after' => '</div>', 'nextpagelink' => __( '<button class="next-page-nav">Next page &rarr;</button>', 'independent_publisher' ), 'previouspagelink' => __( '<button class="previous-page-nav">&larr; Previous page</button>', 'independent_publisher' ), 'next_or_number' => 'next' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
	</div>
	<!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
