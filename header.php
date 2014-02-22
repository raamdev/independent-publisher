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
<html <?php html_tag_schema(); ?> <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

<?php // Displays full-width featured image on Single Posts if applicable ?>
<?php independent_publisher_full_width_featured_image(); ?>

<?php // Makes the Header Image a small icon floating in the top left corner when Multi Author Mode is enabled ?>
<?php if ( independent_publisher_is_multi_author_mode() && is_single() ) : ?>
	<div class="site-master-logo">
		<?php if ( get_header_image() ) : ?>
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img class="no-grav" src="<?php echo esc_url( get_header_image() ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

		<?php // Show only post author info on Single Pages ?>
		<?php if ( is_single() ) : ?>
			<?php independent_publisher_posted_author_card(); ?>
		<?php endif; ?>

		<?php // Show Header Image, Site Title, and Site Tagline on everything except Single Pages ?>
		<?php if ( ! is_single() ) : ?>
			<?php independent_publisher_site_info(); ?>
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