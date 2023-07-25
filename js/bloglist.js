let myBody = document.querySelector('body');
myBody.classList.add('bloglist');
if(document.body.classList.contains('bloglist')){
   $('header .logo img').attr("src","img/V-logo.svg");
   $('header > .withLove').attr('src', 'img/withLoveGray.svg');
   $('.social li a img ').addClass('invertColor')

}


$(window).on('scroll', function(){
   if($(this).scrollTop() > 40){
      $(".blog-list .back-to-top").addClass("backtopTopactive")
      $(".blog-list .back-to-top").css("bottom", "3%")
   }else{
      $(".blog-list .back-to-top").removeClass("backtopTopactive")
   }
})