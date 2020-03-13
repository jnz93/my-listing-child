<?php
global $post;
$post_id = $post->ID;

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
        <input type="date" id="untcd_mb_validate" class="<?php echo $post_id; ?>" name="untcd_mb_validate" value="<?php echo ( !empty($curr_validate) ? $curr_validate : '' ); ?>" <?php echo (!empty($curr_validate) ? 'disabled' : ''); ?>>        
    </div>
    <?php    
}

/** SAVE METABOXES */
function ec_save_metaboxes($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    {
        return $post_id;
    }

    #Pegar os valores a serem salvos via $_POST
    $ec_token           = $_POST['untcd_mb_token'];
    $ec_validate        = $_POST['untcd_mb_validate'];

    #Update dos meta-campos
    update_post_meta($post_id, 'untcd_mb_token', $ec_token);
    update_post_meta($post_id, 'untcd_mb_validate', $ec_validate);
}

/**
 * Register a category for post type 'token'
 * 
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 */
function create_custom_taxonomies() 
{

    $labels = array(
        'name'              => _x( 'Categorias', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Categoria', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Procurar Categorias', 'textdomain' ),
        'all_items'         => __( 'Todas as Categorias', 'textdomain' ),
        'parent_item'       => __( 'Categoria Pai', 'textdomain' ),
        'parent_item_colon' => __( 'Categoria Pai:', 'textdomain' ),
        'edit_item'         => __( 'Editar Categoria', 'textdomain' ),
        'update_item'       => __( 'Atualizar Categoria', 'textdomain' ),
        'add_new_item'      => __( 'Adicionar nova Categoria', 'textdomain' ),
        'new_item_name'     => __( 'Nova Categoria', 'textdomain' ),
        'menu_name'         => __( 'Categoria', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category_token' ),
    );
    register_taxonomy( 'category_token', array('token'), $args);
}

/**
 * Set categories by categories
 * 
 * @link https://developer.wordpress.org/reference/functions/wp_set_post_terms/
 */
function set_custom_taxonomies_programmatically()
{
    $terms_to_insert    = get_terms('job_listing_category', array('hide_empty' => false));

    foreach ($terms_to_insert as $term) :
        $term_name  = $term->name;
        $taxonomy   = 'category_token';
        $args       = array(
            'description'   => 'Criado automaticamente baseado nas categorias dos parceiros.',
            'slug'          => $term->slug,
        );

        if ( !term_exists($term_name, $taxonomy) ) :
            wp_insert_term($term_name, $taxonomy, $args);
        endif;

    endforeach;
}

/**
 * Shortcode for checking token
 * 
 * @link https://codex.wordpress.org/Shortcode_API
 */
function form_check_token()
{
    ?>
    <form action="" class="col-lg-4 center">
        <div class="">
            <label for="check_token">Token promocional</label>
            <input type="text" name="check_token" id="check_token" placeholder="Token promocional">
        </div>
        <div class="">
            <label for="check_date">Data de validação</label>
            <input type="date" name="check_date" id="check_date" placeholder="Token promocional">
        </div>
        <div class="">
            <label for="check_id_partner">ID do parceiro</label>
            <input type="text" name="check_id_partner" id="check_id_partner" placeholder="Id do parceiro">
        </div>
        <button type="button" onclick="fetch()">Válidar o token</button>
    </form>
    <div id="insert"></div>
    <?php
    // $teste = get_post_meta('3562', 'untcd_mb_token', true);
    // echo $teste;
}
add_shortcode('form_validate_token', 'form_check_token');

function ajax_fetch()
{?>
    <script type="text/javascript">
    function fetch()
    {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            data: { 
                action: 'data_fetch_token', 
                token: jQuery('#check_token').val(), 
                date: jQuery('#check_date').val(), 
                id_partner: jQuery('#check_id_partner').val() 
            },
            success: function(data)
            {
                jQuery('#insert').html(data);
            }
        })
    }    
    </script>
<?php
}


function data_fetch_token()
{
    $ajax_token         = esc_attr($_POST['token']);
    $ajax_date          = esc_attr($_POST['date']);
    $ajax_id_partner    = esc_attr($_POST['id_partner']);

    $validate_token     = validate_token($ajax_token, $ajax_date);
    $validate_partner   = validate_partner_by_id($ajax_id_partner);

    if (is_array($validate_token) && is_array($validate_partner)) :

        if ($validate_token['category'] === $validate_partner['category']) :
            echo "Token válido!";
        else :
            echo "Token inválido!";
        endif;

    else :
        echo 'Token inválido';
    endif;
    
    die();
}


/**
 * function validate_token
 * 
 * @param $ajax_token, $ajax_date
 * @return array or false
 */
function validate_token($ajax_token, $ajax_date)
{
    $args = array(
        'post_type'     => 'token',
        'post_status'   => 'publish',
        'post_per_page' => -1,
    );
    $the_query = new WP_Query($args);
    $data = array();
    if ($the_query->have_posts()) :
        while($the_query->have_posts()) :
            $the_query->the_post();
            $token_id   = get_the_ID();
            $token_code = get_post_meta($token_id, 'untcd_mb_token', true);
            $token_code_date = get_post_meta($token_id, 'untcd_mb_validate', true);

            $categories     = get_the_terms($token_id, 'category_token');
            $category       = '';
            foreach($categories as $cat) :
                $category = $cat->slug;
            endforeach;

            if ($ajax_token === $token_code && $ajax_date === $token_code_date) :

                $data['id_token']   = $token_id;
                $data['category']   = $category;

                return $data;
            else :
                return false;
            endif;

        endwhile;
        wp_reset_postdata();
    endif;
}

/**
 * function validate_partner_by_id
 * 
 * @param $ajax_id_partner
 * @return boolean
 */
function validate_partner_by_id($ajax_id_partner)
{
    $args = array(
        'post_type'     => 'job_listing',
        'post_status'   => 'publish',
        'post_per_page' => -1,
    );
    $partners = new WP_Query($args);
    $data       = array();
    if ($partners->have_posts()) :
        while ($partners->have_posts()) :
            $partners->the_post();
            $partner_id = get_the_ID();
            $category   = '';
            
            $categories = get_the_terms($partner_id, 'job_listing_category');
            foreach ($categories as $cat) :
                $category = $cat->slug;
            endforeach;

            if ($ajax_id_partner == $partner_id) :

                $data['partner_id']     = $partner_id;
                $data['category']       = $category;

                return $data;
            endif;
        endwhile;
        wp_reset_postdata();
    endif;
}