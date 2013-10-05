<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<?php if ( get_header_image() ) : ?>
			<a class="site-logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img class="no-grav" src="<?php echo esc_url( get_header_image() ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php endif; ?>
		<hgroup>
			<h1 class="site-title">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>

			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<?php if ( is_single() ) : ?>
			<div class="site-published-separator"></div>
			<hgroup>
				<h2 class="site-published">Published</h2>

				<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>

				<?php if ( function_exists('get_ncl_location') ) : ?>
					<h2 class="site-published-location"><?php echo get_ncl_location(); ?></h2>
				<?php endif; ?>

			</hgroup>
		<?php endif; ?>

		<?php if ( ! is_single() ) : ?>
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'independent_publisher' ); ?></h1>

				<div class="assistive-text skip-link">
					<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'independent_publisher' ); ?>"><?php _e( 'Skip to content', 'independent_publisher' ); ?></a>
				</div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1 ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->
		<?php endif; ?>

		<?php do_action( 'independent_publisher_header_after' ); ?>
	</header>
	<!-- #masthead .site-header -->

	<div id="main" class="site-main">