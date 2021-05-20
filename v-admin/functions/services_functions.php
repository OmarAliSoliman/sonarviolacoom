<?php
   
    # --- INSERT NEW service Function ---------------------------------------------------------------------------------------

    function insertServices(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $service_title, $service_content, $service_title_ar, $service_content_ar;
        global $service_link, $service_status, $service_icon;

        
        if(isset($_POST['submit']))
        {
            $service_title = mysqli_real_escape_string($db_connect,strip_tags($_POST['srv_title']));                                    
            $service_content = mysqli_real_escape_string($db_connect,$_POST['srv_content']);                                    
                                               
            $service_status = mysqli_real_escape_string($db_connect,$_POST['srv_status']);                                    
            $service_icon = mysqli_real_escape_string($db_connect,$_POST['srv_icon']);                                    
            $service_order = mysqli_real_escape_string($db_connect,$_POST['srv_order']);                                    
            
            $service_title_ar = mysqli_real_escape_string($db_connect,$_POST['srv_title_ar']);                                    
            $service_content_ar = mysqli_real_escape_string($db_connect,$_POST['srv_content_ar']);                                    
        
            
            if($service_title =='' || empty($service_title))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Service Title </div>";
            }
            
            elseif($service_content =='' || empty($service_content))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Service Content </div>";
            }
            
            elseif($service_title_ar =='' || empty($service_title_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
            
            elseif($service_content_ar =='' || empty($service_content_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Content </div>";
            }
            
            else
            {
                //  -------------------  image uploader ------------------------
                
                $image = @$_FILES['p_image'];
                        
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
                                    $new_name = uniqid('srv_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/services/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/services/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                                        // Start insering the data to DB..
                                        
                                        $query = "INSERT INTO services (`srv_title`, `srv_content`, `srv_image`, `srv_status`, `srv_title_ar`, `srv_content_ar`, `srv_icon`, `srv_order`) ";
                                        $query .= " VALUES('$service_title','$service_content','$image_db','$service_status', '$service_title_ar', '$service_content_ar', '$service_icon', '$service_order' ) ";
                                        $insert_service = mysqli_query($db_connect, $query);
                                        
                                        if($insert_service)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Service has been added successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=services.php" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the service  <br>'.mysqli_error($db_connect).'</div>';
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
                    //$default_img = "images/services/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    // Start insering the data to DB..
                    $query = "INSERT INTO services (`srv_title`, `srv_content`, `srv_status`, `srv_title_ar`, `srv_content_ar`, `srv_icon`, `srv_order`) ";
                    $query .= " VALUES('$service_title','$service_content','$service_status', '$service_title_ar', '$service_content_ar', '$service_icon', '$service_order' ) ";
                    $insert_service = mysqli_query($db_connect, $query);
                    
                    if(!$insert_service)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }

                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Service has been added successfully  </p>
                                </div>';
                        /*
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Service has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        echo '<meta http-equiv="refresh" content="3;url=services.php" />';
                        
                        //header("Location: services.php");
                    }
                                       
                }
                
            }
         
        }
    
    }



    # --- LISTING All services Function ----------------------------------------------------------------------------------------

    function getAllServices(){
        global $db_connect;
        
        $query = "SELECT * FROM services ORDER BY srv_order DESC";
        $select_services = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_services))
        {
            $service_id = $row['srv_id'];
            $service_image = $row['srv_image'];
            $service_title = $row['srv_title'];
            $service_title_ar = $row['srv_title_ar'];
            $service_content = $row['srv_content'];
            $service_content_ar = $row['srv_content_ar'];
            $service_status = $row['srv_status'];
            
            $service_icon = $row['srv_icon'];
            $service_order = $row['srv_order'];
            $num++;
            
            
            
            // Change Service Status : Published / Draft 
            if(isset($_GET['status']) AND isset($_GET['service']))        
            {
                $query = mysqli_query($db_connect, "UPDATE services SET srv_status='$_GET[status]' WHERE srv_id='$_GET[service]' ");
                
                if($query)
                {
                    header("Location: services.php");
                }
            }            
                            
        ?>
        
            <tr>
                <!--<td><?php echo $num; ?></td>-->
                <td><?php echo $service_order; ?></td>
                <td><img src="../<?php if($service_image == ''){ echo 'assets/img/no-image.jpg';} else {echo $service_image;} ?>" class="img-thumbnail" width="120px"/></td>  
                <!--<td><span class='blck-icn-sm <?php echo $service_icon; ?>' ></span></td> -->
               <!-- <td> <a href="../service.php?id=<?php echo $service_id;?>" target="_blank"> <?php echo $service_title; ?> </a></td> -->
                <td><?php echo $service_title; ?></td>
                
                <td>
                    <?php
                            if($service_status == 'draft')
                            {
                                echo '<a href="services.php?status=published&service='.$service_id.'" class="btn btn-success btn-xs font-weight-bold"> Publish </a>';
                            }
                            else
                            {
                                echo '<a href="services.php?status=draft&service='.$service_id.'" class="btn btn-warning btn-xs font-weight-bold">  Draft </a>';
                            }
                    ?>
                </td>
                
                
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $service_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this service">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $service_id;?>" onClick="return confirm('Are you sure you want to delete this service?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- DELETE services Function -----------------------------------------------------------------------------------

    function deleteServices(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deleteServiceId = $_GET['delete'];
            
             // ----- UPDATE services Order Step 1 : Fetch data of the current service  we want to delete and for getting "srv_order" value ..
            $sql = mysqli_query($db_connect, "SELECT * FROM `services` WHERE `srv_id` = {$deleteServiceId}");
            $blc = mysqli_fetch_assoc($sql);
            $blc_id = $blc['srv_id'];
            $blc_order = $blc['srv_order'];
            
            
            $query = "DELETE FROM services WHERE srv_id = {$deleteServiceId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                
                // ----- UPDATE Blocks Order Step 2 : Start Updating the block_Order for all blocks > the deleted block order
                $updateBlockOrder = mysqli_query($db_connect, "UPDATE `services` SET srv_order = srv_order - 1 WHERE `srv_order` > {$blc_order} ") or die(myqli_error($db_connect));
                
                
                $msg_del_sucs = "<div class='alert alert-success text-center' > service has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'services.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: services.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE services Function ----------------------------------------------------------------------------------------------------

    function updateServices(){
        global $db_connect;
        global $upServiceId;
        global $service_id, $service_title, $service_content, $service_title_ar, $service_content_ar, $service_image, $service_link, $service_status, $service_icon, $service_order; 
        global $msg;
        global $msg_up_sucs;
        
        # --- get current service for updating..
        $query = "SELECT * FROM services WHERE srv_id={$upServiceId}";
        $select_service = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_service); 
    
        $service_id = $row['srv_id'];
        $service_image = $row['srv_image'];
        $service_title = $row['srv_title'];
        $service_title_ar = $row['srv_title_ar'];
        $service_content = $row['srv_content'];
        $service_content_ar = $row['srv_content_ar'];
        $service_status = $row['srv_status'];
        
        $service_icon = $row['srv_icon'];
        $service_order = $row['srv_order'];
                
        
        
          
        # ---- Update service ...    
        if(isset($_POST['update']))
        {
            
            $serviceTitle = mysqli_real_escape_string($db_connect,strip_tags($_POST['srv_title']));                                    
            $serviceTitle_ar = mysqli_real_escape_string($db_connect,strip_tags($_POST['srv_title_ar']));                                    
            $serviceContent = mysqli_real_escape_string($db_connect,$_POST['srv_content']);                                    
            $serviceContent_ar = mysqli_real_escape_string($db_connect,$_POST['srv_content_ar']);                                    
            $serviceStatus = mysqli_real_escape_string($db_connect,$_POST['srv_status']);                                    
   
            $serviceIcon = mysqli_real_escape_string($db_connect,$_POST['srv_icon']);
            $serviceOrder = mysqli_real_escape_string($db_connect,$_POST['srv_order']);
            
            
            
            
            if($serviceTitle =='' || empty($serviceTitle))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Service Title </div>";
            }
            
            elseif($serviceContent =='' || empty($serviceContent))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Service Content </div>";
            }
            
            elseif($serviceTitle_ar =='' || empty($serviceTitle_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Service Title </div>";
            }
            
            elseif($serviceContent_ar =='' || empty($serviceContent_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Service Content </div>";
            }
            
            else
            {
                //  -------------------  image uploader ------------------------
                
                $image = @$_FILES['p_image'];
                        
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
                                    $new_name = uniqid('srv_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/services/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/services/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Service..                        
                                        $query = "UPDATE services SET `srv_title` = '$serviceTitle', `srv_content` = '$serviceContent', `srv_title_ar` = '$serviceTitle_ar', `srv_content_ar` = '$serviceContent_ar', `srv_status` = '$serviceStatus', `srv_icon` = '$serviceIcon', `srv_image` = '$image_db'  WHERE srv_id={$upServiceId}";
                                        $update_query = mysqli_query($db_connect, $query);
                
                
                                        # --- Apply ONLY if Order changed : if order has been changed start Update Order queries..
                                        if($serviceOrder !== $service_order) :
                                        
                                        # ---------------------------------------------------------------------------
                                        #  UPDATE Order queries ..
                                        # ---------------------------------------------------------------------------
                                       
                                        # Step 1 : Get current block order to update existing_order with it  => already saved in ' $block_order '
                                        
                                        # Step 2 : Get the existing_order Block => already has this new selected order to exchange with it .. (selected order : $blockOrder = $_POST['ab_order'])
                                        
                                        $existing_order_block_query = mysqli_query($db_connect, "SELECT * FROM services WHERE srv_order={$serviceOrder}");
                                        $existing_order_block = mysqli_fetch_assoc($existing_order_block_query);
                                        $existing_order_block_id = $existing_order_block['srv_id'];
                                        
                                        # Step 3 : Update existing_order with the order of this current block
                                        $update_existing_order = mysqli_query($db_connect, "UPDATE services SET `srv_order` = '$service_order'  WHERE srv_id={$existing_order_block_id}");
                                    
                                        # Step 4 : Update the current block order with the new passed via $_POST .. ($blockOrder)
                                        $update_current_order = mysqli_query($db_connect, "UPDATE services SET `srv_order` = '$serviceOrder'  WHERE srv_id={$upServiceId}"); 
                                        
                                        # ------------------------------------------------------------------------------------------------------------
                                        
                                        endif;
                                        
                                        
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Service has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=services.php?edit='.$service_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the service  <br>'.mysqli_error($db_connect).'</div>';
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
                    // Start Updating Service..
                    $query = "UPDATE services SET `srv_title` = '$serviceTitle', `srv_content` = '$serviceContent', `srv_title_ar` = '$serviceTitle_ar', `srv_content_ar` = '$serviceContent_ar',`srv_status` = '$serviceStatus', `srv_icon` = '$serviceIcon'  WHERE srv_id={$upServiceId}";
                    $update_query = mysqli_query($db_connect, $query);
                                        
                                        # --- Apply ONLY if Order changed : if order has been changed start Update Order queries..
                                        if($serviceOrder !== $service_order) :
                                        
                                        # ---------------------------------------------------------------------------
                                        #  UPDATE Order queries ..
                                        # ---------------------------------------------------------------------------
                                       
                                        # Step 1 : Get current block order to update existing_order with it  => already saved in ' $block_order '
                                        
                                        # Step 2 : Get the existing_order Block => already has this new selected order to exchange with it .. (selected order : $blockOrder = $_POST['ab_order'])
                                        
                                        $existing_order_block_query = mysqli_query($db_connect, "SELECT * FROM services WHERE srv_order={$serviceOrder}");
                                        $existing_order_block = mysqli_fetch_assoc($existing_order_block_query);
                                        $existing_order_block_id = $existing_order_block['srv_id'];
                                        
                                        # Step 3 : Update existing_order with the order of this current block
                                        $update_existing_order = mysqli_query($db_connect, "UPDATE services SET `srv_order` = '$service_order'  WHERE srv_id={$existing_order_block_id}");
                                    
                                        # Step 4 : Update the current block order with the new passed via $_POST .. ($blockOrder)
                                        $update_current_order = mysqli_query($db_connect, "UPDATE services SET `srv_order` = '$serviceOrder'  WHERE srv_id={$upServiceId}"); 
                                        
                                        # ------------------------------------------------------------------------------------------------------------
                                        
                                        endif;
                                        
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                       /* $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Service has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Service has been updated successfully  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=services.php?edit='.$service_id.'" />';
                        
                        //header("Location: services.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>