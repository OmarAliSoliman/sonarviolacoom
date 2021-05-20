
          <?php
                if(!isset($_SESSION['u_id']))
                {
                     //echo '<meta http-equiv="refresh" content="3; \'index.php\'" />';
                     header("Location: login.php"); 
                }        
          ?>
          
          
          <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
            <aside>
              <div class="sidebar-box">
                <div class="user">
                  <figure>
                    <!--<a href="#"><img src="assets/img/author/img1.jpg" alt=""></a>  -->
                    <a href="account-profile-setting.php"><img class="img-thumbnail img-rounded" src="<?php echo ($select_userAvatar == '' ? 'assets/img/no-avatar.png' : $select_userAvatar); ?>" alt=""></a>
                  </figure>
                  <div class="usercontent">
                    <h3><?php echo lang('welcome'); ?>, <?php echo $_SESSION['u_name'];?></h3>
                    <h4> <?php echo ($_SESSION['u_role'] == 'admin' ? lang('admin') : ($_SESSION['u_role'] == 'employee' ? lang('employee') : lang('user') ) );?></h4>
                  </div>
                </div>
                <nav class="navdashboard">
                  <ul>
                    <!--
                    <li>
                      <a <?php if($currentPage == 'dashboard.php'){ echo 'class="active"';} ?>href="dashboard.php">
                        <i class="lni-dashboard"></i>
                        <span><?php echo lang('dashboard'); ?></span>
                      </a>
                    </li> -->
                    
                    <li>
                      <a <?php if($currentPage == 'account-profile-setting.php'){ echo 'class="active"';} ?> href="account-profile-setting.php">
                        <i class="lni-cog"></i>
                        <span><?php echo lang('profile_settings'); ?></span>
                      </a>
                    </li>
                    
                    <?php  if($select_userRole != 'admin') :    // don't show for admins accounts   ?>  
                    <li>
                      <a <?php if($currentPage == 'account-my-tasks.php'){ echo 'class="active"';} ?> href="account-my-tasks.php">
                        <i class="lni-layers"></i>
                        <span><?php echo lang('required_tasks'); ?></span>
                      </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php  if($select_userRole != 'user') :    // don't show for admins accounts   ?>  
                    <li>
                      <a <?php if($currentPage == 'account-sent-tasks.php'){ echo 'class="active"';} ?> href="account-sent-tasks.php">
                        <i class="lni-notepad"></i>
                        <span><?php echo lang('sent_tasks'); ?></span>
                      </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    
                        //$select_userRole = $row['user_role'];

                       if($select_userRole == 'employee' OR $select_userRole == 'admin') :    // show only for employee & Admin accounts
                    ?>
                    <li>
                      <a <?php if($currentPage == 'add-task.php'){ echo 'class="active"';} ?> href="add-task.php">
                        <i class="lni-pencil"></i>
                        <span><?php echo ($select_userRole == 'admin' ? lang('create_task_for_employee') : lang('create_task_for_client')); ?></span>
                      </a>
                    </li>         
                    <li>
                      <a <?php if($currentPage == 'account-add-user.php'){ echo 'class="active"';} ?> href="account-add-user.php">
                        <!--<i class="lni-plus"></i>--> <i class="lni-user"></i>
                        <span><?php echo ($select_userRole == 'admin' ? lang('add_employee') : lang('add_client')); ?></span>
                      </a>
                    </li>
                    <li>
                      <a <?php if($currentPage == 'account-my-clients.php'){ echo 'class="active"';} ?> href="account-my-clients.php">
                        <!--<i class="lni-plus"></i>--> <i class="lni-users"></i>
                        <span><?php echo ($select_userRole == 'admin' ? lang('my_employees') : lang('my_clients')); ?></span>
                      </a>
                    </li>
               	
                    <?php endif; ?>

                    <!--<li>
                      <a <?php if($currentPage == 'account_messages.php'){ echo 'class="active"';} ?> href="account_messages.php">
                        <i class="lni-envelope"></i>
                        <span><?php echo lang('messages'); ?></span>
                      </a>
                    </li>
                    
                    <li>
                      <a <?php //if($currentPage == 'payments.php'){ echo 'class="active"';} ?> href="payments.php">
                        <i class="lni-wallet"></i>
                        <span>Payments</span>
                      </a>
                    </li> 
             
                    <li>
                      <a <?php if($currentPage == 'account-favourite-ads.php'){ echo 'class="active"';} ?> href="account-favourite-ads.php">
                        <i class="lni-heart"></i>
                        <span><?php echo lang('my_favourites'); ?></span>
                      </a>
                    </li>
                    
                    <li>
                      <a <?php //if($currentPage == 'privacy-setting.php'){ echo 'class="active"';} ?> href="privacy-setting.php">
                        <i class="lni-star"></i>
                        <span>Privacy Settings</span>
                      </a>
                    </li>
          -->
                    <li>
                      <a href="logout.php?id=<?php echo $_SESSION['u_id']; ?>">
                        <i class="lni-enter"></i>
                        <span><?php echo lang('logout'); ?></span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
              <div class="widget">
                <h4 class="widget-title"><?php echo lang('advertisement'); ?></h4>
                <div class="add-box">
                  <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                </div>
              </div>
            </aside>
          </div>