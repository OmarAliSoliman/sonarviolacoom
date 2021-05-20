<?php  include_once "inc/header.php"; ?>  

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

 
	
	<!-- End Sidebar -->
<?php

	$msg ='';
   
    
    ### ---------------     UPDATE Settings     -------------------- ###
    if(isset($_POST['save_sett']))
    {
        
        $site_name = strip_tags($_POST['site_name']);
        $site_description = @$_POST['site_description'];
        //$site_logo = strip_tags(@$_POST['site_logo']);
        $site_email = strip_tags(@$_POST['site_email']);
        $site_address = strip_tags(@$_POST['site_address']);
        $site_phone = strip_tags(@$_POST['site_phone']);
        $site_keywords = strip_tags(@$_POST['site_keywords']);
        $site_status = strip_tags(@$_POST['site_status']);
        $site_close_msg = @$_POST['site_close_msg'];    // allowing HTML tags..
        $site_fb = strip_tags(@$_POST['site_fb']);
        $site_tw = strip_tags(@$_POST['site_tw']);
        $site_ytb = strip_tags(@$_POST['site_ytb']);
        $site_whatsapp = strip_tags(@$_POST['site_whatsapp']);
        $site_snapchat = strip_tags(@$_POST['site_snapchat']);
        $site_instagram = strip_tags(@$_POST['site_instagram']);
        $site_copyrights = @$_POST['site_copyrights'];        // we didn't use strip_tags for allowing html tags in footer copyrights 
        $site_terms = @$_POST['site_terms'];
        $site_map = $_POST['site_map'];


	
		# --- Arabic fields
		$site_name_ar = strip_tags(@$_POST['site_name_ar']);
        $site_description_ar = @$_POST['site_description_ar'];
        $site_address_ar = strip_tags(@$_POST['site_address_ar']);
        $site_keywords_ar = strip_tags(@$_POST['site_keywords_ar']);
        $site_close_msg_ar = @$_POST['site_close_msg_ar'];    // allowing HTML tags..
        $site_copyrights_ar = @$_POST['site_copyrights_ar'];        // we didn't use strip_tags for allowing html tags in footer copyrights 
        $site_terms_ar = @$_POST['site_terms_ar'];

            
            //  ---------------------------------------------  image uploader ------------------------

           $image = $_FILES['site_logo'];
                    
            $image_name = $image['name'];       // ==>    $image_name = $_FILES['site_logo']['name'];
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
                                     $updateconfig = mysqli_query($db_connect, "UPDATE settings SET
                                                             `site_name` = '$site_name',
                                                             `site_description` = '$site_description',
                                                             `site_logo` = '$image_db',
                                                             `site_email` = '$site_email',
                                                             `site_address` = '$site_address',
                                                             `site_phone` = '$site_phone',
                                                             `site_keywords` = '$site_keywords',
                                                             `site_status` = 1,
                                                             `site_close_msg` = '$site_close_msg',
                                                             `site_fb` = '$site_fb',
                                                             `site_tw` = '$site_tw',
                                                             `site_ytb` = '$site_ytb',
                                                             `site_whatsapp` = '$site_whatsapp',
                                                             `site_instagram` = '$site_instagram',
                                                             `site_copyrights` = '$site_copyrights',
                                                             `site_terms` = '$site_terms',
                                                             `site_snapchat` = '$site_snapchat',
                                                             `site_map` = '$site_map',

															 `site_name_ar` = '$site_name_ar',
                                                             `site_description_ar` = '$site_description_ar',
                                                             `site_address_ar` = '$site_address_ar',
                                                             `site_keywords_ar` = '$site_keywords_ar',
                                                             `site_close_msg_ar` = '$site_close_msg_ar',
                                                             `site_copyrights_ar` = '$site_copyrights_ar',
                                                             `site_terms_ar` = '$site_terms_ar'");
                                    if (isset($updateconfig))
                                    {
                                            $msg = '<div class="alert alert-success" role="alert"> Setting has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=settings.php" />';
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
                             
                // Start Updating data.. (without  site_logo='$image_db')
                $updateconfig = mysqli_query($db_connect, "UPDATE settings SET
                                        `site_name` = '$site_name',
                                        `site_description` = '$site_description',
                                        `site_email` = '$site_email',
                                        `site_address` = '$site_address',
                                        `site_phone` = '$site_phone',
                                        `site_keywords` = '$site_keywords',
                                        `site_status` = 1,
                                        `site_close_msg` = '$site_close_msg',
                                        `site_fb` = '$site_fb',
                                        `site_tw` = '$site_tw',
                                        `site_ytb` = '$site_ytb',
                                        `site_whatsapp` = '$site_whatsapp',
                                        `site_instagram` = '$site_instagram',
                                        `site_copyrights` = '$site_copyrights',
                                        `site_terms` = '$site_terms',
                                        `site_snapchat` = '$site_snapchat',
                                        `site_map` = '$site_map',

										`site_name_ar` = '$site_name_ar',
                                        `site_description_ar` = '$site_description_ar',
                                        `site_address_ar` = '$site_address_ar',
                                        `site_keywords_ar` = '$site_keywords_ar',
										`site_close_msg_ar` = '$site_close_msg_ar',
										`site_copyrights_ar` = '$site_copyrights_ar',
                                        `site_terms_ar` = '$site_terms_ar'");
										 
										 
                if (isset($updateconfig))
                {
                    $msg = '<div class="alert alert-success" role="alert"> update has been successfully. </div>';
                    echo '<meta http-equiv="refresh" content="2;url=settings.php" />';
                }    
                else
                {
                    $msg = '<div class="alert alert-danger" role="alert"> error durring saving data <br>'.mysqli_error($db_connect).'</div>';
                }
            }  

    }

	$selectConfig = mysqli_query($db_connect, "SELECT * FROM settings") or die ("Mysql error");
    $fetchConfig = mysqli_fetch_object($selectConfig);
    
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
				<a href="#">General Settings</a>
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
						  <li class="nav-item">
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
								
								<div class="form-group form-inline">
								  <label for="site_logo" class="col-md-3 col-form-label">  Site Logo</label>
									<div class="col-md-5 p-0">
										<input type="file" class="form-control input-full" name="site_logo" id="site_logo">
									</div>
								  <div class="col-md-4 float-right"> <img src="../<?php echo $site_logo; ?>" alt="" class="img-thumbnail" style="width: 250px;" ></div>
								</div>
										  
								<div class="form-group form-inline">
								  <label for="site_name" class="col-md-3 col-form-label"> Site Name </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_name" id="site_name" value="<?php echo $fetchConfig->site_name; ?>" placeholder="Enter Site Name">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="editor" class="col-md-3 col-form-label"> About Website (description)</label>
								  <div class="col-md-8 p-0">
									  <textarea name="site_description" class="form-control input-full" id="editor" cols="30" rows="10"><?php echo $fetchConfig->site_description; ?></textarea>
								  </div>
								</div>
								  
								<div class="form-group form-inline">
								  <label for="site_email" class="col-md-3 col-form-label"> Email </label>
								  <div class="col-md-4 p-0">
									<input type="email" class="form-control input-full" name="site_email" id="site_email" value="<?php echo $fetchConfig->site_email; ?>" placeholder="Email Address">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_address" class="col-md-3 col-form-label"> Company Address </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_address" id="site_address" value="<?php echo $fetchConfig->site_address; ?>" placeholder=" Enter Company Address">
								  </div>
								</div>
						  
								<div class="form-group form-inline">
								  <label for="site_phone" class="col-md-3 col-form-label"> Phone </label>
								  <div class="col-md-4 p-0">
									<input type="text" class="form-control input-full ltr " name="site_phone" id="site_phone" value="<?php echo $fetchConfig->site_phone; ?>" placeholder=" Company Phone ">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_keywords" class="col-md-3 col-form-label"> Keywords </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_keywords" id="site_keywords" class="form-control input-full" cols="30" rows="4"><?php echo $fetchConfig->site_keywords; ?></textarea>
								  </div>
								</div>                  
							
							<!--			  
								<div class="form-group form-inline">
								  <label for="site_status" class="col-md-3 col-form-label">  Site Status</label>
								  <div class="col-sm-4">
									 <input type="radio" name="site_status" id="site_status" value="1" <?php if($fetchConfig->site_status == 1 ){echo 'checked'; } ?> >  Opened &nbsp;&nbsp; 
									 <input type="radio" name="site_status" id="site_status" value="0" <?php if($fetchConfig->site_status == 0 ){echo 'checked'; } ?> > Closed 
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_close_msg" class="col-md-3 col-form-label">  Maintenance message </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_close_msg" id="site_close_msg" class="form-control input-full" cols="30" rows="10"></textarea>
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_terms" class="col-md-3 col-form-label">  Terms & Conditions </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_terms" id="editor3" class="form-control input-full" cols="30" rows="20"><?php echo $fetchConfig->site_terms;?></textarea>
								  </div>
								</div>
						   -->
							
								<!------ MAP -------->
								<div class="form-group form-inline">
								  <label for="site_map" class="col-md-3 col-form-label">  MAP location </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_map" id="site_map" class="form-control input-full" cols="30" rows="10"><?php echo $fetchConfig->site_map;?></textarea>
								  </div>
								</div>
						   
								 <div class="form-group form-inline">
								  <label for="site_fb" class="col-md-2 col-form-label"> <i class="fab fa-facebook-f social-icn"></i>  Facebook </label>  
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_fb" id="site_fb" value="<?php echo $fetchConfig->site_fb; ?>" placeholder=" Facebook Url ">
								  </div>
								</div>
								 
								 <div class="form-group form-inline">
								  <label for="site_tw" class="col-md-2 col-form-label"> <i class="fab fa-twitter social-icn"></i> Twitter </label>
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_tw" id="site_tw" value="<?php echo $fetchConfig->site_tw; ?>" placeholder=" Twitter Url ">
								  </div>
								</div>
								 
								<div class="form-group form-inline">
								  <label for="site_ytb" class="col-md-2 col-form-label"> <i class="fab fa-youtube social-icn"></i> Youtube </label>
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_ytb" id="site_ytb" value="<?php echo $fetchConfig->site_ytb; ?>" placeholder=" Youtube Url ">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_instagram" class="col-md-2 col-form-label"> <i class="fab fa-instagram social-icn"></i> Instagram</label>
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_instagram" id="site_instagram" value="<?php echo $fetchConfig->site_instagram; ?>" placeholder=" Instagram Url ">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_whatsapp" class="col-md-2 col-form-label"> <i class="fab fa-whatsapp social-icn"></i> Whatsapp</label>
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_whatsapp" id="site_whatsapp" value="<?php echo $fetchConfig->site_whatsapp; ?>" placeholder=" Whatsapp N° ">
								  </div>
								</div>
																
								<div class="form-group form-inline">
								  <label for="site_snapchat" class="col-md-2 col-form-label"> <i class="fab fa-snapchat social-icn"></i> Snapchat</label>
								  <div class="col-md-1"></div>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full" name="site_snapchat" id="site_snapchat" value="<?php echo $fetchConfig->site_snapchat; ?>" placeholder=" Snapchat Url ">
								  </div>
								</div>
								 
								 
								<div class="form-group form-inline">
								  <label for="site_copyrights" class="col-md-3 col-form-label"> Website copyrights </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_copyrights" id="site_copyrights" class="form-control input-full" cols="30" rows="4"><?php echo $fetchConfig->site_copyrights;?></textarea>
								  </div>
								</div>
								
							</div>
							
							
							<!-------  Tab 2 : Aditional Arabic Fields  ------------------------------------------------------->
							<div class="tab-pane fade" id="Arabic" role="tabpanel">
								
								<div class="form-group form-inline">
								  <label for="site_name_ar" class="col-md-3 col-form-label"> Site Name (Arabic) </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full rtl" name="site_name_ar" id="site_name_ar" value="<?php echo $fetchConfig->site_name_ar; ?>" placeholder="Enter Site Name in Arabic">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="editor2" class="col-md-3 col-form-label"> Site Description (Arabic) </label>
								  <div class="col-md-8 p-0">
									  <textarea name="site_description_ar" class="form-control input-full rtl" id="editor2" cols="30" rows="10"><?php echo $fetchConfig->site_description_ar;?></textarea>
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_address_ar" class="col-md-3 col-form-label"> Company Address (Arabic) </label>
								  <div class="col-md-8 p-0">
									<input type="text" class="form-control input-full rtl" name="site_address_ar" id="site_address_ar" value="<?php echo $fetchConfig->site_address_ar;?>" placeholder=" Enter Company Address in Arabic ">
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_keywords_ar" class="col-md-3 col-form-label"> Keywords (Arabic) </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_keywords_ar" id="site_keywords_ar" class="form-control input-full rtl" cols="30" rows="4"><?php echo $fetchConfig->site_keywords_ar; ?></textarea>
								  </div>
								</div>                  
										  
								<!--
								<div class="form-group form-inline">
								  <label for="site_close_msg_ar" class="col-md-3 col-form-label">  Maintenance message (Arabic) </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_close_msg_ar" id="site_close_msg_ar" class="form-control input-full rtl" cols="30" rows="10"></textarea>
								  </div>
								</div>
								
								<div class="form-group form-inline">
								  <label for="site_terms_ar" class="col-md-3 col-form-label">  Terms & Conditions (Arabic) </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_terms_ar" id="editor4" class="form-control input-full" cols="30" rows="20"><?php echo $fetchConfig->site_terms_ar;?></textarea>
								  </div>
								</div>
						   -->
								
								<div class="form-group form-inline">
								  <label for="site_copyrights_ar" class="col-md-3 col-form-label"> Website copyrights (Arabic) </label>
								  <div class="col-md-8 p-0">
									<textarea name="site_copyrights_ar" id="site_copyrights_ar" class="form-control input-full rtl" cols="30" rows="4"><?php echo $fetchConfig->site_copyrights_ar;?></textarea>
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