<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * If you're looking for the main nav menu or the header image, see header.php.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>
<div id="secondary" class="widget-area" role="complementary">
	<?php if ( ! is_single() || ( is_single() && independent_publisher_show_widgets_on_single_pages() ) ) : ?>
		<?php do_action( 'independent_publisher_before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'independent-publisher' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'independent-publisher' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	<?php endif; ?>
</div><!-- #secondary .widget-area -->
