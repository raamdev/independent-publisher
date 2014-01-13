<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>

</div><!-- #main .site-main -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php do_action( 'independent_publisher_credits' ); ?>
	</div>
	<!-- .site-info -->
</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php independent_publisher_replytocom(); // Handles Reply to Comment links properly when JavaScript is enabled ?>

<?php wp_footer(); ?>

<?php independent_publisher_jetpack_sharing_buttons_css(); // Improves JetPack Sharing Buttons style when Sharing label is blank ?>

</body>
</html>
