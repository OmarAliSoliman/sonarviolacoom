<?php
   
    # --- insert pages Function ------

    function insertPages(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        
        if(isset($_POST['submit']))
        {
            $pg_name = mysqli_real_escape_string($db_connect,$_POST['page_name']);                                    
            $pg_content = mysqli_real_escape_string($db_connect,$_POST['page_content']);                                    
            $pg_slogan = mysqli_real_escape_string($db_connect,$_POST['page_slogan']);                                    
            
            $pg_name_ar = mysqli_real_escape_string($db_connect,$_POST['page_name_ar']);                                    
            $pg_content_ar = mysqli_real_escape_string($db_connect,$_POST['page_content_ar']);                                    
            //$pg_slogan_ar = mysqli_real_escape_string($db_connect,$_POST['page_slogan_ar']);  
        
            
            if($pg_name =='' || empty($pg_name))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Page name </div>";
            }
            elseif($pg_name_ar =='' || empty($pg_name_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Page name in Arabic </div>";
            }
            
                                    
            else
            {
                $query = "INSERT INTO pages (`pg_name`, `pg_content`, `pg_slogan`, `pg_name_ar`, `pg_content_ar`) VALUES('{$pg_name}', '{$pg_content}', '{$pg_slogan}', '{$pg_name_ar}', '{$pg_content_ar}')";
                $add_pg_query = mysqli_query($db_connect, $query);
                                        
                if(!$add_pg_query)
                {
                    die ("query failed!" . mysqli_error($db_connect));
                }
                
                else
                {
                    //$msg_sucs = "<div class='alert alert-success text-center' > page successfully added! ..</div>";
                    //$msg_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;'/><p/>";
                    //$msg_sucs .= '<meta http-equiv="refresh" content="1; \'ad-categories.php\'" />';
                    
                    //echo $msg_sucs;
                    
                    header("Location: pages.php");

                }
            }
        }
    
    }



    # --- Get All pages Function ------

    function getAllPages(){
        global $db_connect;
        
        $query = "SELECT * FROM pages ORDER BY pg_id DESC";
        $select_pages = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_pages))
        {
            $pg_id = $row['pg_id'];
            $pg_name = $row['pg_name'];
            $pg_content = $row['pg_content'];
            $pg_slogan = $row['pg_slogan'];
            $num++;
        ?>
        
            <tr>
                <td><?php echo $num; ?></td>
                <td>  <?php echo $pg_name; ?> </td> 
                <td><?php echo $pg_slogan; ?></td>
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $pg_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this page">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $pg_id;?>" onClick="return confirm('Are you sure you want to delete this page?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                            <i class="fa fa-times"></i> 
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- Delete pages Function ------

    function deletePages(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deletePageId = $_GET['delete'];
            $query = "DELETE FROM pages WHERE pg_id = {$deletePageId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                $msg_del_sucs = "<div class='alert alert-success text-center' > page has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'pages.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: pages.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- Update pages Function ------

    function updatePages(){
        global $db_connect;
        global $upPageId;
        global $pg_name, $pg_content, $pg_name_ar, $pg_content_ar, $pg_slogan; 
        //global $pgName, $pgContent, $pgSlogan, $pgName_ar, $pgContent_ar;
        global $msg;
        global $msg_up_sucs;
        
        # --- get current page for updating..
        $query = "SELECT * FROM pages WHERE pg_id={$upPageId}";
        $select_page = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_page); 
        $pg_name = $row['pg_name'];
        $pg_content = $row['pg_content'];
        $pg_slogan = $row['pg_slogan'];
        
        $pg_name_ar = $row['pg_name_ar'];
        $pg_content_ar = $row['pg_content_ar'];
        
          
        # ---- Update page ...    
        if(isset($_POST['update']))
        {
            $pgName = mysqli_real_escape_string($db_connect,$_POST['page_name']);
            $pgContent = mysqli_real_escape_string($db_connect,$_POST['page_content']);
            $pgSlogan = mysqli_real_escape_string($db_connect,$_POST['page_slogan']);
            
            $pgName_ar = mysqli_real_escape_string($db_connect,$_POST['page_name_ar']);
            $pgContent_ar = mysqli_real_escape_string($db_connect,$_POST['page_content_ar']);
            
            //$upPageId = $_GET['edit'];
            
            if($pg_name =='' || empty($pg_name))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Page name </div>";
            }
            elseif($pg_name_ar =='' || empty($pg_name_ar))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Arabic Title </div>";
            }
                                    
            else
            {
                $query = "UPDATE pages SET `pg_name` = '$pgName', `pg_content` = '$pgContent', `pg_slogan` = '$pgSlogan', `pg_name_ar` = '$pgName_ar', `pg_content_ar` = '$pgContent_ar'  WHERE pg_id={$upPageId}";
                $update_query = mysqli_query($db_connect, $query);
                                    
                                        
                if(!$update_query)
                {
                    die ("query failed!" . mysqli_error($db_connect));
                }
                
                else
                {
                    header("Location: pages.php");
            
                    //$msg_up_sucs = "<div class='alert alert-success text-center' > ad category successfully added! ..</div>";
                    //$msg_up_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;'/><p/>";
                    //$msg_up_sucs .= '<meta http-equiv="refresh" content="1; \'ad-categories.php\'" />';
                }
            }
                                    
        }
                                    
    }
   
?>