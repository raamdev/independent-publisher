<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

if ( ! function_exists( 'independent_publisher_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() )
			$nav_class = 'site-navigation post-navigation';

		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h1 class="assistive-text"><?php _e( 'Post navigation', 'independent_publisher' ); ?></h1>

			<?php if ( is_single() ) : // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous"><button>%link</button></div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'independent_publisher' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next"><button>%link</button></div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'independent_publisher' ) . '</span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<button><span class="meta-nav">&larr;</span> Older posts</button>', 'independent_publisher' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( '<button>Newer posts <span class="meta-nav">&rarr;</span></button>', 'independent_publisher' ) ); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
	}
endif; // independent_publisher_content_nav

if ( ! function_exists( 'independent_publisher_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
			<li class="post pingback">
			<p><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'independent_publisher' ), ' ' ); ?></p>
		<?php else : ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 40 ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'independent_publisher' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div>
					<!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'independent_publisher' ); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time pubdate datetime="<?php comment_time( 'c' ); ?>">
								<?php
								/* translators: 1: date */
								printf( __( '%1$s', 'independent_publisher' ), get_comment_date() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( '(Edit)', 'independent_publisher' ), ' ' );
						?>
					</div>
					<!-- .comment-meta .commentmetadata -->
				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
				<!-- .reply -->
			</article><!-- #comment-## -->

		<?php
		endif;
	}
endif; // ends check for independent_publisher_comment()

if ( ! function_exists( 'independent_publisher_ping' ) ) :
	/**
	 * Template for pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the pings.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_ping( $comment ) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>
		<span> <?php printf( __( '%1$s ', 'independent_publisher' ), get_comment_date( "Y-m-d" ), get_comment_time( "H:i:s" ) ) ?> <?php edit_comment_link( __( '(Edit)', 'independent_publisher' ), '  ', '' ) ?></span>
	<?php
	}
endif; // ends check for independent_publisher_ping()

if ( ! function_exists( 'independent_publisher_posted_author' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_posted_author() {
		/**
		 * This function gets called outside the loop (in header.php),
		 * so we need to figure out the post author ID and Nice Name manually.
		 */
		global $wp_query;
		$post_author_id        = $wp_query->post->post_author;
		$post_author_nice_name = get_the_author_meta( 'display_name', $post_author_id );

		printf( __( '<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'independent_publisher' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'independent_publisher' ), $post_author_nice_name ) ),
			esc_html( $post_author_nice_name )
		);
	}
endif;

if ( ! function_exists( 'independent_publisher_posted_author_cats' ) ) :
	/**
	 * Prints HTML with meta information for the current author and post categories.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_posted_author_cats() {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'independent_publisher' ) );

		if ( independent_publisher_is_multi_author_mode() ) :
			if ( $categories_list && independent_publisher_categorized_blog() ) :
				echo '<span class="cat-links">';
				printf( __( '<a href="%1$s" title="%2$s">%3$s</a> in %4$s', 'independent_publisher' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'independent_publisher' ), get_the_author() ) ),
					esc_html( get_the_author() ),
					$categories_list
				);
				echo '</span>';
			else :
				echo '<span class="cat-links">';
				printf( __( 'by <a href="%1$s" title="%2$s">%3$s</a>', 'independent_publisher' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'independent_publisher' ), get_the_author() ) ),
					esc_html( get_the_author() )
				);
				echo '</span>';
			endif; // End if categories
		else : // not Multi-Author Mode
			if ( $categories_list && independent_publisher_categorized_blog() ) :
				echo '<span class="cat-links">';
				printf( __( 'in %1$s', 'independent_publisher' ),
					$categories_list
				);
				echo '</span>';
			else :
				echo '<span class="cat-links">';
				echo '</span>';
			endif; // End if categories
		endif; // End if independent_publisher_is_multi_author_mode()
	}
endif;

if ( ! function_exists( 'independent_publisher_posted_on_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_posted_on_date() {
		printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'independent_publisher' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
endif;

if ( ! function_exists( 'independent_publisher_continue_reading_link' ) ) :
	/**
	 * Prints HTML with Continue Reading link
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_continue_reading_link() {
		$text = apply_filters( 'independent_publisher_continue_reading_link_text', ' ' . 'Continue Reading &rarr;' );

		printf( __( '<span class="enhanced-excerpt-read-more"><a class="read-more" href="%1$s">%2$s</a></span>', 'independent_publisher' ),
			esc_url( get_permalink() ),
			esc_html( $text )
		);
	}
endif;

if ( ! function_exists( 'independent_publisher_continue_reading_text' ) ) :
	/**
	 * Returns Continue Reading text for usage in the_content()
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_continue_reading_text() {
		return apply_filters( 'independent_publisher_continue_reading_text', __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'independent_publisher' ) );
	}
endif;

if ( ! function_exists( 'get_ncl_location' ) ) :
	/**
	 * Returns location information supplied by Nomad Current Location plugin
	 */
	function get_ncl_location( $prefix = "" ) {

		$location = get_post_meta( get_the_ID(), 'ncl_current_location', TRUE );

		if ( trim( $location ) != "" ) {
			return $location_html = $prefix . '<span class="mapThis" place="' . $location . '" zoom="2">' . $location . '</span>';
		}
		else {
			return $location_html = '';
		}
	}
