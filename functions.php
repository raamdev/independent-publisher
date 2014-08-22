<?php
/**
 * Independent Publisher functions and definitions
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Independent Publisher 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700;
} /* pixels */

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
		require ( get_template_directory() . '/inc/template-tags.php' );

		/**
		 * Customizer additions.
		 */
		require ( get_template_directory() . '/inc/customizer.php' );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'independent-publisher', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable Custom Backgrounds
		 */
		add_theme_support(
			'custom-background', apply_filters(
				'independent_publisher_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Enable support for HTML5 markup.
		add_theme_support(
			'html5', array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
			)
		);

		/**
		 * Enable Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Add custom thumbnail size for use with featured images
		 */

		add_image_size( 'independent_publisher_post_thumbnail', 700, 700);

		/**
		 * Enable editor style
		 */
		add_editor_style();

		/**
		 * Set max width of full screen visual editor to match content width
		 */
		set_user_setting( 'dfw_width', 700 );

		/**
		 * Set default value for Show Post Word Count theme option
		 */
		add_option( 'independent_publisher_general_options', array( 'show_post_word_count' => true ) );

		/**
		 * This theme uses wp_nav_menu() in two locations.
		 */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'independent-publisher' ),
				'single' => __( 'Single Posts Menu', 'independent-publisher' ),
				'social'  => __( 'Social', 'independent-publisher' )
			)
		);

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'link',
				'gallery',
				'status',
				'quote',
				'chat',
				'image',
				'video',
			   'audio'
			)
		);
	}
endif; // independent_publisher_setup
add_action( 'after_setup_theme', 'independent_publisher_setup' );

/**
 * Include additional plugin support routines
 */
require ( get_template_directory() . '/inc/plugin-support.php' );

/**
 * Load Jetpack compatibility file.
 */
require ( get_template_directory() . '/inc/jetpack.php' );

/**
 * Register widgetized areas and update sidebar with default widgets
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'independent-publisher' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Archive Page', 'independent-publisher' ),
			'id'            => 'archive-page',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'independent_publisher_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function independent_publisher_scripts() {
	global $post;

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', array(), '3.1' );

	wp_enqueue_script( 'independent-publisher-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( independent_publisher_page_load_progress_bar_enabled() ) {
		wp_enqueue_style( 'nprogress', get_template_directory_uri() . '/css/nprogress.css', array(), '0.1.3' );
		wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/js/nprogress.js', array(), '0.1.3' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && ! independent_publisher_hide_comments() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	if ( is_singular() ) {
		wp_enqueue_script( 'fade-post-title', get_template_directory_uri() . '/js/fade-post-title.js', array( 'jquery' ));
	}

	/**
	 * Load JetPack Sharing Buttons Style Enhancements
	 */
	independent_publisher_jetpack_sharing_css();

	/**
	 * Load JetPack Sharing Buttons blank Sharing Label Enhancement
	 */
	independent_publisher_jetpack_sharing_label_css();

	/**
	 * Load JetPack Infinite Scroll Dark Overlay Bug Fix
	 */
	independent_publisher_jetpack_dark_overlay_fix_css();
}

add_action( 'wp_enqueue_scripts', 'independent_publisher_scripts' );

/**
 * Insert Page Load Progress Bar markup
 */
function independent_publisher_progress_bar_markup() {
	if ( independent_publisher_page_load_progress_bar_enabled() ) {
		independent_publisher_show_page_load_progress_bar();
	}
}

add_action( 'wp_footer', 'independent_publisher_progress_bar_markup' );

if ( ! function_exists( 'independent_publisher_stylesheet' ) ) :
	/**
	 * Enqueue main stylesheet
	 */
	function independent_publisher_stylesheet() {
		wp_enqueue_style( 'independent-publisher-style', get_stylesheet_uri() );
	}
endif;

add_action( 'wp_enqueue_scripts', 'independent_publisher_stylesheet' );

