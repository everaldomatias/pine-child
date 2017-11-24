<?php
add_action( 'init', 'cpt_perfis_init' );
/**
 * Register a Perfil post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function cpt_perfis_init() {
	$labels = array(
		'name'               => _x( 'Perfis', 'post type general name', 'pine' ),
		'singular_name'      => _x( 'Perfil', 'post type singular name', 'pine' ),
		'menu_name'          => _x( 'Perfis', 'admin menu', 'pine' ),
		'name_admin_bar'     => _x( 'Perfil', 'add new on admin bar', 'pine' ),
		'add_new'            => _x( 'Adicionar Novo', 'perfil', 'pine' ),
		'add_new_item'       => __( 'Adicionar Novo Perfil', 'pine' ),
		'new_item'           => __( 'New Perfil', 'pine' ),
		'edit_item'          => __( 'Editar Perfil', 'pine' ),
		'view_item'          => __( 'View Perfil', 'pine' ),
		'all_items'          => __( 'Todos Perfis', 'pine' ),
		'search_items'       => __( 'Procurar Perfis', 'pine' ),
		'parent_item_colon'  => __( 'Parent Perfis:', 'pine' ),
		'not_found'          => __( 'Nenhum perfil encontrado.', 'pine' ),
		'not_found_in_trash' => __( 'Nenhum perfil encontrado na Lixeira.', 'pine' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'pine' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'			 => 'dashicons-groups',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'perfil' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' )
	);

	register_post_type( 'perfil', $args );
}

function tag_perfis_init() {
	register_taxonomy(
		'inicial',
		'perfil',
		array(
			'label' => __( 'Inicial' ),
			'rewrite' => array( 'slug' => 'inicial' ),
			'hierarchical' => false,
			'show_ui' => false,
			'publicly_queryable' => true
		)
	);
}
add_action( 'init', 'tag_perfis_init' );