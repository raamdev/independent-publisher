<?php
/**
 * @package Independent Publisher
 * @since Independent Publisher 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$categories = get_the_category();
		$separator = ' ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
		}
		?>
		<h2 class="entry-title-meta"><div class="entry-title-meta-author"><?php independent_publisher_posted_author() ?></div> in <?php echo trim($output, $separator); ?></h2>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'independent_publisher' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'independent_publisher' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->


	<div class="post-author-bottom">
		<div class="post-author-card">
			<?php if ( get_header_image() ) : ?>
				<a class="site-logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img class="no-grav" src="<?php echo esc_url( get_header_image() ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				</a>
			<?php endif; ?>
			<div class="post-author-info">
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<div class="post-published-date">
				<h2 class="site-published">Published</h2>
				<h2 class="site-published-date"><?php independent_publisher_posted_on_date(); ?></h2>
				<h2 class="site-published-location"><?php echo get_ncl_location(); ?></h2>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
