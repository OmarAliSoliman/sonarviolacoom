<?php
    ob_start();

    session_start();
    //include_once("../inc/db.php");
    include_once("inc/config.php");
    
    /*
    if(isset($_SESSION['u_id']))
    {
        $query = mysqli_query($db_connect, "SELECT * FROM users WHERE user_id='".$_SESSION['u_id']."' AND user_role = 'admin' OR 'writer'");
    
        if(mysqli_num_rows($query) != 1)
        {
            header("Location: ../login.php");
        }
    }
    
    else
    {
        header("Location: ../login.php");
    }
    */

?>