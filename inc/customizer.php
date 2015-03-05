<?php

/**
 * Independent Publisher Theme Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link    http://codex.wordpress.org/Theme_Customization_API
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
class IndependentPublisher_Customize {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
					 'independent_publisher_layout_options', array(
							 'title'    => __( 'Layout Options', 'independent-publisher' ),
							 'priority' => 124,
						 )
		);

		$wp_customize->add_section(
					 'independent_publisher_excerpt_options', array(
							 'title'    => __( 'Excerpt Options', 'independent-publisher' ),
							 'priority' => 125,
						 )
		);

		$wp_customize->add_section(
					 'independent_publisher_general_options', array(
							 'title'    => __( 'General Options', 'independent-publisher' ),
							 'priority' => 130,
						 )
		);

		// Excerpt Options
		$wp_customize->add_setting(
					 'independent_publisher_excerpt_options[excerpts]', array(
							 'default'    => '0',
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_select_excerpt_options',
						 )
		);
		$wp_customize->add_control(
					 'excerpts', array(
							 'label'    => __( 'Post Excerpts', 'independent-publisher' ),
							 'settings' => 'independent_publisher_excerpt_options[excerpts]',
							 'section'  => 'independent_publisher_excerpt_options',
							 'type'     => 'select',
							 'choices'  => array(
								 '0' => __( 'Disabled', 'independent-publisher' ),
								 '1' => __( 'Enabled', 'independent-publisher' )
							 ),
						 )
		);

		// Generate One-Sentence Excerpts
		$wp_customize->add_setting(
					 'independent_publisher_excerpt_options[generate_one_sentence_excerpts]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'generate_one_sentence_excerpts', array(
							 'settings' => 'independent_publisher_excerpt_options[generate_one_sentence_excerpts]',
							 'label'    => __( 'Generate One-Sentence Excerpts', 'independent-publisher' ),
							 'section'  => 'independent_publisher_excerpt_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Full Content for First Post
		$wp_customize->add_setting(
					 'independent_publisher_excerpt_options[show_full_content_first_post]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_full_content_first_post', array(
							 'settings' => 'independent_publisher_excerpt_options[show_full_content_first_post]',
							 'label'    => __( 'Always Show Full Content for First Post', 'independent-publisher' ),
							 'section'  => 'independent_publisher_excerpt_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Post Word Count
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_post_word_count]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_post_word_count', array(
							 'settings' => 'independent_publisher_general_options[show_post_word_count]',
							 'label'    => __( 'Show Post Word Count in Entry Meta', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Date in Entry Meta
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_date_entry_meta]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_date_entry_meta', array(
							 'settings' => 'independent_publisher_general_options[show_date_entry_meta]',
							 'label'    => __( 'Show Post Date in Entry Meta', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Widgets on Single Posts
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_widgets_on_single]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_widgets_on_single', array(
							 'settings' => 'independent_publisher_general_options[show_widgets_on_single]',
							 'label'    => __( 'Show Widgets on Single Posts', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Nav Menu on Single Posts
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_nav_menu_on_single]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_nav_menu_on_single', array(
							 'settings' => 'independent_publisher_general_options[show_nav_menu_on_single]',
							 'label'    => __( 'Show Nav Menu on Single Posts', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Updated Date on Single Posts
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_updated_date_on_single]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_updated_date_on_single', array(
							 'settings' => 'independent_publisher_general_options[show_updated_date_on_single]',
							 'label'    => __( 'Show Updated Date on Single Posts', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Single-Column Layout
		$wp_customize->add_setting(
					 'independent_publisher_layout_options[single_column_layout]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'single_column_layout', array(
							 'settings' => 'independent_publisher_layout_options[single_column_layout]',
							 'label'    => __( 'Single-Column Layout', 'independent-publisher' ),
							 'section'  => 'independent_publisher_layout_options',
							 'type'     => 'checkbox',
						 )
		);

		// Multi-Author Mode
		$wp_customize->add_setting(
					 'independent_publisher_general_options[multi_author_mode]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'multi_author_mode', array(
							 'settings' => 'independent_publisher_general_options[multi_author_mode]',
							 'label'    => __( 'Enable Multi-Author Mode', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Show Page Load Progress Bar
		$wp_customize->add_setting(
					 'independent_publisher_general_options[show_page_load_progress_bar]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'show_page_load_progress_bar', array(
							 'settings' => 'independent_publisher_general_options[show_page_load_progress_bar]',
							 'label'    => __( 'Show Page Load Progress Bar', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Auto-Set Featured Image as Post Cover
		$wp_customize->add_setting(
					 'independent_publisher_general_options[auto_featured_image_post_cover]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'auto_featured_image_post_cover', array(
							 'settings' => 'independent_publisher_general_options[auto_featured_image_post_cover]',
							 'label'    => __( 'Auto-Set Featured Image as Post Cover', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Overlay Post Title on Post Cover
		$wp_customize->add_setting(
					 'independent_publisher_general_options[post_cover_overlay_post_title]', array(
							 'default'    => false,
							 'type'       => 'option',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'independent_publisher_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'post_cover_overlay_post_title', array(
							 'settings' => 'independent_publisher_general_options[post_cover_overlay_post_title]',
							 'label'    => __( 'Overlay Post Title on Post Cover', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'checkbox',
						 )
		);

		// Comments Call to Action text
		$wp_customize->add_setting(
					 'comments_call_to_action', array(
							 'default'    => 'Write a Comment',
							 'type'       => 'theme_mod',
							 'capability' => 'edit_theme_options',
							 'sanitize_callback' => 'sanitize_text_field',
						 )
		);
		$wp_customize->add_control(
					 'comments_call_to_action', array(
							 'settings' => 'comments_call_to_action',
							 'label'    => __( 'Comments Call to Action', 'independent-publisher' ),
							 'section'  => 'independent_publisher_general_options',
							 'type'     => 'text',
						 )
		);

		// Color options

		$colors = array();

		$colors[] = array(
			'slug'    => 'text_color',
			'default' => '#000000',
			'label'   => __( 'Text Color', 'independent-publisher' )
		);
		$colors[] = array(
			'slug'    => 'comment_form_background_color',
			'default' => '#F1F1F1',
			'label'   => __( 'Comment Form Background Color', 'independent-publisher' )
		);
		$colors[] = array(
			'slug'    => 'link_color',
			'default' => '#57ad68',
			'label'   => __( 'Link Color', 'independent-publisher' )
		);
		$colors[] = array(
			'slug'    => 'header_text_color',
			'default' => '#333332',
			'label'   => __( 'Title and Header Text Color', 'independent-publisher' )
		);
		$colors[] = array(
			'slug'    => 'primary_meta_text_color',
			'default' => '#929292',
			'label'   => __( 'Primary Meta Text Color', 'independent-publisher' )
		);
		$colors[] = array(
			'slug'    => 'secondary_meta_text_color',
			'default' => '#b3b3b1',
			'label'   => __( 'Secondary Meta Text Color', 'independent-publisher' )
		);
		foreach ( $colors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
						 $color['slug'], array(
								 'default'    => $color['default'],
								 'type'       => 'theme_mod',
								 'capability' =>
									 'edit_theme_options'
							 )
			);
			// CONTROLS
			$wp_customize->add_control(
						 new WP_Customize_Color_Control(
							 $wp_customize,
							 $color['slug'],
							 array(
								 'label'    => $color['label'],
								 'section'  => 'colors',
								 'settings' => $color['slug']
							 )
						 )
			);
		}

		// Let's make some stuff use live preview JS
		$wp_customize->get_setting( 'blogname' )->transport                      = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport               = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport              = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport              = 'postMessage';
		$wp_customize->get_setting( 'text_color' )->transport                    = 'postMessage';
		$wp_customize->get_setting( 'header_text_color' )->transport             = 'postMessage';
		$wp_customize->get_setting( 'comment_form_background_color' )->transport = 'postMessage';
		$wp_customize->get_setting( 'link_color' )->transport                    = 'postMessage';
		$wp_customize->get_setting( 'primary_meta_text_color' )->transport       = 'postMessage';
		$wp_customize->get_setting( 'secondary_meta_text_color' )->transport     = 'postMessage';
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see   add_action('wp_head',$func)
	 * @since Independent Publisher 1.0
	 */
	public static function header_output() {
		?>


		<!--WordPress Theme Customizer CSS-->
		<style type="text/css">

			/* Background Color */

			<?php self::generate_css('.site', 'background-color', 'background_color', '#'); ?>

			/* Comment Form Background Color */

			<?php self::generate_css('.comment-respond', 'background-color', 'comment_form_background_color'); ?>

			/* Text Color */

			<?php self::generate_css('body,input,select,textarea', 'color', 'text_color'); ?>
			<?php self::generate_css('.format-aside .entry-content a, .format-aside .entry-content a:hover, .format-aside .entry-content a:visited, .format-aside .entry-content a:active, .format-aside .entry-content a:focus', 'color', 'text_color'); ?>
			<?php self::generate_css('.format-quote .entry-content a, .format-quote .entry-content a:hover, .format-quote .entry-content a:visited, .format-quote .entry-content a:active, .format-quote .entry-content a:focus', 'color', 'text_color'); ?>
			<?php self::generate_css('.post-excerpts .format-standard .entry-content a, .post-excerpts .format-standard .entry-content a:focus, .post-excerpts .format-standard .entry-content a:hover, .post-excerpts .format-standard .entry-content a:active, .post-excerpts .format-standard .entry-content a:visited', 'color', 'text_color'); ?>
			<?php self::generate_css('.post-excerpts .format-chat .entry-content a, .post-excerpts .format-chat .entry-content a:focus, .post-excerpts .format-chat .entry-content a:hover, .post-excerpts .format-chat .entry-content a:active, .post-excerpts .format-chat .entry-content a:visited', 'color', 'text_color'); ?>

			/* Link Color */

			<?php self::generate_css('a, a:visited, a:hover, a:focus, a:active', 'color', 'link_color'); ?>
			<?php self::generate_css('.enhanced-excerpts .enhanced-excerpt-read-more a, .enhanced-excerpts .enhanced-excerpt-read-more a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('.post-excerpts .sticky.format-standard .entry-content a, .post-excerpts .sticky.format-standard .entry-content a:focus, .post-excerpts .sticky.format-standard .entry-content a:hover, .post-excerpts .sticky.format-standard .entry-content a:active, .post-excerpts .sticky.format-standard .entry-content a:visited', 'color', 'link_color'); ?>
			<?php self::generate_css('.post-excerpts .format-standard.show-full-content-first-post .entry-content a', 'color', 'link_color'); ?>
			<?php self::generate_css('.post-excerpts .format-standard .entry-content a.moretag', 'color', 'link_color'); ?>
			<?php self::generate_css('.post-excerpts .format-standard .entry-content a.more-link', 'color', 'link_color'); ?>
			<?php self::generate_css('.read-more a, .read-more a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('.entry-title a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('.entry-meta a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('.site-footer a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('blockquote', 'border-color', 'link_color'); ?>
			<?php self::generate_css('#infinite-footer .blog-credits a, #infinite-footer .blog-credits a:hover', 'color', 'link_color'); ?>
			<?php self::generate_css('#nprogress .bar', 'background', 'link_color'); ?>
			<?php self::generate_css('#nprogress .spinner-icon', 'border-top-color', 'link_color'); ?>
			<?php self::generate_css('#nprogress .spinner-icon', 'border-left-color', 'link_color'); ?>
			<?php self::generate_css('#nprogress .peg', 'box-shadow', 'link_color', '', '', true, '%1$s { %2$s:0 0 10px %3$s, 0 0 5px %3$s; }'); ?>

			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s:%3$s; /* Old browsers */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: -moz-linear-gradient(top, %3$s 60%%, %3$s 100%%); /* FF3.6+ */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: -webkit-gradient(linear, left top, left bottom, color-stop(60%%, %3$s), color-stop(100%%, %3$s)); /* Chrome,Safari4+ */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: -webkit-linear-gradient(top, %3$s 60%%, %3$s 100%%); /* Chrome10+,Safari5.1+ */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: -o-linear-gradient(top, %3$s 60%%, %3$s 100%%); /* Opera 11.10+ */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: -ms-linear-gradient(top, %3$s 60%%, %3$s 100%%); /* IE10+ */ }'); ?>
			<?php self::generate_css('button, html input[type="button"], input[type="reset"], input[type="submit"], button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background', 'link_color', '', '', true, '%1$s { %2$s: linear-gradient(top, %3$s 60%%, %3$s 100%%); /* W3C */ }'); ?>

			/* Header Text Color */

			<?php self::generate_css('.site-published', 'color', 'header_text_color'); ?>
			<?php self::generate_css('.site-title a', 'color', 'header_text_color'); ?>
			<?php self::generate_css('h1,h2,h3,h4,h5,h6', 'color', 'header_text_color'); ?>
			<?php self::generate_css('.entry-title a', 'color', 'header_text_color'); ?>
			<?php self::generate_css('.author .archive-title a', 'color', 'header_text_color'); ?>
			<?php self::generate_css('.author .archive-title a', 'color', 'header_text_color'); ?>

			/* Primary Meta Text Color */

			<?php self::generate_css('.site-description', 'color', 'primary_meta_text_color'); ?>
			<?php self::generate_css('.site-published-date a, .site-published-date a:hover, .site-published-date a:visited, .site-published-date a:focus, .site-published-date a:active', 'color', 'primary_meta_text_color'); ?>
			<?php self::generate_css('.pinglist-title,.taglist-title,.pinglist li::after', 'color', 'primary_meta_text_color'); ?>

			/* Secondary Meta Text Color */

			<?php self::generate_css('.comment-form-author label, .comment-form-email label, .comment-form-url label, .comment-form-comment label, .comment-form-subscriptions label, .comment-form-reply-title', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.entry-title-meta, .entry-title-meta a, .entry-title-meta a:hover, .entry-title-meta a:visited, .entry-title-meta a:focus, .entry-title-meta a:active', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.entry-meta, .entry-meta a, .entry-meta a:hover', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.format-aside .entry-format, .format-quote .entry-format, .format-chat .entry-format, .format-status .entry-format, .format-image .entry-format, .format-link .entry-format, .format-gallery .entry-format', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.comment-meta, .comment-meta a', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.widget_rss .rss-date, .widget_rss li > cite, .widget_twitter .timesince', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.site-footer', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('.comment-content.unapproved', 'color', 'secondary_meta_text_color'); ?>
			<?php self::generate_css('#infinite-footer .blog-credits', 'color', 'secondary_meta_text_color'); ?>

		</style>
		<!--/WordPress Theme Customizer CSS-->

	<?php
	}

	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see   add_action('customize_preview_init',$func)
	 * @since Independent Publisher 1.0
	 */
	public static function live_preview() {
		wp_enqueue_script(
			'independent-publisher-themecustomizer', // Give the script a unique ID
			get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			'', // Define a version (optional)
			true // Specify whether to put in footer (leave this true)
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses  get_theme_mod()
	 *
	 * @param string $selector CSS selector
	 * @param string $style    The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix   Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix  Optional. Anything that needs to be output after the CSS property
	 * @param bool   $echo     Optional. Whether to print directly to the page (default: true).
	 * @param string $format   A sprintf() format to use when printing the style
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since Independent Publisher 1.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true, $format = '%1$s { %2$s:%3$s; }' ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf(
				$format . "\n",
				$selector,
				$style,
				$prefix . $mod . $postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}

		return $return;
	}
}

/**
 * Callback function for sanitizing checkbox settings.
 *
 * Used by IndependentPublisher_Customize
 *
 * @param $input
 *
 * @return int|string
 */
function independent_publisher_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Callback function for sanitizing select menu for Excerpt Options.
 *
 * Used by IndependentPublisher_Customize
 *
 * @param $input
 *
 * @return string
 */
function independent_publisher_sanitize_select_excerpt_options( $input ) {
	$valid = array( '0' => 'Disabled',
					'1' => 'Enabled', );

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'IndependentPublisher_Customize', 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head', array( 'IndependentPublisher_Customize', 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'IndependentPublisher_Customize', 'live_preview' ) );