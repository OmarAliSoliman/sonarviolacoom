<?php
   
    # --- INSERT NEW Media Function ---------------------------------------------------------------------------------------

    function insertMedia(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        global $media_title, $media_content, $media_title_ar, $media_content_ar;
        global $media_link, $media_status, $media_icon;
        
        
        // Assigned Media Type (AMT) (change the table fields name depending of the query_string)
        
        if($_SERVER['QUERY_STRING'] == 'new-media')     // in Services case
        {
            $amt_id = 'services_srv_id';
        }
        elseif ($_SERVER['QUERY_STRING'] == 'new-tour-media')   // in Tours case
        {
            $amt_id = 'tours_tour_id';
        }
        
        
        if(isset($_POST['submit']))
        {
            $assigned_item = mysqli_real_escape_string($db_connect,$_POST['assigned_item']);                                                  
        
            
            
                //  -------------------  image uploader ------------------------
                
                $image = @$_FILES['p_image'];
                        
                $image_name = $image['name'];       // ==>    $image_name = $_FILES['p_name']['name'];
                $image_tmp = $image['tmp_name'];
                $image_size = $image['size'];
                $image_error = $image['error'];
                
                 # --- for MULTIPLE Upload we need to add a for loop..  and we add '[$i]' for specifying element                      
              for($i = 0; $i < count($image_tmp); $i++)
              {                     
                  if( $image_name[$i] !='') // if the image isn't empty..
                  {
                                                                      // explode => removing everything till it arrive to '.' then stop..
                          $image_ext[$i] = explode('.', $image_name[$i]);     // getting the extension from the full name  ex:  image1.png => png
                          
                          $image_ext[$i] = strtolower(end($image_ext[$i]));   // converting the result extension to lowercase  ex: PNG => png
                          
                          $image_max_size = 4194304; //  4Mb = 4 * 1024 * 1024 Kb
                          
                          //  checking if the extension is in our allowed list ..
                          
                          $allowd = array('png', 'gif', 'jpg', 'jpeg');
                          
                          if(in_array($image_ext[$i], $allowd))       // if the extension exist in the array..
                          {
                              if($image_error[$i] === 0)      // if we don't get any error..
                              {
                                if($image_size[$i] <= $image_max_size)   
                                {
                                    $new_name[$i] = uniqid('m_', false) . '.' . $image_ext[$i];    // uniqid(prefix,more_entropy)
                                                                                                  // more_entropy: specifies more entropy 
                                                                                                  // at the end of the return value    
                                      $image_dir[$i] = '../assets/img/media/'.$new_name[$i];     // we use ../  because 'registor.php' is inside 'includes/'
                                      
                                      $image_db[$i] = 'assets/img/media/'.$new_name[$i];         // the stable location of image after is uploaded..
                                     
                                          if(move_uploaded_file($image_tmp[$i], $image_dir[$i]))  // if the image is uploaded succefully..
                                          {
                                             // Start insering the data to DB..
                                        
                                            # m_assigned_for : hidden field ( services, tours ..)
                                            $assigned_for = $_POST['assigned-for'];
                                            
                                            $query = "INSERT INTO media (`m_url`) ";
                                            $query .= " VALUES('$image_db[$i]') ";
                                            $insert_media = mysqli_query($db_connect, $query);
                                            
                                            if($insert_media)
                                            {
                                                $msg = '<div class="alert alert-success" role="alert">  Media has been added successfully! </div>';
                                                echo '<meta http-equiv="refresh" content="2;url=media.php" />';
                                            }
                                            else
                                            {
                                                $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the media  <br>'.mysqli_error($db_connect).'</div>';
                                            }
      
                                          }
                                          else
                                          {
                                               $msg = "<div class='alert alert-danger' role='alert'> Error durring uploading image </div>";       
                                          }
                                }
                            }
                            else
                            {
                                 $msg = "<div class='alert alert-danger' role='alert'>  Sorry, error durring upload media! </div>";    
                            }
                        }
                        else
                        {
                             $msg = "<div class='alert alert-danger' role='alert'>  Please choose a correct media </div>";    
                        }    
                }
                
                else  // if the image isnt set.. 
                {
                   
                    $msg = "<div class='alert alert-danger' role='alert'>  You have forgotten uploading media(s) </div>";       

                    //$default_img = "images/media/no-image.jpg";       // default NO-Image if the user didn't insert the image..
                                    
                    #-- Start insering the data to DB..
                    //$query = "INSERT INTO medias (`m_title`, `m_content`, `m_status`, `m_title_ar`, `m_content_ar`, `m_icon`) ";
                    //$query .= " VALUES('$media_title','$media_content','$media_status', '$media_title_ar', '$media_content_ar', '$media_icon' ) ";
                    //$insert_media = mysqli_query($db_connect, $query);

                    /*
                    if(!$insert_media)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }

                    else
                    {
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Media has been added successfully  </p>
                                </div>';
                        
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Media has been added successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="3;url=media.php" />';
                        
                        //header("Location: media.php");
                    }
                    
                    */
                                       
                }
                }// end For Loop..
                
             
         
        }
    
    }



    # --- LISTING All Medias Function (for : Services, Tours) ----------------------------------------------------------------------------------------

    function getAllMedia(){
        global $db_connect;
        
        // ---- get media by associated service
        if(isset($_POST['media-filter']))
        {
            $associatedTour = $_POST['m_tour_id'];
            $query = "SELECT * FROM media WHERE tours_tour_id = '$associatedTour' ORDER BY m_id DESC";
        }
        elseif(isset($_POST['media-reset']))
        {
            $query = "SELECT * FROM media ORDER BY m_id DESC";
        }
        
        else
        {
            $query = "SELECT * FROM media ORDER BY m_id DESC";
        }
        
        
        $select_medias = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_medias))
        {
            $media_id = $row['m_id'];
            $media_url = $row['m_url'];
            $media_service_id = $row['services_srv_id'];
            $media_tour_id = $row['tours_tour_id'];
            $media_assigned_for = $row['m_assigned_for'];
            
            
            # ----- Change Query depending of the assigned_for type..
            
            //$media_assigned_for = "All";

            switch ($media_assigned_for) {
                
                case "services":
                    $table_name = 'services';
                    $item_id = 'srv_id';
                    $item_title = 'srv_title';
                    $media_id = $media_service_id;
                    break;
                
                case "tours":
                    $table_name = 'tours';
                    $item_id = 'tour_id';
                    $item_title = 'tour_title';
                    $media_id = $media_tour_id;
                    break;
                
                //default:
                //    $table_name = Null;
                //    $item_id = Null;
                //    $item_title = Null;
            }
            
            
            # --- Dynamic Query --------------------
            $getItemById_query = mysqli_query($db_connect, "SELECT * FROM $table_name WHERE $item_id = $media_id");
            $getItemById = mysqli_fetch_assoc($getItemById_query);
            
            $item_name = $getItemById[$item_title];            
        ?>
        
            <div class="col-md-3 float-left mb-3">
                

                <img src="../<?php if($media_url == ''){ echo 'assets/img/no-image.jpg';} else {echo $media_url;} ?>" class="img-thumbnail media-thumbnail"/> 
                <p class="text-center pl-1 m-0"><?php echo $item_name; ?></p>
                <p class="text-center success">( <b> <?php echo $table_name; ?> </b> )</p>
                
                
                <div class="form-button-action thumbnail-button-action">
                    <!--<a href="?edit=<?php echo $media_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a> -->
                    
                    <a href="#" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="?delete=<?php echo $media_id;?>" onClick="return confirm('Are you sure you want to delete this media?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

        <?php
        
        }
    }
    
    
     # --- LISTING Services Medias Function (for Services) ----------------------------------------------------------------------------------------

    function getServicesMedia(){
        global $db_connect;
        
        # ---- Get media by associated service ------------
        if(isset($_POST['media-filter']))
        {
            $associatedService = $_POST['m_service_id'];
            $query = "SELECT * FROM media WHERE services_srv_id = '$associatedService' ORDER BY m_id DESC";
        }
        elseif(isset($_POST['media-reset']))
        {
            $query = "SELECT * FROM media WHERE m_assigned_for = 'services' ORDER BY m_id DESC";
        }
        
        else
        {
            $query = "SELECT * FROM media WHERE m_assigned_for = 'services' ORDER BY m_id DESC";
        }
        
        
        $select_medias = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_medias))
        {
            $media_id = $row['m_id'];
            $media_url = $row['m_url'];
            $media_service_id = $row['services_srv_id'];
            
            # --- Tours Media Query --------------------
            $getItemById_query = mysqli_query($db_connect, "SELECT * FROM services WHERE srv_id = $media_service_id");
            $getItemById = mysqli_fetch_assoc($getItemById_query);
            
            $item_name = $getItemById['srv_title'];            
        ?>
        
            <div class="col-md-3 float-left mb-3">
                

                <img src="../<?php if($media_url == ''){ echo 'assets/img/no-image.jpg';} else {echo $media_url;} ?>" class="img-thumbnail media-thumbnail"/> 
                <p class="text-center pl-1 m-0"><?php echo $item_name; ?></p>
                <!--<p class="text-center success">( <b> <?php echo $table_name; ?> </b> )</p> -->
                
                
                <div class="form-button-action thumbnail-button-action">
                    <!--<a href="?edit=<?php echo $media_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a> -->
                    
                    <a href="#" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="?delete=<?php echo $media_id;?>" onClick="return confirm('Are you sure you want to delete this media?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

        <?php
        
        }
    }
    
    
     
     # --- LISTING Tours Medias Function (for Tours) ----------------------------------------------------------------------------------------

    function getToursMedia(){
        global $db_connect;
        
        # ---- Get media by associated service ------------
        if(isset($_POST['media-filter']))
        {
            $associatedTour = $_POST['m_tour_id'];
            $query = "SELECT * FROM media WHERE tours_tour_id = '$associatedTour' ORDER BY m_id DESC";
        }
        elseif(isset($_POST['media-reset']))
        {
            $query = "SELECT * FROM media WHERE m_assigned_for = 'tours' ORDER BY m_id DESC";
        }
        
        else
        {
            $query = "SELECT * FROM media WHERE m_assigned_for = 'tours' ORDER BY m_id DESC";
        }
        
        
        $select_medias = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_medias))
        {
            $media_id = $row['m_id'];
            $media_url = $row['m_url'];
            $media_tour_id = $row['tours_tour_id'];
            
            # --- Tours Media Query --------------------
            $getItemById_query = mysqli_query($db_connect, "SELECT * FROM tours WHERE tour_id = $media_tour_id");
            $getItemById = mysqli_fetch_assoc($getItemById_query);
            
            $item_name = $getItemById['tour_title'];            
        ?>
        
            <div class="col-md-3 float-left mb-3">
                

                <img src="../<?php if($media_url == ''){ echo 'assets/img/no-image.jpg';} else {echo $media_url;} ?>" class="img-thumbnail media-thumbnail"/> 
                <p class="text-center pl-1 m-0"><?php echo $item_name; ?></p>
                <!--<p class="text-center success">( <b> <?php echo $table_name; ?> </b> )</p> -->
                
                
                <div class="form-button-action thumbnail-button-action">
                    <!--<a href="?edit=<?php echo $media_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a> -->
                    
                    <a href="#" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this media">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="?delete=<?php echo $media_id;?>" onClick="return confirm('Are you sure you want to delete this media?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

        <?php
        
        }
    }
    

    # --- DELETE medias Function -----------------------------------------------------------------------------------

    function deleteMedia(){
        global $db_connect;
        global $msg_del_sucs;
        
            
        if(isset($_GET['delete']))
        {
            $deleteMediaId = $_GET['delete'];
            $query = "DELETE FROM media WHERE m_id = {$deleteMediaId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                # -- delete the file (image) from directory..
                //$sql = mysqli_query($db_connect, "SELECT * FROM media WHERE m_id ={$deleteMediaId} ");
                //$row = mysqli_fetch_assoc($sql);
                //
                //$media_path = $row['m_url'];
                //
                //delete_files($media_path);
                
                $msg_del_sucs = "<div class='alert alert-success text-center' > media has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'media.php\'" />';
                                
                echo $msg_del_sucs;
                
                header("Location: media.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- UPDATE medias Function ----------------------------------------------------------------------------------------------------

    function updateMedia(){
        global $db_connect;
        global $upMediaId;
        global $media_id, $media_title, $media_content, $media_title_ar, $media_content_ar, $media_image, $media_link, $media_status, $media_icon; 
        global $msg;
        global $msg_up_sucs;
        
        # --- get current media for updating..
        $query = "SELECT * FROM medias WHERE m_id={$upMediaId}";
        $select_media = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_media); 
    
        $media_id = $row['m_id'];
        $media_service_id = $row['services_srv_id'];
                
        
        
          
        # ---- Update media ...    
        if(isset($_POST['update']))
        {
            
            
            $mediaUrl = mysqli_real_escape_string($db_connect,$_POST['m_url']);
            $mediaServiceId = mysqli_real_escape_string($db_connect,$_POST['assigned_item']);
            
            
            
            
            if($mediaTitle =='' || empty($mediaTitle))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Media Title </div>";
            }
            
            elseif($mediaContent =='' || empty($mediaContent))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Media Content </div>";
            }
            
            elseif($mediaTitle_ar =='' || empty($mediaTitle_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Media Title </div>";
            }
            
            elseif($mediaContent_ar =='' || empty($mediaContent_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Media Content </div>";
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
                                    $new_name = uniqid('m_', false) . '.' . $image_ext;    // uniqid(prefix,more_entropy)
                                                                                                // more_entropy: specifies more entropy 
                                                                                                // at the end of the return value    
                                    $image_dir = '../assets/img/media/'.$new_name;     // we use ../  because 'registor.php' is inside 'includes/'
                                    
                                    $image_db = 'assets/img/media/'.$new_name;         // the stable location of image after is uploaded..
                                    
                                    if(move_uploaded_file($image_tmp, $image_dir))  // if the image is uploaded succefully..
                                    {
                
                                        // Start Updating Media..                        
                                        $query = "UPDATE medias SET `m_title` = '$mediaTitle', `m_content` = '$mediaContent', `m_title_ar` = '$mediaTitle_ar', `m_content_ar` = '$mediaContent_ar', `m_link` = '$mediaLink', `m_status` = '$mediaStatus', `m_icon` = '$mediaIcon', `m_image` = '$image_db'  WHERE m_id={$upMediaId}";
                                        $update_query = mysqli_query($db_connect, $query);
                
                                        if($update_query)
                                        {
                                            $msg = '<div class="alert alert-success" role="alert">  Media has been updated successfully! </div>';
                                            echo '<meta http-equiv="refresh" content="2;url=media.php?edit='.$media_id.'" />';
                                        }
                                        else
                                        {
                                            $msg = '<div class="alert alert-danger" role="alert">   Error durring adding the media  <br>'.mysqli_error($db_connect).'</div>';
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
                    // Start Updating Media..
                    $query = "UPDATE medias SET `m_title` = '$mediaTitle', `m_content` = '$mediaContent', `m_title_ar` = '$mediaTitle_ar', `m_content_ar` = '$mediaContent_ar', `m_link` = '$mediaLink', `m_status` = '$mediaStatus', `m_icon` = '$mediaIcon'  WHERE m_id={$upMediaId}";
                    $update_query = mysqli_query($db_connect, $query);
                
                    if(!$update_query)
                    {
                        die ("query failed!" . mysqli_error($db_connect));
                    }
                
                    
                    else
                    {
                       /* $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Media has been updated successfully  </p>
                                    <p class="alert alert-info">  Notice! you didn\'t added image, you can add it later  </p>
                                </div>';
                        */
                        $msg = '<div>
                                    <p class="alert alert-success" role="alert">  Media has been updated successfully  </p>
                                </div>';
                        
                        echo '<meta http-equiv="refresh" content="1;url=media.php?edit='.$media_id.'" />';
                        
                        //header("Location: media.php");
                    }
                                       
                }
                
            }
                                 
        }
                                    
    }
   
?>