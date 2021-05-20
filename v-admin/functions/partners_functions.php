<?php
   
    # --- INSERT NEW partner Function ---------------------------------------------------------------------------------------

    function insertPartners(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $partner_name, $partner_content, $partner_name_ar, $partner_content_ar;
        global $partner_link, $partner_status, $partner_icon;

        
        if(isset($_POST['submit']))
        {
            $partner_name = mysqli_real_escape_string($db_connect,strip_tags($_POST['prtn_name']));                                    
            //$partner_content = mysqli_real_escape_string($db_connect,$_POST['prtn_content']);                                    
            $partner_link = mysqli_real_escape_string($db_connect,$_POST['prtn_link']);                                    
            $partner_status = mysqli_real_escape_string($db_connect,$_POST['prtn_status']);                                    
            //$partner_icon = mysqli_real_escape_string($db_connect,$_POST['prtn_icon']);                                    
            
            $partner_name_ar = mysqli_real_escape_string($db_connect,$_POST['prtn_name_ar']);                                    
            //$partner_content_ar = mysqli_real_escape_string($db_connect,$_POST['prtn_content_ar']);                                    
        
            
            if($partner_name =='' || empty($partner_name))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Partner Title </div>";
            }
            
            //elseif($partner_content =='' || empty($partner_content))
            //{
            //    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Partner Content </div>";
            //}
            
            elseif($partner_name_ar =='' || empty($partner_name_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
            
            //elseif($partner_content_ar =='' || empty($partner_content_ar))
            //{
            //    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Content </div>";
            //}
            
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
                                    $new_name = uniqid('prtn_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/partners/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/partners/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                                        // Start insering the data to DB..
                                        
                                        $query = "INSERT INTO partners (`prtn_name`, `prtn_image`, `prtn_status`, `prtn_name_ar`, `prtn_link`) ";
                                        $query .= " VALUES('$partner_name','$image_db','$partner_status', '$partner_name_ar', '$partner_link') ";
                                        $insert_partner = mysqli_query($db_connect, $query);
                                        
                                        if($insert_partner)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Partner has been added successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=partners.php" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the partner  <br>'.mysqli_error($db_connect).'</div>';
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
                    //$default_img = "images/partners/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    // Start insering the data to DB..
                    $query = "INSERT INTO partners (`prtn_name`, `prtn_status`, `prtn_name_ar`, `prtn_link`) ";
                    $query .= " VALUES('$partner_name','$partner_status', '$partner_name_ar', '$partner_link' ) ";
                    $insert_partner = mysqli_query($db_connect, $query);
                    
                    if(!$insert_partner)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }

                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Partner has been added successfully  </p>
                                </div>';
                        /*
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Partner has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        echo '<meta http-equiv="refresh" content="3;url=partners.php" />';
                        
                        //header("Location: partners.php");
                    }
                                       
                }
                
            }
         
        }
    
    }



    # --- LISTING All partners Function ----------------------------------------------------------------------------------------

    function getAllPartners(){
        global $db_connect;
        
        $query = "SELECT * FROM partners ORDER BY prtn_id DESC";
        $select_partners = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_partners))
        {
            $partner_id = $row['prtn_id'];
            $partner_image = $row['prtn_image'];
            $partner_name = $row['prtn_name'];
            $partner_name_ar = $row['prtn_name_ar'];
            //$partner_content = $row['prtn_content'];
            //$partner_content_ar = $row['prtn_content_ar'];
            $partner_status = $row['prtn_status'];
            $partner_link = $row['prtn_link'];
            //$partner_icon = $row['prtn_icon'];
            $num++;
            
            
            
            // Change Partner Status : Published / Draft 
            if(isset($_GET['status']) AND isset($_GET['partner']))        
            {
                $query = mysqli_query($db_connect, "UPDATE partners SET prtn_status='$_GET[status]' WHERE prtn_id='$_GET[partner]' ");
                
                if($query)
                {
                    header("Location: partners.php");
                }
            }            
                            
        ?>
        
            <tr>
                <td><?php echo $num; ?></td>
                <td class="p-1"><img src="../<?php if($partner_image == ''){ echo 'assets/img/no-image.jpg';} else {echo $partner_image;} ?>" class="img-thumbnail" width="120px"/></td>  
                <!--<td><span class='blck-icn-sm <?php echo $partner_icon; ?>' ></span></td>-->
                <td> <a href="<?php echo $partner_link;?>" target="_blank"> <?php echo $partner_name; ?> </a></td>
                
                <td>
                    <?php
                            if($partner_status == 'draft')
                            {
                                echo '<a href="partners.php?status=published&partner='.$partner_id.'" class="btn btn-success btn-xs font-weight-bold"> Publish </a>';
                            }
                            else
                            {
                                echo '<a href="partners.php?status=draft&partner='.$partner_id.'" class="btn btn-warning btn-xs font-weight-bold">  Draft </a>';
                            }
                    ?>
                </td>
                
                
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $partner_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this partner">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $partner_id;?>" onClick="return confirm('Are you sure you want to delete this partner?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- DELETE partners Function -----------------------------------------------------------------------------------

    function deletePartners(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deletePartnerId = $_GET['delete'];
            $query = "DELETE FROM partners WHERE prtn_id = {$deletePartnerId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                $msg_del_sucs = "<div class='alert alert-success text-center' > partner has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'partners.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: partners.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE partners Function ----------------------------------------------------------------------------------------------------

    function updatePartners(){
        global $db_connect;
        global $upPartnerId;
        global $partner_id, $partner_name, $partner_content, $partner_name_ar, $partner_content_ar, $partner_image, $partner_link, $partner_status, $partner_icon; 
        global $msg;
        global $msg_up_sucs;
        
        # --- get current partner for updating..
        $query = "SELECT * FROM partners WHERE prtn_id={$upPartnerId}";
        $select_partner = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_partner); 
    
        $partner_id = $row['prtn_id'];
        $partner_image = $row['prtn_image'];
        $partner_name = $row['prtn_name'];
        $partner_name_ar = $row['prtn_name_ar'];
        //$partner_content = $row['prtn_content'];
        //$partner_content_ar = $row['prtn_content_ar'];
        $partner_status = $row['prtn_status'];
        $partner_link = $row['prtn_link'];
        //$partner_icon = $row['prtn_icon'];
                
        
        
          
        # ---- Update partner ...    
        if(isset($_POST['update']))
        {
            
            $partnerName = mysqli_real_escape_string($db_connect,strip_tags($_POST['prtn_name']));                                    
            $partnerName_ar = mysqli_real_escape_string($db_connect,strip_tags($_POST['prtn_name_ar']));                                    
            //$partnerContent = mysqli_real_escape_string($db_connect,$_POST['prtn_content']);                                    
            //$partnerContent_ar = mysqli_real_escape_string($db_connect,$_POST['prtn_content_ar']);                                    
            $partnerStatus = mysqli_real_escape_string($db_connect,$_POST['prtn_status']);                                    
            $partnerLink = mysqli_real_escape_string($db_connect,$_POST['prtn_link']);
            //$partnerIcon = mysqli_real_escape_string($db_connect,$_POST['prtn_icon']);
            
            
            
            
            if($partnerName =='' || empty($partnerName))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Partner Title </div>";
            }
            
            //elseif($partnerContent =='' || empty($partnerContent))
            //{
            //    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Partner Content </div>";
            //}
            
            elseif($partnerName_ar =='' || empty($partnerName_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Partner Title </div>";
            }
            
            //elseif($partnerContent_ar =='' || empty($partnerContent_ar))
            //{
            //    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Partner Content </div>";
            //}
            
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
                                    $new_name = uniqid('partner_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/partners/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/partners/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Partner..                        
                                        $query = "UPDATE partners SET `prtn_name` = '$partnerName', `prtn_name_ar` = '$partnerName_ar', `prtn_link` = '$partnerLink', `prtn_status` = '$partnerStatus', `prtn_image` = '$image_db'  WHERE prtn_id={$upPartnerId}";
                                        $update_query = mysqli_query($db_connect, $query);
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Partner has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=partners.php?edit='.$partner_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the partner  <br>'.mysqli_error($db_connect).'</div>';
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
                    // Start Updating Partner..
                    $query = "UPDATE partners SET `prtn_name` = '$partnerName', `prtn_name_ar` = '$partnerName_ar', `prtn_link` = '$partnerLink', `prtn_status` = '$partnerStatus'  WHERE prtn_id={$upPartnerId}";
                    $update_query = mysqli_query($db_connect, $query);
                
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                       /* $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Partner has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Partner has been updated successfully  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=partners.php?edit='.$partner_id.'" />';
                        
                        //header("Location: partners.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>