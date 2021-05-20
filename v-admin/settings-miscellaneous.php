<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

	<!--- check if cureent user is supper admin --->
	<?php checkSuperAdmin() ?>


	<!-- End Sidebar -->
<?php

	$msg ='';

    #------------------------------------------------------------------------------------
    # ---- Settings Miscellaneous 
    #--------------------------------------------
    $miscellaneous_query = mysqli_query($db_connect, "SELECT * FROM `settings_miscellaneous` ");
    $miscellaneous = mysqli_fetch_assoc($miscellaneous_query);

    # --- Services ----
    $srvPerRow = $miscellaneous['services_number'];
    $srvHeading = $miscellaneous['services_heading'];
    $srvHeading_ar = $miscellaneous['services_heading_ar'];
    $srvLimit = $miscellaneous['services_limit'];
    $srvEnable = $miscellaneous['enable_services'];

 
    
	    
    # --- Blog ----
    $blogPerRow = $miscellaneous['blog_number'];
    $blogHeading = $miscellaneous['blog_heading'];
    $blogHeading_ar = $miscellaneous['blog_heading_ar'];
    $blogLimit = $miscellaneous['blog_limit'];
    $blogEnable = $miscellaneous['enable_blog'];
	 

    
    //$bootsrap_grid = array(1=>12, 2=>6, 3=>4, 4=>3, 6=>2);
    
    ### ---------------     UPDATE Settings     -------------------- ###
    if(isset($_POST['save_sett']))
    {
		# --- Services 
        $services_number = strip_tags(@$_POST['services_number']);
        $services_heading = strip_tags(@$_POST['services_heading']);
        $services_heading_ar = strip_tags(@$_POST['services_heading_ar']);
        $services_limit = strip_tags(@$_POST['services_limit']);
        $services_enable = strip_tags(@$_POST['services_enable']);

	 
		
		
		# --- Blog 
		$blog_number = strip_tags(@$_POST['blog_number']);
        $blog_heading = strip_tags(@$_POST['blog_heading']);
        $blog_heading_ar = strip_tags(@$_POST['blog_heading_ar']);
        $blog_limit = strip_tags(@$_POST['blog_limit']);
        $blog_enable = strip_tags(@$_POST['blog_enable']);
		
		 
		
      
		
		 
			// Start Updating data.. 
			$updateconfig = mysqli_query($db_connect, "UPDATE settings_miscellaneous SET
									`services_number` = '$services_number',
									`services_heading` = '$services_heading',
									`services_heading_ar` = '$services_heading_ar',
									`services_limit` = '$services_limit',
									`enable_services` = '$services_enable', 
									`blog_number` = '$blog_number',
									`blog_heading` = '$blog_heading',
									`blog_heading_ar` = '$blog_heading_ar',
									`blog_limit` = '$blog_limit',
									`enable_blog` = '$blog_enable'");
									 
			if (isset($updateconfig))
			{
				$msg = '<div class="alert alert-success" role="alert"> update has been successfully. </div>';
				echo '<meta http-equiv="refresh" content="2;url=settings-miscellaneous.php" />';
			}    
			else
			{
				$msg = '<div class="alert alert-danger" role="alert"> error durring saving data <br>'.mysqli_error($db_connect).'</div>';
			}
		 


    }
    
    ### ------------------
	
?>
	<div class="main-panel">
	    <div class="content">
		<div class="page-inner">
		    <div class="page-header">
			<h4 class="page-title">Miscellaneous Settings</h4>
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
				<a href="#">Setup</a>
			    </li>
			    <li class="separator">
				<i class="flaticon-right-arrow"></i>
			    </li>
			    <li class="nav-item">
				<a href="#">Miscellaneous Settings</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
			<div class="col-md-12">
			    <div class="card">
				<div class="card-header">
				    <div class="card-title">Website Settings</div>
				</div>
				
				


				<!---- End TABs ----------------------------------------------------------------------------->
				<div class="card-body">
				   <?php echo $msg; ?>
					<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		
						<!-- Nav tabs -->
						<ul class="nav nav-pills mb-5" role="tablist">
						  <li class=" nav-item">
							<a href="#English" class="nav-link active" role="tab" data-toggle="tab"> English </a>
						  </li>
						  
						  <li class="nav-item">
							<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic Settings</a>
						  </li>
						  
						</ul>
						
						<!-- Tab panes -->
						<div class="tab-content">
							
							<!-------  Tab 1 : General English Fields ------------------------------------------------------->
							<div class="tab-pane fade show active" id="English" role="tabpanel">
								
								<!--------------- Services  ---------------------------------------------------------------------->
								<h1 class="m-3 sett-head"> Services </h1>		  
								<div class="form-group form-inline">
								  <label for="services_number" class="col-md-3 col-form-label"> Service / per Row </label>
								  <div class="col-md-8 p-0">
									<!--<input type="text" class="form-control input-full" name="services_number" id="services_number" value="<?php echo $miscellaneous->services_number; ?>" placeholder="12=>1 |   6=>2 |  4=>3  | 3=>4 |  2=>6">  -->
									<select class="form-control col-md-2 <?php if($srvEnable == 0 ){echo'cursor-not-allowed';}?>" id="services_number" name="services_number" <?php if($srvEnable == 0 ){echo'readonly';}?>>
										<option value="12" <?php if($srvPerRow == 12){echo"selected";}?> > 1 </option>
										<option value="6" <?php if($srvPerRow == 6){echo"selected";}?>> 2 </option>
										<option value="4" <?php if($srvPerRow == 4){echo"selected";}?>> 3 </option>
										<option value="3" <?php if($srvPerRow == 3){echo"selected";}?>> 4 </option>
										<option value="2" <?php if($srvPerRow == 2){echo"selected";}?>> 6 </option>
									</select>
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="services_heading" class="col-md-3 col-form-label"> Services Heading </label>
								  <div class="col-md-8 p-0">
									<textarea name="services_heading" id="services_heading" class="form-control input-full <?php if($srvEnable == 0 ){echo'cursor-not-allowed';}?>" cols="30" rows="2" <?php if($srvEnable == 0 ){echo'readonly';}?> ><?php echo $srvHeading;?></textarea>
								  </div>
								</div>
														
								<div class="form-group form-inline">
								  <label for="services_limit" class="col-md-3 col-form-label"> Services Limit </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full <?php if($srvPerRow == 0 ){echo'cursor-not-allowed';}?>" name="services_limit" id="services_limit" value="<?php echo $srvLimit; ?>" placeholder="Enter Limited number of services" <?php if($srvEnable == 0 ){echo'readonly';}?>  >
								  </div>
								</div>
								
								<div class="form-group form-inline">
									<label for="services_enable" class="col-md-3 col-form-label"> Enable Services </label>
									<div class="col-md-8 p-0">
										<div class="form-check form-check-inline col-md-6 float-left">
											<input class="form-check-input" type="radio" name="services_enable" id="services_enable" value="1" <?php if($srvEnable == 1 ){echo'checked';}?> >
											<label class="form-check-label  <?php if($srvEnable == 1 ){echo'greenColor';}?> " for="services_enable">Enabled</label>
										</div>
										<div class="form-check form-check-inline col-md-6 float-left">
											<input class="form-check-input" type="radio" name="services_enable" id="services_enable" value="0" <?php if($srvEnable == 0 ){echo'checked';}?>>
											<label class="form-check-label <?php if($srvEnable == 0 ){echo'redColor';}?>" for="services_enable">Disabled</label>
										</div>
									</div>
								</div>
								 <!-- separator -------------------------------------------------------------->
								<div class="mt-5"></div> <span class="divider m-auto"></span> <div class="mb-5"></div>
								
								
								
								 
								 <!-- separator -------------------------------------------------------------->
								<div class="mt-5"></div> <span class="divider m-auto"></span> <div class="mb-5"></div>
								
								
								<!--------------- Blog  ---------------------------------------------------------------------->
								<h1 class="m-3 sett-head"> Blog </h1>		  
								<div class="form-group form-inline">
								  <label for="blog_number" class="col-md-3 col-form-label"> Post / per Row </label>
								  <div class="col-md-8 p-0">
									<!--<input type="text" class="form-control input-full" name="blog_number" id="blog_number" value="<?php echo $miscellaneous->blog_number; ?>" placeholder="12=>1 |   6=>2 |  4=>3  | 3=>4 |  2=>6">  -->
									<select class="form-control col-md-2 <?php if($blogEnable == 0 ){echo'cursor-not-allowed';}?>" id="blog_number" name="blog_number" <?php if($blogEnable == 0 ){echo'readonly';}?>>
										<option value="12" <?php if($blogPerRow == 12){echo"selected";}?> > 1 </option>
										<option value="6" <?php if($blogPerRow == 6){echo"selected";}?>> 2 </option>
										<option value="4" <?php if($blogPerRow == 4){echo"selected";}?>> 3 </option>
										<option value="3" <?php if($blogPerRow == 3){echo"selected";}?>> 4 </option>
										<option value="2" <?php if($blogPerRow == 2){echo"selected";}?>> 6 </option>
									</select>
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="blog_heading" class="col-md-3 col-form-label"> blog Heading </label>
								  <div class="col-md-8 p-0">
									<textarea name="blog_heading" id="blog_heading" class="form-control input-full <?php if($blogEnable == 0 ){echo'cursor-not-allowed';}?>" cols="30" rows="2" <?php if($blogEnable == 0 ){echo'readonly';}?> ><?php echo $blogHeading;?></textarea>
								  </div>
								</div>
														
								<div class="form-group form-inline">
								  <label for="blog_limit" class="col-md-3 col-form-label"> blog Limit </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full <?php if($blogPerRow == 0 ){echo'cursor-not-allowed';}?>" name="blog_limit" id="blog_limit" value="<?php echo $blogLimit; ?>" placeholder="Enter Limited number of posts" <?php if($blogEnable == 0 ){echo'readonly';}?>  >
								  </div>
								</div>
																
								<div class="form-group form-inline">
									<label for="blog_enable" class="col-md-3 col-form-label"> Enable blog </label>
									<div class="col-md-8 p-0">
										<div class="form-check form-check-inline col-md-6 float-left">
											<input class="form-check-input" type="radio" name="blog_enable" id="blog_enable" value="1" <?php if($blogEnable == 1 ){echo'checked';}?> >
											<label class="form-check-label  <?php if($blogEnable == 1 ){echo'greenColor';}?> " for="blog_enable">Enabled</label>
										</div>
										<div class="form-check form-check-inline col-md-6 float-left">
											<input class="form-check-input" type="radio" name="blog_enable" id="blog_enable" value="0" <?php if($blogEnable == 0 ){echo'checked';}?>>
											<label class="form-check-label <?php if($blogEnable == 0 ){echo'redColor';}?>" for="blog_enable">Disabled</label>
										</div>
									</div>
								</div>
								  
								
							</div>
							
							
							<!-------  Tab 2 : Aditional Arabic Fields  ------------------------------------------------------->
							<div class="tab-pane fade" id="Arabic" role="tabpanel">
								
								<div class="form-group form-inline">
								  <label for="services_heading_ar" class="col-md-3 col-form-label"> Services Heading (Arabic) </label>
								  <div class="col-md-8 p-0">
									<textarea name="services_heading_ar" id="services_heading_ar" class="form-control input-full rtl <?php if($srvEnable == 0 ){echo'cursor-not-allowed';}?>" cols="30" rows="2" <?php if($srvEnable == 0 ){echo'disabled';}?> ><?php echo $srvHeading_ar;?></textarea>
								  </div>
								</div>
								
								 
								
								 
								
							</div> <!------------------>
							
							<!-------  Save Button -------->
							<div class="form-group form-inline">
							  <div class="col-md-3"></div>
							  <div class="col-sm-offset-2 col-md-8 p-0">
								<button type="submit" name="save_sett" class="btn btn-success">  Save Settings </button>
							  </div>
							</div>
						
						</div> <!--- Tab content --------->
					</form>
							  
					
				 
				</div>
			
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>