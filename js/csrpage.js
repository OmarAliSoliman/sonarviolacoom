let myBody = document.querySelector('body');
myBody.classList.add('csrPage');
if (document.body.classList.contains('csrPage')) {
    $('header > .logo img').attr('src', 'img/V-beta-white.svg');
    $('header > .withLove').attr('src', 'img/withLoveGray.svg');
    $('.social li a img ').removeClass('invertColor')

}