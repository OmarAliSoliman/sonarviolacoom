<?php
    
    //include_once("db.php");
    include_once("../inc/db.php");
	ini_set('default_charset', 'UTF-8');

    
    # --- get the name of the current page (exmaple : test.php) -->          
    $currentPage = basename($_SERVER['PHP_SELF']);
   
   
    # -------------------------------------------------------
    # ----  General Variables (for using it in any place ..) 
    #-------------------------------------------------------
    
    
    
    
    # -------  Website Settings ...
   /* $query = mysqli_query($db_connect, "SELECT * FROM settings");
    $fetch_settings = mysqli_fetch_object($query);
    
    $site_name = $fetch_settings->site_name;
    $site_description = $fetch_settings->site_description;
    $site_logo = $fetch_settings->site_logo;
    $site_email = $fetch_settings->site_email;
    $site_address = $fetch_settings->site_address;
    $site_phone = $fetch_settings->site_phone;
    $site_keywords = $fetch_settings->site_keywords;
    $site_status = $fetch_settings->site_status;
    $site_close_msg = $fetch_settings->site_close_msg;
    $site_fb = $fetch_settings->site_fb;
    $site_tw = $fetch_settings->site_tw;
    $site_ytb = $fetch_settings->site_ytb;
    $site_instagram = $fetch_settings->site_instagram;
    $site_copyrights = $fetch_settings->site_copyrights;  
    
    $site_name_ar = $fetch_settings->site_name_ar;
    $site_description_ar = $fetch_settings->site_description_ar;
    $site_address_ar = $fetch_settings->site_address_ar;
    $site_keywords_ar = $fetch_settings->site_keywords_ar;
    $site_close_msg_ar = $fetch_settings->site_close_msg_ar;
    $site_copyrights_ar = $fetch_settings->site_copyrights_ar;
    */
    //$site_default_lang = $fetch_settings->site_lang;

    
     
    # -------  Website Settings ...
    $query = mysqli_query($db_connect, "SELECT * FROM settings");
    $fetch_settings = mysqli_fetch_assoc($query);
    
    $site_name = $fetch_settings['site_name'];
    $site_description = $fetch_settings['site_description'];
    $site_logo = $fetch_settings['site_logo'];
    $site_email = $fetch_settings['site_email'];
    $site_address = $fetch_settings['site_address'];
    $site_phone = $fetch_settings['site_phone'];
    $site_keywords = $fetch_settings['site_keywords'];
    $site_status = $fetch_settings['site_status'];
    $site_close_msg = $fetch_settings['site_close_msg'];
    $site_fb = $fetch_settings['site_fb'];
    $site_tw = $fetch_settings['site_tw'];
    $site_ytb = $fetch_settings['site_ytb'];
    $site_instagram = $fetch_settings['site_instagram'];
	$site_whatsapp = $fetch_settings['site_whatsapp'];
    $site_snapchat = $fetch_settings['site_snapchat'];
    $site_copyrights = $fetch_settings['site_copyrights'];
    $site_terms = $fetch_settings['site_terms'];
    $site_terms_ar = $fetch_settings['site_terms_ar'];
    
   
?>