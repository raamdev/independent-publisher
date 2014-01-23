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
		$GLOBALS['comment']    = $comment;
		$comment_content_class = ''; // Used to style the comment-content differently when comment is awaiting moderation
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 48 ); ?>
					<?php printf( sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<?php $comment_content_class = "unapproved"; ?>
						<em><?php _e( ' - Your comment is awaiting moderation.', 'independent_publisher' ); ?></em>
					<?php endif; ?>
				</div>
				<!-- .comment-author .vcard -->
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

			<div class="comment-content <?php echo $comment_content_class; ?>"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<!-- .reply -->
		</article><!-- #comment-## -->
	<?php
	}
endif; // ends check for independent_publisher_comment()

if ( ! function_exists( 'independent_publisher_pings' ) ) :
	/**
	 * Creates a custom query for pingbacks/trackbacks (i.e., 'pings')
	 * and displays them. Using this custom query instead of
	 * wp_list_comments() allows us to always show all pings,
	 * even when we're showing paginated comments.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_pings() {
		$args        = array(
			'post_id' => get_the_ID(),
			'type'    => 'pings'
		);
		$pings_query = new WP_Comment_Query;
		$pings       = $pings_query->query( $args );

		if ( $pings ) {
			foreach ( $pings as $ping ) {
				?>
				<li <?php comment_class( '', $ping->comment_ID ); ?> id="li-comment-<?php echo $ping->comment_ID ?>">
				<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link( $ping->comment_ID ) ) ?>
				<span> <?php edit_comment_link( __( '(Edit)', 'independent_publisher' ), '  ', '' ) ?></span>
			<?php
			}
		}
	}
endif; // ends check for independent_publisher_pings()

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

		if ( ( ! post_password_required() && comments_open() ) || ( ! post_password_required() && independent_publisher_show_post_word_count() ) ) {
			$separator = apply_filters( 'independent_publisher_entry_meta_separator', '|' ); // @TODO Document independent_publisher_entry_meta_separator filter
		}
		else {
			$separator = '';
		}

		if ( independent_publisher_is_multi_author_mode() ) :
			if ( $categories_list && independent_publisher_categorized_blog() ) :
				echo '<span class="cat-links">';
				printf( __( '<a href="%1$s" title="%2$s">%3$s</a> %4$s %5$s', 'independent_publisher' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'independent_publisher' ), get_the_author() ) ),
					esc_html( get_the_author() ),
					independent_publisher_entry_meta_category_prefix(),
					$categories_list
				);
				echo '</span> <span class="sep"> ' . $separator . '</span>';
			else :
				echo '<span class="cat-links">';
				printf( __( '%1$s <a href="%2$s" title="%3$s">%4$s</a>', 'independent_publisher' ),
					independent_publisher_entry_meta_author_prefix(),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'independent_publisher' ), get_the_author() ) ),
					esc_html( get_the_author() )
				);
				echo '</span>';
			endif; // End if categories
		else : // not Multi-Author Mode
			if ( $categories_list && independent_publisher_categorized_blog() ) :
				echo '<span class="cat-links">';
				printf( __( '%1$s %2$s', 'independent_publisher' ),
					independent_publisher_entry_meta_category_prefix(),
					$categories_list
				);
				echo '</span> <span class="sep"> ' . $separator . '</span>';
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

if ( ! function_exists( 'independent_publisher_categorized_blog' ) ) :
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
endif;

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

if ( ! function_exists( 'independent_publisher_wp_title' ) ) :
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
endif;

add_filter( 'wp_title', 'independent_publisher_wp_title', 10, 2 );

if ( ! function_exists( 'independent_publisher_post_categories' ) ) :
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
endif;

if ( ! function_exists( 'independent_publisher_site_info' ) ) :
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
		<?php get_template_part( 'menu', 'social' ); ?>
	<?php
	}
endif;

if ( ! function_exists( 'independent_publisher_posted_author_card' ) ) :
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

		<?php get_template_part( 'menu', 'social' ); ?>

		<div class="site-published-separator"></div>
		<hgroup>
			<h2 class="site-published">Published</h2>

			<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>

			<?php do_action( 'independent_publisher_after_post_published_date' ); ?>

		</hgroup>
	<?php
	}
endif;

if ( ! function_exists( 'independent_publisher_posted_author_bottom_card' ) ) :
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

					<?php do_action( 'independent_publisher_after_post_published_date' ); ?>

				</div>
			</div>
		</div>
		<!-- .post-author-bottom -->
		<?php
		do_action( 'independent_publisher_after_post_author_bottom_card' );
	}
endif;

if ( ! function_exists( 'independent_publisher_get_post_word_count' ) ) :
	/**
	 * Returns number of words in a post formatted for display in theme
	 * @return string
	 */
	function independent_publisher_get_post_word_count() {
		if ( ! post_password_required() && comments_open() ) {
			$separator = ' <span class="sep"> ' . apply_filters( 'independent_publisher_entry_meta_separator', '|' ); // @TODO Document independent_publisher_entry_meta_separator filter . ' </span>';
		}
		else {
			$separator = '';
		}
		return sprintf( __( '<span>%1$s Words</span>' . $separator, 'independent_publisher' ), independent_publisher_post_word_count() );
	}
