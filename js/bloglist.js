let myBody = document.querySelector('body');
myBody.classList.add('bloglist');
if(document.body.classList.contains('bloglist')){
   $('header .logo img').attr("src","img/V-beta.svg");
   $('header > .withLove').attr('src', 'img/withLoveGray.svg');
   $('.social li a img ').addClass('invertColor')

}
