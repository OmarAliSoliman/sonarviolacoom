<?php
  
    ob_start();
    session_start();
  
    # --- Enable MultiLangual ---------------------------------------------------------------------
    if(!isset($_SESSION['lang']))
    {
        $_SESSION['lang'] = "ar";
    }
    elseif(isset($_POST['lang']) && $_SESSION['lang'] != $_POST['lang'] && !empty($_POST['lang']))
    {
        if($_POST['lang'] == "en")
        {
            $_SESSION['lang'] = "en";
        }
        
        elseif($_POST['lang'] == "ar")
        {
            $_SESSION['lang'] = "ar";
        }
    }
    
    
    
    
    require_once "languages/" . $_SESSION['lang'] . ".php";  // ------ Translation File path ----->

    
?>