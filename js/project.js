// $(window).resize(function () {
//     if (window.matchMedia("(max-width: 768px)").matches) {
//         /* the viewport is less than 768 pixels wide */
//         $('.projectImages').slick({
//             autoplay: true,
//             arrows: true,
//             autoplaySpeed: 800,
//         });
//     } else {
//         $('.projectImages').slick('unslick');
//     }
// })
// if (window.matchMedia("(max-width: 768px)").matches) {
//     /* the viewport is less than 768 pixels wide */
//     $('.projectImages').slick({
//         autoplay: true,
//         arrows: true,
//         autoplaySpeed: 800,
//     });
// } else {
//     $('.projectImages').slick('unslick');
// }

// $('.counter').counterUp({
//     delay: 10,
//     time: 2000
// });


$(document).on('click', '.owl-item', function () {
    n = $(this).index();
    console.log(n)
    window.location.href = "project" + (n + 1) + ".html";
});
$('.projectFullPage').fullpage({
    //options here
    autoScrolling: true,
    scrollHorizontally: true,
    responsiveWidth: 700,
    onLeave: function (origin, destination, direction) {
        //it won't scroll if the destination is the 3rd section

        if (destination.index !== 0) {
            $('.back-to-top').css('opacity', 1);

            $('header > .logo img').attr('src', 'img/V-beta.svg');
        }
        if (destination.index !== 0 || origin.index == 0) {
            $('.back-to-top').css('opacity', 0);
            $('header > .logo img').attr('src', 'img/V-beta-white.svg');

        }


        // var curTime = new Date().getTime();


        $('header > .logo img').attr('src', 'img/V-beta.svg');
    },
    afterLoad: function (origin, destination, direction) {
        $('header > .logo img').attr('src', 'img/V-beta.svg');
        // $('.active svg').removeClass('d-none');
        $('.active .animate__animated').addClass('animate__fadeInLeft d-block').removeClass(
            'd-none');

        $(".active svg").attr("class", " d-block");
    },
});