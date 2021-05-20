<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>


	<!-- End Sidebar -->

<?php
	
	# -- Pagination : Part 1 ----------
    $per_page = 12;
                        
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
                        

    $msg ='';
    $msg_sucs = '';
    $userName = '';
    $userFname = '';
    $userLname = '';
    $userEmail ='';
	$userRole = '';
	$userStatus = '';

	
	$userId = @$_GET['user_id'];
    $action = @$_GET['action'];
	
	
    # --------- Delete User.. ------------------------------------------------------------
   
    if(isset($action) AND $action == 'delete')
    {
		$deleteUserdQuery = mysqli_query($db_connect, "DELETE FROM users WHERE user_id = $userId") or die("mysql error" . mysqli_error($db_connect));
                        
        if($deleteUserdQuery)
        {
                            $msg_sucs = "<div class='alert alert-success text-center' > Ad has been deleted successfully! ..</div>";
                            $msg_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                            $msg_sucs .= '<meta http-equiv="refresh" content="3; \'users.php\'" />';
                            
                            echo $msg_sucs;
        }
                        
    }
	
    # --------- Update User.. ------------------------------------------------------------

	elseif(isset($action) AND $action == 'edit')
	{
		# -- Get the current user details for editing..
		$userInfoQuery = mysqli_query($db_connect, "SELECT * FROM users WHERE user_id = $userId");
		$fetchUserInfo = mysqli_fetch_assoc($userInfoQuery);
		
			
		$user_id = $fetchUserInfo['user_id'];
		$user_name = $fetchUserInfo['user_name'];
		$user_fname = $fetchUserInfo['user_fname'];
		$user_lname = $fetchUserInfo['user_lname'];
		$user_email = $fetchUserInfo['user_email'];
		$user_phone = $fetchUserInfo['user_phone'];
		$user_status = $fetchUserInfo['user_status'];
		$user_reg_date = $fetchUserInfo['user_reg_date'];
		$user_role = $fetchUserInfo['user_role'];
		$user_avatar = $fetchUserInfo['user_avatar']; 		//   '../'  => because the image is located in different
							
		if(isset($_POST['edit-user']))
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
				$msg = "<div class='alert alert-danger' role='alert'> Please enter username </div>";
			}
	   
			elseif(empty($userEmail))
			{
				$msg = "<div class='alert alert-danger' role='alert'> Please enter email </div>";
			}
		
			elseif(!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
			{
				$msg = "<div class='alert alert-danger' role='alert'> <b>".$userEmail." </b> is not a valid email! </div>";
			}
			
			 elseif(empty($_POST['user_role']))
			{
				$msg = "<div class='alert alert-danger' role='alert'> please select the user role </div>";
			}
			
			
			else    
			{ 	// checking if the username\email isnt already exist AND isn't the current username\email
				$sql_username = mysqli_query($db_connect, "SELECT * FROM users WHERE user_name = '$userName' AND user_id != $user_id");
				$sql_email = mysqli_query($db_connect, "SELECT * FROM users WHERE user_email = '$userEmail' AND user_id != $user_id");
				
				// check if username and email are already exist..
				if(mysqli_num_rows($sql_username) > 0)  
				{
					$msg = "<div class='alert alert-danger' role='alert'> Username is already exist </div>";
				}
				
				elseif(mysqli_num_rows($sql_email) > 0)  
				{
					$msg = "<div class='alert alert-danger' role='alert'> Email is already exist </div>";
				}
				
				else
				{
					//  -------------------  image uploader ------------------------
					
					$image = $_FILES['p_image'];
							
					$image_name = $image['name'];       // ==>    $image_name = $_FILES['p_name']['name'];
					$image_tmp = $image['tmp_name'];
					$image_size = $image['size'];
					$image_error = $image['error'];
					
					if( $image_name !='') // if the image isn't empty..
					{
																		// explode => removing everything till it arrive to '.' then stop..
							$image_ext = explode('.', $image_name);     // getting the extension from the full name  ex:  image1.png => png
							
							$image_ext = strtolower(end($image_ext));   // converting the result extension to lowercase  ex: PNG => png
							
							$image_max_size = 4194304; //  4Mb = 4 * 1024 * 1024 Kb
							
							//  checking if the extension is in our allowed list ..
							
							$allowd = array('png', 'gif', 'jpg', 'jpeg');
							
							if(in_array($image_ext, $allowd))       // if the extension exist in the array..
							{
								if($image_error === 0)      // if we don't get any error..
								{
									if($image_size <= $image_max_size)    
									{
										$new_name = uniqid('user_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
																									// more_entropy: specifies more entropy 
																									// at the end of the return value    
										$image_dir = '../assets/img/users/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
										
										$image_db = 'assets/img/users/'.$new_name;         // the stable location of image after is uploaded..
										
										if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
										{
					
											// if the password has been changed too ..
											if(!empty($_POST['user_password']))
											{
												//$msg = "<div class='alert alert-danger' role='alert'> please insert password </div>";
												
												if(empty($_POST['user_re_password']))
												{
													$msg = "<div class='alert alert-danger' role='alert'> please re-type password </div>";
												}
										   
												elseif($_POST['user_password'] != $_POST['user_re_password'])
												{
													$msg = "<div class='alert alert-danger' role='alert'> Password does not match </div>";
												}
												
												else
												{
													# --- Start updating the data.. ( With Password)
																		
													$userPass = md5($_POST['user_password']);
													
													$query = "UPDATE users SET `user_name` = '$userName', `user_fname` = '$userFname', `user_lname` = '$userLname', `user_email` = '$userEmail', `user_status` = '$userStatus', `user_password` = '$userPass', `user_role` = '$userRole', `user_avatar` = '$image_db' WHERE user_id = '$userId' ";
													$update_user = mysqli_query($db_connect, $query) or die("Mysql Error".mysqli_error($db_connect));
												
													if($update_user)
													{
														header("Location: users.php");
													}
												
												}
											
											}
									   
						
											else
											{
											
												# --- Start updating the data.. ( Without Password)														
												$query = "UPDATE users SET `user_name` = '$userName', `user_fname` = '$userFname', `user_lname` = '$userLname', `user_email` = '$userEmail', `user_status` = '$userStatus', `user_role` = '$userRole', `user_avatar` = '$image_db' WHERE user_id = {$userId}";
												$update_user = mysqli_query($db_connect, $query) or die("Mysql Error".mysqli_error($db_connect));	
																						
												if($update_user)
												{
													header("Location: users.php?action=edit&user_id=$user_id ");
												}
											
											}
											
										}
										else
										{
											 $msg = "<div class='alert alert-danger' role='alert'>  error durring uploading image </div>";       
										}
									
									}                                                               
									else                                                                                                              
									{
										 $msg = "<div class='alert alert-danger' role='alert'> Max image size 4Mb </div>";       
									}
								}
								else
								{
									 $msg = "<div class='alert alert-danger' role='alert'>  Sorry, error durring upload image! </div>";    
								}
							}
							else
							{
								 $msg = "<div class='alert alert-danger' role='alert'>  Please choose a correct image </div>";    
							}    
					}
					
					else  // if the image isnt set.. (Image Empty)
					{                                    
						// if the password has been changed too ..
						if(!empty($_POST['user_password']))
						{
							//$msg = "<div class='alert alert-danger' role='alert'> please insert password </div>";
							
							if(empty($_POST['user_re_password']))
							{
								$msg = "<div class='alert alert-danger' role='alert'> please re-type password </div>";
							}
					   
							elseif($_POST['user_password'] != $_POST['user_re_password'])
							{
								$msg = "<div class='alert alert-danger' role='alert'> Password does not match </div>";
							}
							
							else
							{
								# --- Start updating the data.. ( With Password)
													
								$userPass = md5($_POST['user_password']);
								
								$query = "UPDATE users SET `user_name` = '$userName', `user_fname` = '$userFname', `user_lname` = '$userLname', `user_email` = '$userEmail', `user_status` = '$userStatus', `user_password` = '$userPass', `user_role` = '$userRole' WHERE user_id = '$userId' ";
								$update_user = mysqli_query($db_connect, $query) or die("Mysql Error".mysqli_error($db_connect));
							
								if($update_user)
								{
									header("Location: users.php");
								}
							
							}
						
						}
				   
	
						else
						{
							# --- Start updating the data.. ( Without Password)
							
							$query = "UPDATE users SET `user_name` = '$userName', `user_fname` = '$userFname', `user_lname` = '$userLname', `user_email` = '$userEmail', `user_status` = '$userStatus', `user_role` = '$userRole' WHERE user_id = {$userId}";
							$update_user = mysqli_query($db_connect, $query) or die("Mysql Error".mysqli_error($db_connect));	
																	
							if($update_user)
							{
								header("Location: users.php?action=edit&user_id=$user_id ");
							}
						
						}
										   
					}
				}	
            }
				
				
		}  //------------------------------      
	
?>
	<!-- EDITE User Form ------------------------------------->
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
				<a href="#">Edit User</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
				<div class="col-md-12">
					<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Edite User</h4>
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
										<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-12">
																<!--
																<div class="col-md-6 mb-5">
																	<label class="col-md-3 col-form-label"> </label>
																	<img src="<?php echo ($user_avatar == '' ? '../assets/img/no-avatar.png' : '../'.$user_avatar ); ?>" alt="..." class="img-thumbnail avatar-img">
																</div>
																-->
												
																<div class="form-group form-inline mb-5 imgUploadBg">
																	<!--  <label for="p_image" class="col-md-2 control-label"> Image </label>  -->
																	<!--<label class="col-md-3 col-form-label"> </label> -->
																	<img src="<?php echo ($user_avatar == '' ? '../assets/img/no-avatar.png' : '../'.$user_avatar ); ?>" alt="..." class="img-thumbnail height-160">
																	<div class="col-md-5 float-right mt-5">
																		<input type="file" id="p_image" name="p_image">
																	</div>
																</div>
																
																<div class="form-group">
																	<label class="col-md-3 col-form-label"> Username</label>
																	<input type="text" name="user_name" id="user_name" class="form-control input-full" value="<?php echo $user_name; ?>" placeholder="Enter Username"> 
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Firstname</label>
																	<input type="text" name="user_fname" id="user_fname" class="form-control" value="<?php echo $user_fname; ?>" placeholder="Enter Firstname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group"> 
																	<label>Lastname</label>
																	<input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php echo $user_lname; ?>" placeholder="Enter lastname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $user_email; ?>" placeholder="User email">
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
																	<option value="sup-admin" <?php if($user_role == 'sup-admin'){echo 'selected';}?> >Super Admin</option>
																	<?php endif; ?>
																		<option value="admin" <?php if($user_role == 'admin'){echo 'selected';}?> >Admin</option>
																		<!--<option value="employee" <?php if($user_role == 'employee'){echo 'selected';} ?> >Employee</option>-->
																		<option value="poster" <?php if($user_role == 'poster'){echo 'selected';} ?> >Poster</option>  
																		<option value="user" <?php if($user_role == 'user'){echo 'selected';} ?> >User</option>
																	</select>
																</div>
															</div>
															
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Status</label>
																	<select name="user_status" class="form-control" id="user_status">
																		<option value="enabled" <?php if($user_status == 'enabled'){echo 'selected';}?> >Enabled</option>
																		<option value="disabled" <?php if($user_status == 'disabled'){echo 'selected';}?> >Disabled</option>
																	</select>
																</div>
															</div>
											</div>
													<div class="modal-footer no-bd">
													<button type="submit" name="edit-user" id="submit-user" class="btn btn-outline-info w-25"> <i class="icon-refresh"></i> Update</button>
											</div>
										</form>
									</div>		
								</div>
							</div>
					</div>
			</div>
			
		</div>
		</div>
		
<?php		
	}
    // ----- End Updating user--------   

	
	
	else 	// if No $_GET request has been sent 
	{
		# -- Display All Users -------------------------------------------------------------------
		
		// hide the sup-admin users if the current logged-In user isn't a Super Admin 
		if($_SESSION['u_role'] !== 'sup-admin')
		{
			$all_users_per_pg_query = mysqli_query($db_connect, "SELECT * FROM users WHERE user_role != 'sup-admin' ORDER BY user_id DESC LIMIT $start_from , $per_page");
			$all_users_query = mysqli_query($db_connect, "SELECT * FROM users WHERE user_role != 'sup-admin' ORDER BY user_id DESC");
	        $count_all_users = mysqli_num_rows($all_users_query);
		}
		else
		{
			$all_users_per_pg_query = mysqli_query($db_connect, "SELECT * FROM users ORDER BY user_id DESC LIMIT $start_from , $per_page");
			$all_users_query = mysqli_query($db_connect, "SELECT * FROM users ORDER BY user_id DESC");
			$count_all_users = mysqli_num_rows($all_users_query);
		}
?>

	<div class="main-panel">
	    <div class="content">
		<div class="page-inner">
		    <div class="page-header">
			<h4 class="page-title">Users Listing</h4>
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
				<a href="#">All users</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
				<div class="col-md-12">
					<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Display All Users</h4>
								<!--		<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											New User
										</button>  -->
										
										<a href="new-user.php" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i> 
											New User
										</a>
									</div>
								</div>
								<div class="card-body">
									<!-- Modal -->
									<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														New</span> 
														<span class="fw-light">
															User
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
											
												<div class="modal-body">
													<p class="small">Create a new User using this form, make sure you fill them all</p>
													<form action="" method="post">
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-md-3 col-form-label"> Username</label>
																	<input type="text" name="user_name" id="user_name" class="form-control input-full" placeholder="Enter Username"> 
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Firstname</label>
																	<input type="text" name="user_fname" id="user_fname" class="form-control" placeholder="Enter Firstname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Lastname</label>
																	<input type="text" name="user_lname" id="user_lname" class="form-control" placeholder="Enter lastname">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" name="user_email" id="user_email" class="form-control" placeholder="User email">
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
																		<option value="admin">Admin</option>
																		<option value="poster">Poster</option>
																		<option value="user">User</option>
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
													<button type="submit" name="creat-user" id="addRowButton" class="btn btn-primary">Add</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
													</form>
												</div>
												
											</div>
										</div>
									</div>

								<!-------  Displaying Users in Table	 ------------------------------------------------------>
											<?php
												echo $msg_sucs;
												echo $msg;
											?>
												
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Image</th>
													<th>Name</th>
													<th>Email</th>
													<th>Status</th>
													<th>Role</th>
													<th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Image</th>
													<th>Name</th>
													<th>Email</th>
													<th>Status</th>
													<th>Role</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>

									<?php            
											# --- Display all users 
											while($row = mysqli_fetch_assoc($all_users_per_pg_query))
											{
												$user_id = $row['user_id'];
												$user_avatar = $row['user_avatar'];
												$user_name = $row['user_name'];
												$user_fname = $row['user_fname'];
												$user_lname = $row['user_lname'];
												$user_email = $row['user_email'];
												$user_status = $row['user_status'];
												$user_role = $row['user_role'];
												
												$user_no_image = 'assets/img/no-avatar.png';
									?>  
												<tr>
													<td> <img src="../<?php echo ($user_avatar == '' ? $user_no_image : $user_avatar); ?>" alt="<?php echo $user_name; ?>" class="img-thumbnail sml-img rounded-circle">   </td>
													<td><?php echo $user_fname.' '.$user_lname; ?></td>
													<td><?php echo $user_email; ?></td>
													<td><?php echo $user_status; ?></td>
													<td><?php echo $user_role; ?></td>
													<td>
														<div class="form-button-action">
															<a href="?action=edit&user_id=<?php echo $user_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit this User">
																<i class="fa fa-edit"></i>
															</a>
															<a href="?action=delete&user_id=<?php echo $user_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
																<i class="fa fa-times"></i>
															</a>
														</div>
													</td>
												</tr>
												
									<?php
											}
									?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
					
				<?php
                    
                        # -- Pagination : Part 2 ----------
                        
						if($_SESSION['u_role'] !== 'sup-admin')
						{
							$page_sql = mysqli_query($db_connect, "SELECT * FROM users WHERE user_role != 'sup-admin'");
						}
						else
						{
							$page_sql = mysqli_query($db_connect, "SELECT * FROM users");
						}
                        
						$count_pages = mysqli_num_rows($page_sql);
                        
                        $total_page = ceil( $count_pages / $per_page );     // ceil(3,4)  => 3     ceil(3,7)  => 4
                       
                ?>
				
				</div>
				
			</div>
			
			<!-- Display Pagination ---------------->
			<div class="row">
				<div class="col-sm-12 col-md-5">
					<div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 10 of <?php echo $count_all_users; ?> entries</div>
				</div>
				<div class="col-sm-12 col-md-7">
					<div class="dataTables_paginate paging_simple_numbers" id="basic-datatables_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous disabled" id="basic-datatables_previous"><a href="#" aria-controls="basic-datatables" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
						<?php
							for($i = 1; $i <= $total_page; $i++)
							{
								echo '<li '.($page == $i ? 'class="page-item active"' : 'class="page-item"').' > <a class="page-link" href="users.php?page='.$i.'"> '.$i.' '.($page == $i ? '<span class="sr-only">(current)</span>' : '').'</a> </li>';
							}
							
							# ------------------------------------------------                
						?>
							
							<li class="paginate_button page-item next" id="basic-datatables_next">
								<?php $next = $i - 1; ?>
								<a href="<?php echo "users.php?page=".$next ?>" aria-controls="basic-datatables" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
							</li>
						</ul>
					</div>
				</div>
			</div><!------>
			
			
		</div>
	    </div>

<?php
	// End Displaying users
	}
?>
	    
<?php include_once "inc/footer.php"; ?>