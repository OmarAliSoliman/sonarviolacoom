$('header > .logo img').attr('src', 'img/V-logo.svg');

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


$('.social li a img ').addClass('invertColor')
console.log('sas');
// let getAllDropdowns = document.querySelectorAll('.hyperLink');
// for (var i = 0; i < getAllDropdowns.length; i++) {
//     getAllDropdowns[i].addEventListener('click', function () {
//         let getAttr = this.getAttribute('data-link-to-page');
//         let getPageId = $(getAttr);
//         $("#siteContainer").load('pages/'+getPageId.selector+".html");
//         $.fn.fullpage.destroy('all');
//         console.log('worked in wokrJS File');
//     });
// }
