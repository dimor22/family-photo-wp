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
            while ( have_posts() ) : the_post();
                ?>
                <section>
                    <?php get_template_part( 'template-parts/familiar-card' ); ?>
                </section>
                <?php
            endwhile;
        endif; ?>

    </main><!-- #site-content -->


<?php
get_footer();
