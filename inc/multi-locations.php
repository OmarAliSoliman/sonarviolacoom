<?php
  
    $countryPOST = @$_POST['location']; // get the submited value from dropdown (location form)
    //$selected_country = mysqli_query($db_connect, "SELECT * FROM countries WHERE country_id = {$countryPOST}");
    //$_SESSION['location'] = '1';
  
    # --- Enable MultiLocations ---------------------------------------------------------------------

    //if(isset($_POST['location']) && $_SESSION['location'] != $_POST['location'] && !empty($_POST['location']))
    if(isset($_POST['location']) && !empty($_POST['location']))
    {
        
        $_SESSION['location'] = $countryPOST;   // assigning the selected country to the session
    
    }
    else
    {
        $_SESSION['location'] = '1';  

    }
    
    $currentLocation = @$_SESSION['location'];
    
    
    //require_once "languages/" . $_SESSION['location'] . ".php";  // ------ Translation File path ----->

    
?>