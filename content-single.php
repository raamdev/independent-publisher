<?php
/**
 * @package Independent Publisher
 * @since Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title-meta">
			<span class="entry-title-meta-author"><?php independent_publisher_posted_author() ?></span> in <?php echo independent_publisher_post_categories('', TRUE); ?></h2>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<div class="post-author-bottom">
		<div class="post-author-card">
			<?php if ( get_header_image() ) : ?>
				<a class="site-logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img class="no-grav" src="<?php echo esc_url( get_header_image() ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				</a>
			<?php endif; ?>
			<div class="post-author-info">
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<div class="post-published-date">
				<h2 class="site-published">Published</h2>
				<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>
				<h2 class="site-published-location"><?php echo get_ncl_location(); ?></h2>
			</div>
		</div>
	</div> <!-- .post-author-bottom -->

	<footer class="entry-meta">

		<?php independent_publisher_sharing_buttons(); ?>

		<?php if( comments_open() ) : ?>
			<div id="share-comment-button"><button><i class="icon-comment"></i>Share a comment</button></div>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
