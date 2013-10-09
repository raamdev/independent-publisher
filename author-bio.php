<?php
/**
 * The template for displaying Author bios.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
?>
<div class="author-avatar">
	<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'independent_publisher_author_bio_avatar_size', 100 ) ); ?>
</div><!-- .author-avatar -->
<div class="author-info">
	<div class="author-description">
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
	</div>
	<!-- .author-description -->
</div><!-- .author-info -->