<?php

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level
 * 'Independent Publisher Theme' menu.
 */
function independent_publisher_theme_menu() {

	add_theme_page(
		'Independent Publisher Theme', // The title to be displayed in the browser window for this page.
		'Theme Options', // The text to be displayed for this menu item
		'administrator', // Which type of users can see this menu item
		'independent_publisher_theme_options', // The unique ID - that is, the slug - for this menu item
		'independent_publisher_theme_display' // The name of the function to call when rendering this menu's page
	);

	add_submenu_page(
		'independent_publisher_theme_menu',
		__( 'General Options', 'independent_publisher' ),
		__( 'General Options', 'independent_publisher' ),
		'administrator',
		'independent_publisher_theme_general_options',
		create_function( null, 'independent_publisher_theme_display( "general_options" );' )
	);


} // end independent_publisher_theme_menu
add_action( 'admin_menu', 'independent_publisher_theme_menu' );

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function independent_publisher_theme_display( $active_tab = '' ) {
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Independent Publisher Theme Options', 'independent_publisher' ); ?></h2>
		<?php settings_errors(); ?>

		<?php if ( isset( $_GET['tab'] ) ) {
			$active_tab = $_GET['tab'];
		}
		else if ( $active_tab == 'general_options' ) {
			$active_tab = 'general_options';
		}
		else {
			$active_tab = 'general_options';
		} // end if/else
		?>

		<h2 class="nav-tab-wrapper">
			<a href="?page=independent_publisher_theme_options&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General Options', 'independent_publisher' ); ?></a>
		</h2>

		<form method="post" action="options.php">
			<?php

			if ( $active_tab == 'general_options' ) {

				settings_fields( 'independent_publisher_theme_general_options' );
				do_settings_sections( 'independent_publisher_theme_general_options' );

			}

			submit_button();

			?>
		</form>

	</div><!-- /.wrap -->
<?php
} // end independent_publisher_theme_display

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */


/**
 * Provides default values for the General Options.
 */
function independent_publisher_theme_default_general_options() {

	$defaults = array(
		'multi_author_mode' => ''
	);

	return apply_filters( 'independent_publisher_theme_default_general_options', $defaults );

} // end independent_publisher_theme_default_general_options

/**
 * Initializes the theme's general options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
function independent_publisher_theme_intialize_general_options() {

	if ( false == get_option( 'independent_publisher_theme_general_options' ) ) {
		add_option( 'independent_publisher_theme_general_options', apply_filters( 'independent_publisher_theme_default_general_options', independent_publisher_theme_default_general_options() ) );
	} // end if

	add_settings_section(
		'general_settings_section', // ID used to identify this section and with which to register options
		__( 'General Options', 'independent_publisher' ), // Title to be displayed on the administration page
		'independent_publisher_general_options_callback', // Callback used to render the description of the section
		'independent_publisher_theme_general_options' // Page on which to add this section of options
	);

	add_settings_field(
		'multi_author_mode',
		'Multi-Author Mode?',
		'independent_publisher_multi_author_mode_callback',
		'independent_publisher_theme_general_options',
		'general_settings_section'
	);

	register_setting(
		'independent_publisher_theme_general_options',
		'independent_publisher_theme_general_options'
	);

} // end independent_publisher_theme_intialize_general_options
add_action( 'admin_init', 'independent_publisher_theme_intialize_general_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function provides a simple description for the General Options page.
 *
 * It's called from the 'independent_publisher_theme_intialize_general_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function independent_publisher_general_options_callback() {
	echo '<p>' . __( 'Configure general theme settings', 'independent_publisher' ) . '</p>';
} // end independent_publisher_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */

function independent_publisher_multi_author_mode_callback() {

	// First, we read the general options collection
	$options = get_option( 'independent_publisher_theme_general_options' );

	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	if ( true == $options['multi_author_mode'] ) { $checked = 'checked="checked"'; } else { $checked = ''; }

	// Render the output
	echo '<input type="checkbox" id="twitter" name="independent_publisher_theme_general_options[multi_author_mode]" value="true" '. $checked .' /> <em>Enabling this will modify the theme behavior to support multiple authors. For example, the Header image will become the site logo and appear in the top-left of Single post pages.</em>';

} // end independent_publisher_twitter_callback

?>