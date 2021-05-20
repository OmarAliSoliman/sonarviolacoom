<?php
  /*ob_start();
  session_start();
  include_once "inc/config.php";
*/

    # -- Pagination : Part 1 ----------
    $per_page = 10;
                        
    if(!isset($_GET['page']))
    {
        $page = 1;   // set default value..
    }
    else
    {
        $page = (int)$_GET['page'];
    }
                    
    $start_from = ($page-1) * $per_page;
                        
    # ------------------------------------------------
                        
                        
                        
    #-- execute this queries only when user is logged in..    
    if(isset($_SESSION['u_id']))
    {
        # -- Get User Session ..
        $gid = $_SESSION['u_id'];

        # -- User Logged-In Fetching
        $user_query = mysqli_query($db_connect, "SELECT * FROM users WHERE user_id = $gid ");
        
           
 
        # ---------------------------------------------
        # ---  Lawyer script
        # ---------------------
  

        
         # -- All Clients created by the current user
        $user_all_clients_query = mysqli_query($db_connect, "SELECT * FROM users WHERE created_by = $gid ORDER BY user_id DESC LIMIT $start_from , $per_page");
        $total_user_clients_query = mysqli_query($db_connect, "SELECT * FROM users WHERE created_by = $gid ");
        $count_user_clients = mysqli_num_rows($total_user_clients_query);
    }

    

    #------------------------------------------------------------------------------------
    # ---- Settings Miscellaneous 
    #--------------------------------------------
    $miscellaneous_query = mysqli_query($db_connect, "SELECT * FROM `settings_miscellaneous` ");
    $miscellaneous = mysqli_fetch_assoc($miscellaneous_query);
    
    # --- Services ----
    $srvPerRow = $miscellaneous['services_number'];
    $srvHeading = $miscellaneous['services_heading'.$prefix];
    $srvLimit = $miscellaneous['services_limit'];
    $srvEnable = $miscellaneous['enable_services'];
    
  
    
    # --- Blog ----
    $blogPerRow = $miscellaneous['blog_number'];
    $blogHeading = $miscellaneous['blog_heading'.$prefix];
    $blogLimit = $miscellaneous['blog_limit'];
    $blogEnable = $miscellaneous['enable_blog'];
    
    

    
    $bootsrap_grid = array(1=>12, 2=>6, 3=>4, 4=>3, 6=>2);
    
    
?>