<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

 
	
	<!-- End Sidebar -->

<?php
	
	$uid = $_SESSION['u_id'];
	
	# -- Pagination : Part 1 ----------
    $per_page = 6;
                        
    if(!isset($_GET['page']))
    {
        $page = 1;   // set default value..
    }
    else
    {
        $page = (int)$_GET['page'];
    }
                    
    $start_from = ($page-1) * $per_page;
                        
    # ----------------------------------------------------------------------------------------------------------------
                        

    # ----------  Create New User  -------------------------------------------------
    $msg ='';
    $msg_sucs = '';
    $userName = '';
    $userFname = '';
    $userLname = '';
    $userEmail ='';
	$userRole = '';
	$userStatus = '';

    
    
    if(isset($_POST['creat-user']))
    {
        $userName = mysqli_real_escape_string($db_connect,$_POST['user_name']);
        $userFname = mysqli_real_escape_string($db_connect,$_POST['user_fname']);
        $userLname = mysqli_real_escape_string($db_connect,$_POST['user_lname']);
        $userEmail = mysqli_real_escape_string($db_connect,$_POST['user_email']);
        $userRole = mysqli_real_escape_string($db_connect,$_POST['user_role']);
        $userStatus = mysqli_real_escape_string($db_connect,$_POST['user_status']);
        $userDate = date("Y-m-d");
    
    /*  $userPass = @$_POST['user_password'];
        $userRePass = @$_POST['user_re_password'];
    */
    
        if(empty($userName))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter username </div>";
        }
   
        elseif(empty($userEmail))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter email </div>";
        }
    
        elseif(!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <b>".$userEmail." </b> is not a valid email! </div>";
        }
        
         elseif(empty($_POST['user_role']))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> please select the user role </div>";
        }
		
        
        elseif(empty($_POST['user_password']))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> please insert password </div>";
        }
   
        elseif(empty($_POST['user_re_password']))
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> please re-type password </div>";
        }
   
        elseif($_POST['user_password'] != $_POST['user_re_password'])
        {
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Password does not match </div>";
        }
   
        else    
        {
            $sql_username = mysqli_query($db_connect, "SELECT * FROM users WHERE user_name = '$userName'");
            $sql_email = mysqli_query($db_connect, "SELECT * FROM users WHERE user_email = '$userEmail'");
            
            // check if username and email are already exist..
            if(mysqli_num_rows($sql_username) > 0)  
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Username is already exist </div>";
            }
            elseif(mysqli_num_rows($sql_email) > 0)  
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Email is already exist </div>";
            }
            else
            {
            
                # --- Start insering the data to DB but.. 
                                    
                $userPass = md5($_POST['user_password']);
                        
                $query = "INSERT INTO users (`user_name`,`user_fname`,`user_lname`, `user_email`, `user_status`, `user_password`, `user_reg_date`, `user_role`, `created_by`) ";
                $query .= " VALUES('$userName', '$userFname', '$userLname', '$userEmail', '$userStatus', '$userPass','$userDate', '$userRole', $uid ) ";
                $insert_user = mysqli_query($db_connect, $query) or die("Mysql Error".mysqli_error($db_connect));
                                
                if(isset($insert_user))
                {
                // Start storing the info in the SESSION array..
                    $userInfo = mysqli_query($db_connect, "SELECT * FROM users WHERE user_name = '$userName'");
                    $fetchUser = mysqli_fetch_assoc($userInfo);
                        
                    $_SESSION['u_id'] = $fetchUser['user_id'];
                    $_SESSION['u_name'] = $fetchUser['user_name'];
                    $_SESSION['u_email'] = $fetchUser['user_email'];
                    $_SESSION['u_phone'] = $fetchUser['user_phone'];
                    $_SESSION['u_date'] = $fetchUser['user_reg_date'];
                    $_SESSION['u_role'] = $fetchUser['user_role'];
                        
                    $msg_sucs = "<div class='alert alert-success text-center' > user successfully registered! ..</div>";
                    $msg_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;'/><p/>";
                    $msg_sucs .= '<meta http-equiv="refresh" content="3; \'users.php\'" />';
                }
				
                
            }
        }        
    }
    // ----- End Creating user--------   
	
?>

	<div class="main-panel">
	    <div class="content">
		<div class="page-inner">
		    <div class="page-header">
			<h4 class="page-title">Users</h4>
			<ul class="breadcrumbs">
			    <li class="nav-home">
				<a href="#">
				    <i class="flaticon-home"></i>
				</a>
			    </li>
			    <li class="separator">
				<i class="flaticon-right-arrow"></i>
			    </li>
			    <li class="nav-item">
				<a href="#">Users</a>
			    </li>
			    <li class="separator">
				<i class="flaticon-right-arrow"></i>
			    </li>
			    <li class="nav-item">
				<a href="#">New User</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
				<div class="col-md-12">
					<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Create New User</h4>
								<!--		<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											New User
										</button>  -->
									</div>
								</div>
								
								
								<div class="card-body">
									<div class="col-md-8">
								<?php
										echo $msg_sucs;
										echo $msg;
								?>
										<form action="" method="post">
											<div class="row">
												<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-md-3 col-form-label"> Username</label>
																	<input type="text" name="user_name" id="user_name" class="form-control input-full" value="<?php echo $userName ?>" placeholder="Enter Username"> 
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Firstname</label>
																	<input type="text" name="user_fname" id="user_fname" class="form-control" value="<?php echo $userFname ?>" placeholder="Enter Firstname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Lastname</label>
																	<input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php echo $userLname ?>" placeholder="Enter lastname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $userEmail ?>" placeholder="User email">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Password</label>
																	<input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter password">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Re-type password</label>
																	<input type="password" name="user_re_password" id="user_re_password" class="form-control" placeholder="Re type password">
																</div>
															</div>
															
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Permissions</label>
																</div>
															</div>
															
															<div class="col-md-6">
																<div class="form-group form-group-default">
																	<label>Role</label>
																	<select name="user_role" class="form-control" id="user_role">
																	<?php if($_SESSION['u_role'] == 'sup-admin') : ?>
																	<option value="sup-admin" <?php if($userRole == 'sup-admin'){echo 'selected';}?> >Super Admin</option>
																	<?php endif; ?>
																		<option value="admin" <?php if($userRole == 'admin'){echo 'selected';}?> >Admin</option>
																		<option value="employee" <?php if($userRole == 'employee'){echo 'selected';} ?> >Employee</option>
																	<!--	<option value="poster" <?php if($userRole == 'poster'){echo 'selected';} ?> >Poster</option>  	-->
																		<option value="user" <?php if($userRole == 'user'){echo 'selected';} ?> >User</option>
																	</select>
																</div>
															</div>
															
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Status</label>
																	<select name="user_status" class="form-control" id="user_status">
																		<option value="enabled" selected>Enabled</option>
																		<option value="disabled">Disabled</option>
																	</select>
																</div>
															</div>
											</div>
											<div class="modal-footer no-bd">
													<button type="submit" name="creat-user" id="submit-user" class="btn btn-outline-info w-25"> <i class="icon-plus"></i> Add</button>
											</div>
										</form>
									</div>		
								</div>
							</div>
				</div>
				
			</div>
			
			
		</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>