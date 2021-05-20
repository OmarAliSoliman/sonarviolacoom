<?php
   
    # --- INSERT NEW block Function ---------------------------------------------------------------------------------------

    function insertBlocks(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $block_title, $block_content, $block_title_ar, $block_content_ar;
        global  $block_status, $block_icon;

        
        if(isset($_POST['submit']))
        {
            $block_title = mysqli_real_escape_string($db_connect,strip_tags($_POST['ab_title']));                                    
            $block_content = mysqli_real_escape_string($db_connect,$_POST['ab_content']);                                    
                                                
            $block_status = mysqli_real_escape_string($db_connect,$_POST['ab_status']);                                    
            $block_icon = mysqli_real_escape_string($db_connect,$_POST['ab_icon']);                                    
            $block_order = mysqli_real_escape_string($db_connect,$_POST['ab_order']);                                    
            
            $block_title_ar = mysqli_real_escape_string($db_connect,$_POST['ab_title_ar']);                                    
            $block_content_ar = mysqli_real_escape_string($db_connect,$_POST['ab_content_ar']);                                    
        
            
            if($block_title =='' || empty($block_title))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Block Title </div>";
            }
            
            elseif($block_content =='' || empty($block_content))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Block Content </div>";
            }
            
            elseif($block_title_ar =='' || empty($block_title_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
            
            elseif($block_content_ar =='' || empty($block_content_ar))
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
                                    $new_name = uniqid('ab_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/blocks/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/blocks/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                                        // Start insering the data to DB..
                                        
                                        $query = "INSERT INTO blocks (`ab_title`, `ab_content`, `ab_image`, `ab_status`, `ab_title_ar`, `ab_content_ar`, `ab_icon`, `ab_order`) ";
                                        $query .= " VALUES('$block_title','$block_content','$image_db','$block_status', '$block_title_ar', '$block_content_ar', '$block_icon', '$block_order' ) ";
                                        $insert_block = mysqli_query($db_connect, $query);
                                        
                                        if($insert_block)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Block has been added successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=blocks.php" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the block  <br>'.mysqli_error($db_connect).'</div>';
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
                    //$default_img = "images/blocks/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    // Start insering the data to DB..
                    $query = "INSERT INTO blocks (`ab_title`, `ab_content`, `ab_status`, `ab_title_ar`, `ab_content_ar`, `ab_icon`, `ab_order`) ";
                    $query .= " VALUES('$block_title','$block_content','$block_status', '$block_title_ar', '$block_content_ar', '$block_icon', '$block_order' ) ";
                    $insert_block = mysqli_query($db_connect, $query);
                    
                    if(!$insert_block)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }

                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Block has been added successfully  </p>
                                </div>';
                        /*
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Block has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        echo '<meta http-equiv="refresh" content="3;url=blocks.php" />';
                        
                        //header("Location: blocks.php");
                    }
                                       
                }
                
            }
         
        }
    
    }



    # --- LISTING All blocks Function ----------------------------------------------------------------------------------------

    function getAllBlocks(){
        global $db_connect;
        
        $query = "SELECT * FROM blocks ORDER BY ab_order ASC";
        $select_blocks = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_blocks))
        {
            $block_id = $row['ab_id'];
            $block_image = $row['ab_image'];
            $block_title = $row['ab_title'];
            $block_title_ar = $row['ab_title_ar'];
            $block_content = $row['ab_content'];
            $block_content_ar = $row['ab_content_ar'];
            $block_status = $row['ab_status'];
             
            $block_icon = $row['ab_icon'];
            $block_order = $row['ab_order'];
            $num++;
            
            
            
            // Change Block Status : Published / Draft 
            if(isset($_GET['status']) AND isset($_GET['block']))        
            {
                $query = mysqli_query($db_connect, "UPDATE blocks SET ab_status='$_GET[status]' WHERE ab_id='$_GET[block]' ");
                
                if($query)
                {
                    header("Location: blocks.php");
                }
            }            
                            
        ?>
        
            <tr>
                <!--<td><?php echo $num; ?></td>  -->
                <td><?php echo $block_order; ?></td>
               <td><img src="../<?php if($block_image == ''){ echo 'assets/img/no-image.jpg';} else {echo $block_image;} ?>" class="img-thumbnail" width="120px"/></td> 
                
                <td> <?php echo $block_title;?></td>
                
                <td>
                    <?php
                            if($block_status == 'draft')
                            {
                                echo '<a href="blocks.php?status=published&block='.$block_id.'" class="btn btn-success btn-xs font-weight-bold"> Publish </a>';
                            }
                            else
                            {
                                echo '<a href="blocks.php?status=draft&block='.$block_id.'" class="btn btn-warning btn-xs font-weight-bold">  Draft </a>'; 
                                
                            }
                    ?>
                </td>
                
                
				<td class="text-center">
					<div class="form-button-action">
						<a href="?edit=<?php echo $block_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this block">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $block_id;?>" onClick="return confirm('Are you sure you want to delete this block?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
                
			</tr>
        <?php
        
        }
    }
    

    # --- DELETE blocks Function -----------------------------------------------------------------------------------

    function deleteBlocks(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
             $deleteBlockId = $_GET['delete'];
            
            // ----- UPDATE Blocks Order Step 1 : Fetch data of the current block  we want to delete and for getting "ab_order" value ..
            $sql = mysqli_query($db_connect, "SELECT * FROM `blocks` WHERE `ab_id` = {$deleteBlockId}");
            $blc = mysqli_fetch_assoc($sql);
            $blc_id = $blc['ab_id'];
            $blc_order = $blc['ab_order'];
            
            
           
            $query = "DELETE FROM blocks WHERE ab_id = {$deleteBlockId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
               
                // ----- UPDATE Blocks Order Step 2 : Start Updating the block_Order for all blocks > the deleted block order
                $updateBlockOrder = mysqli_query($db_connect, "UPDATE `blocks` SET ab_order = ab_order - 1 WHERE `ab_order` > {$blc_order} ") or die(myqli_error($db_connect));
                
                
                $msg_del_sucs = "<div class='alert alert-success text-center' > block has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'blocks.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: blocks.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE blocks Function ----------------------------------------------------------------------------------------------------

    function updateBlocks(){
        global $db_connect;
        global $upBlockId;
        global $block_id, $block_title, $block_content, $block_title_ar, $block_content_ar, $block_image, $block_status, $block_icon, $block_order; 
        global $msg;
        global $msg_up_sucs;
        
        # --- get current block for updating..
        $query = "SELECT * FROM blocks WHERE ab_id={$upBlockId}";
        $select_block = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_block); 
    
        $block_id = $row['ab_id'];
        $block_image = $row['ab_image'];
        $block_title = $row['ab_title'];
        $block_title_ar = $row['ab_title_ar'];
        $block_content = $row['ab_content'];
        $block_content_ar = $row['ab_content_ar'];
        $block_status = $row['ab_status'];
        
        $block_icon = $row['ab_icon'];
        $block_order = $row['ab_order'];

                
        
        
          
        # ---- Update block ...    
        if(isset($_POST['update']))
        {
            
            $blockTitle = mysqli_real_escape_string($db_connect,strip_tags($_POST['ab_title']));                                    
            $blockTitle_ar = mysqli_real_escape_string($db_connect,strip_tags($_POST['ab_title_ar']));                                    
            $blockContent = mysqli_real_escape_string($db_connect,$_POST['ab_content']);                                    
            $blockContent_ar = mysqli_real_escape_string($db_connect,$_POST['ab_content_ar']);                                    
            $blockStatus = mysqli_real_escape_string($db_connect,$_POST['ab_status']);                                    
            
            $blockIcon = mysqli_real_escape_string($db_connect,$_POST['ab_icon']);
            $blockOrder = mysqli_real_escape_string($db_connect,$_POST['ab_order']);
            
            
            
            
            if($blockTitle =='' || empty($blockTitle))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Block Title </div>";
            }
            
            elseif($blockContent =='' || empty($blockContent))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Block Content </div>";
            }
            
            elseif($blockTitle_ar =='' || empty($blockTitle_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Block Title </div>";
            }
            
            elseif($blockContent_ar =='' || empty($blockContent_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Block Content </div>";
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
                                    $new_name = uniqid('ab_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/blocks/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/blocks/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Block..                        
                                        $query = "UPDATE blocks SET `ab_title` = '$blockTitle',
                                                                    `ab_content` = '$blockContent',
                                                                    `ab_title_ar` = '$blockTitle_ar',
                                                                    `ab_content_ar` = '$blockContent_ar',
                                                                    
                                                                    `ab_status` = '$blockStatus',
                                                                    `ab_icon` = '$blockIcon',
                                                                    `ab_image` = '$image_db'  WHERE ab_id={$upBlockId}";
                                        $update_query = mysqli_query($db_connect, $query);
                                        
                                        
                                        # --- Apply ONLY if Order changed : if order has been changed start Update Order queries..
                                        if($blockOrder !== $block_order) :
                                        
                                        # ---------------------------------------------------------------------------
                                        #  UPDATE Order queries ..
                                        # ---------------------------------------------------------------------------
                                       
                                        # Step 1 : Get current block order to update existing_order with it  => already saved in ' $block_order '
                                        
                                        # Step 2 : Get the existing_order Block => already has this new selected order to exchange with it .. (selected order : $blockOrder = $_POST['ab_order'])
                                        
                                        $existing_order_block_query = mysqli_query($db_connect, "SELECT * FROM blocks WHERE ab_order={$blockOrder}");
                                        $existing_order_block = mysqli_fetch_assoc($existing_order_block_query);
                                        $existing_order_block_id = $existing_order_block['ab_id'];
                                        
                                        # Step 3 : Update existing_order with the order of this current block
                                        $update_existing_order = mysqli_query($db_connect, "UPDATE blocks SET `ab_order` = '$block_order'  WHERE ab_id={$existing_order_block_id}");
                                    
                                        # Step 4 : Update the current block order with the new passed via $_POST .. ($blockOrder)
                                        $update_current_order = mysqli_query($db_connect, "UPDATE blocks SET `ab_order` = '$blockOrder'  WHERE ab_id={$upBlockId}"); 
                                        
                                        # ------------------------------------------------------------------------------------------------------------
                                        
                                        endif;
                                        
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Block has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=blocks.php?edit='.$block_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the block  <br>'.mysqli_error($db_connect).'</div>';
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
                    // Start Updating Block..
                    $query = "UPDATE blocks SET `ab_title` = '$blockTitle',
                                                `ab_content` = '$blockContent',
                                                `ab_title_ar` = '$blockTitle_ar',
                                                `ab_content_ar` = '$blockContent_ar',
                                              
                                                `ab_status` = '$blockStatus',
                                                `ab_icon` = '$blockIcon'  WHERE ab_id={$upBlockId}";
                    $update_query = mysqli_query($db_connect, $query);
                    
                    
                    # --- Apply ONLY if Order changed : if order has been changed start Update Order queries..
                    if($blockOrder !== $block_order) :
                    
                    # ---------------------------------------------------------------------------
                    #  UPDATE Order queries ..
                    # ---------------------------------------------------------------------------
                   
                    # Step 1 : Get current block order to update existing_order with it  => already saved in ' $block_order '
                    
                    # Step 2 : Get the existing_order Block => already has this new selected order to exchange with it .. (selected order : $blockOrder = $_POST['ab_order'])
                    
                    $existing_order_block_query = mysqli_query($db_connect, "SELECT * FROM blocks WHERE ab_order={$blockOrder}");
                    $existing_order_block = mysqli_fetch_assoc($existing_order_block_query);
                    $existing_order_block_id = $existing_order_block['ab_id'];
                    
                    # Step 3 : Update existing_order with the order of this current block
                    $update_existing_order = mysqli_query($db_connect, "UPDATE blocks SET `ab_order` = '$block_order'  WHERE ab_id={$existing_order_block_id}");
                
                    # Step 4 : Update the current block order with the new passed via $_POST .. ($blockOrder)
                    $update_current_order = mysqli_query($db_connect, "UPDATE blocks SET `ab_order` = '$blockOrder'  WHERE ab_id={$upBlockId}"); 
                    
                    # ------------------------------------------------------------------------------------------------------------
                    
                    endif;
                    
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                       /* $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Block has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Block has been updated successfully  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=blocks.php?edit='.$block_id.'" />';
                        
                        //header("Location: blocks.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>