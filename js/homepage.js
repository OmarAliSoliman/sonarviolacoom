console.log('init Homepage.js');

// $.fn.fullpage.destroy('all');

var delay = 800;
var timeoutId;
var isWaiting = false;
var animationIsFinished = false;
$('header > .logo img').attr('src', 'img/V-logo-white.svg');
$('.fullPage').fullpage({
    autoScrolling: true,
    scrollHorizontally: true,
    responsiveWidth: 1100,
    normalScrollElements: '#iti-0__country-listbox, #contactForm',
    // normalScrollElementTouchThreshold: 200,
    // touchSensitivity: 50,
    scrollOverflow:true,
    anchors: ['page1', 'page2', 'page3', 'page4', 'page5'],
    onLeave: function (origin, destination, direction) {
        $('.banner').addClass('zoomAnimation');
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function () {
            animationIsFinished = true;
            // fullpage_api.moveTo(destination.index + 1);
            //console.log('redned');
        }, delay);

        //console.log(destination);

        if (destination == 4) {
            // $('.withLove').addClass('d-none');
            $('header .social').addClass('d-none');
        } else {

            $('header .social').removeClass('d-none');
        }
        if (destination > 1) {
            $('.back-to-top').css('opacity', 1);
            $('.back-to-top').css('bottom', "7%");
            $('.withLove').addClass('d-none');
        } else {
            $('.back-to-top').css('opacity', 0);
            $('.withLove').removeClass('d-none');
        }

        if (destination == 3) {
            $('.contact .animate__animated').addClass('animate__fadeInLeft');
        }
        if (destination == 2) {
            $('.network .animate__animated').addClass('animate__fadeInLeft');
            $('#home-video').get(0).play();
        } else {
            $('#home-video').get(0).pause();
        }
        if (destination == 5) {
            //    $('.social').addClass('hideImportant')
            $('header .leftSocial').addClass('hideImportant');

            $('.withLove').addClass('invertColor');
        } else {
            $('.social').removeClass('hideImportant')
            $('.withLove').removeClass('invertColor');
        }
        // $('.videoItem').get(0).pause()
        return animationIsFinished;

    },
    afterLoad: function () {
        // $('.videoItem').get(0).play()
        $(".back-to-top").click(function (e) {
            e.preventDefault();
            $.fn.fullpage.moveTo(1);
            // fullpage_api.moveTo(1);
        });

        $(".scrollDown").click(function (e) {
            $.fn.fullpage.moveTo(2);
        })
    }
});

// $(document).on('click', '.scrollDown', function () {
//     fullpage_api.moveTo('page2', 1);
// });
$(document).on('click', '.muted', function () {
    var useElement = this.getElementsByTagName("use")[0];
    $('.videoItem').get(0).muted = !$('.videoItem').get(0).muted
    if ($('.videoItem').get(0).muted === true) {
        useElement.href.baseVal = "#mute";
    } else {
        useElement.href.baseVal = "#unmute";
    }
});