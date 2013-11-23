<?php
/**
 * Independent Publisher Theme Customizer
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function independent_publisher_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'independent_publisher_general_options', array(
		'title'    => __( 'Theme Options', 'independent_publisher' ),
		'priority' => 130,
	) );

	// Excerpt Options
	$wp_customize->add_setting( 'independent_publisher_general_options[excerpts]', array(
		'default'    => '2',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'excerpts', array(
		'settings' => 'independent_publisher_general_options[excerpts]',
		'label'   => 'Post Excerpts:',
		'section' => 'independent_publisher_general_options',
		'type'    => 'select',
		'choices'    => array(
			'0' => 'Disabled',
			'1' => 'Default Excerpts',
			'2' => 'One-Sentence Excerpts',
		),
	) );

	// Show Full Content for First Post
	$wp_customize->add_setting( 'independent_publisher_general_options[show_full_content_first_post]', array(
		'default'    => true,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'show_full_content_first_post', array(
		'settings' => 'independent_publisher_general_options[show_full_content_first_post]',
		'label'    => __( 'Show Full Content for First Post', 'independent_publisher' ),
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
		'label'    => __( 'Show Post Word Count in Entry Meta', 'independent_publisher' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );

	// Hide Widgets on Single pages
	$wp_customize->add_setting( 'independent_publisher_general_options[hide_widgets_on_single]', array(
		'default'    => true,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'hide_widgets_on_single', array(
		'settings' => 'independent_publisher_general_options[hide_widgets_on_single]',
		'label'    => __( 'Hide Widgets on Single Pages', 'independent_publisher' ),
		'section'  => 'independent_publisher_general_options',
		'type'     => 'checkbox',
	) );
}

add_action( 'customize_register', 'independent_publisher_customize_register' );