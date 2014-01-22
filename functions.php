<?php
/**
 * Independent Publisher functions and definitions
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

/**
 * Include additional plugin support routines
 */
require_once( 'inc/plugin-support.php' );

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
		require( get_template_directory() . '/inc/template-tags.php' );

		/**
		 * Customizer additions.
		 */
		require get_template_directory() . '/inc/customizer.php';

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'independent_publisher', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable Custom Backgrounds
		 */
		add_theme_support( 'custom-background' );

		/**
		 * Enable Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

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
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'independent_publisher' ),
			'social', __( 'Social', 'independent_publisher' ),
		) );

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'chat', 'image', 'video' ) );

		/**
		 * Add support for Infinite Scroll
		 * @since Independent Publisher 1.0
		 */
		add_theme_support( 'infinite-scroll', array(
			'footer' => 'page',
		) );
	}
endif; // independent_publisher_setup
add_action( 'after_setup_theme', 'independent_publisher_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'independent_publisher' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

add_action( 'widgets_init', 'independent_publisher_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function independent_publisher_scripts() {
	global $post;

	wp_enqueue_style( 'independent-publisher-style', get_stylesheet_uri() );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', array(), '3.0.3' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	independent_publisher_jetpack_sharing_css();
	independent_publisher_jetpack_sharing_label_css();
}

add_action( 'wp_enqueue_scripts', 'independent_publisher_scripts' );

/**
 * Echoes the theme's footer credits
 *
 * @since Independent Publisher 1.0
 */
function independent_publisher_footer_credits() {
	echo independent_publisher_get_footer_credits();
}

add_action( 'independent_publisher_credits', 'independent_publisher_footer_credits' );

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
		sprintf( __( 'An %1$s empowered by %2$s.', 'independent_publisher' ), '<a href="' . esc_url( 'http://independentpublisher.me' ) . '" rel="designer">Independent Publisher</a>', '<a href="http://wordpress.org/" rel="generator">open-source publishing</a>' )
	);
}

add_filter( 'infinite_scroll_credit', 'independent_publisher_get_footer_credits' );

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
	}
	else {
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
			}
			else {
				$author = __( 'Anonymous', 'independent_publisher' );
			}
		}
		else {
			$author = $comment->comment_author;
		}

		// If the user provided more than a first name, use only first name
		if ( strpos( $author, ' ' ) ) {
			$author = substr( $author, 0, strpos( $author, ' ' ) );
		}

		// Replace Reply Link with "Reply to <Author First Name>"
		$reply_link_text = $args['reply_text'];
		$link            = str_replace( $reply_link_text, 'Reply to ' . $author, $link );

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
		}
		else {
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
			'title_reply_to'       => __( 'Leave a Reply for %s', 'independent_publisher' ),
			'cancel_reply_link'    => __( 'Cancel Reply', 'independent_publisher' ),
			'label_submit'         => __( 'Submit Comment', 'independent_publisher' ),

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

			'fields'               => apply_filters( 'comment_form_default_fields', array(
					'author' =>
							'<p class="comment-form-author"><label for="author">' . __( 'Name', 'independent_publisher' ) . '</label>' .
							( $req ? '' : '' ) .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'"' . $aria_req . ' /></p>',

					'email'  =>
							'<p class="comment-form-email"><label for="email">' . __( 'Email', 'independent_publisher' ) . '</label>' .
							( $req ? '' : '' ) .
							'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
							'"' . $aria_req . ' /></p>',

					'url'    =>
							'<p class="comment-form-url"><label for="url">' . __( 'Website', 'independent_publisher' ) . '</label>' .
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
		echo '<div id="main-reply-title"><h3>Share a Comment</h3></div>';
		echo '<div class="comment-form-reply-title"><p>Comment</p></div>';
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
		if ( independent_publisher_is_multi_author_mode() )
			wp_enqueue_script( 'site-logo-icon-js', get_template_directory_uri() . '/js/site-logo-icon.js', array( 'jquery' ), '1.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'independent_publisher_site_logo_icon_js' );

if ( ! function_exists( 'independent_publisher_is_multi_author_mode' ) ):
	/**
	 * Checks if Multi Author Mode is enabled. Disabled by default, but can be overridden in a child theme
	 */
	function independent_publisher_is_multi_author_mode() {
		return false;
	}
endif;

if ( ! function_exists( 'independent_publisher_single_author_link' ) ):
	/**
	 * Point author links to home page when not using multi-author mode
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
	if ( isset( $independent_publisher_excerpt_options['excerpts'] ) && $independent_publisher_excerpt_options['excerpts'] == '1' )
		return true;
	else
		return false;
}

/**
 * Returns true if Generate One-Sentence Excerpts option is enabled
 */
function independent_publisher_generate_one_sentence_excerpts() {
	$independent_publisher_excerpt_options = get_option( 'independent_publisher_excerpt_options' );
	if ( isset( $independent_publisher_excerpt_options['generate_one_sentence_excerpts'] ) && $independent_publisher_excerpt_options['generate_one_sentence_excerpts'] )
		return true;
	else
		return false;
}

/**
 * Returns true if Show Full Content for First Post option is enabled
 */
function independent_publisher_show_full_content_first_post() {
	$independent_publisher_excerpt_options = get_option( 'independent_publisher_excerpt_options' );
	if ( isset( $independent_publisher_excerpt_options['show_full_content_first_post'] ) && $independent_publisher_excerpt_options['show_full_content_first_post'] )
		return true;
	else
		return false;
}

/**
 * Returns true if Show Post Word Count option is enabled
 */
function independent_publisher_show_post_word_count() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_post_word_count'] ) && $independent_publisher_general_options['show_post_word_count'] )
		return true;
	else
		return false;
}

/**
 * Returns true if Show Widgets on Single Pages option is enabled
 */
function independent_publisher_show_widgets_on_single_pages() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['show_widgets_on_single'] ) && $independent_publisher_general_options['show_widgets_on_single'] )
		return true;
	else
		return false;
}

