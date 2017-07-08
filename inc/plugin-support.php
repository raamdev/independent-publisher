<?php
/**
 * Code that improves theme support for various plugins
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/*
 * Wrapper function for a possible custom display of Syndication Links output
 */
function independent_publisher_syndication_links( $separator ) {
	$args = array(
		'text' => false,
		'icons' => true
	);
	echo get_syndication_links( get_the_ID(), $args );
}

/*
 * Wrapper function for a possible custom display of Simple Location output
 */
function independent_publisher_simple_location( $separator ) {
	echo '<h3 class="site-location">' . __( 'Location', 'independent-publisher' ) . '</h3>';
	echo '<h3 class="site-location-detail">' . Loc_View::get_location() . '</h3>';
}

function independent_publisher_indieweb_plugin_support() {
	/*
 	* Adds support for Syndication Links
 	*/
	if ( class_exists( 'Syn_Meta' ) ) {
		remove_filter( 'the_content', array( 'Syn_Config', 'the_content' ), 30 );
		add_action( 'independent_publisher_entry_meta_top', 'independent_publisher_syndication_links', 11 );
	}
	/*
	 * Adds suport for Simple Location
	 */
	if ( class_exists( 'Loc_View' ) ) {
		remove_filter( 'the_content', array( 'Loc_View', 'location_content' ), 12 );
		add_action( 'independent_publisher_after_post_published_date', 'independent_publisher_simple_location' );

	}

}

add_action( 'init', 'independent_publisher_indieweb_plugin_support', 11 );

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
