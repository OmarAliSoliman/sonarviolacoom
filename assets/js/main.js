
/*
Theme Name:       Classix - Classified Ads and Listing Template
Author:           UIdeck
Author URI:       http://uideck.com
Text Domain:      UIdeck
Domain Path:      /languages/

JS INDEX
================================================
1. preloader js
2. scroll to top js
3. slick menu js
4. sticky menu js
6. counter js
9. wow js
7. Testimonial owl carousel
8. New Products owl carouse
9. Categories Iocn owl Carousel
================================================*/

(function($) {

  var $main_window = $(window);

  /*====================================
  preloader js
  ======================================*/
  $main_window.on("load", function() {
      $("#preloader").fadeOut("slow");
  });

  /*====================================
  scroll to top js
  ======================================*/
  $main_window.on("scroll", function() {
    if ($(this).scrollTop() > 250) {
      $(".back-to-top").fadeIn(200);
    } else {
      $(".back-to-top").fadeOut(200);
    }
  });
  $(".back-to-top").on("click", function() {
    $("html, body").animate(
      {
        scrollTop: 0
      },
      "slow"
    );
    return false;
  });
    
  /*====================================
  slick menu js
  ======================================*/
  var logo_path=$('.mobile-menu').data('logo');
  $('#main-navbar').slicknav({
      appendTo:'.mobile-menu',
      removeClasses:false,
      label:'',
      closedSymbol:'<i class="lni-chevron-right"><i/>',
      openedSymbol:'<i class="lni-chevron-right"><i/>',
      brand:'<a href="index.php"><img src="'+logo_path+'" class="img-responsive" alt="logo"></a>'
  });

  /*====================================
  sticky menu js
  ======================================*/
  $main_window.on('scroll', function () {  
    var scroll = $(window).scrollTop();
    if (scroll >= 10) {
        $(".scrolling-navbar").addClass("top-nav-collapse");
    } else {
        $(".scrolling-navbar").removeClass("top-nav-collapse");
    }
  });

  /*=======================================
  counter
  ======================================= */
  if ($(".counter").length > 0) {
    $(".counterUp").counterUp({
      delay: 10,
      time: 2000
    });
  }

  /*====================================
  wow js
  ======================================*/
  var wow = new WOW({
      //disabled for mobile
      mobile: false
  });
  wow.init();

  /*====================================
  Tooltip Toggle
  ======================================*/
  $('[data-toggle="tooltip"]').tooltip()

  /*====================================
  Testimonials Carousel 
  ======================================*/
  var testiOwl = $("#testimonials");
  testiOwl.owlCarousel({
      autoplay:true,
      margin:30,
      dots:false,
      autoplayHoverPause:true,
      nav:false,
      loop:true,
      responsiveClass:true,
      responsive:{
          0: {
              items:1,
          },
          991:{
              items:2
        }
      }
  });

  /*====================================
  New Products Owl Carousel
  ======================================*/
  var newproducts = $("#new-products");
    newproducts.owlCarousel({
      autoplay: true,
      nav: true,
      autoplayHoverPause:true,
      smartSpeed: 350,
      dots: false,
      margin:30,
      loop: true,
      navText: [
        '<i class="lni-chevron-left"></i>',
        '<i class="lni-chevron-right"></i>'
      ],
      responsiveClass: true,
      responsive: {
          0: {
              items: 1,
          },
          575: {
              items: 2,
          },
          991: {
              items: 3,
          }
        }
    });

  /*====================================
  Categories Iocn Owl Carousel
  ======================================*/
  var categoriesslider = $("#categories-icon-slider");
  categoriesslider.owlCarousel({
    autoplay: true,
    nav: false,
    autoplayHoverPause:true,
    smartSpeed: 350,
    dots: true,
    margin:30,
    loop: true,
    navText: [
      '<i class="lni-chevron-left"></i>',
      '<i class="lni-chevron-right"></i>'
    ],
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
        },
        575: {
            items: 2,
        },
        991: {
            items: 5,
        }
      }
  });

  /*====================================
  Details  Owl Carousel
  ======================================*/
  var detailsslider = $("#owl-demo");
  detailsslider.owlCarousel({
    autoplay: true,
    nav: false,
    autoplayHoverPause:true,
    smartSpeed: 350,
    dots: true,
    margin:30,
    loop: true,
    navText: [
      '<i class="lni-chevron-left"></i>',
      '<i class="lni-chevron-right"></i>'
    ],
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
        },
        575: {
            items: 1,
        },
        991: {
            items: 1,
        }
      }
  });

    
})(jQuery);



   
  /*==================================================================
  Dependent dynamic dropdown list (countries->states->cities->districts)
  ===================================================================*/
    
    // country -> states
    $(document).ready(function(){
      
      $('#country').on('change',function(){
       
       var countryID = $(this).val(); 
        
        if(countryID)
        {
          $.get(
            "ajax.php",
            {country: countryID},
            function(data){
              $('#state').html(data);
            }
          );
        }
        else
        {
          $('#state').html('<option>Select country first </option>');
        }
        });
    
    
    // State -> cities  
      $('#state').on('change',function(){
        
       var stateID = $(this).val(); 
        
        if(stateID)
        {
          $.get(
            "ajax.php",
            {state: stateID},
            function(data){
              $('#city').html(data);
            }
          );
        }
        else
        {
          $('#city').html('<option>Select State first </option>');
        }
        });
    
    
    // City => districts
      $('#city').on('change',function(){
       
       var cityID = $(this).val(); 
        
        if(cityID)
        {
          $.get(
            "ajax.php",
            {city: cityID},
            function(data){
              $('#district').html(data);
            }
          );
        }
        else
        {
          $('#district').html('<option>Select city first </option>');
        }
        });
      });
    
    
    
    
  /*==================================================================
  Dependent dynamic dropdown list (Category -> sub category)
  ===================================================================*/
    

    $(document).ready(function(){
    
    // City => districts
      $('#category').on('change',function(){
       
       var categoryID = $(this).val(); 
        
        if(categoryID)
        {
          $.get(
            "ajax.php",
            {category: categoryID},
            function(data){
              $('#subcategory').html(data);
            }
          );
        }
        else
        {
          $('#subcategory').html('<option>Select city Category first </option>');
        }
        });
      });    


    
    
  /*==================================================================
  Dependent dynamic dropdown list (Category -> Ad Custom Fields)
  ===================================================================*/
    

    $(document).ready(function(){
    
    // category => custom fields
      $('.for-fields').on('change',function(){
       
       var fieldCategoryID = $(this).val(); 
        
        if(fieldCategoryID)
        {
          $.get(
            "ajax.php",
            {fields_category: fieldCategoryID},
            function(data){
              $('#adfields').html(data);
            }
          );
        }
        else
        {
          $('#adfields').html('<option>Select Category first to show the related Custom fields </option>');
        }
        });
      });    



  
  
  
  /*==================================================================
  // CKEDITOR 
  ===================================================================*/
    

  $(document).ready(function(){
        
        // CKEDITOR 
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );     


		// in case second editor in same page..
		ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );     		
       
});



  /*==================================================================
  // Terms & Conditions : Disable a button until a checkbox is checked.
  ===================================================================*/
	//JavaScript function that enables or disables a submit button depending
	//on whether a checkbox has been ticked or not.
	function terms_changed(termsCheckBox){
		//If the checkbox has been checked
		if(termsCheckBox.checked){
			//Set the disabled property to FALSE and enable the button.
			document.getElementById("submit_button").disabled = false;
		} else{
			//Otherwise, disable the submit button.
			document.getElementById("submit_button").disabled = true;
		}
	}