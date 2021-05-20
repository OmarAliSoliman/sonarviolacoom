<footer>
      <!-- Footer Area Start -->
      <section class="footer-Content">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3 col-mb-12">
              <div class="widget">
                <div class="footer-logo"><img src="<?php echo $site_logo; ?>" alt=""></div>
                <div class="textwidget">
                  <p> <?php echo mb_substr($site_description, 0, 110, "utf8"); ?> ..<a href="about.php"> + </a> </p>
                </div>
                <!--  <ul class="mt-3 footer-social">
                  <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                  <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                  <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                </ul> -->
              </div>
            </div>
            
            <!--- separator ----->
            <div class="col-lg-1 col-md-1 col-xs-1 col-mb-12"> </div>
            
            <div class="col-lg-2 col-md-2 col-xs-2 col-mb-12">
              <div class="widget">
                <h3 class="block-title mb-0"><?php echo lang('about'); ?></h3>
                <ul class="menu">
                  <li><a href="index.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('footer_link_home'); ?> </a></li>
                  <li><a href="about.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('about_us'); ?></a></li>
                  <li><a href="services.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('our_services'); ?></a></li>
                  <li><a href="contact.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('footer_link_contact'); ?></a></li>
                  
                </ul>
              </div>
            </div>
            
            <!-------- Login or Account ------>
           <!-- <div class="col-lg-2 col-md-2 col-xs-2 col-mb-12">
              <div class="widget">
                <h3 class="block-title mb-0"><?php echo lang('my_account'); ?></h3>
                <ul class="menu">
                  <?php if(!isset($_SESSION['u_id'])) : ?>
                  <li><a href="login.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('footer_link_login'); ?></a></li>
                  <li><a href="register.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('footer_link_register'); ?></a></li>
                  <?php else : ?>
                  <li><a href="account-profile-setting.php"><i class="lni-check-mark-circle"></i> &nbsp;   <?php echo lang('footer_link_account_profile_setting'); ?></a></li>
                  <li><a href="account-my-tasks.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('required_tasks'); ?></a></li>
                  <li><a href="logout.php?id=<?php echo $_SESSION['u_id']; ?>"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('logout'); ?></a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </div> -->
            
            
            <div class="col-lg-2 col-md-2 col-xs-2 col-mb-12">
              <div class="widget">
                <h3 class="block-title mb-0"><?php echo lang('footer_title_quick_link'); ?></h3>
                <ul class="menu">
                  <li><a href="career.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('career'); ?></a></li>
                   
                  <li><a href="catalog.php"><i class="lni-check-mark-circle"></i> &nbsp;  <?php echo lang('catalog'); ?></a></li>
                </ul>
              </div>
            </div>
            
            
            
            <div class="col-lg-4 col-md-4 col-xs-4 col-mb-12">
              <div class="widget">
                <h3 class="block-title mb-0"><?php echo lang('footer_title_contact_info'); ?></h3>
                <ul class="contact-footer">
                  <li>
                    <strong><i class="lni-phone"></i></strong><span><?php echo $site_phone; ?></span>
                  </li> 
                  <li>
                    <strong><i class="lni-envelope"></i></strong><span><?php echo $site_email; ?></span>
                  </li>
                    <li>
                    <strong><i class="lni-map-marker"></i></strong><span> <?php echo $site_address; ?> </span>
                  </li>
                </ul>         
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer area End -->
      
      <!-- Copyright Start  -->
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="site-info text-center site_copyright">
                <p > <?php echo $site_copyrights; ?> &nbsp;  <?php echo lang('footer_copyrights'); ?> &copy; <?php echo date("Y"); ?> | &nbsp; <?php echo lang('footer_developped_by'); ?> <a href="http://webmanway.com"> <u>Webmanway</u> </a> </p>
              </div>     
            </div>
          </div>
        </div>
      </div>
      
      <!-- Copyright End -->
    </footer>
    <!-- Footer Section End --> 

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS 
    <script src="assets/js/jquery-min.js"></script>-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/contact-form-script.min.js"></script>
    <script src="assets/js/summernote.js"></script>
    
    
    <!-- Bootstrap-Select Plugin----->
    <script src="assets/js/bootstrap-select.js"></script>
    
     <!-- Lightslider Plugin----->
    <script src="assets/js/lightslider.js"></script>

	
	<!-- GLightbox : Filter Lightbox Gallery ----->
    <script src="assets/js/glightbox.min.js"></script>

    
    <!--   Lawyer Script JS  ------------------------------------------->
   <!-- <script src="assets/js/lightgallery.min.js"></script>
    <script src="assets/js/lightgallery2.js"></script>  <!---- New ---> 
    
    

    <script>
      $('#summernote').summernote({
          height: 250, // set editor height
          minHeight: null, // set minimum height of editor
          maxHeight: null, // set maximum height of editor
          focus: false // set focus to editable area after initializing summernote
      });
    </script>
    
  
   
   <!--------  Bootstrap-select plugin  -----------> 
    <script>
      $('.selectpicker').selectpicker();
    </script>
    
	<!--------  Language Switcher  -----------> 
    <script>
      function changeLanguage(){
        //console.log("its works");
        
        document.getElementById("language_switcher").submit();
        
      }
      
      // make the options picker..
      $(function(){
          $('.selectpicker').selectpicker();
      });

    </script>
	
	<!--------  Location Switcher  -----------> 
    <script>
      function changeLocation(){
        //console.log("its works");
        
        document.getElementById("location_switcher").submit();
        
      }
      
      // make the options picker..
      $(function(){
          $('.selectpicker').selectpicker();
      });

    </script>

    
	<!--------  Toggle element -----------> 
    <script>
      $(".doToggle").click(function(){
        $(".toggle-elm").slideToggle();
      });
    </script>
    


	<!--------  GLightbox -----------> 
    <script>
      	
	var lightboxDescription = GLightbox({
	  selector: 'glightbox'
	});


	function call(id) {
	  const items = Array.from(document.getElementsByClassName("filter"));
	  items.map(function (item, index) {
		console.log(item);
		if (id === "all") {
		  item.classList.remove('d-none');
		  item.classList.add('fadeIn','glightbox');
		  setTimeout(clean,500);
		} else {
		  const check = items[index].classList.contains(id);
		  console.log(check);

		  if (check) {
			item.classList.remove('d-none');
			item.classList.add('fadeIn','glightbox');
		  } else {
			item.classList.add('d-none');
			item.classList.remove('fadeIn','glightbox');
		  }
		}
	  })
	}

	function clean() {
	  const items = Array.from(document.getElementsByClassName("filter"));
	  items.map(function (item, index) {
		item.classList.remove('fadeIn');
	  })
	}

    </script>

    
  <!--  Lawyer Script -------------------->