if ( ! function_exists( 'independent_publisher_wp_fullscreen_title_editor_style' ) ) :
	/**
	 * Enqueue the stylesheet for styling the full-screen visual editor post title
	 * so that it closely matches the front-end theme design. Hat tip to Helen:
	 * https://core.trac.wordpress.org/ticket/25783#comment:3
	 */
	function independent_publisher_wp_fullscreen_title_editor_style() {
		if ( 'post' === get_current_screen()->base ) {
			wp_enqueue_style( 'independent-publisher-wp-fullscreen-title', get_template_directory_uri() . '/css/wp-fullscreen-title.css', array(), '1.0' );
		}
	}
endif;

add_action('admin_enqueue_scripts', 'independent_publisher_wp_fullscreen_title_editor_style');

/**
 * Returns the theme's footer credits
 *
 * @return string
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_get_footer_credits() {
	return sprintf(
		'%1$s',
		sprintf( __( '%1$s empowered by %2$s', 'independent-publisher' ), '<a href="' . esc_url( 'http://independentpublisher.me' ) . '" rel="designer" title="Independent Publisher: A beautiful reader-focused WordPress theme, for you.">Independent Publisher</a>', '<a href="http://wordpress.org/" rel="generator" title="WordPress: A free open-source publishing platform">WordPress</a>' )
	);
}

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Fix comment count so that it doesn't include pings/trackbacks
 */
add_filter( 'get_comments_number', 'independent_publisher_comment_count', 0 );
function independent_publisher_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments         = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $comments );

		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

if ( ! function_exists( 'independent_publisher_author_comment_reply_link' ) ) :
	/*
	 * Change the comment reply link to use 'Reply to [Author First Name]'
	 */
	function independent_publisher_author_comment_reply_link( $link, $args, $comment ) {

		$comment = get_comment( $comment );

		// If no comment author is blank, use 'Anonymous'
		if ( empty( $comment->comment_author ) ) {
			if ( ! empty( $comment->user_id ) ) {
				$user   = get_userdata( $comment->user_id );
				$author = $user->user_login;
			} else {
				$author = __( 'Anonymous', 'independent-publisher' );
			}
		} else {
			$author = $comment->comment_author;
		}

		// If the user provided more than a first name, use only first name
		if ( strpos( $author, ' ' ) ) {
			$author = substr( $author, 0, strpos( $author, ' ' ) );
		}

		// Replace Reply Link with "Reply to <Author First Name>"
		$reply_link_text = $args['reply_text'];
		$link            = str_replace( $reply_link_text, __('Reply to', 'independent-publisher') . ' ' . $author, $link );

		return $link;
	}
endif;

add_filter( 'comment_reply_link', 'independent_publisher_author_comment_reply_link', 420, 4 );


if ( ! function_exists( 'independent_publisher_comment_form_args' ) ) :
	/**
	 * Arguments for comment_form()
	 *
	 * @return array
	 */
	function independent_publisher_comment_form_args() {

		if ( ! is_user_logged_in() ) {
			$comment_notes_before = '';
			$comment_notes_after  = '';
		} else {
			$comment_notes_before = '';
			$comment_notes_after  = '';
		}

		$user      = wp_get_current_user();
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );

		$args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => '',
			'title_reply_to'       => __( 'Leave a Reply for %s', 'independent-publisher' ),
			'cancel_reply_link'    => __( 'Cancel Reply', 'independent-publisher' ),
			'label_submit'         => __( 'Submit Comment', 'independent-publisher' ),
			'must_log_in'          => '<p class="must-log-in">' .
									  sprintf(
										  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
										  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
									  ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' .
									  sprintf(
										  __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
										  admin_url( 'profile.php' ),
										  $user->display_name,
										  wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
									  ) . '</p>',
			'comment_notes_before' => $comment_notes_before,
			'comment_notes_after'  => $comment_notes_after,
			'fields'               => apply_filters(
				'comment_form_default_fields', array(
					'author' =>
						'<p class="comment-form-author"><label for="author">' . __( 'Name', 'independent-publisher' ) . '</label>' .
						( $req ? '' : '' ) .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'"' . $aria_req . ' /></p>',
					'email'  =>
						'<p class="comment-form-email"><label for="email">' . __( 'Email', 'independent-publisher' ) . '</label>' .
						( $req ? '' : '' ) .
						'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
						'"' . $aria_req . ' /></p>',
					'url'    =>
						'<p class="comment-form-url"><label for="url">' . __( 'Website', 'independent-publisher' ) . '</label>' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" /></p>',
				)
			),
		);

		return $args;
	}
