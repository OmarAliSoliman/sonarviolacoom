
$(document).ready(function () {
    var owl = $('.owl-carousel');
    var hideOnFooter = $('.withLove,header .social');


    // withLove.fadeOut();
    // withLove.addClass('d-none');
    $('.fullPage').fullpage({
        //options here
        autoScrolling: true,
        scrollHorizontally: true,
        onLeave: function (origin, destination, direction) {
            //it won't scroll if the destination is the 3rd section
            if (destination.index == 4) {
                hideOnFooter.addClass('d-none');
                // alert("Going to section 3!");
            }
            // if (origin.index == 3 && direction == 'down') {
            //     withLove.fadeOut();
            // }
        }
    });
    // fullpage_api.moveTo(3);


    $('#nav-icon').click(function () {
        $(this).toggleClass('open');
        $('.menu').toggleClass('open')
    });
    owl.owlCarousel({
        loop: false,
        nav: false,
        slideBy: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            960: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });
    owl.on('mousewheel', '.owl-stage', function (e) {
        console.log(e.deltaY)
        e.preventDefault();
        if (e.deltaY > 0) {
            console.log("next")
            owl.trigger('next.owl');
        } else {
            console.log("prev")
            owl.trigger('prev.owl');
        }
    });
});

$(window).load(function () {
    $('.overlay').fadeOut();
    setTimeout(function () {

        $('.banner .animate__animated').addClass('animate__fadeInLeft');
        $('.banner ').addClass('animate-banner');
    }, 500)

})