let myBody = document.querySelector('body');
myBody.classList.add('blogPostCopy');
if(document.body.classList.contains('blogPostCopy')){
   $('header .logo img').attr("src","img/V-logo.svg");
   $('header > .withLove').attr('src', 'img/withLoveGray.svg');
   $('.social li a img ').addClass('invertColor')

}

// $(window).on('scroll', function(){
//    if($(this).scrollTop() > 40){
//       $(".blog .back-to-top").addClass("backtopTopactive")
//       $(".blog .back-to-top").css("bottom", "3%")
//    }else{
//       $(".blog .back-to-top").removeClass("backtopTopactive")
//    }
// })