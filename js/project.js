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


// $(window).on('scroll', function(){
//     if($(this).scrollTop() > 10){
//        $(".projectFullPage .back-to-top").addClass("backtopTopactive")
//        $(".projectFullPage .back-to-top").css("bottom", "3%")
//     }else{
//        $(".projectFullPage .back-to-top").removeClass("backtopTopactive")
//     }
//  })

$('.projectFullPage').fullpage({
    //options here
    autoScrolling: true,
    scrollHorizontally: false,
    responsiveWidth: 4650,
    // scrollOverflow: true,

    onLeave: function (origin, destination, direction) {
        //it won't scroll if the destination is the 3rd section
        // if (destination.index !== 0) {
        //     $('.back-to-top').css('opacity', 1);

        // }
        if (destination.index !== 0 || origin.index == 0) {
            $('.back-to-top').css('opacity', 0);
        // $('header > .logo img').attr('src', 'img/V-beta-white.svg');
            $('header > .withLove').attr('src', 'img/withLoveGray.svg');

        }

        // if (destination > 1) {
        //     $('.back-to-top').css('opacity', 1);
        //     $('.back-to-top').css('bottom', "3%");
        //     $('.withLove').addClass('d-none');
        // } else {
        //     $('.back-to-top').css('opacity', 0);
        //     $('.withLove').removeClass('d-none');
        // }


        // var curTime = new Date().getTime();


        $('header > .logo img').attr('src', 'img/V-logo.svg');
    },
    afterLoad: function (origin, destination, direction) {
        $('header > .withLove').attr('src', 'img/withLoveGray.svg');
        $('header > .logo img').attr('src', 'img/V-logo.svg');

        // $('.active svg').removeClass('d-none');
        $('.active .animate__animated').addClass('animate__fadeInLeft d-block').removeClass(
            'd-none');

        $(".active img").attr("class", "d-block");

        $(".back-to-top").click(function (e) {
            e.preventDefault();
            $.fn.fullpage.moveTo(1);
            // fullpage_api.moveTo(1);
        });
    },
});

// $('.projectFullPage').fullpage('destroy');