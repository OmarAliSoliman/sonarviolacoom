$(window).resize(function () {
    if (window.matchMedia("(max-width: 768px)").matches) {
        /* the viewport is less than 768 pixels wide */
        $('.projectImages').slick({
            autoplay: true,
            arrows: true,
            autoplaySpeed: 800,
        });
    } 
});

if (window.matchMedia("(max-width: 768px)").matches) {
    /* the viewport is less than 768 pixels wide */
    $('.projectImages').slick({
        autoplay: true,
        arrows: true,
        autoplaySpeed: 800,
    });
}

// $('.counter').counterUp({
//     delay: 10,
//     time: 2000
// });
$('.social li a img ').addClass('invertColor')


$('.projectFullPage').fullpage({
    //options here
    autoScrolling: true,
    scrollHorizontally: true,
    responsiveWidth: 1100,
    onLeave: function (origin, destination, direction) {
        //it won't scroll if the destination is the 3rd section
        if (destination.index !== 0) {
            $('.back-to-top').css('opacity', 1);

        }
        if (destination.index !== 0 || origin.index == 0) {
            $('.back-to-top').css('opacity', 0);
        // $('header > .logo img').attr('src', 'img/V-beta-white.svg');
            $('header > .withLove').attr('src', 'img/withLoveGray.svg');

        }


        // var curTime = new Date().getTime();


        $('header > .logo img').attr('src', 'img/V-logo.svg');
    },
    afterLoad: function (origin, destination, direction) {
        $('header > .withLove').attr('src', 'img/withLoveGray.svg');
        $('header > .logo img').attr('src', 'img/V-logo.svg');

        // $('.active svg').removeClass('d-none');
        $('.active .animate__animated').addClass('animate__fadeInLeft d-block').removeClass(
            'd-none');

        $(".active svg").attr("class", " d-block");
    },
});