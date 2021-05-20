<?php
  
  include_once "inc/multilangues.php";    // included session_start()
  
  include_once "inc/config.php";

  include_once "inc/queries.php";
  
  include_once "inc/functions.php";
  
  include_once "inc/multi-locations.php";    // change locations (countries)
  
  

  
  //require_once "languages/" . $_SESSION['lang'] . ".php";  // ------ Translation File path ----->

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="<?php echo $site_description; ?>" />
    <meta name="keywords" content="<?php echo $site_keywords; ?>" />
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Favicon ----->
    <!--<link rel="icon" type="image/png" href="images/favicon.ico" sizes="16x16" /> -->
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title> <?php echo $site_name; ?> </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/line-icons.css">
    
	<!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.css">

	<!-- CSS Animations -->
    <link rel="stylesheet" type="text/css" href="assets/css/animations.css">
    
    <!-- GLightbox : Filter Lightbox Gallery -->
    <link rel="stylesheet" type="text/css" href="assets/css/glightbox.css">
    

    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    
    <!-- Lightslider Style (partners) -->
    <link rel="stylesheet" type="text/css" href="assets/css/lightslider.css">
    
    <!-- Bootstrap Select Plugin -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.css">
    
    <!-- Fontawsome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <!--  Start Lawyer Script ---------------------------------------->
  <!--<link rel="stylesheet" href="assets/css/slider.css">
    
    <!-- Light Gallery plugin -->
  <!--  <link type="text/css" rel="stylesheet" href="assets/css/lightgallery.css" />
    
    <!-- Light Slider plugin -->
  <!--  <link type="text/css" rel="stylesheet" href="assets/css/lightslider.css" />                  

 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    
  <?php
      if($lang == 'ar')     // $lang = $_SESSION['lang']
      {
  ?>
  
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-rtl.css">
    
    <!-- Main RTL CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/rtl.css">
    
  <?php
      }
          # --- getting the post id (ad_id) for rating
          $get_ad_id = @$_GET['ad_id']; 
  ?>
    
    
    <!---------------------------------------------
    5 Stars Rating System 
    ----------------------------------------------->
    
    <!-- jquery-bar-rating-master => Rating CSS -->
    <link href='assets/css/rating-themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
    
    <!-- jQuery ----->
    <script src="assets/js/jquery-min.js"></script>
    
    <!--  jquery-bar-rating-master Plugin----->
    <script src="assets/js/jquery.barrating.min.js" type="text/javascript"></script>

    
    <!--  ckeditor 5  -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script> 
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>-->

    
    <script>
        $(function() {
                                $('.rating').barrating({
                                    theme: 'fontawesome-stars',
									//reverse: true,

                                    onSelect: function(value, text, event) {
                    
                                        // Get element id by data-id attribute
                                        var el = this;
                                        var el_id = el.$elem.data('id');
                    
                                        // rating was selected by a user
                                        if (typeof(event) !== 'undefined')
                                        {
                                            
                                            var split_id = el_id.split("_");
                    
                                            var postid = split_id[1];  // postid
                                            //var postid =  <?php echo $get_ad_id; ?> // postid
                    
                                            // AJAX Request
                                            $.ajax({
                                                url: 'rating_ajax.php',
                                                type: 'post',
                                                data: {ads_ad_id:postid,rating:value},
                                                dataType: 'json',
                                                success: function(data){
                                                    // Update average
                                                    var average = data['averageRating'];
                                                    $('#avgrating_'+postid).text(average);
                                                }
                                            });
                                        }
                                    }
                                });
                            });
    </script>
    
    <!----- End 5 stars Rating System -------------------------->

  </head>
  <body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
      <!--<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">  -->
      <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar bg-light">
        <div class="container">
          <div class="theme-header clearfix">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header float-left">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="lni-menu"></span>
                <span class="lni-menu"></span>
                <span class="lni-menu"></span>
              </button>
              <a href="index.php" class="navbar-brand"><img src="<?php echo $site_logo; ?>" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
              <ul class="navbar-nav ml-5 w-100 justify-content-left mt-2">
              <?php
                    $query = mysqli_query($db_connect, "SELECT * FROM menu WHERE item_status ='published' ORDER BY item_order ASC");
                    while($row = mysqli_fetch_assoc($query))
                    {
                      $item_id = $row['item_id'];
                      $item_label = $row['item_label'.$prefix];
                      $item_type = $row['item_type'];
                      $item_url = $row['item_url'];
                      $item_page_id = $row['item_page_id'];
                      $item_order = $row['item_order'];
                      
                      # --- get the page name from pages by item_page_id
                      $SQL = mysqli_query($db_connect, "SELECT * FROM pages WHERE pg_id = {$item_page_id} "); 
                      $fetchSQL = mysqli_fetch_assoc($SQL);
                      $page_name = $fetchSQL['pg_name'.$prefix];
                      
                      if($item_type == 'link')
                      {
                          $item_name = $item_label;
                          $item_link = $item_url;
                      }
                      
                      else
                      {
                          $item_name = $page_name;
                          $item_link = 'page.php?id='.$item_page_id;
                      }
              ?>
                  <li class="nav-item <?php currentPage($item_link);?>"><a class="nav-link" href="<?php echo $item_link;?>" > <?php echo $item_name; ?></a></li>
              <?php
                    }
              ?>
              
                <!-- <li class="nav-item"> <a class="nav-link" href="contact.php"><?php echo lang('contact'); ?></a> </li> -->
               
              </ul>

         <?php
         
              # --- Getting current user data for updating it..
              $query = "SELECT * FROM users WHERE user_id = '$gid'";
              $select_user = mysqli_query($db_connect, $query);
              
              $row = mysqli_fetch_assoc($select_user);
                  
              $select_userName = $row['user_name'];
              $select_userFname = $row['user_fname'];
              $select_userLname = $row['user_lname'];
              $select_userEmail = $row['user_email'];
              $select_userAvatar = $row['user_avatar'];
              $select_userPhone = $row['user_phone'];
              $select_userRole = $row['user_role'];
         ?>
         <!--     
          <?php if(isset($_SESSION['u_id'])) : ?>
              
                    <div class="header-top-right float-right">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown ">
                          <a class="nav-link dropdown-toggle header-top-button" href="dashboard.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="lni-user"></i>  <?php echo lang('my_account') ?>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="account-profile-setting.php"><?php echo lang('edit_account') ?></a>
                            
                            <?php  if($select_userRole != 'admin') :    // don't show for admins accounts   ?>  
                            <a class="dropdown-item" href="account-my-tasks.php"><?php echo lang('required_tasks') ?></a>
                            <?php else : ?>
                            <a class="dropdown-item" href="account-sent-tasks.php"><?php echo lang('sent_tasks') ?></a>
                            <?php endif; ?>
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php?id=<?php echo $_SESSION['u_id']; ?>"><?php echo lang('logout')?></a>
                          </div>
                        </li>
                      </ul>
                    </div>
             
              <?php else : ?>
                
                    <div class="header-top-right float-right login-box radius-0">
                      <a href="login.php" class="header-top-button"><i class="lni-lock"></i> <?php echo lang('login') ?> </a> <span class="hidden-in-mobile">|</span>
                      <a href="register.php" class="header-top-button"><i class="lni-pencil"></i> <?php echo lang('register') ?> </a>
                    </div>
                    
              <?php endif; ?>
           -->
              <div class="post-btn">
                <a class="btn btn-common radius-0" href="contact.php"><i class="lni-pencil-alt"></i> <?php echo lang('contact'); ?></a>
              </div>
                
            </div>
          </div>
          

        </div>
        <div class="mobile-menu" data-logo="assets/img/logo-mobile.png">
          
          <!----------  Languages Switcher --------------------------------------->
                 <div class="bg-light float-left p-0">
                  <form class="navbar-form navbar-right lang_switcher" action="" method="post" id="language_switcher">
                    <div class="form-group mb-0">
                      <select name="lang" id="lang" class="form-control selectpicker" onchange="changeLanguage();">
                        <option value="en" <?php if($_SESSION['lang'] == 'en'){echo 'selected';} ?> >English</option>
                        <option value="ar" <?php if($_SESSION['lang'] == 'ar'){echo 'selected';} ?> >العربية</option>
                      </select>
                    </div>
                  </form>
                 </div>
                 
                 

        </div>
      </nav>
      <!-- Navbar End -->
