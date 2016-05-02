<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('full', array(
				'class' => ' img-responsive '
			)); ?>
		</div>
	<?php endif; ?>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php simple_blog_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
		endif; ?>
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ($post->post_excerpt) {
				the_excerpt();
				echo sprintf('<a href="%s" class="btn btn-primary btn-lg" role="button">'.__( 'Continue reading <span class="glyphicon glyphicon-menu-right"></span>', 'simple-blog').'</a>
', esc_url( get_permalink() ));
			} else {
				the_content( sprintf(
				/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading <span class="glyphicon glyphicon-menu-right"></span>', 'simple-blog' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'simple-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php simple_blog_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
