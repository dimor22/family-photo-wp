<?php

/* Template Name: Familiar Registration */

if( false === is_user_logged_in() ) {
    wp_redirect( wp_login_url() );
    exit;
}

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
                            'submit_value' => __('Add Family Member', 'lws-family-photo-library'),
                            'honeypot' => true,
                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
                            'updated_message' => __("Family Member Added", 'lws-family-photo-library'),
                            'uploader' => 'basic'
                    ]);

                endwhile;

            ?>

        </div><!-- #content -->
    </div><!-- #primary -->



<?php get_footer(); ?>