<!--  <script type="text/javascript">
    $(document).ready(function() {
      $("#lightSlider").lightSlider(); 
    });
  </script> -->
  
  
	<!--------  LightSlider -----------> 
    <script type="text/javascript">
$(document).ready(function() {
    $("#lightSlider").lightSlider({
        item: 6,
        autoWidth: true,
        slideMove: 1, // slidemove will be 1 if loop is true
        slideMargin: 10,
 
        addClass: '',
        mode: "slide",
        useCSS: true,
        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
        easing: 'linear', //'for jquery animation',////
 
        speed: 1800, //ms'
        auto: true,
        loop: true,
        slideEndAnimation: true,
        pause: 2000,
 
        keyPress: true,
        controls: true,
        prevHtml: '',
        nextHtml: '',
 
        rtl:true,
        adaptiveHeight:false,
 
        vertical:false,
        verticalHeight:500,
        vThumbWidth:100,
 
        thumbItem:10,
        pager: true,
        gallery: false,
        galleryMargin: 5,
        thumbMargin: 5,
        currentPagerPosition: 'middle',
 
        enableTouch:true,
        enableDrag:true,
        freeMove:true,
        swipeThreshold: 40,
 
        responsive : [],
 
        onBeforeStart: function (el) {},
        onSliderLoad: function (el) {},
        onBeforeSlide: function (el) {},
        onAfterSlide: function (el) {},
        onBeforeNextSlide: function (el) {},
        onBeforePrevSlide: function (el) {}
    });
});
</script>
    
  </body>
</html>
