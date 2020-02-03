<?php
/**
 * Archive for Familiares
 *
 */

get_header();

?>
    <main id="site-content" role="main">

    <?php 
    if ( have_posts() ) :
        echo '<ul class="familiares-list">';
        while ( have_posts() ) {
            the_post();
            echo '<li>';
            get_template_part( 'template-parts/familiar-card' );
            echo '</li>';
        }
        echo '</ul>';
    endif; ?>
    </main><!-- #site-content -->
<?php
get_footer();
