<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

 
	
	<!-- End Sidebar -->
<?php

	$msg ='';
/*    
    $blck_name = '';
    $blck_content = '';
    //$blck_image = strip_tags(@$_POST['blck_image']);
    $blck_email = '';
    $blck_address = '';
    $blck_phone = '';
    $blck_keywords = '';
    $blck_status = '';
    $blck_close_msg = '';
    $blck_fb = '';
    $blck_tw = '';
    $blck_ytb = '';
    $blck_instagram = '';
    $blck_copyrights = '';
    */
        
    
    
    //blck_name VARCHAR(255) blck_content TEXT blck_image TEXT blck_link VARCHAR(255) blck_name_ar VARCHAR(25… blck_content_ar TEXT
    
    $selectWelcomeBlock = mysqli_query($db_connect, "SELECT * FROM welcome_block") or die ("Mysql error". mysqli_error($db_connect));
    $fetchWelcomeBlock = mysqli_fetch_object($selectWelcomeBlock);
    
    
    
    ### ---------------     UPDATE Settings     -------------------- ###
    if(isset($_POST['save_sett']))
    {
        
        $blck_name = strip_tags(@$_POST['blck_name']);
        $blck_content = strip_tags(@$_POST['blck_content']);
        //$blck_image = strip_tags(@$_POST['blck_image']);
        $blck_link = strip_tags(@$_POST['blck_link']);
 
	
		# --- Arabic fields
		$blck_name_ar = strip_tags(@$_POST['blck_name_ar']);
        $blck_content_ar = strip_tags(@$_POST['blck_content_ar']);
        
            
            //  ---------------------------------------------  image uploader ------------------------

           $image = $_FILES['blck_image'];
                    
            $image_name = $image['name'];       // ==>    $image_name = $_FILES['blck_image']['name'];
            $image_tmp = $image['tmp_name'];
            $image_size = $image['size'];
            $image_error = $image['error'];
            
            if( $image_name !='') // if the image isn't empty..
            {
                       
                                                                // explode => removing everything till it arrive to '.' then stop..
                    $image_ext = explode('.', $image_name);     // getting the extension from the full name  ex:  image1.png => png
                    
                    $image_ext = strtolower(end($image_ext));   // converting the result extension to lowercase  ex: PNG => png
                    
                    
                    //  checking if the extension is in our allowed list ..
                    
                    $allowd = array('png', 'gif', 'jpg', 'jpeg');
                    
                    if(in_array($image_ext, $allowd))       // if the extension exist in the array..
                    {
                        if($image_error === 0)      // if we don't get any error..
                        {
                            if($image_size <= 2097152)     // 2Mb = 2 * 1024 * 1024 Kb
                            {
                                $new_name = uniqid('logo_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                            // more_entropy: specifies more entropy 
                                                                                            // at the end of the return value    
                                $image_dir = '../assets/img/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                
                                $image_db = 'assets/img/'.$new_name;         // the stable location of image after is uploaded..
                                
                                if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                {
                                    // Start Updating data..
                                     $updateconfig = mysqli_query($db_connect, "UPDATE welcome_block SET
                                                             `blck_name` = '$blck_name',
                                                             `blck_content` = '$blck_content',
                                                             `blck_link` = '$blck_link',
                                                             `blck_image` = '$image_db',
                                                             
															 
															 `blck_name_ar` = '$blck_name_ar',
                                                             `blck_content_ar` = '$blck_content_ar'");
                                    if (isset($updateconfig))
                                    {
                                            $msg = '<div class="alert alert-success" role="alert"> Setting has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=welcome-block.php" />';
                                    }    
                                    else
                                    {
                                        $msg = '<div class="alert alert-danger" role="alert"> Error durring saving data  <br>'.mysqli_error($db_connect).'</div>';
                                    }
                                }
                                else
                                {
                                     $msg = "<div class='alert alert-danger' role='alert'> error durring uploading logo </div>";       
                                }
                            
                            }                                                               
                            else                                                                                                              
                            {
                                 $msg = "<div class='alert alert-danger' role='alert'> logo size should be <= 2Mb </div>";       
                            }
                        }
                        else
                        {
                             $msg = "<div class='alert alert-danger' role='alert'> Sorry! error durring uploading logo </div>";    
                        }
                    }
                    else
                    {
                         $msg = "<div class='alert alert-danger' role='alert'> please choose a right image </div>";    
                    }    
            }            
            
            
            else  // if the image is empty.. 
            {
                                
                // Start Updating data.. (without  blck_image='$image_db')
                $updateconfig = mysqli_query($db_connect, "UPDATE welcome_block SET
                                                             `blck_name` = '$blck_name',
                                                             `blck_content` = '$blck_content',
                                                             `blck_link` = '$blck_link',
                                                             
															 `blck_name_ar` = '$blck_name_ar',
                                                             `blck_content_ar` = '$blck_content_ar'");
                if (isset($updateconfig))
                {
                    $msg = '<div class="alert alert-success" role="alert"> update has been successfully. </div>';
                    echo '<meta http-equiv="refresh" content="2;url=welcome-block.php" />';
                }    
                else
                {
                    $msg = '<div class="alert alert-danger" role="alert"> error durring saving data <br>'.mysqli_error($db_connect).'</div>';
                }
            }  

    }
    
    ### ------------------
	
?>
	<div class="main-panel">
	    <div class="content">
		<div class="page-inner">
		    <div class="page-header">
			<h4 class="page-title">General Settings</h4>
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
				<a href="#">Welcome Block Settings</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
			<div class="col-md-12">
			    <div class="card">
				<div class="card-header">
				    <div class="card-title">Home Welcome Block</div>
				</div>
				
				


				<!---- End TABs ----------------------------------------------------------------------------->
				<div class="card-body">
				   <?php echo $msg; ?>
					<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		
						<!-- Nav tabs -->
						<ul class="nav nav-pills mb-5" role="tablist">
						  <li class="active nav-item">
							<a href="#English" class="nav-link" role="tab" data-toggle="tab"> English </a>
						  </li>
						  
						  <li class="nav-item">
							<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic</a>
						  </li>
						  
						</ul>
						
						<!-- Tab panes -->
						<div class="tab-content">
							
							<!-------  Tab 1 : General English Fields ------------------------------------------------------->
							<div class="tab-pane fade show active" id="English" role="tabpanel">
								
								<div class="form-group form-inline">
								  <label for="blck_image" class="col-md-3 col-form-label">  Block Logo </label>
									<div class="col-md-5 p-0">
										<input type="file" class="form-control input-full" name="blck_image" id="blck_image">
									</div>
								  <div class="col-md-4 float-right"> <img src="../<?php echo $fetchWelcomeBlock->blck_image; ?>" alt="" class="img-thumbnail" style="width: 250px;" ></div>
								</div>
										  
								<div class="form-group form-inline">
								  <label for="blck_name" class="col-md-3 col-form-label"> Block Name </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="blck_name" id="blck_name" value="<?php echo $fetchWelcomeBlock->blck_name; ?>" placeholder="Enter block Name">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="blck_content" class="col-md-3 col-form-label"> block content </label>
								  <div class="col-md-8 p-0">
									  <textarea name="blck_content" class="form-control input-full" id="blck_content" cols="30" rows="10"><?php echo $fetchWelcomeBlock->blck_content; ?></textarea>
								  </div>
								</div>
								  
								<div class="form-group form-inline">
								  <label for="blck_link" class="col-md-3 col-form-label"> Button link </label>
								  <div class="col-sm-4">
									<input type="text" class="form-control input-full" name="blck_link" id="blck_link" value="<?php echo $fetchWelcomeBlock->blck_link; ?>" placeholder="Button Link">
								  </div>
								</div>
								
							</div>
							
							
							<!-------  Tab 2 : Aditional Arabic Fields  ------------------------------------------------------->
							<div class="tab-pane fade" id="Arabic" role="tabpanel">
								
								<div class="form-group form-inline">
								  <label for="blck_name_ar" class="col-md-3 col-form-label"> Block Name (Arabic) </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full rtl" name="blck_name_ar" id="blck_name_ar" value="<?php echo $fetchWelcomeBlock->blck_name_ar; ?>" placeholder="Enter Block Name in Arabic">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="blck_content_ar" class="col-md-3 col-form-label"> Block Content (Arabic) </label>
								  <div class="col-md-8 p-0">
									  <textarea name="blck_content_ar" class="form-control input-full rtl" id="blck_content_ar" cols="30" rows="10"><?php echo $fetchWelcomeBlock->blck_content_ar; ?></textarea>
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