/**
 * Returns true if Use Single Column Layout option is enabled
 */
function independent_publisher_use_single_column_layout() {
	$independent_publisher_general_options = get_option( 'independent_publisher_general_options' );
	if ( isset( $independent_publisher_general_options['single_column_layout'] ) && $independent_publisher_general_options['single_column_layout'] )
		return true;
	else
		return false;
}

/**
 * Returns true if the the current post has Full Width Featured Image enabled
 */
function independent_publisher_has_full_width_featured_image() {
	$full_width_featured_image = get_post_meta( get_the_ID(), 'full_width_featured_image' );

	if ( $full_width_featured_image )
		return true;
	else
		return false;
}

/**
 * Add full-width-featured-image to body class when displaying a post with Full Width Featured Image enabled
 */
function independent_publisher_full_width_featured_image_body_class( $classes ) {
	if ( is_single() && has_post_thumbnail() && get_post_meta( get_the_ID(), 'full_width_featured_image', true ) ) {
		$classes[] = 'full-width-featured-image';
	}
	return $classes;
}

add_filter( 'body_class', 'independent_publisher_full_width_featured_image_body_class' );

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
	function independent_publisher_first_sentence_excerpt( $output ) {
		global $post;
		$content_post = get_post( $post->ID );

		// Only generate a one-sentence excerpt if there is no excerpt set and One Sentence Excerpts is enabled
		if ( ! $content_post->post_excerpt && independent_publisher_generate_one_sentence_excerpts() ) {
			$post_content = $content_post->post_content;

			// If the post starts with an image containing a caption, remove the caption before generating the excerpt
			if ( strpos( $post_content, '[caption' ) !== FALSE ) {
				$post_content = substr( $post_content, strpos( $post_content, '[/caption]' ) + 10, strlen( $post_content ) - ( strpos( $post_content, '[/caption]' ) + 10 ) );
			}

			// Get the first sentence in $post_content
			$strings = preg_split( '/(\.|!|\?)\s/', strip_tags( $post_content ), 2, PREG_SPLIT_DELIM_CAPTURE );

			// $strings[0] is the first sentence and $strings[1] is the punctuation character at the end
			if ( ! empty( $strings[0] ) && ! empty( $strings[1] ) ) {
				$excerpt = $strings[0] . $strings[1];
				$output  = apply_filters( 'the_content', $excerpt );
			}
		}
		return $output;
	}