endif;

if ( ! function_exists( 'independent_publisher_remove_textarea' ) ) :
	/**
	 * Move the comment form textarea above the comment fields
	 */
	function independent_publisher_remove_textarea( $defaults ) {
		$defaults['comment_field'] = '';

		return $defaults;
	}
endif;
add_filter( 'comment_form_defaults', 'independent_publisher_remove_textarea' );

if ( ! function_exists( 'independent_publisher_add_textarea' ) ) :
	/**
	 * Recreates the comment form textarea HTML for reinclusion in comment form
	 */
	function independent_publisher_add_textarea() {
		echo '<div id="main-reply-title"><h3>' . independent_publisher_comments_call_to_action_text() . '</h3></div>';
		echo '<div class="comment-form-reply-title"><p>' . __( 'Comment', 'independent-publisher' ) . '</p></div>';
		echo '<p class="comment-form-comment" id="comment-form-field"><textarea id="comment" name="comment" cols="60" rows="6" aria-required="true"></textarea></p>';
	}
endif;
add_action( 'comment_form_top', 'independent_publisher_add_textarea' );

if ( ! function_exists( 'independent_publisher_enhanced_comment_form' ) ) :
	/**
	 * Enqueue enhanced comment form JavaScript
	 */
	function independent_publisher_enhanced_comment_form() {
		wp_enqueue_script( 'enhanced-comment-form-js', get_template_directory_uri() . '/js/enhanced-comment-form.js', array( 'jquery' ), '1.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'independent_publisher_enhanced_comment_form' );

if ( ! function_exists( 'independent_publisher_site_logo_icon_js' ) ):
	/**
	 * Enqueue Site Logo Icon JavaScript if Multi-Author Site enabled
	 */
	function independent_publisher_site_logo_icon_js() {
		if ( independent_publisher_is_multi_author_mode() ) {
			wp_enqueue_script( 'site-logo-icon-js', get_template_directory_uri() . '/js/site-logo-icon.js', array( 'jquery' ), '1.0' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'independent_publisher_site_logo_icon_js' );

if ( ! function_exists( 'independent_publisher_is_multi_author_mode' ) ):
	/**
	 * Returns true if Multi-Author Mode is enabled
	 */
	function independent_publisher_is_multi_author_mode() {
		$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
		if ( isset( $independent_publisher_general_options['multi_author_mode'] ) && $independent_publisher_general_options['multi_author_mode'] ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'independent_publisher_single_author_link' ) ):
	/**
	 * Returns the author link; defaults to home page when not using multi-author mode
	 */
	function independent_publisher_single_author_link() {
		return get_home_url();
	}
endif;

/**
 * Changes the link around the authors name to the home page when Multi Author Mode is disabled
 */
if ( ! independent_publisher_is_multi_author_mode() ) {
	add_filter( 'author_link', 'independent_publisher_single_author_link', 10, 3 );
}

/**
 * Returns true if Post Excerpts option is enabled
 */
function independent_publisher_use_post_excerpts() {
	$independent_publisher_excerpt_options = get_option( 'independent_publisher_excerpt_options' );
	if ( isset( $independent_publisher_excerpt_options['excerpts'] ) && $independent_publisher_excerpt_options['excerpts'] == '1' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Generate One-Sentence Excerpts option is enabled
 */
function independent_publisher_generate_one_sentence_excerpts() {
	$independent_publisher_excerpt_options = get_option( 'independent_publisher_excerpt_options' );
	if ( isset( $independent_publisher_excerpt_options['generate_one_sentence_excerpts'] ) && $independent_publisher_excerpt_options['generate_one_sentence_excerpts'] && independent_publisher_use_post_excerpts() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Full Content for First Post option is enabled
 */
function independent_publisher_show_full_content_first_post() {
	$independent_publisher_excerpt_options = get_option( 'independent_publisher_excerpt_options' );
	if ( isset( $independent_publisher_excerpt_options['show_full_content_first_post'] ) && $independent_publisher_excerpt_options['show_full_content_first_post'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Post Word Count option is enabled
 */
function independent_publisher_show_post_word_count() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_post_word_count'] ) && $independent_publisher_general_options['show_post_word_count'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Post Date in Entry Meta option is enabled
 */
function independent_publisher_show_date_entry_meta() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_date_entry_meta'] ) && $independent_publisher_general_options['show_date_entry_meta'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Widgets on Single Pages option is enabled
 */
function independent_publisher_show_widgets_on_single_pages() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_widgets_on_single'] ) && $independent_publisher_general_options['show_widgets_on_single'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Use Single Column Layout option is enabled
 */
function independent_publisher_use_single_column_layout() {
	$independent_publisher_layout_options = get_option( 'independent_publisher_layout_options' );
	if ( isset( $independent_publisher_layout_options['single_column_layout'] ) && $independent_publisher_layout_options['single_column_layout'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns Comments Call to Action text
 */
function independent_publisher_comments_call_to_action_text() {
	$comments_call_to_action = get_theme_mod( 'comments_call_to_action' );
	if ( isset( $comments_call_to_action ) && trim( $comments_call_to_action ) !== '' ) {
		return esc_attr( $comments_call_to_action );
	} else {
		return __( 'Write a Comment', 'independent-publisher' );
	}
}

/*
 * Return true if Auto-Set Featured Image as Post Cover is enabled and it hasn't
 * been disabled for this post.
 *
 * Returns true if the current post has Full Width Featured Image enabled.
 *
 * Returns false if not a Single post type or there is no Featured Image selected
 * or none of the above conditions are true.
 */
function independent_publisher_has_full_width_featured_image() {

	// If this isn't a Single post type or we don't have a Featured Image set
	if ( ! is_single() || ! has_post_thumbnail() ) {
		return false;
	}

	$full_width_featured_image             = get_post_meta( get_the_ID(), 'full_width_featured_image' );
	$full_width_featured_image_disabled    = get_post_meta( get_the_ID(), 'full_width_featured_image_disabled' );
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );

	// If Auto-Set Featured Image as Post Cover is enabled and it hasn't been disabled for this post, return true.
	if ( isset( $independent_publisher_general_options['auto_featured_image_post_cover'] ) && $independent_publisher_general_options['auto_featured_image_post_cover'] && ! $full_width_featured_image_disabled ) {
		return true;
	}

	// If Use featured image as Post Cover has been checked in the Featured Image meta box, return true.
	if ( $full_width_featured_image ) {
		return true;
	}

	return false; // Default
}
/**
 * Return true if post has the custom field post_cover_overlay_post_title set to true
 */
function independent_publisher_post_has_post_cover_title() {
	$post_has_cover_title 	= get_post_meta( get_the_ID(), 'post_cover_overlay_post_title', true);

	$has_full_width_featured_image = independent_publisher_has_full_width_featured_image();

	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );


	// Allow site owner to set this option on a per-post basis using a Custom Field
	if ( ( $post_has_cover_title === '1' || $post_has_cover_title === 'true' ) && $has_full_width_featured_image ) {
		return true;
	} else if ( ( $post_has_cover_title === '0' || $post_has_cover_title === 'false' ) && $has_full_width_featured_image ) {
		return false;
	}

	if( isset( $independent_publisher_general_options['post_cover_overlay_post_title'] ) && $independent_publisher_general_options['post_cover_overlay_post_title'] && $has_full_width_featured_image ) {
		return true;
	}

	return false; // Default
}


/**
 * Returns true if Enable Page Load Progress Bar option is enabled
 */
function independent_publisher_page_load_progress_bar_enabled() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_page_load_progress_bar'] ) && $independent_publisher_general_options['show_page_load_progress_bar'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Nav Menu on Single Posts option is enabled
 */
function independent_publisher_show_nav_on_single() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_nav_menu_on_single'] ) && $independent_publisher_general_options['show_nav_menu_on_single'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Show Updated Date on Single Posts option is enabled
 */
function independent_publisher_show_updated_date_on_single() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_updated_date_on_single'] ) && $independent_publisher_general_options['show_updated_date_on_single'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Auto-Set Featured Image as Post Cover option is enabled
 */
function independent_publisher_auto_featured_image_post_cover() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['auto_featured_image_post_cover'] ) && $independent_publisher_general_options['auto_featured_image_post_cover'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns true if Auto-Set Post with Post Cover Title option is enabled
 */
function independent_publisher_post_cover_overlay_post_title() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['post_cover_overlay_post_title'] ) && $independent_publisher_general_options['post_cover_overlay_post_title'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Add full-width-featured-image to body class when displaying a post with Full Width Featured Image enabled
 */
function independent_publisher_full_width_featured_image_body_class( $classes ) {
	if ( independent_publisher_has_full_width_featured_image() ) {
		$classes[] = 'full-width-featured-image';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_full_width_featured_image_body_class' );

/**
 * Add post-cover-overlay-post-title to body class when displaying a post with Post Title Overlay on Post Cover enabled
 */
function independent_publisher_post_cover_title_body_class( $classes ) {
	if ( independent_publisher_post_has_post_cover_title() &&  independent_publisher_has_full_width_featured_image() ) {
		$classes[] = 'post-cover-overlay-post-title';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_post_cover_title_body_class' );

/**
 * Add single-column-layout to body class when Use Single Column Layout option enabled
 */
function independent_publisher_single_column_layout_body_class( $classes ) {
	if ( independent_publisher_use_single_column_layout() ) {
		$classes[] = 'single-column-layout';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_single_column_layout_body_class' );

/**
 * Add multi-author-mode to body class when Multi-Author Mode enabled
 */
function independent_publisher_multi_author_mode_body_class( $classes ) {
	if ( independent_publisher_is_multi_author_mode() ) {
		$classes[] = 'multi-author-mode';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_multi_author_mode_body_class' );

/**
 * Add no-post-excerpts to body class when Post Excerpts option is disabled
 */
function independent_publisher_no_post_excerpts_body_class( $classes ) {
	if ( ! independent_publisher_use_post_excerpts()
		 && ! independent_publisher_generate_one_sentence_excerpts()
		 && ! is_singular()
	) {
		$classes[] = 'no-post-excerpts';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_no_post_excerpts_body_class' );

/**
 * Add enhanced-excerpts to body class when Use Enhanced Excerpts option enabled
 */
function independent_publisher_enhanced_excerpts_body_class( $classes ) {
	if ( independent_publisher_generate_one_sentence_excerpts() && ! is_singular() ) {
		$classes[] = 'enhanced-excerpts';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_enhanced_excerpts_body_class' );

/**
 * Add post-excerpts to body class when Use Post Excerpts option enabled
 */
function independent_publisher_post_excerpts_body_class( $classes ) {
	if ( independent_publisher_use_post_excerpts() && ! is_singular() ) {
		$classes[] = 'post-excerpts';
	}

	return $classes;
}

add_filter( 'body_class', 'independent_publisher_post_excerpts_body_class' );

if ( ! function_exists( 'independent_publisher_post_word_count' ) ):
	/**
	 * Returns number of words in a post
	 * @return string
	 */
	function independent_publisher_post_word_count() {
		global $post;
		$content = get_post_field( 'post_content', $post->ID );
		$count   = str_word_count( strip_tags( $content ) );

		return number_format( $count );
	}
endif;

if ( ! function_exists( 'independent_publisher_first_sentence_excerpt' ) ):
	/**
	 * Return the post excerpt. If no excerpt set, generates an excerpt using the first sentence.
	 */
	function independent_publisher_first_sentence_excerpt( $text = '' ) {
		global $post;
		$content_post = get_post( $post->ID );

		// Only generate a one-sentence excerpt if there is no excerpt set and One Sentence Excerpts is enabled
		if ( ! $content_post->post_excerpt && independent_publisher_generate_one_sentence_excerpts() ) {

			// The following mimics the functionality of wp_trim_excerpt() in wp-includes/formatting.php
			// and ensures that no shortcodes or embed URLs are included in our generated excerpt.
			$text           = get_the_content( '' );
			$text           = strip_shortcodes( $text );
			$text           = apply_filters( 'the_content', $text );
			$text           = str_replace( ']]>', ']]&gt;', $text );
			$excerpt_length = 150; // Something long enough that we're likely to get a full sentence.
			$excerpt_more   = ''; // Not used, but included here for clarity
			$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more ); // See wp_trim_words() in wp-includes/formatting.php

			// Get the first sentence
			// This looks for three punctuation characters: . (period), ! (exclamation), or ? (question mark), followed by a space
			$strings = preg_split( '/(\.|!|\?)\s/', strip_tags( $text ), 2, PREG_SPLIT_DELIM_CAPTURE );

			// $strings[0] is the first sentence and $strings[1] is the punctuation character at the end
			if ( ! empty( $strings[0] ) && ! empty( $strings[1] ) ) {
				$text = $strings[0] . $strings[1];
			}

			$text = wpautop( $text );
		}

		return $text;
	}
endif;

add_filter( 'the_excerpt', 'independent_publisher_first_sentence_excerpt' );

/*
 * Add a checkbox for Post Covers to the featured image metabox
 */
function independent_publisher_featured_image_meta( $content ) {

	// If we don't have a featured image, nothing to do.
	if ( ! has_post_thumbnail() ) {
		return $content;
	}

	global $post;

	// Meta key
	$meta_key = 'full_width_featured_image';

	// Text for checkbox
	$text = __( "Use as post cover (full-width)", 'independent-publisher' );

	// Option type (for use when saving post data in independent_publisher_save_featured_image_meta()
	$option_type = "enable";

	/* If Auto-Set Featured Image as Post Cover enabled, this checkbox's functionality should reverse and
	 * allow for disabling Post Covers on a post-by-post basis.
	 */
	if ( independent_publisher_auto_featured_image_post_cover() ) {
		$meta_key    = 'full_width_featured_image_disabled';
		$text        = __( "Disable post cover (full-width)", 'independent-publisher' );
		$option_type = "disable";
	}

	// Get the current setting
	$value = esc_attr( get_post_meta( $post->ID, $meta_key, true ) );

	// Output the checkbox HTML
	$label = '<label for="' . $meta_key . '" class="selectit"><input name="' . $meta_key . '" type="checkbox" id="' . $meta_key . '" value="1" ' . checked( $value, 1, false ) . '> ' . $text . '</label>';
	$label .= '<input type="hidden" name="full_width_featured_image_enable_disable" value="' . $option_type . '">';

	$label = wp_nonce_field( basename( __FILE__ ), 'independent_publisher_full_width_featured_image_meta_nonce' ) . $label;

	return $content .= $label;
}

add_filter( 'admin_post_thumbnail_html', 'independent_publisher_featured_image_meta' );

/*
 * Save the Featured Image meta box's post metadata for Post Cover options.
 */
function independent_publisher_save_featured_image_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( ! isset( $_POST['independent_publisher_full_width_featured_image_meta_nonce'] ) || ! wp_verify_nonce( $_POST['independent_publisher_full_width_featured_image_meta_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	/* Get the posted data and sanitize it for use as an HTML class. */
	if ( isset( $_POST['full_width_featured_image'] ) ) {
		$new_meta_value = esc_attr( $_POST['full_width_featured_image'] );
		$meta_key       = 'full_width_featured_image';
	} elseif ( isset( $_POST['full_width_featured_image_disabled'] ) ) {
		$new_meta_value = esc_attr( $_POST['full_width_featured_image_disabled'] );
		$meta_key       = 'full_width_featured_image_disabled';
	} else {
		$new_meta_value = ''; // Empty value means we're unchecking this option
	}

	// Figure out which option was being unchecked (this routine handles two types)
	if ( isset( $_POST['full_width_featured_image_enable_disable'] ) ) {
		if ( $_POST['full_width_featured_image_enable_disable'] === 'enable' ) {
			$meta_key = 'full_width_featured_image';
		} elseif ( $_POST['full_width_featured_image_enable_disable'] === 'disable' ) {
			$meta_key = 'full_width_featured_image_disabled';
		}
	} else {
		$meta_key = 'full_width_featured_image'; // Default
	}


	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value ) {
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	} /* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	} /* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, $meta_key, $meta_value );
	}
}

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'independent_publisher_save_featured_image_meta', 10, 2 );


/**
 * Return true when we're on the first page of a Blog, Archive, or Search
 * page and the current post is the first post.
 */
function independent_publisher_is_very_first_standard_post() {
	global $wp_query;
	if ( in_the_loop() && $wp_query->current_post == 0 && ! is_paged() && false === get_post_format() && get_query_var( 'paged' ) === 0 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Return true when Show Full Content First Post option is disabled,
 * or when Show Full Content First Post is enabled but excerpts are disabled,
 * or when Show Full Content First Post is enabled and we're not on
 * the very first post
 */
function independent_publisher_is_not_first_post_full_content() {

	// This only works in the loop, so return false if we're not there
	if ( ! in_the_loop() ) {
		return false;
	}

	// If Show Full Content First Post option is not enabled,
	// or if it's enabled by excerpts are disabled, return true
	if ( ! independent_publisher_show_full_content_first_post() || ( ! independent_publisher_generate_one_sentence_excerpts() && ! independent_publisher_use_post_excerpts() ) ) {
		return true;
	}

	// If Show Full Content First Post option is enabled but this is not
	// the very first post, return true
	if ( independent_publisher_show_full_content_first_post() && ! independent_publisher_is_very_first_standard_post() ) {
		return true;
	}

	// If Show Full Content First Post option is enabled and this is the
	// very first post, return false
	if ( independent_publisher_show_full_content_first_post() && independent_publisher_is_very_first_standard_post() ) {
		return false;
	}

	// Default return false
	return false;
}

if ( ! function_exists( 'independent_publisher_clean_content' ) ):
	/**
	 * Cleans and returns the content for display as a Quote or Aside by stripping anything that might screw up formatting. This is necessary because we link Quotes and Asides to their own permalink. If the Quote or Aside contains a footnote with an anchor tag, or even just an anchor tag, then nesting anchor within anchor will break formatting.
	 */
	function independent_publisher_clean_content( $content ) {

		// Remove footnotes
		$content = preg_replace( '!<sup\s+.*?>.*?</sup>!is', '', $content );

		// Remove anchor tags
		$content = preg_replace(array('"<a href(.*?)>"', '"</a>"'), array('',''), $content);

		return $content;
	}
endif;

/**
 * Add classes to article based on current theme settings
 */
function independent_publisher_post_classes() {
	global $wp_query;

	if ( independent_publisher_show_full_content_first_post() &&
		 ( independent_publisher_is_very_first_standard_post() &&
		   is_home() &&
		   ! is_sticky()
		 )
	) {
		post_class( 'show-full-content-first-post' );
	} elseif ( independent_publisher_show_full_content_first_post() &&
			   ( independent_publisher_is_very_first_standard_post() &&
				 is_home() &&
				 is_sticky()
			   )
	) {
		post_class( 'show-full-content-first-post-sticky' );
	} elseif ( $wp_query->current_post == 0 ) {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && get_query_var( 'paged' ) !== 0 ) {
			post_class();
		} else {
			post_class( 'first-post' );
		}
	} else {
		post_class();
	}
}

/**
 * Handles Reply to Comment links properly when JavaScript is enabled
 */
function independent_publisher_replytocom() {
	if ( isset( $_GET['replytocom'] ) ) {
		$replytocom_comment_id = $_GET['replytocom'];
		$replytocom_post_id    = get_the_ID();
		?>
		<script type="text/javascript">
			addComment.moveForm("comment-<?php echo $replytocom_comment_id; ?>", "<?php echo $replytocom_comment_id; ?>", "respond", "<?php echo $replytocom_post_id; ?>");
			jQuery(function () {
				jQuery('#respond').show();
			});
			jQuery(function () {
				jQuery('.comment-form-reply-title').show();
			});
			jQuery(function () {
				jQuery('#main-reply-title').hide();
			});
		</script>
	<?php
	}
}

/**
 * Returns the entry title meta category prefix (e.g., "<author name> in <category name>"; 'in' is the portion this function returns)
 */
function independent_publisher_entry_meta_category_prefix() {
	$prefix = __( 'in', 'independent-publisher' );

	return apply_filters( 'independent_publisher_entry_meta_category_prefix', $prefix );
}

/**
 * Returns the entry meta author prefix (e.g., "by <author name>"; 'by' is the portion this function returns)
 */
function independent_publisher_entry_meta_author_prefix() {
	$prefix = __( 'by', 'independent-publisher' );

	return apply_filters( 'independent_publisher_entry_meta_author_prefix', $prefix );
}

if ( ! function_exists( 'independent_publisher_maybe_linkify_the_content' ) ) :
	/**
	 * Returns the post content for Asides and Quotes with the content linked to the permalink, for display on non-Single pages
	 */
	function independent_publisher_maybe_linkify_the_content( $content ) {
		if ( ! is_single() && ( 'aside' === get_post_format() || 'quote' === get_post_format() ) ) {

			// Asides and Quotes might have footnotes with anchor tags, or just anchor tags, both of which would screw things up when linking the content to itself (anchors cannot have anchors inside them), so let's clean things up
			$content = independent_publisher_clean_content( $content );

			// Now we can link the Quote or Aside content to itself
			$content = '<a href="' . get_permalink() . '" rel="bookmark" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'independent-publisher' ), the_title_attribute( 'echo=0' ) ) ) . '">' . $content . '</a>';
		}

		return $content;
	}
endif;

add_filter( 'the_content', 'independent_publisher_maybe_linkify_the_content', 100 );

if ( ! function_exists( 'independent_publisher_maybe_linkify_the_excerpt' ) ) :
	/**
	 * Returns the excerpt with the excerpt linked to the permalink, for display on non-Single pages
	 */
	function independent_publisher_maybe_linkify_the_excerpt( $content ) {
		if ( ! is_single() ) {
			$content = '<a href="' . get_permalink() . '" rel="bookmark" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'independent-publisher' ), the_title_attribute( 'echo=0' ) ) ) . '">' . $content . '</a>';
		}

		return $content;
	}
endif;

add_filter( 'the_excerpt', 'independent_publisher_maybe_linkify_the_excerpt' );

if ( ! function_exists( 'independent_publisher_cancel_comment_reply_link' ) ) :
	/**
	 * Returns the cancel comment reply link with #respond stripped out so it behaves with jQuery used to enhance comments
	 */
	function independent_publisher_cancel_comment_reply_link( $formatted_link) {
		return str_ireplace('#respond', '', $formatted_link);
	}
endif;

add_filter( 'cancel_comment_reply_link', 'independent_publisher_cancel_comment_reply_link', 10, 1 );

if ( ! function_exists( 'independent_publisher_html_tag_schema' ) ) :
	/**
	 * Returns the proper schema type
	 */
	function independent_publisher_html_tag_schema() {
		$schema = 'http://schema.org/';

		// Is single post
		if ( is_single() ) {
			$type = "Article";
		} // Contact form page ID
		else {
			if ( is_page( 1 ) ) {
				$type = 'ContactPage';
			} // Is author page
			elseif ( is_author() ) {
				$type = 'ProfilePage';
			} // Is search results page
			elseif ( is_search() ) {
				$type = 'SearchResultsPage';
			} // Is of movie post type
			elseif ( is_singular( 'movies' ) ) {
				$type = 'Movie';
			} // Is of book post type
			elseif ( is_singular( 'books' ) ) {
				$type = 'Book';
			} else {
				$type = 'WebPage';
			}
		}

		echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
	}
endif;

if ( ! function_exists( 'independent_publisher_show_page_load_progress_bar' ) ) :
	/**
	 * Echos the HTML and JavScript necessary to enable page load progress bar
	 */
	function independent_publisher_show_page_load_progress_bar() { ?>
	<!-- Progress Bar - https://github.com/rstacruz/nprogress -->

		<div class="bar" role="bar"></div>
		<script type="text/javascript">
			NProgress.start();

			setTimeout(function() {

				NProgress.done();

				jQuery('.fade').removeClass('out');

			}, 1000);

			jQuery("#b-0").click(function() { NProgress.start(); });
			jQuery("#b-40").click(function() { NProgress.set(0.4); });
			jQuery("#b-inc").click(function() { NProgress.inc(); });
			jQuery("#b-100").click(function() { NProgress.done(); });
		</script>

	<!-- End Progress Bar -->

		<?php
	}
endif;