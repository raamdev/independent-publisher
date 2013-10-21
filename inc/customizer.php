<?php
/**
 * Independent Publisher Theme Customizer
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function independent_publisher_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'independent_publisher_general_options', array(
		'title'    => __( 'Theme Options', 'independent_publisher' ),
		'priority' => 130,
	) );

	// Multi-Author Mode
	$wp_customize->add_setting( 'independent_publisher_general_options[multi_author_mode]', array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'multi_author_mode', array(
		'settings' => 'independent_publisher_general_options[multi_author_mode]',
		'label'    => __( 'Multi Author Mode' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );

	// Use Post Excerpts
	$wp_customize->add_setting( 'independent_publisher_general_options[use_post_excerpts]', array(
		'default'    => true,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'use_post_excerpts', array(
		'settings' => 'independent_publisher_general_options[use_post_excerpts]',
		'label'    => __( 'Use Post Excerpts' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );

	// Use Enhanced Excerpts
	$wp_customize->add_setting( 'independent_publisher_general_options[use_enhanced_excerpts]', array(
		'default'    => true,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'use_enhanced_excerpts', array(
		'settings' => 'independent_publisher_general_options[use_enhanced_excerpts]',
		'label'    => __( 'Use Enhanced Excerpts' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );

	// Show Post Word Count
	$wp_customize->add_setting( 'independent_publisher_general_options[show_post_word_count]', array(
		'default'    => true,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'show_post_word_count', array(
		'settings' => 'independent_publisher_general_options[show_post_word_count]',
		'label'    => __( 'Show Post Word Count' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );

	// Show Post Thumbnail
	$wp_customize->add_setting( 'independent_publisher_general_options[show_post_thumbnail]', array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'show_post_thumbnail', array(
		'settings' => 'independent_publisher_general_options[show_post_thumbnail]',
		'label'    => __( 'Show Post Thumbnail' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );
}

add_action( 'customize_register', 'independent_publisher_customize_register' );