endif;

add_filter( 'the_excerpt', 'independent_publisher_first_sentence_excerpt' );

/**
 * Add a checkbox to the featured image metabox
 */
function independent_publisher_featured_image_meta( $content ) {

	if ( ! has_post_thumbnail() )
		return $content;

	global $post;

	// Text for checkbox
	$text = __( "Use as post cover (full-width)", 'independent_publisher' );

	// Meta value ID
	$id    = 'full_width_featured_image';
	$value = esc_attr( get_post_meta( $post->ID, $id, true ) );
	// Output the checkbox HTML
	$label = '<label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="1" ' . checked( $value, 1, false ) . '> ' . $text . '</label>';

	$label = wp_nonce_field( basename( __FILE__ ), 'independent_publisher_full_width_featured_image_meta_nonce' ) . $label;

	return $content .= $label;
}

add_filter( 'admin_post_thumbnail_html', 'independent_publisher_featured_image_meta' );

/**
 * Save the meta box's post metadata.
 */
function independent_publisher_save_featured_image_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( ! isset( $_POST['independent_publisher_full_width_featured_image_meta_nonce'] ) || ! wp_verify_nonce( $_POST['independent_publisher_full_width_featured_image_meta_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['full_width_featured_image'] ) ? esc_attr( $_POST['full_width_featured_image'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'full_width_featured_image';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'independent_publisher_save_featured_image_meta', 10, 2 );


/**
 * Return true when we're on the first page of a Blog, Archive, or Search
 * page and the current post is the first post.
 */
function independent_publisher_is_very_first_standard_post() {
	global $wp_query;
	if ( in_the_loop() && $wp_query->current_post == 0 && ! is_paged() && false === get_post_format() && get_query_var( 'paged' ) === 0 )
		return true;
	else
		return false;
}

/**
 * Return true when Show Full Content First Post option is disabled,
 * or when Show Full Content First Post is enabled but excerpts are disabled,
 * or when Show Full Content First Post is enabled and we're not on
 * the very first post
 */
function independent_publisher_is_not_first_post_full_content() {

	// This only works in the loop, so return false if we're not there
	if ( ! in_the_loop() )
		return false;

	// If Show Full Content First Post option is not enabled,
	// or if it's enabled by excerpts are disabled, return true
	if ( ! independent_publisher_show_full_content_first_post() || ( ! independent_publisher_generate_one_sentence_excerpts() && ! independent_publisher_use_post_excerpts() ) )
		return true;

	// If Show Full Content First Post option is enabled but this is not
	// the very first post, return true
	if ( independent_publisher_show_full_content_first_post() && ! independent_publisher_is_very_first_standard_post() )
		return true;

	// If Show Full Content First Post option is enabled and this is the
	// very first post, return false
	if ( independent_publisher_show_full_content_first_post() && independent_publisher_is_very_first_standard_post() )
		return false;

	// Default return false
	return false;
}

if ( ! function_exists( 'independent_publisher_strip_footnotes' ) ):
	/**
	 * Strip footnotes (<sup></sup>) from post content
	 */
	function independent_publisher_strip_footnotes( $content ) {

		// This creates the same output as the_content()
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		return preg_replace( '!<sup\s+id="fnref.*?">.*?</sup>!is', '', $content );
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
	}
	elseif ( independent_publisher_show_full_content_first_post() &&
			( independent_publisher_is_very_first_standard_post() &&
					is_home() &&
					is_sticky()
			)
	) {
		post_class( 'show-full-content-first-post-sticky' );
	}
	elseif ( $wp_query->current_post == 0 ) {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && get_query_var( 'paged' ) !== 0 ) {
			post_class();
		}
		else {
			post_class( 'first-post' );
		}
	}
	else {
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
