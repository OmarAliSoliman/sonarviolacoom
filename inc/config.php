<?php
    
    include_once("db.php");
    
    # -------------------------------------------------------
    # ----  General Variables (for using it in any place ..) 
    #-------------------------------------------------------
    
    # --- detect the site language (ex: ar, en ..)
    $lang = $_SESSION['lang'];
    
    # --- Case 1 : Get the name of the current page (exmaple : test.php)   simple url with no REQUEST Query          
    //$currentPage = basename($_SERVER['PHP_SELF']);
   
    
    # --- Case 2 : Get the name of the current page (exmaple : test.php?p=12) (in case of REQUEST query existing '?p=12')          

    $fullUrl = $_SERVER['REQUEST_URI'];     // get the full website url   (Ex. /folder/sub_folder/page.php?id=13)
    $parts = explode("/", $fullUrl);        // return parts into array    (Ex. 'folder', 'sub_folder', 'page.php?id=13')
    $currentPage = end($parts);             // get last element of array  (Ex. 'page.php?id=13')

   
   
   
   
    # -------------------------------------------------------
    # ----  Multilangual 
    # -------------------------------------------------------
    
    # --- we add the prefix `_ar`  in arabic columns       Ex. =>   `adcat_name`  and  `adcat_name_ar` ..
    $prefix = '';
    
    if($lang == 'en')
    {
        $prefix = '';
    }
    
    elseif($lang == 'ar')
    {
        $prefix = '_ar';
    }
    
     
    # -------  Website Settings ...
    $query = mysqli_query($db_connect, "SELECT * FROM settings");
    $fetch_settings = mysqli_fetch_assoc($query);
    
    $site_name = $fetch_settings['site_name'.$prefix];
    $site_description = $fetch_settings['site_description'.$prefix];
    $site_logo = $fetch_settings['site_logo'];
    $site_email = $fetch_settings['site_email'];
    $site_address = $fetch_settings['site_address'.$prefix];
    $site_phone = $fetch_settings['site_phone'];
    $site_keywords = $fetch_settings['site_keywords'.$prefix];
    $site_status = $fetch_settings['site_status'];
    $site_close_msg = $fetch_settings['site_close_msg'.$prefix];
    $site_fb = $fetch_settings['site_fb'];
    $site_tw = $fetch_settings['site_tw'];
    $site_ytb = $fetch_settings['site_ytb'];
    $site_instagram = $fetch_settings['site_instagram'];
    $site_linkedin = $fetch_settings['site_linkedin'];
	$site_whatsapp = $fetch_settings['site_whatsapp'];
	$site_snapchat = $fetch_settings['site_snapchat'];
    $site_copyrights = $fetch_settings['site_copyrights'.$prefix];
    $site_terms = $fetch_settings['site_terms'.$prefix];
    $site_map = $fetch_settings['site_map'];

     
     
?>