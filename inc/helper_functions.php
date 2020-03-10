<?php
/**
 *  
 */
function unityCode_enqueue_styles_theme() 
{
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/**
 * Register a cutom post type called "token"
 * 
 */
function unityCode_cpt_token()
{
    $plural_name    = 'Tokens';
    $singular_name  = 'Token';
    $post_type      = 'token';

    $labels = array(
        'name'                  => _x( $plural_name, 'Post type Tokens no plural', 'pc' ),
        'singular_name'         => _x( $singular_name, 'Post type Token no singular', 'pc' ),
        'menu_name'             => _x( $plural_name, 'Menu Tokens', 'pc' ),
        'name_admin_bar'        => _x( $plural_name, 'Acesso rápido', 'pc' ),
        'add_new'               => __( 'Adicionar novo', 'pc' ),
        'add_new_item'          => __( 'Adicionar Novo Token', 'pc' ),
        'new_item'              => __( 'Novo Token', 'pc' ),
        'edit_item'             => __( 'Editar Token', 'pc' ),
        'view_item'             => __( 'Ver Token', 'pc' ),
        'all_items'             => __( 'Todos os Tokens', 'pc' ),
        'search_items'          => __( 'Procurar Token', 'pc' ),
        'parent_item_colon'     => __( 'Parent Token:', 'pc' ),
        'not_found'             => __( 'Nenhum Token encontrado.', 'pc' ),
        'not_found_in_trash'    => __( 'Nenhum Token encontrado na lixeira.', 'pc' ),
        'featured_image'        => _x( 'Capa do Token', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'pc' ),
        'set_featured_image'    => _x( 'Definir Capa do Token', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'pc' ),
        'remove_featured_image' => _x( 'Remover Capa', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'pc' ),
        'use_featured_image'    => _x( 'Usar imagem como Capa', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'pc' ),
        'archives'              => _x( 'Arquivos de Tokens', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'pc' ),
        'insert_into_item'      => _x( 'Inserir no Token', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'pc' ),
        'uploaded_to_this_item' => _x( 'Enviado para Token', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'pc' ),
        'filter_items_list'     => _x( 'Filtrar Lista de Tokens', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'pc' ),
        'items_list_navigation' => _x( 'Navegação de Tokens', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'pc' ),
        'items_list'            => _x( 'Lista de Tokens', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'pc' ),
    );
 
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'token' ),
        'capability_type'       => 'post',
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array( 'title', 'author', 'thumbnail', 'excerpt' ),
        'menu_icon'             => 'dashicons-tickets-alt',
    );
    register_post_type($post_type, $args);
}