endif;

if ( ! function_exists( 'independent_publisher_full_width_featured_image' ) ):
	/**
	 * Show Full Width Featured Image on single pages if post has full width featured image selected
	 */
	function independent_publisher_full_width_featured_image() {
		if ( is_single() && independent_publisher_has_full_width_featured_image() ) {
			while ( have_posts() ) : the_post();
				$full_width_featured_image = get_post_meta( get_the_ID(), 'full_width_featured_image' );
				if ( $full_width_featured_image ) :
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( array( 700, 700 ), array( 'class' => 'full-width-featured-image' ) );
					endif;
				endif;
			endwhile; // end of the loop.
		}
	}
endif;

if ( ! function_exists( 'independent_publisher_search_stats' ) ):
	/**
	 * Returns stats for search results
	 */
	function independent_publisher_search_stats() {
		global $wp_query;
		$total            = $wp_query->found_posts;
		$total_pages      = $wp_query->max_num_pages; // The total number of pages
		$current_page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$pagination_info  = '';

		/**
		 * Only show pagination info when there is more than 1 page
		 */
		if ( $total_pages > 1 ) {
			$pagination_info = sprintf( __( ' (this is page <strong>%1$s</strong> of <strong>%2$s</strong>)', 'independent_publisher' ), number_format_i18n( $current_page_num ), number_format_i18n( $total_pages ) );
		}

		$stats_text = sprintf( _n( 'Found one search result for <strong>%2$s</strong>.', 'Found %1$s search results for <strong>%2$s</strong>' . $pagination_info . '.', $total, 'independent_publisher' ), number_format_i18n( $total ), get_search_query() );

		return wpautop( $stats_text );
	}
endif;

if ( ! function_exists( 'independent_publisher_taxonomy_archive_stats' ) ):
	/**
	 * Returns taxonomy archive stats and current page info for use in taxonomy archive descriptions
	 */
	function independent_publisher_taxonomy_archive_stats( $taxonomy = 'category' ) {
		global $wp_query;
		$total            = $wp_query->found_posts;
		$total_pages      = $wp_query->max_num_pages; // The total number of pages
		$current_page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$pagination_info  = '';
		$stats_text       = '';

		/**
		 * Only show pagination info when there is more than 1 page
		 */
		if ( $total_pages > 1 ) {
			$pagination_info = sprintf( __( ' (this is page <strong>%1$s</strong> of <strong>%2$s</strong>)', 'independent_publisher' ), number_format_i18n( $current_page_num ), number_format_i18n( $total_pages ) );
		}

		if ( $taxonomy === 'category' ) {
			$stats_text = sprintf( _n( 'There is one post filed in <strong>%2$s</strong>.', 'There are %1$s posts filed in <strong>%2$s</strong>' . $pagination_info . '.', $total, 'independent_publisher' ), number_format_i18n( $total ), single_term_title( '', false ) );
		}
		elseif ( $taxonomy === 'post_tag' ) {
			$stats_text = sprintf( _n( 'There is one post tagged <strong>%2$s</strong>.', 'There are %1$s posts tagged <strong>%2$s</strong>' . $pagination_info . '.', $total, 'independent_publisher' ), number_format_i18n( $total ), single_term_title( '', false ) );
		}
		return wpautop( $stats_text );
	}
