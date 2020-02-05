<?php

/* Template Name: Familiar Registration */

if( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url() );
    exit;
}

function my_pre_save_post( $post_id ) {


    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    die();


    // Create a new post
    $post = array(
        'post_title'  => 'Mario' ,
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // return the new ID
    return $post_id;

}

// add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );





acf_form_head();

get_header();


?>


    <div id="primary">
        <div id="content" role="main">

            <?php

                while ( have_posts() ) : the_post();

                    the_title('<h1>', '</h1>');

                    the_content();

                    acf_form([
                            'id'    => 'add-new-familiar',
                        'post_id'   => 'new_post',
                        'new_post' => [
                            'post_type' => 'familiares',
                            'post_status'   => 'publish'
                        ],
                        'submit_value' => __('Add Post', 'family-pictures'),
                        'honeypot' => true,
                        'html_submit_spinner' => '<span class="acf-spinner"></span>',
                        'updated_message' => __("Familiar Added", 'acf'),
                        'uploader' => 'basic'
                    ]);

                endwhile;

            ?>

        </div><!-- #content -->
    </div><!-- #primary -->



<?php get_footer(); ?>
