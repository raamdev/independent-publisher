<?php
/**
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'independent_publisher' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>
	<!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php if ( 'aside' === get_post_format() ) : // Do something special for Asides ?>

				<?php // This creates the same output as the_content() ?>
				<?php $content = get_the_content(); ?>
				<?php $content = apply_filters( 'the_content', $content ); ?>
				<?php $content = str_replace( ']]>', ']]&gt;', $content ); ?>

				<?php // Asides might have footnotes, which don't display properly when linking Asides to themselves, so we strip <sup> here ?>
				<?php $content = preg_replace( '!<sup\s+id="fnref.*?">.*?</sup>!is', '', $content ); ?>

				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo $content; ?></a>
			<?php else : ?>

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'independent_publisher' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>

			<?php endif; ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'independent_publisher' ) );
			if ( $categories_list && independent_publisher_categorized_blog() ) :
				?>
				<span class="cat-links">
				<?php printf( __( ' in %1$s', 'independent_publisher' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'independent_publisher' ), __( '1 Comment', 'independent_publisher' ), __( '% Comments', 'independent_publisher' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
