<?php

$photoId = get_field('photo');
$nombre = get_field('nombre');
$papellido = get_field('primer_apellido');
$sapellido = get_field('segundo_apellido');
$edad = get_field('edad');
$fdn = get_field('fecha_de_nacimiento');

?>

<div class="familiar-photo">
    <?php echo wp_get_attachment_image( $photoId, 'full' ); ?>
</div>
<div class="familiar-info">
    <?php if ( is_archive() ) : ?>
    <a href="<?php the_permalink();?>">
    <h3><?php printf( __(' Name: %s', 'family-pictures'), $nombre);?> <?php echo $papellido;?>
        <?php echo $sapellido;
        ?></h3>
    </a>

    <?php else : ?>
        <h3><?php printf( __(' Name: %s', 'family-pictures'), $nombre);?> <?php echo $papellido;?>
            <?php echo $sapellido;
            ?></h3>

    <?php endif; ?>

    <p><?php printf( __('%d years old.', 'family-pictures'), $edad) ;?></p>
    <p><?php printf(__('Birthday: %s', 'family-pictures'), $fdn) ;?></p>
    <p><?php printf(__('By: %s', 'family-pictures'), get_the_author());?></p>
</div>
