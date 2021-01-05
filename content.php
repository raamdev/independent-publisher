<?php
/**
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php independent_publisher_post_classes(); ?>>
	<header class="entry-header">
		<?php
		/* Show entry title meta only when
		 * Show Full Content First Post enabled AND
		 * this is the very first standard post AND
		 * we're on the home page AND this is not a sticky post
		 */
		?>
		<?php if ( independent_publisher_show_full_content_first_post() && ( independent_publisher_is_very_first_standard_post() && is_home() && !is_sticky() ) ) : ?>
			<h2 class="entry-title-meta">
				<span class="entry-title-meta-author"><?php independent_publisher_posted_author() ?></span> <?php echo independent_publisher_entry_meta_category_prefix() ?> <?php echo independent_publisher_post_categories(); ?>
				<span class="entry-title-meta-post-date">
					<span class="sep"> <?php echo apply_filters( 'independent_publisher_entry_meta_separator', '|' ); ?> </span>
					<?php independent_publisher_posted_on_date() ?>
				</span>
				<?php do_action( 'independent_publisher_entry_title_meta', $separator = ' | ' ); ?>
			</h2>
		<?php endif; ?>
		<h1 class="entry-title p-name">
			<a href="<?php the_permalink(); ?>" title="<?php echo independent_publisher_post_link_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>
	<!-- .entry-header -->

	<div class="<?php echo independent_publisher_show_excerpt() ? 'entry-summary e-summary' : 'entry-content e-content'; ?>">

		<?php if ( independent_publisher_show_excerpt() ) : ?>

			<?php if ( independent_publisher_show_post_thumbnails() ) : ?>

				<?php /* Only show featured image for Standard post and gallery post formats */ ?>
				<?php if ( has_post_thumbnail() && in_array( get_post_format(), array( 'gallery', false ) ) ) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo independent_publisher_post_thumbnail_link_title(); ?>"><?php the_post_thumbnail( 'independent_publisher_post_thumbnail' ); ?></a>
				<?php endif; ?>

			<?php endif; ?>

			<?php the_excerpt(); ?>

		<?php else : ?>

			<?php /* Only show featured image for Standard post and gallery post formats */ ?>
			<?php if ( has_post_thumbnail() && in_array( get_post_format(), array( 'gallery', false ) ) ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo independent_publisher_post_thumbnail_link_title(); ?>"><?php the_post_thumbnail( 'independent_publisher_post_thumbnail' ); ?></a>
			<?php endif; ?>

			<?php the_content( independent_publisher_continue_reading_text() ); ?>
			<?php if (function_exists('wp_pagenavi')) : // WP-PageNavi support ?>

				<?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?>

			<?php else: ?>

				<?php wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'independent-publisher' ),
						'after'  => '</div>'
					)
				); ?>

			<?php endif; ?>

		<?php endif; ?>
	</div>
	<!-- .entry-content -->

	<?php
	/* Show Continue Reading link when this is a Standard post format AND
	 * One-Sentence Excerpts options is enabled AND
 	 * we're not showing the first post full content AND
 	 * this is not a sticky post
 	 */
	?>
	<?php if ( false === get_post_format() && independent_publisher_generate_one_sentence_excerpts() && independent_publisher_is_not_first_post_full_content() && !is_sticky() ) : ?>
		<?php independent_publisher_continue_reading_link(); ?>
	<?php endif; ?>

	<footer class="entry-meta">

		<?php
		/* Show author name and post categories only when post type == post AND
		 * we're not showing the first post full content
		 */
		?>
		<?php if ( 'post' == get_post_type() && independent_publisher_is_not_first_post_full_content() ) : // post type == post conditional hides category text for Pages on Search ?>
			<?php independent_publisher_posted_author_cats() ?>
		<?php endif; ?>

		<?php /* Show post date when show post date option enabled */
		?>
		<?php if ( independent_publisher_show_date_entry_meta() ) : ?>
			<?php echo independent_publisher_get_post_date() ?>
		<?php endif; ?>

		<?php
		/* Show post word count when post is not password-protected AND
		 * this is a Standard post format AND
		 * post word count option enabled AND
		 * we're not showing the first post full content
		 */
		?>
		<?php if ( !post_password_required() && false === get_post_format() && independent_publisher_show_post_word_count() && independent_publisher_is_not_first_post_full_content() ) : ?>
			<?php echo independent_publisher_get_post_word_count() ?>
		<?php endif; ?>

		<?php $separator = apply_filters( 'independent_publisher_entry_meta_separator', '|' ); ?>

		<?php /* Show webmentions link only when post is not password-protected AND pings open AND there are mentions on this post */ ?>
		<?php if ( !post_password_required() && pings_open() && independent_publisher_comment_count_mentions() && !independent_publisher_hide_mentions() ) : ?>
			<?php $mention_count = independent_publisher_comment_count_mentions(); ?>
			<?php $mention_label = (independent_publisher_comment_count_mentions() > 1 ? __( 'Webmentions', 'independent-publisher' ) : __( 'Webmention', 'independent-publisher' ) ); ?>
			<span class="mentions-link"><a href="<?php the_permalink(); ?>#webmentions"><?php echo $mention_count . ' ' . $mention_label; ?></a></span><span class="sep"><?php echo (comments_open() && !independent_publisher_hide_comments()) ?  ' '.$separator : '' ?></span>
		<?php endif; ?>

		<?php /* Show comments link only when post is not password-protected AND comments are enabled on this post */ ?>
		<?php if ( !post_password_required() && comments_open() && !independent_publisher_hide_comments() ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'independent-publisher' ), __( '1 Comment', 'independent-publisher' ), __( '% Comments', 'independent-publisher' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent-publisher' ), '<span class="sep"> ' . $separator . ' </span> <span class="edit-link">', '</span>' ); ?>

	</footer>
	<!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
