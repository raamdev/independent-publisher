<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Independent Publisher
 * @since Independent Publisher 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'independent_publisher_before_sidebar' ); ?>
			<?php dynamic_sidebar( 'sidebar-1' ) ?>
		</div><!-- #secondary .widget-area -->
