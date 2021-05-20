<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

	<!-- End Sidebar -->

 

<?php

    $msg = '';                    
    $msg2 = '';                    
	$msg_sucs ='';
	$msg_del_sucs ='';
	$msg_up_sucs ='';
	
	$service_title ='';
	$service_content ='';
	$service_title_ar ='';
	$service_content_ar ='';
	
?>

	<div class="main-panel">
	    <div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="service-title">Services</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Services</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Service</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><!--Create Service--> &nbsp;</h4>
										
										<a href="?new-service" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i> New Service
										</a>
									</div>
									
									<div class="card-body">

									<!-------  	If : Insert New Service	 ------>
									<?php if ($_SERVER['QUERY_STRING'] == 'new-service') : ?>
									<div class="col-md-12 mb-5">
									<!---------  Add Service Form -------------->	
										<div>
											<?php
												# --- Insert Services Function
												insertServices(); 
											
												echo $msg_sucs;
												echo $msg;
											?>
																
											<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">

														<!-- Nav tabs -->
														<ul class="nav nav-pills mb-5" role="tablist">
														  <li class="active nav-item">
															<a href="#English" class="nav-link" role="tab" data-toggle="tab"> English </a>
														  </li>
														  
														  <li class="nav-item">
															<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic</a>
														  </li>
														  
														</ul>
														
														<!-- Tab panes -->
														<div class="tab-content">
															
															<!-------  Tab 1 : General English Fields ------------------------------------------------------->
															<div class="tab-pane fade show active" id="English" role="tabpanel">
														
																<div class="form-group form-inline mb-5 imgUploadBg">
																  <div class="col-md-5 float-right mt-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																  <div class="col-md-5 mt-3" >
																	<img src="../<?php if($service_image == NULL){ echo 'assets/img/posts/no-image.jpg';} else {echo $service_image;} ?>" class="img-thumbnail"/>
																  </div>
																</div>
													<!--
																<div class="form-group form-inline mb-5 imgUploadBg2">
																  <label for="srv_content" class="col-md-2 control-label mt-3"> Icon </label>

																  <div class="col-md-5 float-right mt-3">
																	<input type="text" class="form-control" id="srv_icon" name="srv_icon" value="<?php echo $service_icon; ?>" placeholder="ex. 'lni-leaf' ">

																  </div>
																  <div class="col-md-5 mt-3" >
																	<span class='blck-icn <?php echo $service_icon; ?>' ></span>

																  </div>
																</div>
															-->
														
																<div class="form-group form-inline">
																  <label for="srv_title" class="col-md-2 control-label"> Service Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="srv_title" name="srv_title" value="<?php echo $service_title; ?>" placeholder="Add service title">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="srv_content" class="col-md-2 control-label"> Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" cols="80" class="form-control" id="editor" name="srv_content">  <?php echo $service_content; ?> </textarea>
																  </div>
																</div>
														<!--																
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
															
																<div class="form-group form-inline">
																  <label for="srv_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="srv_link" name="srv_link" value="<?php echo $service_link; ?>" placeholder="Add service button link">
																  </div>
																</div>
														-->			
																
																 <!-- for uploading images in tinymce -->
																 <input name="image" type="file" id="upload" class="d-none" onchange="">
																
																<div class="form-group form-inline">
																  <label for="srv_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="srv_status" name="srv_status">
																		<option value="published"> Publish </option>
																		<option value="draft"> Draft </option>
																	</select>
																  </div>
																</div>
																   
															</div>
															
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="srv_title_ar" class="col-md-2 control-label"> Arabic Service Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl" id="srv_title_ar" name="srv_title_ar" value="<?php echo $service_title_ar; ?>" placeholder="أضف العنوان بالعربي">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="srv_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10 rtl">
																	<textarea rows="8" cols="80" class="form-control" id="editor2" name="srv_content_ar"><?php echo $service_content_ar;?></textarea>
																  </div>
																</div>																
															</div>
															
														</div><!--- Tab content --------->
														
														<?php
															$sql = mysqli_query($db_connect, "SELECT * FROM services");
															$countSQL = mysqli_num_rows($sql);
															$auto_order = $countSQL + 1;
															
														?>
														
														<div class="form-group form-inline">
															<label for="srv_order" class="col-md-2 control-label">  Default Order </label>
															<div class="col-md-2">
															  <?php echo $auto_order ?>
															</div>
														</div>
														
														<!--------  Hidden field for auto generating the order ----------->
														<input type="hidden" name="srv_order" value="<?php echo $auto_order ?>" >
														
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="submit" id="submit" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Service </button>
															</div>
														</div>														
													</div>
												</div>
											</form> <!---------------------->
											
											
											<?php echo $msg_del_sucs; ?>
										</div>
										
									</div>
									
									<!-------  	ElseIf : Edit Service	 ------>
									<?php elseif (isset($_REQUEST['edit']) && !empty($_REQUEST['edit'])) : ?>
	
										<!---------  Update Service Form -------------->	
										<!--	<div class="col-md-6 float-right">  -->
										<div class="mb-5">
										<?php
											echo $msg_up_sucs;
											echo $msg;

											if(isset($_GET['edit']))
											{
												$upServiceId = $_GET['edit'];
											
												# --- Update service function 
													updateServices();  
										?>		
										
											<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														
														<!-- view button -->
														<!--<a href="../service.php?p_id=<?php echo $service_id; ?>" class="btn btn-success float-right" target="_blank"><i class="lni-eye"></i></a> -->
														
														<!-- Nav tabs -->
														<ul class="nav nav-pills mb-5" role="tablist">
														  <li class="nav-item">
															<a href="#English" class="nav-link active" role="tab" data-toggle="tab"> English </a>
														  </li>
														  
														  <li class="nav-item">
															<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic</a>
														  </li>
														  
														</ul>

														<!-- Tab panes -->
														<div class="tab-content">
															
															<!-------  Tab 1 : General English Fields ------------------------------------------------------->
															<div class="tab-pane fade show active" id="English" role="tabpanel">
														
														
																<div class="form-group form-inline mb-5 imgUploadBg">
																  <div class="col-md-5 float-right mt-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																  <div class="col-md-5 mt-3" >
																	<img src="../<?php if($service_image == NULL){ echo 'assets/img/posts/no-image.jpg';} else {echo $service_image;} ?>" class="img-thumbnail"/>
																  </div>
																</div>
													<!--	
																<div class="form-group form-inline mb-5 imgUploadBg2">
																  <label for="srv_content" class="col-md-2 control-label mt-3"> Icon </label>

																  <div class="col-md-5 float-right mt-3">
																	<input type="text" class="form-control" id="srv_icon" name="srv_icon" value="<?php echo $service_icon; ?>" placeholder="ex. 'lni-leaf' ">

																  </div>
																  <div class="col-md-5 mt-3" >
																	<span class='blck-icn <?php echo $service_icon; ?>' ></span>

																  </div>
																</div>
														-->
														
																<div class="form-group form-inline">
																  <label for="srv_title" class="col-md-2 control-label"> Service Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="srv_title" name="srv_title" value="<?php echo $service_title; ?>" placeholder="Add service title">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="srv_content" class="col-md-2 control-label"> Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" cols="80" class="form-control" id="editor" name="srv_content">  <?php echo $service_content; ?> </textarea>
																  </div>
																</div>
																
																<!--														
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="srv_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="srv_link" name="srv_link" value="<?php echo $service_link; ?>" placeholder="Add service button link">
																  </div>
																</div>-->
																
																<!-------- Set Order ------------>
																<div class="form-group form-inline">
																  <label for="srv_order" class="col-md-2 control-label">  Order </label>
																  <div class="col-md-2">
																	<select class="form-control" id="srv_order" name="srv_order">
																	<?php
																		$sql = mysqli_query($db_connect, "SELECT * FROM `services` ORDER BY srv_order ASC") or die(mysqli_error($db_connect));
																		while($row = mysqli_fetch_assoc($sql))
																		{
																			$srv_order = $row['srv_order'];
																	?>
																			<option value="<?php echo $srv_order;?>" <?php if($service_order == $srv_order){ echo 'selected';} ?> > <?php echo $srv_order;?> </option>
																	<?php
																		}
																	?>
																	</select>
																  </div>
																</div>
																
																 <!-- for uploading images in tinymce -->
																 <input name="image" type="file" id="upload" class="d-none" onchange="">
																
																<div class="form-group form-inline">
																  <label for="srv_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="srv_status" name="srv_status">
																		<option value="published" <?php if($service_status == 'published'){ echo 'selected';} ?> > Published </option>
																		<option value="draft" <?php if($service_status == 'draft'){ echo 'selected';} ?> > Draft </option>
																	</select>
																  </div>
																</div>
																   
															</div>
														
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="srv_title_ar" class="col-md-2 control-label"> Arabic Service Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl" id="srv_title_ar" name="srv_title_ar" value="<?php echo $service_title_ar; ?>" placeholder="أضف العنوان بالعربي">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="srv_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10 rtl">
																	<textarea rows="8" cols="80" class="form-control" id="editor2" name="srv_content_ar"><?php echo $service_content_ar;?></textarea>
																  </div>
																</div>																
															</div>
															
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="update" id="update-service" class="btn btn-outline-info mt-3 "> <i class="icon-refresh"></i> Update </button>
															</div>
														</div>
													</div>
												</div>
											</form> <!---------------------->
							
												<?php echo $msg_del_sucs; ?>
												<?php
												}
											?>
											
										</div>
									</div>
									
									
									<?php else: ?>	<!-------  	Else : Show Listing Services	 ------>
										
										<!----------  Listing services  ------------------------------->
										<div class="col-md-12" style=" display: flex; ">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">image</th>
														<th scope="col">Title</th>
														<th scope="col">Status</th>
														<th style="text-align: center;">Action</th>
													</tr>
												</thead>
												<tbody>
									   
											<?php
													# --- Services listing ...
													getAllServices();
											?>
												   
												</tbody>
											</table>
										</div>
										
										
										
										<?php
												# --- Delete services function
												deleteServices()
										?>
									
									<?php endif; ?>	
								
								</div>
						</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>