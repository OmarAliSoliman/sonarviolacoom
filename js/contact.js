let myBody = document.querySelector('body');
myBody.classList.add('contactPage');
if (document.body.classList.contains('contactPage')) {
    $('header > .logo img').attr('src', 'img/V-beta-white.svg');
    $('header > .withLove').attr('src', 'img/withLoveGray.svg');
    $('.social li a img ').removeClass('invertColor')

}