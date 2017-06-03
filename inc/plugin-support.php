<?php
/**
 * Code that improves theme support for various plugins
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/*
 * Adds support for showing Subscribe to Comments Reloaded options after comment form fields
 */
if ( function_exists( 'subscribe_reloaded_show' ) ) {
	if ( get_option( 'subscribe_reloaded_show_subscription_box', 'yes' ) !== 'yes' ) {
		add_action( 'comment_form_logged_in_after', 'subscribe_reloaded_show' );
		add_action( 'comment_form_after_fields', 'subscribe_reloaded_show' );
	}
}

if ( !function_exists( 'independent_publisher_jetpack_dark_overlay_fix_css' ) ) :
	/**
	 * Fixes an issue with a dark overlay that appears < 800px when the Jetpack Infinite Scroll
	 * module is enabled. See https://github.com/raamdev/independent-publisher/issues/72
	 */
	function independent_publisher_jetpack_dark_overlay_fix_css() {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			wp_enqueue_style( 'independent-publisher-jetpack-infinite-scroll-dark-overlay-fix', get_template_directory_uri() . '/css/jetpack-infinite-scroll-dark-overlay-fix.css', array(), '1.0' );
		}
	}
endif;

/**
 * When the Disqus Commenting System is active and enabled, don't load our comment form enhancements
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Required to use is_plugin_active() here
if (
	is_plugin_active( 'disqus-comment-system/disqus.php' )
	&& ! function_exists( 'independent_publisher_enhanced_comment_form' )
) :
	if ( get_option( 'disqus_active' ) !== '0' ) {
		function independent_publisher_enhanced_comment_form() {
			return;
		}
	}
endif;

/*
 * When Jetpack Comments is enabled, don't load our comment form enhancements
 */
if (
	class_exists( 'Jetpack' )
	&& Jetpack::is_module_active( 'comments' )
	&& ! function_exists( 'independent_publisher_enhanced_comment_form' )
) {
	function independent_publisher_enhanced_comment_form() {
		return;
	}
}

if ( !function_exists( 'independent_publisher_wp_pagenavi_css' ) ) :
	/**
	 * Improves the style of WP-PageNavi when used with this theme
	 */
	function independent_publisher_wp_pagenavi_css() {
		if ( function_exists('wp_pagenavi') ) {
			wp_enqueue_style( 'independent-publisher-wp-pagenavi-css', get_template_directory_uri() . '/css/wp-pagenavi.css', array(), '1.7' );
		}
	}
endif;
