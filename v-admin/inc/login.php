<?php
    
    $msg ='';
    $msg_sucs = '';

    if(isset($_POST['login']))
    {
            $user = stripcslashes(mysqli_real_escape_string($db_connect, $_POST['user_name']));
            $pass = md5($_POST['user_pass']);
            
            if(empty($user))
            {
                //$msg = "<div class='alert alert-danger' role='alert'>  ".lang('please_enter_uname_mail')."  </div>";
                $msg = "<div class='alert alert-danger' role='alert'>  please enter username  </div>";
            }
  
            elseif(empty($_POST['user_pass']))  // we don't use the '$pass' variable because it return empty value after using md5() 
            {
                //$msg = "<div class='alert alert-danger' role='alert'> ".lang('password_required')."  </div>";
                $msg = "<div class='alert alert-danger' role='alert'> Password required  </div>";
            }
            
            else
            {
                $query = mysqli_query($db_connect, "SELECT * FROM users WHERE (`user_name` = '$user' OR `user_email` = '$user') AND `user_password` = '$pass' AND (user_role = 'admin' OR user_role = 'sup-admin')");      
                
                if(mysqli_num_rows($query) != 1)
                {
                    //$msg = "<div class='alert alert-danger' role='alert'>   ".lang('username_password_incorrect')." </div>";
                    $msg = "<div class='alert alert-danger' role='alert'>   username or password is incorrect </div>";
                }
                else
                {
                    $fetchUser = mysqli_fetch_assoc($query);    
                    
                    // start storing the data in Session .. 
                    $_SESSION['u_id'] = $fetchUser['user_id'];
                    $_SESSION['u_name'] = $fetchUser['user_name'];
                    $_SESSION['u_email'] = $fetchUser['user_email'];
                    $_SESSION['u_phone'] = $fetchUser['user_phone'];
                    $_SESSION['u_date'] = $fetchUser['user_reg_date'];
                    $_SESSION['u_role'] = $fetchUser['user_role'];
                    
                    //$msg_sucs = "<div class='alert alert-success text-center' > ".lang('logged_successfully')." </div>";
                    $msg_sucs = "<div class='alert alert-success text-center' > Logged successfully </div>";
                    $msg_sucs .= "<p class='text-center m-auto'> <img src='assets/img/ajax-loader.gif'/><p/>";
                    $msg_sucs .= '<meta http-equiv="refresh" content="3; \'index.php\'" />';;
                }
            }
    }

?>