<?php
   
    # --- INSERT NEW branche Function ---------------------------------------------------------------------------------------

    function insertBranches(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $branche_title, $branche_content, $branche_title_ar, $branche_content_ar;
        global $branche_link, $branche_status, $branche_icon, $branche_map;

        
        if(isset($_POST['submit']))
        {
            $branche_title = mysqli_real_escape_string($db_connect,strip_tags($_POST['branche_title']));                                    
            $branche_content = mysqli_real_escape_string($db_connect,$_POST['branche_content']);                                    
            $branche_link = mysqli_real_escape_string($db_connect,$_POST['branche_link']);                                    
            $branche_status = mysqli_real_escape_string($db_connect,$_POST['branche_status']);                                    
            $branche_icon = mysqli_real_escape_string($db_connect,$_POST['branche_icon']);                                    
            
            $branche_title_ar = mysqli_real_escape_string($db_connect,$_POST['branche_title_ar']);                                    
            $branche_content_ar = mysqli_real_escape_string($db_connect,$_POST['branche_content_ar']);                                    
            $branche_map = mysqli_real_escape_string($db_connect,$_POST['branche_map']);                                    
        
            
            if($branche_title =='' || empty($branche_title))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Branche Title </div>";
            }
            
            elseif($branche_content =='' || empty($branche_content))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Branche Content </div>";
            }
            
            elseif($branche_title_ar =='' || empty($branche_title_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
            
            elseif($branche_content_ar =='' || empty($branche_content_ar))
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
                        
                        $allowd = array('png', 'gif', 'jpg', 'jpeg','svg');
                        
                        if(in_array($image_ext, $allowd))       // if the extension exist in the array..
                        {
                            if($image_error === 0)      // if we don't get any error..
                            {
                                if($image_size <= $image_max_size)    
                                {
                                    $new_name = uniqid('branche_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/branches/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/branches/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                                        // Start insering the data to DB..
                                        
                                        $query = "INSERT INTO branches (`branche_title`, `branche_content`, `branche_image`, `branche_status`, `branche_title_ar`, `branche_content_ar`, `branche_icon`, `branche_map`) ";
                                        $query .= " VALUES('$branche_title','$branche_content','$image_db','$branche_status', '$branche_title_ar', '$branche_content_ar', '$branche_icon', '$branche_map' ) ";
                                        $insert_branche = mysqli_query($db_connect, $query);
                                        
                                        if($insert_branche)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Branche has been added successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=branches.php" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the branche  <br>'.mysqli_error($db_connect).'</div>';
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
                    //$default_img = "images/branches/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    // Start insering the data to DB..
                    $query = "INSERT INTO branches (`branche_title`, `branche_content`, `branche_status`, `branche_title_ar`, `branche_content_ar`, `branche_icon`, `branche_map`) ";
                    $query .= " VALUES('$branche_title','$branche_content','$branche_status', '$branche_title_ar', '$branche_content_ar', '$branche_icon', '$branche_map' ) ";
                    $insert_branche = mysqli_query($db_connect, $query);
                    
                    if(!$insert_branche)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }

                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Branche has been added successfully  </p>
                                </div>';
                        /*
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Branche has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        echo '<meta http-equiv="refresh" content="3;url=branches.php" />';
                        
                        //header("Location: branches.php");
                    }
                                       
                }
                
            }
         
        }
    
    }



    # --- LISTING All branches Function ----------------------------------------------------------------------------------------

    function getAllBranches(){
        global $db_connect;
        
        $query = "SELECT * FROM branches ORDER BY branche_id DESC";
        $select_branches = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_branches))
        {
            $branche_id = $row['branche_id'];
            $branche_image = $row['branche_image'];
            $branche_title = $row['branche_title'];
            $branche_title_ar = $row['branche_title_ar'];
            $branche_content = $row['branche_content'];
            $branche_content_ar = $row['branche_content_ar'];
            $branche_status = $row['branche_status'];
            $branche_link = $row['branche_link'];
            $branche_icon = $row['branche_icon'];
            $branche_map = $row['branche_map'];
            $num++;
            
            
            
            // Change Branche Status : Published / Draft 
            if(isset($_GET['status']) AND isset($_GET['branche']))        
            {
                $query = mysqli_query($db_connect, "UPDATE branches SET branche_status='$_GET[status]' WHERE branche_id='$_GET[branche]' ");
                
                if($query)
                {
                    header("Location: branches.php");
                }
            }            
                            
        ?>
        
            <tr>
                <td><?php echo $num; ?></td>
                <td><img src="../<?php if($branche_image == ''){ echo 'assets/img/no-image.jpg';} else {echo $branche_image;} ?>" class="img-thumbnail" width="120px"/></td>  
                <!--<td><span class='blck-icn-sm <?php echo $branche_icon; ?>' ></span></td> -->
               <!-- <td> <a href="../branche.php?id=<?php echo $branche_id;?>" target="_blank"> <?php echo $branche_title; ?> </a></td> -->
                <td><?php echo $branche_title; ?></td>
                
                <td>
                    <?php
                            if($branche_status == 'draft')
                            {
                                echo '<a href="branches.php?status=published&branche='.$branche_id.'" class="btn btn-success btn-xs font-weight-bold"> Publish </a>';
                            }
                            else
                            {
                                echo '<a href="branches.php?status=draft&branche='.$branche_id.'" class="btn btn-warning btn-xs font-weight-bold">  Draft </a>';
                            }
                    ?>
                </td>
                
                
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $branche_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this branche">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $branche_id;?>" onClick="return confirm('Are you sure you want to delete this branche?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- DELETE branches Function -----------------------------------------------------------------------------------

    function deleteBranches(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deleteBrancheId = $_GET['delete'];
            $query = "DELETE FROM branches WHERE branche_id = {$deleteBrancheId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                $msg_del_sucs = "<div class='alert alert-success text-center' > branche has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'branches.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: branches.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE branches Function ----------------------------------------------------------------------------------------------------

    function updateBranches(){
        global $db_connect;
        global $upBrancheId;
        global $branche_id, $branche_title, $branche_content, $branche_title_ar, $branche_content_ar, $branche_image, $branche_link, $branche_status, $branche_icon, $branche_map; 
        global $msg;
        global $msg_up_sucs;
        
        # --- get current branche for updating..
        $query = "SELECT * FROM branches WHERE branche_id={$upBrancheId}";
        $select_branche = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_branche); 
    
        $branche_id = $row['branche_id'];
        $branche_image = $row['branche_image'];
        $branche_title = $row['branche_title'];
        $branche_title_ar = $row['branche_title_ar'];
        $branche_content = $row['branche_content'];
        $branche_content_ar = $row['branche_content_ar'];
        $branche_status = $row['branche_status'];
        $branche_link = $row['branche_link'];
        $branche_icon = $row['branche_icon'];
        $branche_map = $row['branche_map'];
                
        
        
          
        # ---- Update branche ...    
        if(isset($_POST['update']))
        {
            
            $brancheTitle = mysqli_real_escape_string($db_connect,strip_tags($_POST['branche_title']));                                    
            $brancheTitle_ar = mysqli_real_escape_string($db_connect,strip_tags($_POST['branche_title_ar']));                                    
            $brancheContent = mysqli_real_escape_string($db_connect,$_POST['branche_content']);                                    
            $brancheContent_ar = mysqli_real_escape_string($db_connect,$_POST['branche_content_ar']);                                    
            $branchestatus = mysqli_real_escape_string($db_connect,$_POST['branche_status']);                                    
            $brancheLink = mysqli_real_escape_string($db_connect,$_POST['branche_link']);
            $brancheIcon = mysqli_real_escape_string($db_connect,$_POST['branche_icon']);
            $brancheMap = mysqli_real_escape_string($db_connect,$_POST['branche_map']);
            
            
            
            
            if($brancheTitle =='' || empty($brancheTitle))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Branche Title </div>";
            }
            
            elseif($brancheContent =='' || empty($brancheContent))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Branche Content </div>";
            }
            
            elseif($brancheTitle_ar =='' || empty($brancheTitle_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Branche Title </div>";
            }
            
            elseif($brancheContent_ar =='' || empty($brancheContent_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Branche Content </div>";
            }
            elseif($brancheMap =='' || empty($brancheMap))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Branche MAP </div>";
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
                        
                        $allowd = array('png', 'gif', 'jpg', 'jpeg','svg');
                        
                        if(in_array($image_ext, $allowd))       // if the extension exist in the array..
                        {
                            if($image_error === 0)      // if we don't get any error..
                            {
                                if($image_size <= $image_max_size)    
                                {
                                    $new_name = uniqid('branche_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/branches/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/branches/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Branche..                        
                                        $query = "UPDATE branches SET `branche_title` = '$brancheTitle', `branche_content` = '$brancheContent', `branche_title_ar` = '$brancheTitle_ar', `branche_content_ar` = '$brancheContent_ar', `branche_link` = '$brancheLink', `branche_status` = '$branchestatus', `branche_icon` = '$brancheIcon', `branche_image` = '$image_db', `branche_map` = '$brancheMap' WHERE branche_id={$upBrancheId}";
                                        $update_query = mysqli_query($db_connect, $query);
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Branche has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=branches.php?edit='.$branche_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the branche  <br>'.mysqli_error($db_connect).'</div>';
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
                    // Start Updating Branche..
                    $query = "UPDATE branches SET `branche_title` = '$brancheTitle', `branche_content` = '$brancheContent', `branche_title_ar` = '$brancheTitle_ar', `branche_content_ar` = '$brancheContent_ar', `branche_link` = '$brancheLink', `branche_status` = '$branchestatus', `branche_icon` = '$brancheIcon', `branche_map` = '$brancheMap'  WHERE branche_id={$upBrancheId}";
                    $update_query = mysqli_query($db_connect, $query);
                
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                       /* $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Branche has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Branche has been updated successfully  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=branches.php?edit='.$branche_id.'" />';
                        
                        //header("Location: branches.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>