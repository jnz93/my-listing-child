<?php
/**
 * Includes 
 */
include_once('inc/helper_functions.php');


/**
 * Add actions list
 */
add_action( 'wp_enqueue_scripts', 'unityCode_enqueue_styles_theme' );
add_action( 'init', 'unityCode_cpt_token' );
add_action( 'add_meta_boxes', 'unityCode_mb_register' );
add_action( 'save_post', 'ec_save_metaboxes' );
add_action( 'init', 'create_custom_taxonomies');
add_action( 'update_custom_terms', 'set_custom_taxonomies_programmatically');

/**
 * Add actions on cron job
 */
if ( ! wp_next_scheduled( 'update_custom_terms' ) ) :
    wp_schedule_event( time(), 'twicedaily', 'update_custom_terms' );
endif;