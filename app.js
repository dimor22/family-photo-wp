jQuery(document).ready( function ($) {
    $('.foto-album').on('click', '.unit', function () {
        $(this).toggleClass('js-clicked');

    })
    console.log($('.unit').length);
})