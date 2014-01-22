<?php
/**
 * The Social nav menu, for displaying social icons.
 *
 * Thanks to Konstantin Kovshenin and Justin Tadlock for this idea.
 * http://kovshenin.com/2014/social-menus-in-wordpress-themes/
 * http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

if ( has_nav_menu( 'social' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

}