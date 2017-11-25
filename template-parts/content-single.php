<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pine
 */

?>

<?php if ( 'perfil' == get_post_type() ): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>

		<?php
			$post_id	= get_the_ID();
			$pes 		= get_post_meta( $post_id, 'pes', true );
			$instagram	= get_post_meta( $post_id, 'instagram', true );
			$facebook	= get_post_meta( $post_id, 'facebook', true );
			$site		= get_post_meta( $post_id, 'site', true );
			$link 		= get_post_meta( $post_id, 'link', true );
			$to_report	= get_post_meta( $post_id, 'to_report', true );

		?>

		<?php if ( ! empty( $pes ) ): ?>
			<span class="pes"><?php echo esc_html( $pes ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $instagram ) ): ?>
			<a class="instagram" href="<?php echo esc_url( $instagram ); ?>" target="_blank">Instagram</a>
		<?php endif; ?>

		<?php if ( ! empty( $facebook ) ): ?>
			<a class="facebook" href="<?php echo esc_url( $facebook ); ?>" target="_blank">Facebook</a>
		<?php endif; ?>

		<?php if ( ! empty( $site ) ): ?>
			<a class="link" href="<?php echo esc_url( $site ); ?>" target="_blank">Site</a>
		<?php endif; ?>

		<?php if ( ! empty( $link ) ): ?>
			<a class="link" href="<?php echo esc_url( $link ); ?>" target="_blank">Outro link</a>
		<?php endif; ?>

		<?php if ( ! empty( $to_report ) ): ?>
			<div class="report">
				<span><?php _e( 'Use o formulário abaixo para reportar informações erradas, abuso ou ofensas nesse perfil. Sua identidade será preservada e seus dados utilizados apenas para entrar em contato caso necessário.', 'pine_child' ); ?></span>
				<?php echo do_shortcode( '[contact-form-7 title="Denunciar"]' ); ?>
				<span><?php _e( 'Desde já muito obrigado por ajudar para que nosso acervo digital tenha cada vez mais qualidade.', 'pine_child' ); ?></span>
			</div><!-- report -->
		<?php endif; ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pine_child' ),
			'after'  => '</div>',
		) ); ?>
	</article><!-- #post-## -->

<?php else: ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pine' ),
			'after'  => '</div>',
		) ); ?>
	</article><!-- #post-## -->

<?php endif ?>

