<?php
    /* ----------------------------------------------------
        Words Fixing function (using for URI)
     ----------------------------------------------------- */
    function fixForUri($string){
        $slug = trim($string); // trim the string
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug= str_replace(' ','-', $slug); // replace spaces by dashes
        $slug= strtolower($slug);  // make it lowercase
        return $slug;
    }

    

    
    
   
    /* ----------------------------------------------------
        Advanced Search Form
     ----------------------------------------------------- */
    function advancedSearchForm() {
        global $db_connect, $prefix, $currentLocation;
        global $search, $ad_category_adcat_id, $ad_sub_category_ad_subcat_id, $min_price, $max_price, $ad_currency, $ad_condition, $ad_type; 
        global $country_id, $state_id, $city_id, $district_id, $ad_number, $ad_currency;
    ?>
        <form class="search-form" action="search.php" method="post" id="searchform">

            <!--- Search Word ----------------------->
            <div class="form-group w-100">
                    <i class="fa fa-search srch-inpt-icn"></i><input type="text" name="search_word" id="search_word" class="form-control pl-3" value="<?php echo isset($search) ? $search : '' ; ?>" placeholder="<?php echo lang('search_placeholder'); ?>">
            </div>
            
            <div class="col-lg-12">      
                      
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 float-left mb-4">
                 
                        <!--- Min Price ----------------------->
                        <div class="input-group mb-3 col-lg-6 p-1 float-left">
                            <div class="input-group-prepend">
                              <span class="input-group-text"> <i class="lni-arrow-down"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="min_price" placeholder="<?php echo lang('min_price'); ?>"  value="<?php echo $min_price; ?>">
                        </div>

                        <!--- Max Price ----------------------->
                        <div class="input-group mb-3 col-lg-6 p-1">
                            <input type="text" class="form-control" name="max_price" placeholder="<?php echo lang('max_price'); ?>"  value="<?php echo $max_price; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"> <i class="lni-arrow-up"></i> </span>
                            </div>
                        </div>
                          
                    
                        <!--- Ad Condition (Used / New) ----------------------->
                        <div class="form-group mb-3 inputwithicon">
                            <div class="tg-select">
                              <select name="ad_condition" class="form-control">
                                <option value=""><?php echo lang('condition'); ?> </option>
                                <option value="used" <?php if($ad_condition == 'used'){echo 'selected';}?> ><?php echo lang('used'); ?></option>
                                <option value="new"  <?php if($ad_condition == 'new') {echo 'selected';}?> ><?php echo lang('new'); ?></option>
                              </select>
                            </div>
                        </div>
                    
                    <!--- #Ad Number ----------------------->
                    <div class="form-group w-100">
                        <i class="lni-key srch-inpt-icn"> </i><input type="text" name="ad_number" class="form-control pl-3" placeholder="#<?php echo lang('ad_number'); ?>" value="<?php echo $ad_number; ?>">
                    </div>
 
                    
                </div>     
                      
                      
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 float-right">

                         


                        <!--- Categories ----------------------->
                        <div class="form-group mb-3 inputwithicon">
                            <div class="select">
                            <!--    <div class="srch-icn-label float-left p-2"> <i class="lni-folder"></i> </div> -->
                                <select name="ad_category_adcat_id" id="category" class="for-fields form-control">
                                <option value=""><?php echo lang('category'); ?></option>
                    <?php
                            $adCats_query = mysqli_query($db_connect,"SELECT * FROM ad_category");
                            while($adCat = mysqli_fetch_assoc($adCats_query))
                            {
                    ?>
                                <option value="<?php echo $adCat['adcat_id']?>" <?php if($adCat['adcat_id'] == $ad_category_adcat_id){echo 'selected';}?> > <?php echo $adCat['adcat_name'.$prefix]?></option>
                    <?php         
                            }
                    ?>
                               </select>
                            </div>
                        </div>


                        <!--- Sub-Categories ----------------------->
                        <div class="form-group mb-3 inputwithicon">
                            <div class="select">
                              <select name="ad_sub_category_ad_subcat_id" id="subcategory" class="form-control">
                                <option value=""><?php echo lang('select_sub_cat'); ?> </option>
            
                               </select>
                            </div>
                        </div>
                        
                        
                        <!--- Ad Type (Private / Business) ----------------------->
                        <div class="form-group mb-3 inputwithicon">
                            <label class="control-label mr-2"><?php echo lang('ad_type'); ?></label>
                            
                                 <input type="radio" class="control-form" id="ad_type" name="ad_type" value="Private" checked > <?php echo lang('private'); ?> &nbsp;&nbsp; | &nbsp;&nbsp;
                                <input type="radio" class="control-form" id="ad_type" name="ad_type" value="Business" > <?php echo lang('business'); ?>
                        </div>
                        
                </div>
                
                <!----- Using it for Ajax (receive data) -------------->
                <div id="adfields" class="col-12 d-inline-block mt-3"> </div>
                        
                        
                        
                <!--------- Submit & Reset buttons ------------>
                <div class="col-lg-12 d-inline-block">
                    <button class="btn btn-outline-info" type="submit" name="adv_search"><i class="lni-search"></i> <?php echo lang('search_now'); ?></button>
                    <button class="btn btn-outline-secondary ml-2" value="Reset" onclick="clearform()"><?php echo lang('reset'); ?></button>
                                    
                    <script>
                        function clearform() {
                            var form = document.getElementById("searchform");
                            var textFields = form.getElementsByTagName('input');
                            var selectField = form.getElementsByTagName('select')
                            
                            // for ' Text Input' fields 
                            for(var i = 0; i < textFields.length; i++) {
                                textFields[i].setAttribute('value', '');
                            }
                            
                            // for 'dropdown Select' fields 
                            for(var i = 0; i < selectField.length; i++) {
                                
                                selectField[i].selectedIndex =0;    // selectedIndex => the option selected ( we select the first one '0')
    
                            }
                                // other ways :
                              //document.getElementById('search_word').value = '';
                              //document.getElementById("searchform").reset();
                        }
                    </script>
                </div>
                
            </div>  
        </form>
    
    <?php
    
    
    }



    /* ----------------------------------------------------
        Blog Sidebar 
     ----------------------------------------------------- */
    function blogSidebar(){
        
        global $db_connect;
		global $prefix;
        
        ?>
          <aside id="sidebar" class="col-lg-4 col-md-12 col-xs-12 right-sidebar">
            <!-- Search Widget -->          
              <div class="widget_search">
                <form role="search" id="search-form">
                  <input type="search" class="form-control" autocomplete="off" name="s" placeholder="<?php echo lang('search'); ?>" id="search-input" value="">
                  <button type="submit" id="search-submit" class="search-btn"><i class="lni-search"></i></button>
                </form>
              </div>
            
            

            

            <div class="widget">
              <h4 class="widget-title"><?php echo lang ('advertisement'); ?></h4>
              <div class="add-box">
                <img src="assets/img/img1.jpg" alt="">
              </div>
            </div>

          </aside>
   <?php
    }

    # --- Current Page -------------------------------------------------
    function currentPage ($pageName){
        
        global $currentPage;
        
        if($currentPage == $pageName)
        {
            echo 'active';
        }
    }

    
    function checkEvenNumber($number){ 
        if($number % 2 == 0)
        { 
            return true;
            //echo "even"; 
        } 
        else
        {
            return false; 
            //echo "Odd"; 
        } 
    } 
    
?>