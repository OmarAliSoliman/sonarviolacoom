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
    <meta name="google-site-verification" content="5gd7gh7gCgZZaKg6IOhf52nEYaZwqL85y1u__pUJNQ8" />
    <meta name="google-site-verification" content="5gd7gh7gCgZZaKg6IOhf52nEYaZwqL85y1u__pUJNQ8" />
    
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
    
    
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-48JFVHL0VB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-48JFVHL0VB');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PFLGM63');</script>
<!-- End Google Tag Manager -->

  </head>
  <body>
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PFLGM63"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
     
      <!--------------------------------------------------------------------------------------------------- -->
      <!----  Fixed Top Navbar Menu----->
      <nav class="navbar navbar-expand-sm bg-faded navbar-light sticky-top first-nav d-none d-md-block d-lg-block">  <!--  d-none d-md-block d-lg-block => display only on LG, Md---->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
              <span class="navbar-toggler-icon"></span>
          </button>

        <div class="container py-2">
          
          <!-- Left section -->
          <div class="float-left white_icn">
            <p class="ltr float-left"><i class="fas fa-mobile-alt white_icn"></i> <a class="phn" href="tel:<?php echo $site_phone;?>" class="navbar-brand"><?php echo $site_phone;?></a> </p>
            <p class="float-left white_icn ml-3 phn"> <span class="ml-2">|</span> <?php echo $site_email;?> <i class="far fa-envelope white_icn ml-1"></i></p>
          </div>
        
          <div class="navbar-collapse collapse topbar-menu" id="navbar1">
            <ul class="navbar-nav">
              <!--<li class="nav-item active">
                <a class="nav-link" href="#"><?php echo lang('contact');?> <span class="sr-only">Home</span></a>
              </li> -->
             <?php //echo getMenuItem(9);?></a>
            <!--<span class="devis"><?php //echo getMenuItem(12);?></a></span> -->
            </ul>
          </div>
        
        
            <!-- Right section -->
            <div class="float-right ">
              <a class="facebook" href="<?php echo $site_fb;?>" target="_blank"><i class="fab fa-facebook social_icn white_icn ml-3"></i></a>
              <a class="twitter" href="<?php echo $site_tw;?>" target="_blank"><i class="fab fa-twitter social_icn white_icn ml-3"></i></a>
              <a class="instagram" href="<?php echo $site_instagram;?>" target="_blank"><i class="fab fa-instagram social_icn white_icn ml-3"></i></a>
              <a class="snapchat" href="<?php echo $site_snapchat;?>" target="_blank"><i class="fab fa-snapchat social_icn white_icn ml-3"></i></a>
              <!--<a class="linkedin" href="<?php echo $site_linkedin;?>" target="_blank"><i class="lni-linkedin-fill social_icn white_icn ml-3"></i></a>-->
            </div>
        </div>
      </nav>

      <!------ Only on Mobile ------->
      
      <div class="d-block d-md-none py-1">
        <div class="container">
          	<ul class="left-list">
              <!--<span class="devis devis-mob"><?php //echo getMenuItem(12);?></span>-->
              <li><a class="phn float-left__ phn-mob" href="tel:<?php echo $site_phone;?>" class="navbar-brand"><?php echo $site_phone;?></a></li>
               <li> <a class="facebook" href="<?php echo $site_fb;?>" target="_blank"><i class="fab fa-facebook social_icn  ml-2"></i></a></li>
               <li> <a class="twitter" href="<?php echo $site_tw;?>" target="_blank"><i class="fab fa-twitter social_icn  ml-2"></i></a></li>
               <li> <a class="instagram" href="<?php echo $site_instagram;?>" target="_blank"><i class="fab fa-instagram social_icn  ml-2"></i></a></li>
               <li> <a class="snapchat" href="<?php echo $site_snapchat;?>" target="_blank"><i class="fab fa-snapchat social_icn  ml-2"></i></a></li>
               <!--<li> <a class="linkedin" href="<?php echo $site_linkedin;?>" target="_blank"><i class="lni-linkedin-fill social_icn  ml-2"></i></a></li>-->

           
               <!--<li><a class="facebook float-left" href="<?php echo $site_fb;?>" target="_blank"><i class="lni-facebook-filled"></i></a></li>-->
               <!--<li><a class="linkedin float-left" href="<?php echo $site_linkedin;?>" target="_blank"><i class="lni-linkedin-fill"></i></a></li>-->
              </ul>
        </div>
      </div>
      <!--------------------------------------------------------------------------------------------------- -->


      <!--<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">  -->
      <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar second-nav py-3__">
        <div class="container p-0">
          <div class="theme-header clearfix">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header float-left py-2">
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
