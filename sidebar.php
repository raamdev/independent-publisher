<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>
<div id="secondary" class="widget-area" role="complementary">
	<?php if ( ! independent_publisher_hide_widgets_on_single_pages() ) : ?>
		<?php do_action( 'independent_publisher_before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ) ?>
	<?php endif; ?>
</div><!-- #secondary .widget-area -->