endif;


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so independent_publisher_categorized_blog should return true
		return true;
	}
	else {
		// This blog has only 1 category so independent_publisher_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in independent_publisher_categorized_blog
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', 'independent_publisher_category_transient_flusher' );
add_action( 'save_post', 'independent_publisher_category_transient_flusher' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'independent_publisher' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'independent_publisher_wp_title', 10, 2 );


/**
 * Returns categories for current post with separator.
 * Optionally returns only a single category.
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_post_categories( $separator = ',', $single = FALSE ) {
	$categories = get_the_category();
	$output     = '';
	if ( $categories ) {
		foreach ( $categories as $category ) {
			$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'independent_publisher' ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator;
			if ( $single )
				break;
		}
	}
	return $output;
}

/**
 * Outputs site info for display on non-single pages
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_site_info() {
	?>
	<?php if ( get_header_image() ) : ?>
		<a class="site-logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img class="no-grav" src="<?php echo esc_url( get_header_image() ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		</a>
	<?php endif; ?>
	<hgroup>
		<h1 class="site-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>

		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</hgroup>
<?php
}

/**
 * Outputs post author info for display on single posts
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_posted_author_card() {
	/**
	 * This function gets called outside the loop (in header.php),
	 * so we need to figure out the post author ID and Nice Name manually.
	 */
	global $wp_query;
	$post_author_id = $wp_query->post->post_author;
	?>
	<a class="site-logo" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ); ?>">
		<?php echo get_avatar( get_the_author_meta( 'ID', $post_author_id ), 100 ); ?>
	</a>
	<hgroup>
		<h1 class="site-title">
			<?php independent_publisher_posted_author(); ?>
		</h1>

		<h2 class="site-description"><?php the_author_meta( 'description', $post_author_id ) ?></h2>
	</hgroup>

	<div class="site-published-separator"></div>
	<hgroup>
		<h2 class="site-published">Published</h2>

		<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>

		<?php if ( function_exists( 'get_ncl_location' ) ) : ?>
			<h2 class="site-published-location"><?php echo get_ncl_location(); ?></h2>
		<?php endif; ?>

	</hgroup>
<?php
}

/**
 * Outputs post author info for display on bottom of single posts
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_posted_author_bottom_card() {

	do_action( 'independent_publisher_before_post_author_bottom_card' );
	?>
	<div class="post-author-bottom">
		<div class="post-author-card">
			<a class="site-logo" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
			</a>

			<div class="post-author-info">
				<h1 class="site-title">
					<?php independent_publisher_posted_author(); ?>
				</h1>

				<h2 class="site-description"><?php the_author_meta( 'description' ) ?></h2>
			</div>
			<div class="post-published-date">
				<h2 class="site-published">Published</h2>

				<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>

				<?php if ( function_exists( 'get_ncl_location' ) ) : ?>
					<h2 class="site-published-location">
						<?php echo get_ncl_location(); ?>
					</h2>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- .post-author-bottom -->
	<?php
	do_action( 'independent_publisher_after_post_author_bottom_card' );
}

if ( ! function_exists( 'independent_publisher_get_post_word_count' ) ) :
	/**
	 * Returns number of words in a post formatted for display in theme
	 * @return string
	 */
	function independent_publisher_get_post_word_count() {
		return sprintf( __( '<span class="sep"> | </span> <span>%1$s Words</span>', 'independent_publisher' ), independent_publisher_post_word_count() );
	}
endif;