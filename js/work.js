var owl = $('.owl-carousel');


owl.owlCarousel({
    loop: false,
    nav: false,
    slideBy: 3,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        800: {
            items: 1
        },
        1024:{
            items: 1

        },
        1025: {
            items: 3
        }
    }
});
owl.on('mousewheel', '.owl-stage', function (e) {
    e.preventDefault();
    if (e.deltaY > 0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
});
$(".back-to-top").click(function (e) {
    e.preventDefault();
    fullpage_api.moveTo(1);
});