<?php
   
    # --- INSERT NEW slide Function ---------------------------------------------------------------------------------------

    function insertSlider(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $slide_title, $slide_description, $slide_title_ar, $slide_description_ar, $slide_link, $slide_status;
        
        if(isset($_POST['submit']))
        {
            $slide_title = mysqli_real_escape_string($db_connect,strip_tags($_POST['slide_title']));                                    
            $slide_description = mysqli_real_escape_string($db_connect,$_POST['slide_description']);                                    
            $slide_link = mysqli_real_escape_string($db_connect,$_POST['slide_link']);                                    
            $slide_status = mysqli_real_escape_string($db_connect,$_POST['slide_status']);                                    
            
            $slide_title_ar = mysqli_real_escape_string($db_connect,$_POST['slide_title_ar']);                                    
            $slide_description_ar = mysqli_real_escape_string($db_connect,$_POST['slide_description_ar']);                                    
        
            
            if($slide_title =='' || empty($slide_title))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide Title </div>";
            }
            
            elseif($slide_description =='' || empty($slide_description))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide Content </div>";
            }
            
            /*
            elseif($slide_title_ar =='' || empty($slide_title_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
            
            elseif($slide_description_ar =='' || empty($slide_description_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Content </div>";
            }
            */
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
                                    $new_name = uniqid('slide_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/slider/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/slider/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                                        // Start insering the data to DB..
                                        
                                        $query = "INSERT INTO slider (`slide_title`, `slide_description`, `slide_image`, `slide_link`, `slide_status`, `slide_title_ar`, `slide_description_ar`) ";
                                        $query .= " VALUES('$slide_title','$slide_description', '$image_db','$slide_link','$slide_status', '$slide_title_ar', '$slide_description_ar' ) ";
                                        $insert_slide = mysqli_query($db_connect, $query) or die("mysql error". mysqli_error($db_connect));
                                        
                                        if($insert_slide)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Slide has been added successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=slider.php" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the slide  <br>'.mysqli_error($db_connect).'</div>';
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
                
                else  // if the image isnt set.. 
                {
                    //$default_img = "images/slides/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    // Start insering the data to DB..
                    $query = "INSERT INTO slider (`slide_title`, `slide_description`, `slide_link`, `slide_status`, `slide_title_ar`, `slide_description_ar`) ";
                    $query .= " VALUES('$slide_title','$slide_description', '$slide_link','$slide_status', '$slide_title_ar', '$slide_description_ar' ) ";
                    $insert_slide = mysqli_query($db_connect, $query);
                
                    
                    if(!$insert_slide)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                    
                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Slide has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, but you can add it later  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="3;url=slider.php" />';
                        
                        //header("Location: slider.php");
                    }
                                       
                }
                
            }
         
        }
    
    }



    # --- LISTING All slides Function ----------------------------------------------------------------------------------------

    function getAllSlider(){
        global $db_connect;
        
        $query = "SELECT * FROM slider ORDER BY slide_id DESC";
        $select_slides = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_slides))
        {
            $slide_id = $row['slide_id'];
            $slide_image = $row['slide_image'];
            $slide_title = $row['slide_title'];
            @$slide_title_ar = $row['slide_title_ar'];
            $slide_link = $row['slide_link'];
            $slide_status = $row['slide_status'];
            $num++;
            
            
            
            
            // Change Slide Status : Published / Draft 
            if(isset($_GET['status']) AND isset($_GET['slide']))        
            {
                $query = mysqli_query($db_connect, "UPDATE slider SET slide_status='$_GET[status]' WHERE slide_id='$_GET[slide]' ");
                
                if($query)
                {
                    header("Location: slider.php");
                }
            }            
                            
        ?>
        
            <tr <?php if($slide_status == 'draft'){ echo 'class="inactive-slide"'; } ?> >
                <td><?php echo $num; ?></td>
                <td>  <?php echo $slide_title; ?> </td>
                <td><img src="../<?php if($slide_image == ''){ echo 'assets/img/no-image.jpg';} else {echo $slide_image;} ?>" class="img-thumbnail slide-thumb-admin height-120" /></td>
             <!--   <td><?php echo $slide_status; ?></td>  -->
                <td>
                    <?php
                            if($slide_status == 'draft')
                            {
                                echo '<a href="slider.php?status=published&slide='.$slide_id.'" class="btn btn-success btn-xs font-weight-bold"> Publish </a>';
                            }
                            else
                            {
                                echo '<a href="slider.php?status=draft&slide='.$slide_id.'" class="btn btn-warning btn-xs font-weight-bold">  Draft </a>';
                            }
                    ?>
                </td>
                
                
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $slide_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this slide">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $slide_id;?>" onClick="return confirm('Are you sure you want to delete this slide?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- DELETE slides Function -----------------------------------------------------------------------------------

    function deleteSlider(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deleteSlideId = $_GET['delete'];
            $query = "DELETE FROM slider WHERE slide_id = {$deleteSlideId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                $msg_del_sucs = "<div class='alert alert-success text-center' > slide has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'slider.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: slider.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE slides Function ----------------------------------------------------------------------------------------------------

    function updateSlider(){
        global $db_connect;
        global $upSlideId;
        global $slide_id, $slide_title, $slide_description, $slide_title_ar, $slide_description_ar, $slide_image, $slide_status, $slide_link; 
        global $msg, $msg2;
        global $msg_up_sucs;
        
        # --- get current slide for updating..
        $query = "SELECT * FROM slider WHERE slide_id={$upSlideId}";
        $select_slide = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_slide); 
        
        $slide_id = $row['slide_id'];
        $slide_image = $row['slide_image'];
        $slide_title = $row['slide_title'];
        $slide_description = $row['slide_description'];
        $slide_link = $row['slide_link'];
        $slide_status = $row['slide_status'];
        
        $slide_title_ar = $row['slide_title_ar'];
        $slide_description_ar = $row['slide_description_ar'];
        
          
        # ---- Update slide ...    
        if(isset($_POST['update']))
        {
            
            $slideTitle = mysqli_real_escape_string($db_connect,strip_tags($_POST['slide_title']));                                    
            $slideDescription = mysqli_real_escape_string($db_connect,$_POST['slide_description']);                                    
            $slideStatus = mysqli_real_escape_string($db_connect,$_POST['slide_status']);                                    
            $slideLink = mysqli_real_escape_string($db_connect,$_POST['slide_link']);                                    
            $slideTitle_ar = mysqli_real_escape_string($db_connect,$_POST['slide_title_ar']);                                    
            $slideDescription_ar = mysqli_real_escape_string($db_connect,$_POST['slide_description_ar']);                                    
            
            
            
            if($slideTitle =='' || empty($slideTitle))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide Title </div>";
            }
            
            elseif($slideDescription =='' || empty($slideDescription))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide Description </div>";
            }
            
            elseif($slideTitle_ar =='' || empty($slideTitle_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide Title in Arabic </div>";
            }
            
            elseif($slideDescription_ar =='' || empty($slideDescription_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Slide description in Arabic </div>";
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
                                    $new_name = uniqid('slide_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/slider/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/slider/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Slide..                        
                                        $query = "UPDATE slider SET `slide_title` = '$slideTitle', `slide_description` = '$slideDescription', `slide_title_ar` = '$slideTitle_ar', `slide_description_ar` = '$slideDescription_ar', `slide_status` = '$slideStatus', `slide_link` = '$slideLink', `slide_image` = '$image_db'  WHERE slide_id={$upSlideId}";
                                        $update_query = mysqli_query($db_connect, $query);
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Slide has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=slider.php?edit='.$slide_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the slide  <br>'.mysqli_error($db_connect).'</div>';
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
                
                else  // if the image isnt set.. 
                {                                    
                    // Start Updating Slide..
                    $query = "UPDATE slider SET `slide_title` = '$slideTitle', `slide_description` = '$slideDescription', `slide_title_ar` = '$slideTitle_ar', `slide_description_ar` = '$slideDescription_ar', `slide_status` = '$slideStatus', `slide_link` = '$slideLink' WHERE slide_id={$upSlideId}";
                    $update_query = mysqli_query($db_connect, $query);
                    
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Slide has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=slider.php?edit='.$slide_id.'" />';
                        
                        //header("Location: slider.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>