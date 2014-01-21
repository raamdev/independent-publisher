<?php
/**
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php independent_publisher_post_classes(); ?>>
	<header class="entry-header">
		<?php if ( independent_publisher_show_full_content_first_post() && ( independent_publisher_is_very_first_standard_post() && is_home() && ! is_sticky() ) ) : ?>
			<h2 class="entry-title-meta">
				<span class="entry-title-meta-author"><?php independent_publisher_posted_author() ?></span> <?php echo apply_filters('independent_publisher_entry_title_meta_category_prefix','in'); // @TODO document independent_publisher_entry_title_meta_category_prefix filter ?> <?php echo independent_publisher_post_categories( '', TRUE ); ?>
				<?php do_action( 'independent_publisher_entry_title_meta', $separator = ' | ' ); ?>
			</h2>
		<?php endif; ?>
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
			<?php if ( 'aside' === get_post_format() || 'quote' === get_post_format() ) : // Do something special for Asides and Quotes ?>

				<?php // Asides might have footnotes, which don't display properly when linking Asides to themselves, so we strip <sup> here ?>
				<?php $content = independent_publisher_strip_footnotes( get_the_content() ); ?>

				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo $content; ?></a>

			<?php elseif ( independent_publisher_show_full_content_first_post() && independent_publisher_is_very_first_standard_post() ) : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( array( 700, 700 ) ); ?>
				<?php endif; ?>
				<?php the_content( independent_publisher_continue_reading_text() ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>

			<?php
			elseif ( ! get_post_format() && ! is_sticky() &&
					( independent_publisher_use_post_excerpts() || independent_publisher_generate_one_sentence_excerpts() )
			) : // Standard post format
				?>

				<a style="text-decoration: none; color: inherit;" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_excerpt(); ?></a>

			<?php
			else : ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( array( 700, 700 ) ); ?>
				<?php endif; ?>
				<?php the_content( independent_publisher_continue_reading_text() ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>

			<?php endif; ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">

		<?php if ( false === get_post_format() && independent_publisher_generate_one_sentence_excerpts() && independent_publisher_is_not_first_post_full_content() && ! is_sticky() ) : ?>
			<?php independent_publisher_continue_reading_link(); ?>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() && independent_publisher_is_not_first_post_full_content() ) : // Hide category and tag text for pages on Search ?>
			<?php independent_publisher_posted_author_cats() ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( false === get_post_format() && independent_publisher_show_post_word_count() && independent_publisher_is_not_first_post_full_content() ) : // Only show word count on standard post format ?>
			<?php echo independent_publisher_get_post_word_count() ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && comments_open() ) : ?>
			<?php if ( independent_publisher_is_not_first_post_full_content() && independent_publisher_categorized_blog() ) : ?>
				<span class="sep"> | </span>
			<?php endif; ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'independent_publisher' ), __( '1 Comment', 'independent_publisher' ), __( '% Comments', 'independent_publisher' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>

	</footer>
	<!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