endif;

if ( ! function_exists( 'independent_publisher_date_archive_description' ) ):
	/**
	 * Returns the Date Archive description
	 */
	function independent_publisher_date_archive_description() {
		global $wp_query;
		$total            = $wp_query->found_posts; // The total number of posts found for this query
		$total_pages      = $wp_query->max_num_pages; // The total number of pages
		$current_page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$pagination_info  = '';

		/**
		 * Allow overriding the date archive description with a custom description
		 */
		$date_archive_meta = apply_filters( 'custom_date_archive_meta', '' ); // @TODO Document custom_date_archive_meta filter

		/**
		 * Only show pagination info when there is more than 1 page
		 */
		if ( $total_pages > 1 ) {
			$pagination_info = sprintf( __( ' (this is page <strong>%1$s</strong> of <strong>%2$s</strong>)', 'independent_publisher' ), number_format_i18n( $current_page_num ), number_format_i18n( $total_pages ) );
		}

		/**
		 * Only proceed if we're on the first page and the description has not been overridden via custom_date_archive_meta
		 */
		if ( trim( $date_archive_meta ) === '' ) {
			if ( is_year() ) {
				$date_archive_meta = sprintf( _n( 'There was one post published in %2$s.', 'There were %1$s posts published in %2$s' . $pagination_info . '.', $total, 'independent_publisher' ), number_format_i18n( $total ), get_the_date( 'Y' ) );
			}
			else if ( is_day() ) {
				$date_archive_meta = sprintf( _n( 'There was one post published on %2$s.', 'There were %1$s posts published on %2$s' . $pagination_info . '.', $total, 'independent_publisher' ),
					number_format_i18n( $total ), get_the_date() );
			}
			else if ( is_month() ) {
				$year = get_query_var( 'year' );
				if ( empty( $year ) ) {
					$date_archive_meta = sprintf( _n( 'There was one post published in the month of %2$s.', 'There were %1$s posts published in %2$s' . $pagination_info . '.', $total, 'independent_publisher' ),
						number_format_i18n( $total ), get_the_date( 'F' ) );
				}
				else {
					$date_archive_meta = sprintf( _n( 'There was one post published in %2$s %3$s.', 'There were %1$s posts published in %2$s %3$s' . $pagination_info . '.', $total, 'independent_publisher' ),
						number_format_i18n( $total ), get_the_date( 'F' ), get_the_date( 'Y' ) );
				}
			}
		}
		$date_archive_meta = wpautop( $date_archive_meta );

		return apply_filters( 'date_archive_meta', '<div class="intro-meta">' . $date_archive_meta . '</div>' );
	}
endif;

if ( ! function_exists( 'independent_publisher_min_comments_bottom_share_button' ) ):
	/**
	 * Returns the minimum number of comments that must exist for the bottom 'Share a comment' button to appear
	 */
	function independent_publisher_min_comments_bottom_share_button() {
		return 4;
	}
endif;

if ( ! function_exists( 'independent_publisher_min_comments_comment_title' ) ):
	/**
	 * Returns the minimum number of comments that must exist for the comments title to appear
	 */
	function independent_publisher_min_comments_comment_title() {
		return 10;
	}
endif;