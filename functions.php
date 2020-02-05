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

    wp_enqueue_style( 'app-css',
        get_stylesheet_directory_uri() . '/app.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style('thick-font', 'https://fonts.googleapis.com/css?family=BioRhyme+Expanded:800&display=swap');
    wp_enqueue_script('app-js', get_stylesheet_directory_uri() . '/app.js', ['jquery'], '1.0.0');
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
        'supports'    => array('title','editor', 'custom-fields', 'post-formats', 'author')
    );
    register_post_type( 'familiares', $args );
}
add_action( 'init', 'familiares_init' );


/**
 * ADD CSS IN HEAD
 */
function css_in_head() {

    if ( ! current_user_can('update_core') ) :
    ?>

    <style>
        #menu-comments,
        #menu-posts{
            display: none;
        }
    </style>

<?php endif; }
add_action( 'admin_head', 'css_in_head');


/*
	Disable Default Dashboard Widgets
	@ https://digwp.com/2014/02/disable-default-dashboard-widgets/
*/
function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;

    if ( ! current_user_can('update_core') ) {
        // wp..
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
        // bbpress
//        unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
        // yoast seo
//        unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
        // gravity forms
//        unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
    }

}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);


/** ADD TITLE AUTOMATICALY */

add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post( $post_id ) {

    $values = get_fields( $post_id );

    if ( $post_id !== 'new') {

        // Auto generate Title
        if ( ! empty($values['nombre']) ) {
            $title = $values['nombre'] . ' ' .$values['primer_apellido'];

            wp_update_post([
                'ID'    => $post_id,
                'post_title' => $title
            ]);
        }

        // Calculate Age
        if ( !empty($values['fecha_de_nacimiento']) ) {
            //date in mm/dd/yyyy format; or it can be in other formats as well
            $birthDate = $values['fecha_de_nacimiento'];
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            update_field('edad', $age, $post_id);
        }

    }


}