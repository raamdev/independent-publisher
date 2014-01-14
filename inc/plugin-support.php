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

/*
 * Adds support for showing WP Comment Subscriptions plugin options after comment form fields
 */
if ( function_exists( 'wp_comment_subscriptions_show' ) ) {
	if ( get_option( 'wp_comment_subscriptions_show_subscription_box', 'yes' ) !== 'yes' ) {
		add_action( 'comment_form_logged_in_after', 'wp_comment_subscriptions_show' );
		add_action( 'comment_form_after_fields', 'wp_comment_subscriptions_show' );
	}
}

if ( ! function_exists( 'independent_publisher_jetpack_sharing_css' ) ) :
	/**
	 * Improves the style of JetPack Sharing Buttons when used with this theme
	 */
	function independent_publisher_jetpack_sharing_css() {
		$sharedaddy_disable_resources = get_option( 'sharedaddy_disable_resources' );
		if ( isset( $sharedaddy_disable_resources ) && $sharedaddy_disable_resources !== "1" ) {
			wp_enqueue_style( 'independent-publisher-jetpack-sharing', get_template_directory_uri() . '/css/jetpack-sharing.css', array(), '1.0' );
		}
	}
endif;

if ( ! function_exists( 'independent_publisher_jetpack_sharing_label_css' ) ) :
	/**
	 * When the JetPack Sharing Buttons "Sharing label" is blank, this floats the sharing
	 * buttons right instead of left and removes right padding to improve display.
	 */
	function independent_publisher_jetpack_sharing_label_css() {
		$sharedaddy_options = get_option( 'sharing-options' );
		if ( isset( $sharedaddy_options['global']['sharing_label'] ) ) {
			$sharedaddy_disable_resources = get_option( 'sharedaddy_disable_resources' );
			if ( trim( $sharedaddy_options['global']['sharing_label'] ) === '' && ( ! isset( $sharedaddy_disable_resources ) || $sharedaddy_disable_resources !== "1" ) )
				wp_enqueue_style( 'independent-publisher-jetpack-sharing-label', get_template_directory_uri() . '/css/jetpack-sharing-label.css', array(), '1.0' );
		}
	}
endif;