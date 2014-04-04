<?php
/**
 * The template for displaying image attachments.
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */

get_header();
?>

	<div id="primary" class="content-area image-attachment">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h2 class="entry-title-meta">
							<?php
							$metadata = wp_get_attachment_metadata();
							printf(
								__( '"%1$s" - <a href="%2$s" title="Link to full-size image">%3$s &times; %4$s</a> %5$s <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'independent-publisher' ),
								get_the_title(),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height'],
								independent_publisher_entry_meta_category_prefix(),
								get_permalink( $post->post_parent ),
								get_the_title( $post->post_parent )
							);
							?>

							<?php do_action( 'independent_publisher_entry_title_meta', $separator = ' | ' ); ?>
						</h2>

						<!-- .entry-meta -->
					</header>
					<!-- .entry-header -->

					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
								/**
								 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
								 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
								 */
								$attachments = array_values(
									get_children(
										array(
											'post_parent' => $post->post_parent,
											'post_status' => 'inherit',
											'post_type' => 'attachment',
											'post_mime_type' => 'image',
											'order' => 'ASC',
											'orderby' => 'menu_order ID'
										)
									)
								);
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID ) {
										break;
									}
								}
								$k ++;
								// If there is more than 1 attachment in a gallery
								if ( count( $attachments ) > 1 ) {
									if ( isset( $attachments[$k] ) ) // get the URL of the next image attachment
									{
										$next_attachment_url = get_attachment_link( $attachments[$k]->ID );
									} else // or get the URL of the first image attachment
									{
										$next_attachment_url = get_attachment_link( $attachments[0]->ID );
									}
								} else {
									// or, if there's only 1 image, get the URL of the image
									$next_attachment_url = wp_get_attachment_url();
								}
								?>

								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters(
										'independent_publisher_attachment_size', array(
											1200,
											1200
										)
									); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
									?></a>
							</div>
							<!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div><!-- .entry-caption -->
							<?php endif; ?>
						</div>
						<!-- .entry-attachment -->

						<?php the_content(); ?>

						<nav id="image-navigation" class="site-navigation">
							<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous image', 'independent-publisher' ) ); ?></span>
							<span class="next-image"><?php next_image_link( false, __( 'Next image &rarr;', 'independent-publisher' ) ); ?></span>
						</nav>
						<!-- #image-navigation -->

					</div>
					<!-- .entry-content -->

					<?php independent_publisher_posted_author_bottom_card() ?>

					<footer class="entry-meta">
						<?php do_action( 'independent_publisher_entry_meta_top' ); ?>

						<?php if ( comments_open() && ! independent_publisher_hide_comments() ) : ?>
							<div id="share-comment-button">
								<button>
									<i class="share-comment-icon"></i><?php echo independent_publisher_comments_call_to_action_text() ?>
								</button>
							</div>
						<?php endif; ?>

						<?php edit_post_link( __( 'Edit', 'independent-publisher' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>

					<!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template(); ?>

			<?php endwhile; // end of the loop. ?>

		</div>
		<!-- #content .site-content -->
	</div><!-- #primary .content-area .image-attachment -->

<?php get_footer(); ?>