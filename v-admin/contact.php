<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

 
	
	<!-- End Sidebar -->

<?php
	
	# -- Pagination : Part 1 ----------
    $per_page = 12;
                        
    if(!isset($_GET['page']))
    {
        $page = 1;   // set default value..
    }
    else
    {
        $page = (int)$_GET['page'];
    }
                    
    $start_from = ($page-1) * $per_page;
                        
    # ------------------------------------------------
                        

    # --------- Delete Ad..
   /*                 
    $deleteAdId = @$_GET['ad_id'];
    if(isset($deleteAdId))
    {
		$deleteAdQuery = mysqli_query($db_connect, "DELETE FROM ads WHERE ad_id = $deleteAdId") or die("mysql error" . mysqli_error($db_connect));
                        
        if($deleteAdQuery)
        {
                            $msg_sucs = "<div class='alert alert-success text-center' > Ad has been deleted successfully! ..</div>";
                            $msg_sucs .= "<p class='text-center'> <img src='../assets/img/ajax-loader.gif'/><p/>";
                            $msg_sucs .= '<meta http-equiv="refresh" content="3; \'ads.php\'" />';
                            
                            echo $msg_sucs;
        }
                        
    }
	
	*/				
			
    # --------- Delete email query
	  if(isset($_GET['delete']))
	  {
		  $query = mysqli_query($db_connect, "DELETE FROM contact WHERE c_id = '$_GET[delete]'");
		  
		  if($query)
		  {
			  $msg = '<div> <p class="alert alert-success" role="alert"> Item has been deleted successfully </p> </div>';
					  echo '<meta http-equiv="refresh" content="2;url=contact.php" />';
		  }
	  }
	   
	   
	   
		$all_msgs_per_pg_query = mysqli_query($db_connect, "SELECT * FROM contact ORDER BY c_id DESC LIMIT $start_from , $per_page");
		$all_msgs_query = mysqli_query($db_connect, "SELECT * FROM contact ORDER BY c_id DESC");
        $count_all_msgs = mysqli_num_rows($all_msgs_query);
?>

	<div class="main-panel">
	    <div class="content">
		<div class="page-inner">
		    <div class="page-header">
			<h4 class="page-title">Inbox</h4>
			<ul class="breadcrumbs">
			    <li class="nav-home">
				<a href="contact.php">
				    <i class="flaticon-home"></i>
				</a>
			    </li>
			    <li class="separator">
				<i class="flaticon-right-arrow"></i>
			    </li>
			    <li class="nav-item">
				<a href="#">Contact</a>
			    </li>
			    <li class="separator">
				<i class="flaticon-right-arrow"></i>
			    </li>
			    <li class="nav-item">
				<a href="#">All messages</a>
			    </li>
			</ul>
		    </div>
		    <div class="row">
				<div class="col-md-12">
					<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Display All Messages</h4>
								<!--		<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											New Ad
										</button>  -->
								<span class="ml-3"> Total : (<?php echo $count_all_msgs; ?>) </span>
								
									</div>
								</div>
								<div class="card-body">
									<!-- Modal -->
									<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														New</span> 
														<span class="fw-light">
															Row
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p class="small">Create a new row using this form, make sure you fill them all</p>
													<form>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group form-group-default">
																	<label>Name</label>
																	<input id="addName" type="text" class="form-control" placeholder="fill name">
																</div>
															</div>
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Position</label>
																	<input id="addPosition" type="text" class="form-control" placeholder="fill position">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group form-group-default">
																	<label>Office</label>
																	<input id="addOffice" type="text" class="form-control" placeholder="fill office">
																</div>
															</div>
														</div>
													</form>
												</div>
												<div class="modal-footer no-bd">
													<button type="button" id="addRowButton" class="btn btn-primary">Add</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

								<!-------  Displaying Ads in Table	 ------------------------------------------------------>

									<div class="table-responsive">
										<table class="table table-bordered table-hover text-center">
											<thead>
												<tr>
													<th class="text-center"> # </th>
													<th class="text-center">  Name </th>
													<th class="text-center">  Subject </th>
													<th class="text-center">  Email </th>
												<!--	<th class="text-center">  Phone  </th>   -->
													<th class="text-center">  Message  </th>
													<th class="text-center"colspan="2"> ____ </th>
												</tr>
											</thead>
											<tbody>
													
											<?php
												// ---- Display recieved mails ----                  
												$query = mysqli_query($db_connect, "SELECT * FROM contact ORDER BY c_id DESC");
												$num = 1;   
												while($select_mail = mysqli_fetch_assoc($query))
												{  
													echo '
													<tr>
														<td>'.$num.'</td>
														<td>'.$select_mail['c_name'].'</td> 
														<td>'.$select_mail['c_subject'].'</td> 
														<td>'.$select_mail['c_email'].'</td> 
														<td>'.$select_mail['c_message'].'</td> 
																					
														<td> <a href="mailto:'.$select_mail['c_email'].'?subject='.$select_mail['c_subject'].'" class="btn btn-primary btn-xs" target="_blank" > <i class="fa fa-reply"></i> &nbsp;  Reply </a> </td>
														<td><a href="contact.php?delete='.$select_mail['c_id'].'" class="btn btn-danger btn-xs"> <i class="fa fa-remove"></i> Delete </a></td>
													</tr>';
													$num++;
												}              
												
											?>
												   
											</tbody>
										</table>
									</div>
								</div>
							</div>
					
				<?php
                    
                        # -- Pagination : Part 2 ----------
                        $page_sql = mysqli_query($db_connect, "SELECT * FROM contact");
                        $count_pages = mysqli_num_rows($page_sql);
                        
                        $total_page = ceil( $count_pages / $per_page );     // ceil(3,4)  => 3     ceil(3,7)  => 4
                       
                ?>
				
				</div>
				
			</div>
			
			<!-- Display Pagination ---------------->
			
			<?php if ($count_pages > $per_page) : ?>
			
			<div class="row">
				<div class="col-sm-12 col-md-5">
					<div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 10 of <?php echo $count_all_msgs; ?> entries</div>
				</div>
				<div class="col-sm-12 col-md-7">
					<div class="dataTables_paginate paging_simple_numbers" id="basic-datatables_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous disabled" id="basic-datatables_previous"><a href="#" aria-controls="basic-datatables" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
						<?php
							for($i = 1; $i <= $total_page; $i++)
							{
								echo '<li '.($page == $i ? 'class="page-item active"' : 'class="page-item"').' > <a class="page-link" href="ads.php?page='.$i.'"> '.$i.' '.($page == $i ? '<span class="sr-only">(current)</span>' : '').'</a> </li>';
							}
							
							# ------------------------------------------------                
						?>
						 
							<li class="paginate_button page-item next" id="basic-datatables_next">
								<?php $next = $i - 1; ?>
								<a href="<?php echo "ads.php?page=".$next ?>" aria-controls="basic-datatables" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
							</li>						</ul>
					</div>
				</div>
			</div><!------>
			<?php endif; ?>
			
		</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>