<?php
   
    # --- insert categories Function ------

    function insertCategories(){
                               
        global $db_connect;     // this variable is used outside of the function and it should be global..
        global $msg;
        
        if(isset($_POST['submit']))
        {
            $categoryName = mysqli_real_escape_string($db_connect,$_POST['cat_name']);                                    
            $categoryName_ar = mysqli_real_escape_string($db_connect,$_POST['cat_name_ar']);                                    

            if($categoryName =='' || empty($categoryName))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Category name </div>";
            }
                                    
            else
            {
                $query = "INSERT INTO category (`cat_name`, `cat_name_ar`) VALUES('{$categoryName}', '{$categoryName_ar}')";
                $add_cat_query = mysqli_query($db_connect, $query);
                                        
                if(!$add_cat_query)
                {
                    die ("query failed!" . mysqli_error($db_connect));
                }
                
                else
                {
                    //$msg_sucs = "<div class='alert alert-success text-center' > category successfully added! ..</div>";
                    //$msg_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;'/><p/>";
                    //$msg_sucs .= '<meta http-equiv="refresh" content="1; \'categories.php\'" />';
                    
                    //echo $msg_sucs;
                    
                    header("Location: categories.php");

                }
            }
        }
    
    }



    # --- Get All categories Function ------

    function getAllCategories(){
        global $db_connect;
        
        $query = "SELECT * FROM category ORDER BY cat_id DESC";
        $select_categories = mysqli_query($db_connect, $query) ;
         
        $num = 0;                            
        while($row = mysqli_fetch_assoc($select_categories))
        {
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            $num++;
        ?>
        
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $cat_name; ?></td>
				<td>
					<div class="form-button-action">
						<a href="?edit=<?php echo $cat_id;?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edite this category">
                            <i class="fa fa-edit"></i>
                        </a>
						<a href="?delete=<?php echo $cat_id;?>" onClick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
        <?php
        
        }
    }
    

    # --- Delete categories Function ------

    function deleteCategories(){
        global $db_connect;
        global $msg_del_sucs;
            
        if(isset($_GET['delete']))
        {
            $deleteCategoryId = $_GET['delete'];
            $query = "DELETE FROM category WHERE cat_id = {$deleteCategoryId}";
            $delete_query = mysqli_query($db_connect, $query);
                                    
            
            if($delete_query)
            {
                $msg_del_sucs = "<div class='alert alert-success text-center' > category has been deleted successfully! ..</div>";
                $msg_del_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;' /><p/>";
                $msg_del_sucs .= '<meta http-equiv="refresh" content="1; \'categories.php\'" />';
                                
                //echo $msg_del_sucs;
                
                header("Location: categories.php");
            }
                                    
        }
                                    
    }
    
    
    
    # --- Update categories Function ------

    function updateCategories(){
        global $db_connect;
        global $upCategoryId;
        global $cat_name;
        global $cat_name_ar;
        global $msg;
        global $msg_up_sucs;
        
        # --- get current category for updating..
        $query = "SELECT * FROM category WHERE cat_id={$upCategoryId}";
        $select_categories = mysqli_query($db_connect, $query);
        
        $row = mysqli_fetch_assoc($select_categories); 
        $cat_name = $row['cat_name'];
        $cat_name_ar = $row['cat_name_ar'];
          
        # ---- Update category ...    
        if(isset($_POST['update']))
        {
            $categoryName = mysqli_real_escape_string($db_connect,$_POST['cat_name']);
            $categoryName_ar = mysqli_real_escape_string($db_connect,$_POST['cat_name_ar']);
            
            //$upCategoryId = $_GET['edit'];
            
            if($categoryName =='' || empty($categoryName))
            {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Please enter Category name </div>";
            }
                                    
            else
            {
                $query = "UPDATE category SET `cat_name` = '$categoryName', `cat_name_ar` = '$categoryName_ar' WHERE cat_id={$upCategoryId}";
                $update_query = mysqli_query($db_connect, $query);
                                    
                                        
                if(!$update_query)
                {
                    die ("query failed!" . mysqli_error($db_connect));
                }
                
                else
                {
                    header("Location: categories.php");
            
                    //$msg_up_sucs = "<div class='alert alert-success text-center' > category successfully added! ..</div>";
                    //$msg_up_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif' style='width:50px;'/><p/>";
                    //$msg_up_sucs .= '<meta http-equiv="refresh" content="1; \'categories.php\'" />';
                }
            }
                                    
        }
                                    
    }
   
?>