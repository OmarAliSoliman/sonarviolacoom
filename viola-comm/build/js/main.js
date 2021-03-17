
// function sleep(miliseconds) {
//     var currentTime = new Date().getTime();

//     while (currentTime + miliseconds >= new Date().getTime()) {
//     }
// }

$(document).ready(function () {
    var owl = $('.owl-carousel');


    // fullpage_api.setMouseWheelScrolling(false);
    // fullpage_api.setAllowScrolling(false);
    $('#nav-icon').click(function () {
        $(this).toggleClass('open');
        $('.menu').toggleClass('open');
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
    $(".back-to-top").click(function (e) {
        e.preventDefault();
        fullpage_api.moveTo(1);
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

                    dots: false
                }
            }
        ]
    });
   
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });
    // $('.counter').addClass('animate__animated animate__fadeInDownBig');

    $(document).on('click', '.muted', function () {
        var useElement = this.getElementsByTagName("use")[0];
        $('.videoItem').get(0).muted = !$('.videoItem').get(0).muted
        if ($('.videoItem').get(0).muted === true) {
            useElement.href.baseVal = "#mute";
        } else {
            useElement.href.baseVal = "#unmute";
        }
    });

});

$(window).load(function () {
    $('.overlay').fadeOut();
    // $('body').css('overflow', 'visible');
    setTimeout(function () {
        $('.banner .animate__animated').addClass('animate__fadeInLeft');
        $('.banner ').addClass('animate-banner');
    }, 500);
    if (window.location.href.indexOf("contact") > -1) {
        $('.contact .animate__animated').addClass('animate__fadeInLeft');
    }

    $(document).on('click', '.owl-item', function () {
        n = $(this).index();
        console.log(n)
        window.location.href = "project" + (n + 1) + ".html";

    });
    // fullpage_api.setMouseWheelScrolling(true);
    // fullpage_api.setAllowScrolling(true);
});
function showTest() {
    $('.coffee').addClass('hover')
}
function hideText() {
    $('.coffee').removeClass('hover')
}


// function sendEmail() {
//     var name = $('#contactForm').find('input[name="name"]').val();
//     var email = $('#contactForm').find('input[name="email"]').val();
//     var phone = $('#contactForm').find('input[name="phone"]').val();
//     var message = $('#contactForm').find('textarea[name="message"]').val();


//     var messageBody = "Hi I'm " + name + "and this is my email : " + email + "and this is my phone number" + phone + " " + message;

//     console.log(messageBody)
//     Email.send({
//         SecureToken: "8af017f9-0fb9-43d9-ba0b-3d97e5519e39",
//         To: 'Shimaasamir88@gmail.com',
//         From: "webmaster@viola.ae",
//         Subject: "Viola contact form",
//         Body: messageBody
//     }).then(
//         message => alert(message)
//     );
// }



// function sendEmail() {

//     var name = $('#contactForm').find('input[name="name"]').val();
//     var email = $('#contactForm').find('input[name="email"]').val();
//     var phone = $('#contactForm').find('input[name="phone"]').val();
//     var message = $('#contactForm').find('textarea[name="message"]').val();


//     var messageBody = "Hi I'm " + name + "and this is my email : " + email + "and this is my phone number" + phone + " " + message;

//     console.log(messageBody)
//     Email.send({
//         SecureToken: "6f586dd7-0966-4f28-896d-fef9d473305d",
//         To: 'shimaasamir88@gmail.com',
//         From: "shimaasamir88@gmail.com",
//         Subject: "Viola contact form",
//         Body: messageBody
//     }).then(
//         message => alert(message)
//     );
// }
// $('.sendEmailButton').click(function () {
//     console.log('send pressed')
//     sendEmail()
// })
