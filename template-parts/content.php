<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-4' ); ?> itemscope="" itemtype="http://schema.org/Person">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="post-item__image"<?php pine_thumbnail_src( 'pine-column-full' ); ?>></a>
	<?php
	endif; ?>

	<?php the_title( sprintf( '<h2 class="post-item__title" itemprop="name"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( is_single() ): ?>
		<?php the_content( sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Read more %s', 'pine' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) ); ?>		
	<?php endif ?>

	<?php wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pine' ),
		'after'  => '</div>',
	) ); ?>
</article><!-- #post-## -->
