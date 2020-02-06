<?php

$users = get_users(['orderby' => 'user_registered', 'order' => 'DESC']);

$user_ids = [];

foreach( $users as $user ) {
    $user_ids[] = $user->ID;
}

foreach ($user_ids as $user_id) {
    $args = array(
        'post_type' => 'familiares',
        'author' => $user_id
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :

        $members = $query->post_count;
        ?>

        <div class="unit-wrapper items-<?php echo $members;?>">


            <?php while ( $query->have_posts() ) :
                $query->the_post();

                $photoId = get_field('photo');
                $nombre = get_field('nombre');
                $papellido = get_field('primer_apellido');
                $sapellido = get_field('segundo_apellido');
                $edad = get_field('edad');
                $fdn = get_field('fecha_de_nacimiento');
                ?>

                <div class="unit">
                    <?php echo wp_get_attachment_image( $photoId, 'big-square' ); ?>
                    <div class="details">
                    <div class="author-section">
                        <h2>Familia de <?php the_author();?></h2>
                    </div>
                        <ul>
                            <li class="name"><?php echo $nombre . ' ' . $papellido . ' ' . $sapellido; ?></li>
                            <li class="age"><?php echo $edad;?></li>
                            <li class="birthdate"><?php echo $fdn;?></li>
                            <?php
                            if ( is_user_logged_in() && ( get_current_user_id() === get_the_author_meta('ID') ) ) : ?>
                                <li><a href="<?php echo get_permalink(); ?>" target="_self"><?php echo __('Edit', 'lws-family-photo-library');?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            <?php

            endwhile;

            echo '</div>';

    endif;

    wp_reset_postdata();

}