
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        
					<?php
						// Get the current logged user info..
						$uid = $_SESSION['u_id'];
						$sql = mysqli_query($db_connect, "SELECT * FROM users WHERE user_id = $uid ");
						$row = mysqli_fetch_assoc($sql);
						
						$userName = $row['user_name'];
						$userFname = $row['user_fname'];
						$userLname = $row['user_lname'];
						$userEmail = $row['user_email'];
						$userPhone = $row['user_phone'];
						$userImage = $row['user_avatar'];
						$userRole = $row['user_role'];
						
					?>	
                        <div class="avatar-sm float-left mr-2">
                            <img src="../<?php echo ($userImage == '' ? 'assets/img/no-avatar.png' : $userImage ); ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
			<div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="1">
                                <span>
                                    <?php echo strtoupper($userName).' ( '.$userLname.' '.$userFname.' ) '; ?>
                                    <span class="user-level"><?php echo ucfirst($userRole); ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                <!--    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>-->
                                    <li>
                                        <a href="users.php?action=edit&user_id=<?php echo $uid; ?>">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="settings.php">
                                            <span class="link-collapse">General Settings</span>
                                        </a>
                                    </li>
                                    	
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
      
                         

			<!--
                        <li class="nav-item">   
                          <a href="index.php" class="">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li> --> 
                       
 

                <!-- Services -------------->
                 

			            <li class="nav-item">
                            <a data-toggle="collapse" href="#services">
                            <!--    <i class="fas fa-sticky-note"></i>   -->
                                <i class="lni-layers"></i>
                                <p>Services</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  <?php if(($currentPage =='services.php?new-service') || ($currentPage == 'services.php') ){ echo "show"; }  ?> " id="services">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="services.php?new-service">
                                            <span class="sub-item">New Service</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="services.php">
                                            <span class="sub-item">All Services</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                

                <!-- Media -------------->
               
                
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#media">
                            <!--    <i class="fas fa-sticky-note"></i>   -->
                                <i class="fas fa-file-image"></i>
                                <p>Media</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  <?php if(($currentPage =='media.php?new-media') || ($currentPage == 'media.php?new-tour-media') || ($currentPage == 'media.php') ){ echo "show"; }  ?>   " id="media">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="media.php?new-media">
                                            <span class="sub-item">Add Service Media</span>
                                        </a>
                                    </li> <!-- -->
                                     <!--<li>
                                        <a href="media.php?new-tour-media">
                                            <span class="sub-item"> Add Tour Media</span>
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="media.php">
                                            <span class="sub-item">All Medias</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                 
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#blocks">
                            <!--    <i class="fas fa-sticky-note"></i>   -->
                                <i class="lni-layout"></i>
                                <p>About Us</p>
                                <span class="caret"></span>
                            </a> 
                            <div class="collapse  <?php if(($currentPage =='blocks.php?new-block') || ($currentPage == 'blocks.php') ){ echo "show"; }  ?>  " id="blocks">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="blocks.php?new-block">
                                            <span class="sub-item">New Block</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blocks.php">
                                            <span class="sub-item">All Blocks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#partners">
                                <i class="far fa-handshake"></i>
                                <p>Partners</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php if(($currentPage =='partners.php?new-partner') || ($currentPage == 'partners.php') ){ echo "show"; }  ?>" id="partners">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="partners.php?new-partner">
                                            <span class="sub-item">New Partner</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="partners.php">
                                            <span class="sub-item">All Partners</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                 

                <!-- Slider -------------->
                 
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#slider">
                                <!--<i class="fas fa-sticky-note"></i>  -->
                                <i class="lni-control-panel"></i>
                                <p>Slider</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  <?php if(($currentPage =='slider.php?new-slide') || ($currentPage == 'slider.php') ){ echo "show"; }  ?>  " id="slider">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="slider.php?new-slide">
                                            <span class="sub-item">New Slide</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="slider.php">
                                            <span class="sub-item">All Slides</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                 

                <!-- Pages -------------->
                 
                        <li class="nav-item">
                            <a href="pages.php">
                                <i class="far fa-file"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                 
   
                

                <!-- <li class="nav-item">
                                        <a href="categories.php">
                                            <span class="sub-item">Categories</span>
                                        </a>
                                    </li> -->

               

   

                <!-- Users -------------->
                 
                
                        <!-- <li class="nav-item">
                            <a data-toggle="collapse" href="#users">
                                <i class="fas fa-users"></i>
                                <p>Users</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php if(($currentPage =='new-user.php') || ($currentPage == 'users.php')   ){ echo "show"; }  ?>" id="users">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="new-user.php">
                                            <span class="sub-item">New User</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="users.php">
                                            <span class="sub-item">All Users</span>
                                        </a>
                                    </li>
                                   <li>
                                        <a href="user-roles.php">
                                            <span class="sub-item">Roles</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="permissions.php">
                                            <span class="sub-item">Permissions</span>
                                        </a>
                                    </li>  
                                </ul>
                            </div>
                        </li>
                 -->

                <!-- Setup -------------->
                
						
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#setup">
                                <i class="fas fa-cog"></i>
                                <p>Setup</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php if(($currentPage =='settings.php') || ($currentPage == 'welcome-block.php')   ){ echo "show"; }  ?> " id="setup">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="settings.php">
                                            <span class="sub-item">General Settings</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="welcome-block.php">
                                            <span class="sub-item">Home Welcome Block </span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                

                <!-- Contact -------------->
                
                
                        <li class="nav-item">
                            <a href="contact.php">
                                <i class="fas fa-envelope"></i>
                                <p> Inbox </p>
                                <?php
                                        $all_msgs_query = mysqli_query($db_connect, "SELECT * FROM contact");
                                        $count_all_msgs = mysqli_num_rows($all_msgs_query);
                                ?>						
                                <span class="badge badge-warning"><?php echo $count_all_msgs ?></span>
                            </a>
                        </li>
                
 

                        <li class="nav-item">
                            <a href="logout.php?id=<?php echo $_SESSION['u_id']; ?>">
                                <i class="fas fa-sign-out-alt"></i>
                                <p> Signout </p>
                            </a>
                        </li>

                        <li class="mx-4 mt-2">
                            <a href="../index.php" class="btn btn-primary btn-block btn-sm" target="_blank"> <span class="btn-label mr-2"> <i class="fa fa-link"></i> </span> Visit Website </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>