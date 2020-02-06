<?php
/**
 * Archive for Familiares
 *
 */

// Check user is author of the post
check_user_can_edit_post();

acf_form_head();
get_header();

?>
    <main id="site-content" role="main">

        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <?php acf_form([
                    'submit_value'          => __('Update Family Member', 'lws-family-photo-library'),
                    'html_submit_spinner'   => '<span class="acf-spinner"></span>',
                    'updated_message'       => __('Family Member Updated', 'lws-family-photo-library'),
                    'uploader'              => 'basic'
                ]); ?>
            <?php endwhile;
        endif; ?>

    </main><!-- #site-content -->


<?php
get_footer();
