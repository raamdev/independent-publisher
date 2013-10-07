<?php
/**
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title-meta">
			<span class="entry-title-meta-author"><?php independent_publisher_posted_author() ?></span> in <?php echo independent_publisher_post_categories( '', TRUE ); ?>
			<?php if( function_exists('indiepub_spoken_essay_link') ) : ?>
					<?php if ( indiepub_spoken_essay_url() ) : ?>
					| <?php echo indiepub_spoken_essay_link(); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>

		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
	</div>
	<!-- .entry-content -->

	<div class="post-author-bottom">
		<div class="post-author-card">
			<a class="site-logo" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
			</a>
			<div class="post-author-info">
				<h1 class="site-title">
					<?php independent_publisher_posted_author(); ?>
				</h1>

				<h2 class="site-description"><?php the_author_meta('description') ?></h2>
			</div>
			<div class="post-published-date">
				<h2 class="site-published">Published</h2>

				<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>

				<?php if( function_exists('get_ncl_location') ) : ?>
					<h2 class="site-published-location">
						<?php echo get_ncl_location(); ?>
					</h2>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- .post-author-bottom -->

	<footer class="entry-meta">

		<?php if( function_exists('indiepub_sharing_buttons') ) : ?>
			<?php indiepub_sharing_buttons(); ?>
		<?php endif; ?>

		<?php if ( comments_open() ) : ?>
			<div id="share-comment-button">
				<button><i class="icon-comment"></i>Share a comment</button>
			</div>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
