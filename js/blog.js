let myBody = document.querySelector('body');
myBody.classList.add('blogPostCopy');
if(document.body.classList.contains('blogPostCopy')){
   $('header .logo img').attr("src","img/V-logo.svg");
   $('header > .withLove').attr('src', 'img/withLoveGray.svg');
   $('.social li a img ').addClass('invertColor')

}