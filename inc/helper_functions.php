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


/**
 * Meta boxes for Token's cpt
 *  
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 * @since 0.1.0
 */
global $post;

function unityCode_mb_register()
{
    $post_type = 'token';

    # Meta box Token
    add_meta_box('untcd_mb_token', __('Token promocial', 'ec'), 'ec_render_token', $post_type);

    # Meta box validate data
    add_meta_box('untcd_mb_validate', __('Período de validade', 'ec'), 'ec_render_validade', $post_type);
}

/** RENDER TOKEN */
function ec_render_token($post)
{
    $post_id    = $post->ID;
    $curr_token = get_post_meta($post_id, 'untcd_mb_token', true);
    ?>
    <div class="">
        <label for="untcd_mb_token">Token Promocional</label>
        <input type="text" id="untcd_mb_token" class="<?php echo $post_id; ?>" name="untcd_mb_token" value="<?php echo ( $curr_token != '' ? $curr_token : '' ); ?>" <?php echo (!empty($curr_token) ? 'disabled' : ''); ?>>        
    </div>
    <?php    
}

/** RENDER VALIDATE */
function ec_render_validade($post)
{
    $post_id        = $post->ID;
    $curr_validate  = get_post_meta($post_id, 'untcd_mb_validate', true);
    ?>
    <div class="">
        <label for="untcd_mb_validate">Validade do Token</label>
        <input type="date" id="untcd_mb_validate" class="<?php echo $post_id; ?>" name="untcd_mb_validate" value="<?php echo ( !empty($curr_validate) ? $curr_token : '' ); ?>" <?php echo (!empty($curr_validate) ? 'disabled' : ''); ?>>        
    </div>
    <?php    
}

/** SAVE METABOXES */
function ec_save_metaboxes($post)
{
    $post_id        = $post->ID;
    // if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    // {
    //     return $post_id;
    // }

    #Pegar os valores a serem salvos via $_POST
    $ec_token           = $_POST['untcd_mb_token'];
    $ec_validate        = $_POST['untcd_mb_validate'];

    #Update dos meta-campos
    update_post_meta($post_id, 'untcd_mb_token', $ec_token);
    update_post_meta($post_id, 'untcd_mb_validate', $ec_validate);
}
