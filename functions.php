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
require_once dirname(__FILE__) . '/inc/cpt.php';


/**
 * Define inicial tag in creation perfil.
 */
function pine_define_inicial( $post_ID, $post, $update ) {

	$title = get_the_title( $post_ID );
	wp_set_post_terms( $post_ID, $title[0], 'inicial' );

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
		'post_status' => 'publish'
	);
	$footer_list_perfil = new WP_Query( $args );
	if ( $footer_list_perfil->have_posts() ) {
		$count = $footer_list_perfil->found_posts;
		$count_loop = 0;

		/* Quantidade de itens por coluna */
		$columns = $count / 3;

		while ( $footer_list_perfil->have_posts() ) :
			$footer_list_perfil->the_post();
			
			$count_loop++;

			if ( $count_loop == 1 || $count_loop == $columns ) {
				echo "<div class='col-sm-4'>";
			}

			the_title();
			echo "<br>";

			if ( $count_loop == 1 || $count_loop == $columns ) {
				echo "</div>";
			}



		endwhile;
		wp_reset_query();
	}
	echo "</div>";
	echo "</div><!-- .footer-list-perfil -->";
}
add_action( 'wp_footer', 'footer_list_perfil' );