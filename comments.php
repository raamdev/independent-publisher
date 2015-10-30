<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to independent_publisher_comment() which is
 * located in the functions.php file.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( comments_open() && ! independent_publisher_hide_comments() ) : ?>
	<div id="commentform-top"></div> <!-- do not remove; used by jQuery to move the comment reply form here -->
	<?php comment_form( independent_publisher_comment_form_args() ); ?>
<?php endif; ?>

<?php if ( ! independent_publisher_hide_comments() ) : ?>

	<div id="comments" class="comments-area">
		<?php // You can start editing here -- including this comment! ?>
		<?php if ( have_comments() ) : ?>

			<?php if ( get_comments_number() > independent_publisher_min_comments_comment_title() ) : ?>
				<h2 class="comments-title">
					<i class="comments-title-icon"></i>
					<?php
					printf(
						_n( '1 Comment', '%1$s Comments', get_comments_number(), 'independent-publisher' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'
					);
					?>
				</h2>
			<?php endif; ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
					<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'independent-publisher' ); ?></h1>

					<div class="nav-previous"><?php previous_comments_link( '<button>' . __( '&larr; Older Comments', 'independent-publisher' ) . '</button>' ); ?></div>
					<div class="nav-next"><?php next_comments_link( '<button>' . __( 'Newer Comments &rarr;', 'independent-publisher' ) . '</button>' ); ?></div>
				</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use independent_publisher_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define independent_publisher_comment() and that will be used instead.
				 * See independent_publisher_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'type' => 'comment', 'callback' => 'independent_publisher_comment' ) );
				?>
			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
					<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'independent-publisher' ); ?></h1>

					<div class="nav-previous"><?php previous_comments_link( '<button>' . __( '&larr; Older Comments', 'independent-publisher' ) . '</button>' ); ?></div>
					<div class="nav-next"><?php next_comments_link( '<button>' . __( 'Newer Comments &rarr;', 'independent-publisher' ) . '</button>' ); ?></div>
				</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'independent-publisher' ); ?></p>
		<?php endif; ?>

		<?php if ( comments_open() && get_comments_number() >= independent_publisher_min_comments_bottom_comment_button() ) : ?>

			<?php do_action( 'independent_publisher_before_bottom_comment_button' ); ?>

			<div id="share-comment-button-bottom">
				<button>
					<i class="share-comment-icon"></i><?php echo independent_publisher_comments_call_to_action_text() ?>
				</button>
			</div>
			<div id="commentform-bottom"></div> <!-- do not remove; used by jQuery to move the comment reply form here -->
		<?php endif; ?>

		<?php if ( have_comments() && get_comments_number() > 0 ) : // Only show pings/trackbacks if there's at least 1 comment ?>
			<?php if ( count( $wp_query->comments_by_type['pings'] ) ) { ?>
				<div id="pinglist">
					<ul class="pinglist">
						<li class="pinglist-title"><?php echo apply_filters( 'independent_publisher_pingslist_title', __( 'Readers who shared this', 'independent-publisher' ) ); ?></li>
						<?php independent_publisher_pings(); ?>
						<li class="pinglist-title"><?php echo apply_filters( 'independent_publisher_pingslist_end_note', __( 'Thank you!', 'independent-publisher' ) ); ?></li>
					</ul>
				</div>
			<?php } // end if ( count($wp_query->comments_by_type['pings']))?>
		<?php endif; // end have_comments() ?>

		<?php if ( comments_open() && have_comments() && get_comments_number() > 0 ) : ?>
			<?php independent_publisher_replytocom(); // Handles Reply to Comment links properly when JavaScript is enabled ?>
		<?php endif; ?>

	</div><!-- #comments .comments-area -->

<?php endif; // if ( ! independent_publisher_hide_comments() ) ?>
