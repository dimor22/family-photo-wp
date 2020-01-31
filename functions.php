<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style(
        $parent_style,
        get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script('app-js', get_stylesheet_directory_uri() . '/main.js', ['jquery'], '1.0.0');
}

/**
 * CPT FAMILY MEMBERS
 */
function familiares_init() {
    $args = array(
        'labels'      => array(
            'name'          => __( 'Familiares', 'labor-app' ),
            'singular_name' => __( 'Familiar', 'labor-app' ),
            'add_new_item'  => __( 'Nuevo Familiar', 'labor-app' ),
            'edit_item'     => __( 'Edita Familiar', 'labor-app' )
        ),
        'public'      => true,
        'menu_icon'   => 'dashicons-admin-users',
        'has_archive' => true,
        'rewrite'     => true,
        'query_var'   => true,
        'supports'    => array( 'title', 'editor', 'custom-fields', 'post-formats' )
    );
    register_post_type( 'Familiares', $args );
}
add_action( 'init', 'familiares_init' );