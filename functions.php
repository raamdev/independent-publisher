<?php
/**
 * Publish functions and definitions
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Independent Publisher 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 525; /* pixels */

if ( ! function_exists( 'independent_publisher_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * @since Independent Publisher 1.0
	 */
	function independent_publisher_setup() {

		/**
		 * Custom template tags for this theme.
		 */
		require( get_template_directory() . '/inc/template-tags.php' );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'independent_publisher', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable Custom Backgrounds
		 */
		add_theme_support( 'custom-background' );

		/**
		* Enable Post Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable editor style
		 */
		add_editor_style();

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'independent_publisher' ),
		) );

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'chat', 'image', 'video' ) );

		/**
		 * Add support for Infinite Scroll
		 * @since Independent Publisher 1.0
		 */
		add_theme_support( 'infinite-scroll', array(
			'footer' => 'page',
		) );
	}
endif; // independent_publisher_setup
add_action( 'after_setup_theme', 'independent_publisher_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'independent_publisher' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

add_action( 'widgets_init', 'independent_publisher_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function independent_publisher_scripts() {
	global $post;

	wp_enqueue_style( 'publish-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}

add_action( 'wp_enqueue_scripts', 'independent_publisher_scripts' );

/**
 * Echoes the theme's footer credits
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_footer_credits() {
	echo independent_publisher_get_footer_credits();
}

add_action( 'independent_publisher_credits', 'independent_publisher_footer_credits' );

/**
 * Returns the theme's footer credits
 *
 * @param string $credits
 *
 * @return string
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_get_footer_credits( $credits = '' ) {
	return sprintf(
		'%1$s',
		sprintf( __( '%1$s empowered by %2$s.', 'independent_publisher' ), '<a href="' . esc_url( 'http://independentpublisher.me' ) . '" rel="designer">Independent Publisher</a>', '<a href="http://wordpress.org/" rel="generator">open-source publishing</a>' )
	);
}

add_filter( 'infinite_scroll_credit', 'independent_publisher_get_footer_credits' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Fix comment count so that it doesn't include pings/trackbacks
 */
add_filter( 'get_comments_number', 'independent_publisher_comment_count', 0 );
function independent_publisher_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = & separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	}
	else {
		return $count;
	}
}

/*
 * Change the comment reply link to use 'Reply to [Author First Name]'
 */
function independent_publisher_author_comment_reply_link( $link, $args, $comment ) {

	$comment = get_comment( $comment );

	// If no comment author is blank, use 'Anonymous'
	if ( empty( $comment->comment_author ) ) {
		if ( ! empty( $comment->user_id ) ) {
			$user   = get_userdata( $comment->user_id );
			$author = $user->user_login;
		}
		else {
			$author = __( 'Anonymous', 'independent_publisher' );
		}
	}
	else {
		$author = $comment->comment_author;
	}

	// If the user provided more than a first name, use only first name
	if ( strpos( $author, ' ' ) ) {
		$author = substr( $author, 0, strpos( $author, ' ' ) );
	}

	// Replace Reply Link with "Reply to <Author First Name>"
	$reply_link_text = $args['reply_text'];
	$link            = str_replace( $reply_link_text, 'Reply to ' . $author, $link );

	return $link;
}

add_filter( 'comment_reply_link', 'independent_publisher_author_comment_reply_link', 420, 4 );

/**
 * Register font-awesome style sheet.
 */
add_action( 'wp_enqueue_scripts', 'register_font_awesome_style' );
function register_font_awesome_style() {
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '3.2.1' );
	wp_enqueue_style( 'font-awesome' );
}

/*
 * Show Subscribe to Comments Reloaded options after comment form fields
 */
if ( function_exists( 'subscribe_reloaded_show' ) ) :
	add_action( 'comment_form_logged_in_after', 'subscribe_reloaded_show' );
	add_action( 'comment_form_after_fields', 'subscribe_reloaded_show' );
endif;

/**
 * Arguments for comment_form()
 *
 * @return array
 */
function independent_publisher_comment_form_args() {

	if ( ! is_user_logged_in() ) {
		$comment_notes_before = '';
		$comment_notes_after  = '';
	}
	else {
		$comment_notes_before = '';
		$comment_notes_after  = '';
	}

	$user      = wp_get_current_user();
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( '', 'independent_publisher' ),
		'title_reply_to'       => __( 'Leave a Reply for %s', 'independent_publisher' ),
		'cancel_reply_link'    => __( 'Cancel Reply', 'independent_publisher' ),
		'label_submit'         => __( 'Submit Comment', 'independent_publisher' ),

		'must_log_in'          => '<p class="must-log-in">' .
		sprintf(
			__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
			wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',

		'logged_in_as'         => '<p class="logged-in-as">' .
		sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
			admin_url( 'profile.php' ),
			$user->display_name,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',

		'comment_notes_before' => $comment_notes_before,

		'comment_notes_after'  => $comment_notes_after,

		'fields'               => apply_filters( 'comment_form_default_fields', array(
				'author' =>
				'<p class="comment-form-author"><label for="author">' . __( 'Name', 'independent_publisher' ) . '</label>' .
				( $req ? '' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'"' . $aria_req . ' /></p>',

				'email'  =>
				'<p class="comment-form-email"><label for="email">' . __( 'Email', 'independent_publisher' ) . '</label>' .
				( $req ? '' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
				'"' . $aria_req . ' /></p>',

				'url'    =>
				'<p class="comment-form-url"><label for="url">' . __( 'Website', 'independent_publisher' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" /></p>',
			)
		),
	);

	return $args;
}

/**
 * Move the comment form textarea above the comment fields
 */
function independent_publisher_remove_textarea( $defaults ) {
	$defaults['comment_field'] = '';
	return $defaults;
}

function independent_publisher_add_textarea() {
	echo '<div id="main-reply-title"><h3>Share a Comment</h3></div>';
	echo '<div class="comment-form-reply-title"><p>Comment</p></div>';
	echo '<p class="comment-form-comment" id="comment-form-field"><textarea id="comment" name="comment" cols="60" rows="6" aria-required="true"></textarea></p>';
}

add_filter( 'comment_form_defaults', 'independent_publisher_remove_textarea' );
add_action( 'comment_form_top', 'independent_publisher_add_textarea' );

/**
 * Register enhanced comment form stylesheet
 */
function independent_publisher_enhanced_comment_form_style() {
	wp_register_style( 'enhanced-comment-form-css', get_template_directory_uri() . '/css/enhanced-comment-form.css', array(), '1.0' );
	wp_enqueue_style( 'enhanced-comment-form-css' );
}

add_action( 'wp_enqueue_scripts', 'independent_publisher_enhanced_comment_form_style' );

/**
 * Enqueue enhanced comment form JavaScript
 */
function independent_publisher_enhanced_comment_form() {
	wp_enqueue_script( 'enhanced-comment-form-js', get_template_directory_uri() . '/js/enhanced-comment-form.js', array(), '20130920', true );
}

add_action( 'wp_enqueue_scripts', 'independent_publisher_enhanced_comment_form' );

if ( ! function_exists( 'independent_publisher_single_author_link' ) ) :
	/**
	 * Independent Publisher is designed for single-author sites.
	 * This forces author links to point to the home page. This can be overridden in a child theme.
	 */
	add_filter( 'author_link', 'independent_publisher_single_author_link', 10, 3 );
	function independent_publisher_single_author_link() {
		return get_home_url();
	}
endif;