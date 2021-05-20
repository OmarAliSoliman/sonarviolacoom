<?php
    /*
    --------- Users Table  -------------
    CREATE TABLE `cms_madaress`.`users` ( `user_id` INT NOT NULL AUTO_INCREMENT , `user_name` TEXT NOT NULL , `
    user_email` TEXT NOT NULL , `user_password` TEXT NOT NULL , `user_gender` TEXT NOT NULL , `
    user_avatar` TEXT NOT NULL , `user_about` TEXT NOT NULL , `user_fb` TEXT NOT NULL , `user_tw` TEXT NOT NULL , `
    user_ytb` TEXT NOT NULL , `user_reg_date` TEXT NOT NULL , PRIMARY KEY (`user_id`)) ENGINE = MyISAM;
    */
 
    
    $host_name = 'localhost';
    $user_name = 'root';
    $user_pass = '';
    $db_name = 'viola-communications';
    
     
    
    $db_connect = mysqli_connect($host_name, $user_name, $user_pass, $db_name);
    
    mysqli_set_charset($db_connect, "utf8");    // for arabic text..
    
    
    if(!$db_connect)
    {
        echo " <p class='alert alert-danger'> غير متصل !!! <p/>";
    }
    
    
    // function for close the DB Connection
    function close_db(){
        global $db_connect;
        mysqli_close($db_connect);
    }
    
     
     
?>