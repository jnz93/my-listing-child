<?php
/**
 *  
 */
function unityCode_enqueue_styles_theme() 
{
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
