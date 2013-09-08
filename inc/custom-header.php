<?php
/**
 * Implements the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Publish
 * @since Publish 1.2.4
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 * @uses publish_get_default_header_image()
 */
function publish_custom_header_setup() {
	$args = array(
		'default-image'          => publish_get_default_header_image(),
		'width'                  => 100,
		'height'                 => 100,
		'flex-width'             => true,
		'flex-height'            => true,
		'header-text'            => false,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	$args = apply_filters( 'publish_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'publish_custom_header_setup' );

/**
 * A default header image
 *
 * Use the admin email's gravatar as the default header image.
 *
 * @since Publish 1.2.3
 */
function publish_get_default_header_image() {

	// Get default from Discussion Settings.
	$default = get_option( 'avatar_default', 'mystery' ); // Mystery man default
	if ( 'mystery' == $default )
		$default = 'mm';
	elseif ( 'gravatar_default' == $default )
		$default = '';

	$url = ( is_ssl() ) ? 'https://secure.gravatar.com' : 'http://gravatar.com';
	$url .= sprintf( '/avatar/%s/', md5( get_option( 'admin_email' ) ) );
	$url = add_query_arg( array(
		's' => 100,
		'd' => urlencode( $default ),
	), $url );

	return esc_url_raw( $url );
} // publish_get_default_header_image