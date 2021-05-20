<?php  include_once "inc/header.php"; ?>

<?php //include_once("session.php"); ?>  <!-- session.php including config.php -->
<?php //include_once("functions.php"); ?>

</header>

    <!-- Header Area wrapper End -->
    
    <?php
            if(isset($_SESSION['u_id']))
            {
                 header("Location: index.php"); 
            }        
    ?>
          
    <?php include_once "inc/login.php";?>

    

    <!-- Content section Start --> 
    <section class="login section-padding">
      <div class="container-fluid admin-login-area">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-12 col-xs-12"> <br><br><br><br><br><br><br>
            
            <?php
                echo $msg; 
                echo $msg_sucs;
            ?>
            
            <div class="login-form login-area pt-5 login-bg">
              <img class="float-left mb-5 ml-5 img-thumbnail logo-lawyer" src="../<?php echo $site_logo; ?>" alt="<?php echo $site_name; ?>">
              <h3 class="pl-3 float-right pr-5 pt-4">
               Admin Area | <small class="text-muted"> Login </small> <?php //echo lang('login_now'); ?> 
              </h3>
              
              <form role="form" class="login-form" action="" method="post">
                <div class="form-group">
                  <div class="input-icon">
                   <!-- <i class="lni-user"></i> -->
                    <input type="text" id="user_name" class="form-control" name="user_name" placeholder=" Username/Email <?php //echo lang('username_email'); ?>">
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                  <!--  <i class="lni-lock"></i>  -->
                    <input type="password" class="form-control" name="user_pass" placeholder=" Password <?php //echo lang('password'); ?>">
                  </div>
                </div>                  
                <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkedall">
                    <label class="custom-control-label" for="checkedall"> Keep me Logged <?php //echo lang('keep_me_login'); ?></label>
                  </div>
                  <!--<a class="forgetpassword" href="register.php"> New Account <?php //echo lang('new_account'); ?></a>-->
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary log-btn"> Login <?php //echo lang('submit'); ?></button>
                </div>
			<!--	  <a href="forgot-password.php"> Forgot password <?php //echo lang('forgot_password'); ?> </a>   -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>  <br><br><br><br><br><br><br>
    <!-- Content section End --> 
    
    <!-- Footer Section Start -->
    <?php include_once "inc/footer.php"; ?>
