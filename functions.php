<?php
/**
 * THEME CSS AND SCRIPTS
 */
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

    wp_enqueue_style( 'app-css',
        get_stylesheet_directory_uri() . '/app.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style('thick-font', 'https://fonts.googleapis.com/css?family=BioRhyme+Expanded:800&display=swap');
    wp_enqueue_script('app-js', get_stylesheet_directory_uri() . '/app.js', ['jquery'], '1.0.0');
}

