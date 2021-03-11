
$('.aboutFullPage').fullpage({
    autoScrolling: true,
    scrollHorizontally: true,
    // responsiveWidth: 1100,
    onLeave: function (origin, destination, direction) {
        // if (destination.index == 0) {
        //     $('.back-to-top').css('opacity', 0);

        //     $('header > .logo img').attr('src', 'img/V-beta-white.svg');
        // } else {
        //     $('header > .logo img').attr('src', 'img/V-beta.svg');
        //     $('.back-to-top').css('opacity', 1);
        // }
        // $('.videoItem').get(0).pause();
        $('header > .logo img').attr('src', 'img/V-beta.svg');
        $('.back-to-top').css('opacity', 1);
        if ($(window).width() < 600) {
            $('header > .logo img').attr('src', 'img/V-beta-white.svg');
        }
    },
    afterLoad: function (origin, destination, direction) {
        $('.active .animate__animated').addClass('animate__fadeInLeft d-block');
        // $('.videoItem').get(0).play()

        $('header > .logo img').attr('src', 'img/V-beta.svg');
        if ($(window).width() < 600) {
            $('header > .logo img').attr('src', 'img/V-beta-white.svg');
        }
        $('.back-to-top').css('opacity', 1);
    }


});
$('#slick1').slick({
rows: 4,
dots: true,
arrows: false,
infinite: true,
autoplay: true,
autoplaySpeed: 1500,
slidesToShow: 3,
slidesToScroll: 3,
responsive: [

    {
        breakpoint: 600,
        settings: {

            dots: true
        }
    },
    {
        breakpoint: 769,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
        }
    },
    {
        breakpoint: 1441,
        settings: {
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 1,
        }
    }
]
});