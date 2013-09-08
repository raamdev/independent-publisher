<?php
/**
 * Publish functions and definitions
 *
 * @package Publish
 * @since Publish 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Publish 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 525; /* pixels */

if ( ! function_exists( 'publish_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Publish 1.0
 */
function publish_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'publish', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'publish' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'chat', 'image', 'video' ) );

	/**
	 * Add support for Infinite Scroll
	 * @since Publish 1.2
	 */
	add_theme_support( 'infinite-scroll', array(
		'footer' => 'page',
	) );
}
endif; // publish_setup
add_action( 'after_setup_theme', 'publish_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Publish 1.0
 */
function publish_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'publish' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'publish_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function publish_scripts() {
	global $post;

	wp_enqueue_style( 'publish-style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'publish_scripts' );

/**
 * Echoes the theme's footer credits
 *
 * @since Publish 1.2
 */
function publish_footer_credits() {
	echo publish_get_footer_credits();
}
add_action( 'publish_credits', 'publish_footer_credits' );

/**
 * Returns the theme's footer credits
 *
 * @return string
 *
 * @since Publish 1.2
 */
function publish_get_footer_credits( $credits = '' ) {
	return sprintf(
		'%1$s %2$s',
		'<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a>',
		sprintf( __( 'Theme: %1$s by %2$s.', 'publish' ), 'Publish', '<a href="http://kovshenin.com/" rel="designer">Konstantin Kovshenin</a>' )
	);
}
add_filter( 'infinite_scroll_credit', 'publish_get_footer_credits' );

/**
 * Prepends the post format name to post titles on single view
 *
 * @param string $title
 * @return string
 *
 * @since Publish 1.2-wpcom
 */
function publish_post_format_title( $title, $post_id = false ) {
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
add_filter( 'the_title', 'publish_post_format_title', 10, 2 );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
