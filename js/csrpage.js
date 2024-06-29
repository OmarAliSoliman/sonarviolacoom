let myBody = document.querySelector("body");
myBody.classList.add("csrPage");
if (document.body.classList.contains("csrPage")) {
  $("header .logo img").attr("src", "img/V-logo.svg");
  // $('header > .logo img').attr('src', 'img/V-logo-white.svg');
  $("header > .withLove").attr("src", "img/withLoveGray.svg");
  $(".social li a img ").addClass("invertColor");
}
