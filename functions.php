<?php
/**
 * Pine child functions and definitions
 *
 * @package Pine child
 * @see http://codex.wordpress.org/Child_Themes
 */

/**
 * Enqueue scripts and styles.
 */
function pine_child_scripts() {
	// Parent style dependencies.
	$style_dependencies = array( 'pine-style' );

	// Allowed schemes.
	$schemes = array( 'blue', 'green', 'orange', 'purple', 'yellow' );

	// Choosen scheme.
	$scheme = get_theme_mod( 'pine_scheme', 'red' );

	// Add choosen scheme to style dependencies.
	if ( in_array( $scheme, $schemes ) ) {
		$style_dependencies[] = 'pine-style-color-' . $scheme;
	}

	// Child style.
	wp_enqueue_style( 'pine-child-style', get_stylesheet_uri(), $style_dependencies );

	// Child scripts.
	wp_enqueue_script( 'pine-child-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'pine-scripts' ), '20171126', true );
}
add_action( 'wp_enqueue_scripts', 'pine_child_scripts' );

/**
 * Custom Post Types.
 */
require_once dirname( __FILE__ ) . '/inc/cpt.php';


/**
 * Define inicial tag in creation perfil.
 */
function pine_define_inicial( $post_ID, $post, $update ) {

	$title = get_the_title( $post_ID );

	$words = explode( " ", $title );

	/* Remove specifics words of the array  */
	$ignore_words = array( 'Feet', 'feet', 'Pés', 'pés', 'Pezinhos', 'pezinhos' );
	foreach ( $words as $key => $value ) {
	   	if ( in_array( $value, $ignore_words ) ){
	     	unset( $words[$key] );
	   	}
	}

	/* Init array $iniciais */
	$iniciais = array();

	foreach ( $words as $word ) {
	    $iniciais[] = substr( $word, 0, 1 );
	}

	wp_set_post_terms( $post_ID, $iniciais, 'inicial' );

}
add_action( 'save_post_perfil', 'pine_define_inicial', 10, 3 );

/**
 * Footer with list of the Perfil's
 */
function footer_list_perfil() {
	echo "<div class='footer-list-perfil'>";
	echo "<div class='container'>";
	$args = array(
		'post_type' => 'perfil',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$footer_list_perfil = new WP_Query( $args );
	if ( $footer_list_perfil->have_posts() ) {
		$qtde_posts = $footer_list_perfil->found_posts;
		$contagem_loop = 0;

		/* Quantidade de itens por coluna */
		$qtde_por_coluna = $qtde_posts / 4;
		$qtde_por_coluna = round( $qtde_por_coluna );
		
		/* Quantidade de impressões da div de abertura das colunas*/
		$impressao = 0;

		while ( $footer_list_perfil->have_posts() ) :
			$footer_list_perfil->the_post();
			
			$contagem_loop++;
			
			if ( $contagem_loop <= $qtde_por_coluna ) {

				if ( $contagem_loop == 1 ) {

					echo "<ul class='col-sm-3'>";
					echo "<li><a href=" . esc_url( get_permalink() ) . ">" . apply_filters( 'the_title', get_the_title() ) . "</a></li>";

					$impressao++;

				} elseif( $contagem_loop == $qtde_por_coluna ) {

					echo "<li><a href=" . esc_url( get_permalink() ) . ">" . apply_filters( 'the_title', get_the_title() ) . "</a></li>";

					if ( $impressao == 4 ) {
						$contagem_loop = 1;
					} else {
						$contagem_loop = 0;
						echo "</ul>";
					}

				} else {

					echo "<li><a href=" . esc_url( get_permalink() ) . ">" . apply_filters( 'the_title', get_the_title() ) . "</a></li>";

				}

			}
			

		endwhile;
		wp_reset_query();
	}
	echo "</div>";
	echo "</div><!-- .footer-list-perfil -->";
}
add_action( 'wp_footer', 'footer_list_perfil' );