<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

	<!-- End Sidebar -->


	<!-- check if module is disabled deny access to this page --->
	<?php checkModuleStatus($media_module); ?>

<?php

    $msg = '';                    
    $msg2 = '';                    
	$msg_sucs ='';
	$msg_del_sucs ='';
	$msg_up_sucs ='';
	
	$media_title ='';
	$media_content ='';
	$media_title_ar ='';
	$media_content_ar ='';
	
?>

	<div class="main-panel">
	    <div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="media-title">Media</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Media</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Media</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<!--
									<div class="d-flex align-items-center">
										<?php
											$mediaTypeName = ($_SERVER['QUERY_STRING'] == 'new-media' ? 'Service Media' : ($_SERVER['QUERY_STRING'] == 'new-tour-media' ? 'Tours Media' : '') );
										?>
										<h4 class="card-title float-left pl-5">New Media (<?php echo $mediaTypeName; ?>)</h4>
										<a href="?new-media" class="btn btn-warning btn-round ml-auto">
											<i class="lni-plus"></i> New Media
										</a>
									</div>
									-->
									<div class="card-body">

										<!-------  	If : Insert New Media	 ------>
										<?php if ($_SERVER['QUERY_STRING'] == 'new-media') : ?>
										
										<div class="d-flex align-items-center">
											<?php
												//$mediaTypeName = ($_SERVER['QUERY_STRING'] == 'new-media' ? 'Service Media' : ($_SERVER['QUERY_STRING'] == 'new-tour-media' ? 'Tours Media' : '') );
											?>
											<h4 class="card-title float-left pl-3 pb-3">New Service Media </h4>
											<!--<a href="?new-media" class="btn btn-warning btn-round ml-auto">
												<i class="lni-plus"></i> New Media
											</a> -->
										</div>
										
										<div class="col-md-12 mb-5">
										<!---------  Add Media Form -------------->	
											<div>
												<?php
													# --- Insert Media Function
													insertMedia(); 
												
													echo $msg_sucs;
													echo $msg;
												?>
																	
												<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-12">
	
															<!-- Nav tabs -->
															<!--
															<ul class="nav nav-pills mb-5" role="tablist">
															  <li class="active nav-item">
																<a href="#English" class="nav-link" role="tab" data-toggle="tab"> English </a>
															  </li>
															  
															  <li class="nav-item">
																<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic</a>
															  </li>
															  
															</ul>
															-->
															
															<!-- Tab panes -->
															<div class="tab-content">
																
																<!-------  Tab 1 : General English Fields ------------------------------------------------------->
																<div class="tab-pane fade show active" id="English" role="tabpanel">
															
																	<div class="form-group form-inline mb-5 imgUploadBg3">
																	  <div class="col-md-5 float-right mt-5">
																		<input type="file" id="p_image" name="p_image[]" multiple>
																	  </div>
																	  <div class="col-md-5 mt-3" >
																		<img src="../assets/img/upload-image.png" class="img-thumbnail no-border"/>
																	  </div>
																	</div>
														<!--
																	<div class="form-group form-inline mb-5 imgUploadBg2">
																	  <label for="m_content" class="col-md-2 control-label mt-3"> Icon </label>
	
																	  <div class="col-md-5 float-right mt-3">
																		<input type="text" class="form-control" id="m_icon" name="m_icon" value="<?php echo $media_icon; ?>" placeholder="ex. 'lni-leaf' ">
	
																	  </div>
																	  <div class="col-md-5 mt-3" >
																		<span class='blck-icn <?php echo $media_icon; ?>' ></span>
	
																	  </div>
																	</div>
																
															
																	<div class="form-group form-inline">
																	  <label for="m_title" class="col-md-2 control-label"> Media Title </label>
																	  <div class="col-md-4">
																		<input type="text" class="form-control" id="m_title" name="m_title" value="<?php echo $media_title; ?>" placeholder="Add media title">
																	  </div>
																	</div>
																	
																	<div class="form-group form-inline">
																	  <label for="m_content" class="col-md-2 control-label"> Content </label>
																	  <div class="col-md-10">
																		<textarea rows="8" cols="80" class="form-control" id="editor" name="m_content">  <?php echo $media_content; ?> </textarea>
																	  </div>
																	</div>
																															
																	<div class="form-group form-inline">
																	  <label for="p_image" class="col-md-2 control-label"> Image </label>
																	  <div class="col-md-5">
																		<input type="file" id="p_image" name="p_image">
																	  </div>
																	</div>
																
																	<div class="form-group form-inline">
																	  <label for="m_link" class="col-md-2 control-label"> Button Link </label>
																	  <div class="col-md-4">
																		<input type="text" class="form-control" id="m_link" name="m_link" value="<?php echo $media_link; ?>" placeholder="Add media button link">
																	  </div>
																	</div>
															-->			
																	
																	 <!-- for uploading images in tinymce -->
																	 <input name="image" type="file" id="upload" class="d-none" onchange="">
																	 
																	
																	   
																</div>
																
																<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<!--<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																	
																	<div class="form-group form-inline">
																	  <label for="m_title_ar" class="col-md-2 control-label"> Arabic Media Title </label>
																	  <div class="col-md-4">
																		<input type="text" class="form-control rtl" id="m_title_ar" name="m_title_ar" value="<?php echo $media_title_ar; ?>" placeholder="أضف العنوان بالعربي">
																	  </div>
																	</div>
																	
																	<div class="form-group form-inline">
																	  <label for="m_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																	  <div class="col-md-10 rtl">
																		<textarea rows="8" cols="80" class="form-control" id="editor2" name="m_content_ar"><?php echo $media_content_ar;?></textarea>
																	  </div>
																	</div>																
																</div> -->
																
															</div><!--- Tab content --------->
															
															<div class="form-group form-inline">
																<div class="col-md-offset-2 col-md-10">
																	<button type="submit" name="submit" id="submit" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Media </button>
																</div>
															</div>														
														</div>
													</div>
												</form> <!---------------------->
												
												
												<?php echo $msg_del_sucs; ?>
											</div>
											
										</div>
										
									
										<!-------  	elseIf : Insert New TOUR Media	 ------>
										<?php elseif ($_SERVER['QUERY_STRING'] == 'new-tour-media') : ?>
										
										<div class="d-flex align-items-center">
											
											<h4 class="card-title float-left pl-3 pb-3">New Tour Media </h4>
											<!--<a href="?new-tour-media" class="btn btn-warning btn-round ml-auto">
												<i class="lni-plus"></i> New Media
											</a> -->
										</div>
										
										<div class="col-md-12 mb-5">
										<!---------  Add Media Form -------------->	
											<div>
												<?php
													# --- Insert Media Function
													insertMedia(); 
												
													echo $msg_sucs;
													echo $msg;
												?>
																	
												<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-12">
															
															<!-- Tab panes -->
															<div class="tab-content">
																
																<!-------  Tab 1 : General English Fields ------------------------------------------------------->
																<div class="tab-pane fade show active" id="English" role="tabpanel">
															
																	<div class="form-group form-inline mb-5 imgUploadBg3">
																	  <div class="col-md-5 float-right mt-5">
																		<input type="file" id="p_image" name="p_image[]" multiple>
																	  </div>
																	  <div class="col-md-5 mt-3" >
																		<img src="../assets/img/upload-image.png" class="img-thumbnail no-border"/>
																	  </div>
																	</div>
														
																	 <!-- for uploading images in tinymce -->
																	 <input name="image" type="file" id="upload" class="d-none" onchange="">
																	
																	<div class="form-group form-inline">
																	  <label for="m_status" class="col-md-2 control-label">  Associated Tour </label>
																	  <div class="col-md-6">
																		<select class="form-control" id="assigned_item" name="assigned_item">
																			<option value=""> Select Associated Tour </option>
																			<?php
																				$sql = mysqli_query($db_connect, "SELECT * FROM tours ORDER BY tour_id DESC");
																				while($fetchSQL = mysqli_fetch_assoc($sql))
																				{
																					$tour_id = $fetchSQL['tour_id'];
																					$tour_title = $fetchSQL['tour_title'];
																					
																			?>
																					<option value="<?php echo $tour_id;?>"> <?php echo $tour_title; ?> </option>
																			<?php
																				}
																			?>
																		</select>
																	  </div>
																	</div>
																	
																	 <!-- The assigned for (for services, for tours) -->
																	 <input name="assigned-for" type="hidden" id="assigned-for" class="" value="tours">
																	
																	   
																</div>
																
															</div><!--- Tab content --------->
															
															<div class="form-group form-inline">
																<div class="col-md-offset-2 col-md-10">
																	<button type="submit" name="submit" id="submit" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Media </button>
																</div>
															</div>														
														</div>
													</div>
												</form> <!---------------------->
												
												
												<?php echo $msg_del_sucs; ?>
											</div>
										
										</div>
									
									<!-------  	ElseIf : Edit Media	 ------>
									<?php elseif (isset($_REQUEST['edit']) && !empty($_REQUEST['edit'])) : ?>
	
										<!---------  Update Media Form -------------->	
										<!--	<div class="col-md-6 float-right">  -->
										<div class="mb-5">
										<?php
											echo $msg_up_sucs;
											echo $msg;

											if(isset($_GET['edit']))
											{
												$upMediaId = $_GET['edit'];
											
												# --- Update media function 
													updateMedia();  
										?>		
										
											<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														
														<!-- view button -->
														<a href="../media.php?p_id=<?php echo $media_id; ?>" class="btn btn-success float-right" target="_blank"><i class="lni-eye"></i></a>
														
														<!-- Nav tabs -->
														<!--
														<ul class="nav nav-pills mb-5" role="tablist">
														  <li class="active nav-item">
															<a href="#English" class="nav-link" role="tab" data-toggle="tab"> English </a>
														  </li>
														  
														  <li class="nav-item">
															<a href="#Arabic" class="nav-link" role="tab" data-toggle="tab"> Arabic</a>
														  </li>
														</ul>
														-->

														<!-- Tab panes -->
														<div class="tab-content">
															
															<!-------  Tab 1 : General English Fields ------------------------------------------------------->
															<div class="tab-pane fade show active" id="English" role="tabpanel">
														
														
																<div class="form-group form-inline mb-5 imgUploadBg3">
																  <div class="col-md-5 float-right mt-5">
																	<input type="file" id="p_image" name="p_image[]" multiple>
																  </div>
																  <div class="col-md-5 mt-3" >
																	<img src="../<?php if($media_image == NULL){ echo 'assets/img/posts/no-image.jpg';} else {echo $media_image;} ?>" class="img-thumbnail"/>
																  </div>
																</div>
													<!--	
																<div class="form-group form-inline mb-5 imgUploadBg2">
																  <label for="m_content" class="col-md-2 control-label mt-3"> Icon </label>

																  <div class="col-md-5 float-right mt-3">
																	<input type="text" class="form-control" id="m_icon" name="m_icon" value="<?php echo $media_icon; ?>" placeholder="ex. 'lni-leaf' ">

																  </div>
																  <div class="col-md-5 mt-3" >
																	<span class='blck-icn <?php echo $media_icon; ?>' ></span>

																  </div>
																</div>
														
														
																<div class="form-group form-inline">
																  <label for="m_title" class="col-md-2 control-label"> Media Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="m_title" name="m_title" value="<?php echo $media_title; ?>" placeholder="Add media title">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="m_content" class="col-md-2 control-label"> Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" cols="80" class="form-control" id="editor" name="m_content">  <?php echo $media_content; ?> </textarea>
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="m_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="m_link" name="m_link" value="<?php echo $media_link; ?>" placeholder="Add media button link">
																  </div>
																</div>
																-->
													
																 <!-- for uploading images in tinymce -->
																 <input name="image" type="file" id="upload" class="d-none" onchange="">
																
																 
																   
															</div>
														
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<!--
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																<div class="form-group form-inline">
																  <label for="m_title_ar" class="col-md-2 control-label"> Arabic Media Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl" id="m_title_ar" name="m_title_ar" value="<?php echo $media_title_ar; ?>" placeholder="أضف العنوان بالعربي">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="m_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10 rtl">
																	<textarea rows="8" cols="80" class="form-control" id="editor2" name="m_content_ar"><?php echo $media_content_ar;?></textarea>
																  </div>
																</div>																
															</div>
															-->
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="update" id="update-media" class="btn btn-outline-info mt-3 "> <i class="icon-refresh"></i> Update </button>
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
									
									
									<?php else: ?>	<!-------  	Else : Show Listing Media	 ------>
										
										<!-------  Heading   ------------------->
										<div class="d-flex align-items-center pl-2">
											<h4 class="card-title float-left pl-4 pb-5">Listing Media </h4>
										</div>
										
										
										<!-- Nav tabs -->
										<div class="toursContainer">
											<ul class="nav nav-pills mb-5 toursNavTabs py-3" role="tablist">
											  <li class="nav-item">
												<a href="#Services" class="nav-link active" role="tab" data-toggle="tab"> Services Media</a>
											  </li>
											  
											  <!--<li class="nav-item">
												<a href="#Tours" class="nav-link" role="tab" data-toggle="tab"> Tours Media </a>
											  </li> -->
											</ul>
										</div>
										
										<!-- Tab panes -->
										<div class="tab-content">
											
											<!-------  Tab 1 :  Services Media ------------------------------------------------------->
											<div class="tab-pane fade show active" id="Services" role="tabpanel">
											
												<!--- Filter Media by Associated Item ---------------->
												<div class="media-filter-container mb-4">
													<form action="" method="post" class="form-horizontal">
														<div class="form-group form-inline">
															 
															<div class="col-md-4 col-md-offset-2">
																
																<!------- Filter --------->
																<button type="submit" name="media-filter" id="media-filter" class="btn btn-outline-info mr-2 "> <i class="fas fa-sort"></i> Filter </button>
														
																<!------- Reset --------->
																<button type="submit" name="media-rest" id="media-reset" class="btn btn-outline-info "> <i class="icon-refresh"></i> Reset </button>
															</div>
														</div>
														
													</form>
												</div>
												<div class="col-md-12 row">
													<?php
															# --- Media listing ...
															getServicesMedia();
													?>
														   
												</div>
											</div>
											
											
											
											<!-------  Tab 2 : Tours Media ------------------------------------------------------->
											<div class="tab-pane fade" id="Tours" role="tabpanel">

												<!--- Filter Media by Associated Item ---------------->
												<div class="media-filter-container mb-4">
													<form action="" method="post" class="form-horizontal">
														<div class="form-group form-inline">
															
															<label for="m_status" class="col-md-2 control-label">  Assigned Tour </label>
															
															<div class="col-md-6">
															  <select class="form-control" id="m_tour_id" name="m_tour_id">
																  <option value=""> Select Associated Tour </option>
																  <?php
																	  $sql = mysqli_query($db_connect, "SELECT * FROM tours ORDER BY tour_id DESC");
																	  while($fetchSQL = mysqli_fetch_assoc($sql))
																	  {
																		  $tour_id = $fetchSQL['tour_id'];
																		  $tour_title = $fetchSQL['tour_title'];
																		  
																  ?>
																	  <option value="<?php echo $tour_id;?>" <?php if(isset($_POST['media-filter']) AND $tour_id == $_POST['m_tour_id']){ echo 'selected';} ?> > <?php echo $tour_title; ?> </option>
																  <?php
																	  }
																  ?>
															  </select>
															</div>
															
															<div class="col-md-4 col-md-offset-2">
																
																<!------- Filter --------->
																<button type="submit" name="media-filter" id="media-filter" class="btn btn-outline-info mr-2 "> <i class="fas fa-sort"></i> Filter </button>
														
																<!------- Reset --------->
																<button type="submit" name="media-rest" id="media-reset" class="btn btn-outline-info "> <i class="icon-refresh"></i> Reset </button>
															</div>
														</div>
														
													</form>
												</div>
												<div class="col-md-12 row">
													<?php
															# --- Media listing ...
															getToursMedia();
													?>
												</div>
											</div>
															
										</div>
											<?php
												# --- Delete media function
												deleteMedia()
											?>
									
									<?php endif; ?>	
								
								</div>
						</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>