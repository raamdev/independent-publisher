<?php
/**
 * Independent Publisher Theme Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

class IndependentPublisher_Customize {

	public static function register ( $wp_customize ) {

		$wp_customize->add_section( 'independent_publisher_excerpt_options', array(
			'title'    => __( 'Excerpts', 'independent_publisher' ),
			'priority' => 125,
		) );

		$wp_customize->add_section( 'independent_publisher_general_options', array(
			'title'    => __( 'General Options', 'independent_publisher' ),
			'priority' => 130,
		) );

		// Excerpt Options
		$wp_customize->add_setting( 'independent_publisher_excerpt_options[excerpts]', array(
			'default'    => '0',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		) );
		$wp_customize->add_control( 'excerpts', array(
			'label'      => __('Post Excerpts', 'independent_publisher'),
			'settings' => 'independent_publisher_excerpt_options[excerpts]',
			'section' => 'independent_publisher_excerpt_options',
			'type'    => 'radio',
			'choices'    => array(
				'0' => 'Disabled',
				'1' => 'Default Excerpts',
				'2' => 'One-Sentence Excerpts',
			),
		) );

		// Show Full Content for First Post
		$wp_customize->add_setting( 'independent_publisher_excerpt_options[show_full_content_first_post]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		) );
		$wp_customize->add_control( 'show_full_content_first_post', array(
			'settings' => 'independent_publisher_excerpt_options[show_full_content_first_post]',
			'label'    => __( 'Always Show Full Content for First Post', 'independent_publisher' ),
			'section'  => 'independent_publisher_excerpt_options',
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

		// Show Widgets on Single pages
		$wp_customize->add_setting( 'independent_publisher_general_options[show_widgets_on_single]', array(
			'default'    => false,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		) );
		$wp_customize->add_control( 'show_widgets_on_single', array(
			'settings' => 'independent_publisher_general_options[show_widgets_on_single]',
			'label'    => __( 'Show Widgets on Single Pages', 'independent_publisher' ),
			'section'  => 'independent_publisher_general_options',
			'type'     => 'checkbox',
		) );
	}
}

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'IndependentPublisher_Customize' , 'register' ) );