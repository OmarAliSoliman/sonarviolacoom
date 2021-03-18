console.log('init Homepage.js');

// $.fn.fullpage.destroy('all');

var delay = 800;
var timeoutId;
var isWaiting = false;
var animationIsFinished = false;

$('.fullPage').fullpage({
    autoScrolling: true,
    scrollHorizontally: true,
    responsiveWidth: 1100,
    anchors: ['page1', 'page2', 'page3', 'page4', 'page5'],
    onLeave: function (origin, destination, direction) {
        $('.banner').addClass('zoomAnimation');
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function () {
            animationIsFinished = true;
            // fullpage_api.moveTo(destination.index + 1);
            console.log('redned');
        }, delay);

        if (destination.index == 4) {
            $('.withLove').addClass('d-none');
            $('header .social').addClass('d-none');
        } else {
            $('.withLove').removeClass('d-none');
            $('header .social').removeClass('d-none');
        }
        if (destination.index !== 0) {
            $('.back-to-top').css('opacity', 1);
        } else {
            $('.back-to-top').css('opacity', 0);
        }

        if (destination.index == 3) {
            $('.contact .animate__animated').addClass('animate__fadeInLeft');
        }
        if (destination.index == 2) {
            $('.network .animate__animated').addClass('animate__fadeInLeft');
        }
        // $('.videoItem').get(0).pause()

        return animationIsFinished;


    },
    afterLoad: function () {
        // $('.videoItem').get(0).play()
    }
});

// $(document).on('click', '.scrollDown', function () {
//     fullpage_api.moveTo('page2', 1);
// });
// $(document).on('click', '.muted', function () {
//     var useElement = this.getElementsByTagName("use")[0];
//     $('.videoItem').get(0).muted = !$('.videoItem').get(0).muted
//     if ($('.videoItem').get(0).muted === true) {
//         useElement.href.baseVal = "#mute";
//     } else {
//         useElement.href.baseVal = "#unmute";
//     }
// });