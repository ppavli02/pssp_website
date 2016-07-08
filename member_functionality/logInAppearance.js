$( document ).ready(function() {
    $('.toggle').on('click', function() {
        $('.container').stop().addClass('active');
        $('.toggle').css("height","250");
    });

    $('.close').on('click', function() {
        $('.container').stop().removeClass('active');
        $('.toggle').css("height","140");
    });

    $('.footer').on('click', function() {
        $('.container').stop().addClass('container');
        //$('.footer').css("height","250");
    });
});

