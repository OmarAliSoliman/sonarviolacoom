<?php
  
    include_once "../inc/multilangues.php";

    include "../inc/config.php";
    include "../inc/functions.php";
    
    require_once "../languages/" . $_SESSION['lang'] . ".php";  // ------ Translation File path ----->

    $lang = $_SESSION['lang'];
    
    
    # --- we add the prefix `_ar`  in arabic columns       Ex. =>   `adcat_name`  and  `adcat_name_ar` ..
    $prefix = '';
    
    if($lang == 'en')
    {
        $prefix = '';
    }
    
    elseif($lang == 'ar')
    {
        $prefix = '_ar';
    }

  
    # ---------------------------------------------------------------------------------------------
    
    # --- Getting current user data for updating it..
    
    $gid = @$_SESSION['u_id'];
     
    $query = "SELECT * FROM users WHERE user_id = '$gid'";
    $select_user = mysqli_query($db_connect, $query);
    
    $row = mysqli_fetch_assoc($select_user);
        
    $select_userName = $row['user_name'];
    $select_userFname = $row['user_fname'];
    $select_userLname = $row['user_lname'];
    $select_userEmail = $row['user_email'];
    $select_userAvatar = $row['user_avatar'];
    $select_userPhone = $row['user_phone'];
        
    
    $select_userFb = $row['user_fb'];
    $select_userTw = $row['user_tw'];
    $select_userInstg = $row['user_instg'];
        
    $select_userAbout = $row['user_about'];
    $select_userCountry = $row['countries_country_id'];
    $select_userState = $row['states_state_id'];
    $select_userCity = $row['cities_city_id'];
    $select_userDistrict = $row['districts_district_id'];
    
     
    
    /*----------------------------------------------------------------------------------------------
     Category -> Sub Category
    ----------------------------------------------------------------------------------------------*/
    
   if(isset($_GET['category']) && !empty($_GET['category']))
    {
        $category_id = $_GET['category'];
        
        $query = "SELECT * FROM ad_sub_category WHERE ad_category_adcat_id ='$category_id'";
        $sub_category_query = mysqli_query($db_connect, $query);
        $sub_category_count = mysqli_num_rows($sub_category_query);
        
        if($sub_category_count > 0)
        {
            echo '<option value="">'.lang('select_sub_cat').'</option>';

            while ($row = mysqli_fetch_assoc($sub_category_query))
            {
                echo '<option value="'.$row['ad_subcat_id'].'">'.$row['ad_subcat_name'.$prefix].'</option>';
            }
        }
        
   /*     else
        {
            echo '<option> No subcategories Availables </option>';
        }
    */
    }
    
   
    
    
    
     /*----------------------------------------------------------------------------------------------
     Category -> Custom Fields 
    ----------------------------------------------------------------------------------------------*/
    
    elseif(isset($_GET['fields_category']) && !empty($_GET['fields_category']))
    {
        $fieldCategory_id = $_GET['fields_category'];
        
        $query = "SELECT * FROM ad_fields WHERE ad_category_adcat_id ='$fieldCategory_id'";
        $fields_category_query = mysqli_query($db_connect, $query);
        $fields_category_count = mysqli_num_rows($fields_category_query);
        
        if($fields_category_count > 0)
        {
            while ($row = mysqli_fetch_assoc($fields_category_query))
            {
                $field_id = $row['field_id'];
                $field_name = $row['field_name'.$prefix];
                $field_nameEN = $row['field_name'];                   // using english word for the option name (name="xyz")
                $field_type = $row['field_type'];
                
                //echo $row['field_id'].' => '.$row['field_name'].'</br>';
       ?>
            <div class="form-group mb-3 tg-inputwithicon">
                <label class="control-label"><?php  echo $field_name; ?> </label>
            
            
           <!-----  Display fields depending on Field Type    ------------------------>
           <?php
               # -- Dropdown Type -------
               if($field_type == 'dropdown')
               {
           ?>                     
                <div class="tg-select form-control">
                    <select name="<?php echo fixForUri($field_nameEN) ?>" id="">
                        <option value=""> <?php echo lang('select').' '. $field_name; ?></option>
                    <?php
                    
                        $query = mysqli_query($db_connect, "SELECT * FROM ad_options WHERE ad_fields_field_id=$field_id");
                        while($fetchFields = mysqli_fetch_assoc($query))
                        {
                            $optionId = $fetchFields['option_id'];
                            $optionName = $fetchFields['option_name'.$prefix];
                            
                            echo '<option value="'.$optionId.'"> '.$optionName.' </option>';

                        }
                        
                    ?>
                    </select>
                </div>
                
           <?php     
               }
               
               # -- Radio Type -------
                elseif($field_type == 'radio')
               {
            ?>             
                <div class="form-control">
                    <?php
                    
                        $query = mysqli_query($db_connect, "SELECT * FROM ad_options WHERE ad_fields_field_id=$field_id");
                        while($fetchFields = mysqli_fetch_assoc($query))
                        {
                            $optionId = $fetchFields['option_id'];
                            $optionName = $fetchFields['option_name'.$prefix];
                            
                        ?>    
                            <input type="radio" class="control-form" id="" name="<?php echo fixForUri($field_nameEN); ?>" value="<?php echo $optionId; ?>" > <?php echo $optionName; ?> &nbsp &nbsp;

                        <?php
                        }
                        
                    ?>
                </div>
            <?php    
               }

              
               
               # -- Simple Input Type -------
               elseif($field_type == 'input')
               {
        ?>                
                    <input class="form-control input-md" name="<?php echo fixForUri($field_nameEN); ?>" placeholder="<?php echo lang('enter').' '.$field_name; ?>" type="text">
        <?php     
               }
               
               

                # -- Checkbox Type -------
               elseif($field_type == 'checkbox')
               {
                
                
                
               }
               
               # -- Textarea Type -------
               elseif($field_type == 'textarea')
               {
                
                
                
               }
               
               else
               {
                    echo "Please select the Field type from Dashboard";
               }
               
               
            ?>
                
            </div>
       
       <?php         
            }
        }
     /*      
        else
        {
            echo '<option> No custom fields Availables </option>';
        }
      */
    }
    
    else
    {
        echo "Error!";
    }
    
?>