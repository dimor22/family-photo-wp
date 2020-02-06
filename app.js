jQuery(document).ready( function ($) {
    $('.foto-album').on('click', '.unit', function (e) {
        e.preventDefault();
        $(this).toggleClass('js-clicked');

    });

    $('.foto-album').on('click', '.unit a', function (e) {
        $(this).click();
    });
})