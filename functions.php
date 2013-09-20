<?php
/**
 * Publish functions and definitions
 *
 * @package Independent Publisher
 * @since Independent Publisher 1.0
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
	 * Theme Options
	 */
	require( get_template_directory() . '/theme-options.php' );

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
	 * @since Independent Publisher 1.2
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

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'sharing-buttons', get_template_directory_uri() . '/js/sharing-buttons.js', array(), '20130920', true );

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
 * @since Independent Publisher 1.2
 */
function independent_publisher_footer_credits() {
	echo independent_publisher_get_footer_credits();
}
add_action( 'independent_publisher_credits', 'independent_publisher_footer_credits' );

/**
 * Returns the theme's footer credits
 *
 * @return string
 *
 * @since Independent Publisher 1.2
 */
function independent_publisher_get_footer_credits( $credits = '' ) {
	return sprintf(
		'%1$s',
		sprintf( __( '%1$s empowered by %2$s.', 'independent_publisher' ), '<a href="http://independentpublisher.me/">Independent Publisher</a>', '<a href="http://wordpress.org/" rel="generator">open-source publishing</a>' )
	);
}
add_filter( 'infinite_scroll_credit', 'independent_publisher_get_footer_credits' );

/**
 * Prepends the post format name to post titles on single view
 *
 * @param string $title
 * @return string
 *
 * @since Independent Publisher 1.2-wpcom
 */
function independent_publisher_post_format_title( $title, $post_id = false ) {
	if ( ! $post_id )
		return $title;

	$post = get_post( $post_id );

	// Prevent prefixes on menus and other areas that use the_title filter.
	if ( ! $post || $post->post_type != 'post' )
		return $title;

	if ( is_single() && (bool) get_post_format() )
		$title = sprintf( '<span class="entry-format">%1$s: </span>%2$s', get_post_format_string( get_post_format() ), $title );

	return $title;
}
add_filter( 'the_title', 'independent_publisher_post_format_title', 10, 2 );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Fix comment count so that it doesn't include pings/trackbacks
 */
add_filter('get_comments_number', 'independent_publisher_comment_count', 0);
function independent_publisher_comment_count($count)
	{
		if(!is_admin())
			{
				global $id;
				$comments_by_type = & separate_comments(get_comments('status=approve&post_id='.$id));
				return count($comments_by_type['comment']);
			}
		else
			{
				return $count;
			}
	}

/**
 * Fix comment count so that it doesn't include pings/trackbacks
 */
add_filter('erp-related-links-output', 'independent_publisher_erp_title', 0);
function independent_publisher_erp_title($output)
	{
		if(strpos($output, 'No Related Posts Found'))
			return '';
		else
			return $output = str_replace("<ul class='related_post'>", "<ul class='related_post'><li class='related_post_title'>Related Thoughts, Essays, and Journals</li>", $output );
	}

/*
 * Change the comment reply link to use 'Reply to [Author First Name]'
 */
function independent_publisher_author_comment_reply_link($link, $args, $comment){

	$comment = get_comment( $comment );

	// If no comment author is blank, use 'Anonymous'
	if ( empty($comment->comment_author) ) {
		if (!empty($comment->user_id)){
			$user=get_userdata($comment->user_id);
			$author=$user->user_login;
		} else {
			$author = __('Anonymous');
		}
	} else {
		$author = $comment->comment_author;
	}

	// If the user provided more than a first name, use only first name
	if(strpos($author, ' ')){
		$author = substr($author, 0, strpos($author, ' '));
	}

	// Replace Reply Link with "Reply to <Author First Name>"
	$reply_link_text = $args['reply_text'];
	$link = str_replace($reply_link_text, 'Reply to ' . $author, $link);

	return $link;
}
add_filter('comment_reply_link', 'independent_publisher_author_comment_reply_link', 420, 4);

/**
 * Register font-awesome style sheet.
 */
add_action( 'wp_enqueue_scripts', 'register_font_awesome_style' );
function register_font_awesome_style() {
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '3.2.1' );
	wp_enqueue_style( 'font-awesome' );
}
