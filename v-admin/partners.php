<?php  include_once "inc/header.php"; ?>

	<!-- Sidebar -->
	<?php  include_once "inc/sidebar.php"; ?>

	<!-- End Sidebar -->


	<!-- check if module is disabled deny access to this page --->
	<?php checkModuleStatus($partners_module); ?>

<?php

    $msg = '';                    
    $msg2 = '';                    
	$msg_sucs ='';
	$msg_del_sucs ='';
	$msg_up_sucs ='';
	
	$partner_name ='';
	$partner_name_ar ='';
	$partner_content_ar ='';
	
?>

	<div class="main-panel">
	    <div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="partner-title">Partners</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Partners</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Partner</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><!--Create Partner--> &nbsp;</h4>
										
										<a href="?new-partner" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i> New Partner
										</a>
									</div>
									
									<div class="card-body">

									<!-------  	If : Insert New Partner	 ------>
									<?php if ($_SERVER['QUERY_STRING'] == 'new-partner') : ?>
									<div class="col-md-12 mb-5">
									<!---------  Add Partner Form -------------->	
										<div>
											<?php
												# --- Insert Partners Function
												insertPartners(); 
											
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
																	<img src="../<?php if($partner_image == NULL){ echo 'assets/img/posts/no-image.jpg';} else {echo $partner_image;} ?>" class="img-thumbnail"/>
																  </div>
																</div>
																
																<!--
																<div class="form-group form-inline mb-5 imgUploadBg2">
																  <label for="prtn_content" class="col-md-2 control-label mt-3"> Icon </label>

																  <div class="col-md-5 float-right mt-3">
																	<input type="text" class="form-control" id="prtn_icon" name="prtn_icon" value="<?php echo $partner_icon; ?>" placeholder="ex. 'lni-leaf' ">

																  </div>
																  <div class="col-md-5 mt-3" >
																	<span class='blck-icn <?php echo $partner_icon; ?>' ></span>

																  </div>
																</div> -->
														
														
																<div class="form-group form-inline">
																  <label for="prtn_name" class="col-md-2 control-label"> Partner Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="prtn_name" name="prtn_name" value="<?php echo $partner_name; ?>" placeholder="Add partner title">
																  </div>
																</div>
															<!--	
																<div class="form-group form-inline">
																  <label for="prtn_content" class="col-md-2 control-label"> Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" cols="80" class="form-control" id="editorXXX" name="prtn_content">  <?php echo $partner_content; ?> </textarea>
																  </div>
																</div>
																														
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
														-->		
																<div class="form-group form-inline">
																  <label for="prtn_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="prtn_link" name="prtn_link" value="<?php echo $partner_link; ?>" placeholder="Add partner button link">
																  </div>
																</div>
																
																
																 <!-- for uploading images in tinymce -->
																 <!--<input name="image" type="file" id="upload" class="d-none" onchange="">  -->
																
																<div class="form-group form-inline">
																  <label for="prtn_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="prtn_status" name="prtn_status">
																		<option value="published"> Publish </option>
																		<option value="draft"> Draft </option>
																	</select>
																  </div>
																</div>
																   
															</div>
															
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="prtn_name_ar" class="col-md-2 control-label"> Arabic Partner Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl" id="prtn_name_ar" name="prtn_name_ar" value="<?php echo $partner_name_ar; ?>" placeholder="أضف العنوان بالعربي">
																  </div>
																</div>
																<!--
																<div class="form-group form-inline">
																  <label for="prtn_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10 rtl">
																	<textarea rows="8" cols="80" class="form-control" id="editorXXX2XXX" name="prtn_content_ar"><?php echo $partner_content_ar;?></textarea>
																  </div>
																</div>
																-->
															</div>
															
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="submit" id="submit" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Partner </button>
															</div>
														</div>														
													</div>
												</div>
											</form> <!---------------------->
											
											
											<?php echo $msg_del_sucs; ?>
										</div>
										
									</div>
									
									<!-------  	ElseIf : Edit Partner	 ------>
									<?php elseif (isset($_REQUEST['edit']) && !empty($_REQUEST['edit'])) : ?>
	
										<!---------  Update Partner Form -------------->	
										<!--	<div class="col-md-6 float-right">  -->
										<div class="mb-5">
										<?php
											echo $msg_up_sucs;
											echo $msg;

											if(isset($_GET['edit']))
											{
												$upPartnerId = $_GET['edit'];
											
												# --- Update partner function 
													updatePartners();  
										?>		
										
											<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														
														<!-- view button -->
														<a href="../partner.php?p_id=<?php echo $partner_id; ?>" class="btn btn-success float-right" target="_blank"><i class="lni-eye"></i></a>
														
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
																	<img src="../<?php if($partner_image == NULL){ echo 'assets/img/posts/no-image.jpg';} else {echo $partner_image;} ?>" class="img-thumbnail"/>
																  </div>
																</div>
														
																<!--
																<div class="form-group form-inline mb-5 imgUploadBg2">
																  <label for="prtn_content" class="col-md-2 control-label mt-3"> Icon </label>

																  <div class="col-md-5 float-right mt-3">
																	<input type="text" class="form-control" id="prtn_icon" name="prtn_icon" value="<?php echo $partner_icon; ?>" placeholder="ex. 'lni-leaf' ">

																  </div>
																  <div class="col-md-5 mt-3" >
																	<span class='blck-icn <?php echo $partner_icon; ?>' ></span>

																  </div>
																</div>
																-->
														
																<div class="form-group form-inline">
																  <label for="prtn_name" class="col-md-2 control-label"> Partner Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="prtn_name" name="prtn_name" value="<?php echo $partner_name; ?>" placeholder="Add partner title">
																  </div>
																</div>
																
																<!--
																<div class="form-group form-inline">
																  <label for="prtn_content" class="col-md-2 control-label"> Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" cols="80" class="form-control" id="editorXXX" name="prtn_content">  <?php echo $partner_content; ?> </textarea>
																  </div>
																</div>
																
																														
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
																-->
																<div class="form-group form-inline">
																  <label for="prtn_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control" id="prtn_link" name="prtn_link" value="<?php echo $partner_link; ?>" placeholder="Add partner button link">
																  </div>
																</div>
																
																
																 <!-- for uploading images in tinymce -->
																 <!--<input name="image" type="file" id="upload" class="d-none" onchange=""> -->
																
																<div class="form-group form-inline">
																  <label for="prtn_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="prtn_status" name="prtn_status">
																		<option value="published" <?php if($partner_status == 'published'){ echo 'selected';} ?> > Published </option>
																		<option value="draft" <?php if($partner_status == 'draft'){ echo 'selected';} ?> > Draft </option>
																	</select>
																  </div>
																</div>
																   
															</div>
														
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="prtn_name_ar" class="col-md-2 control-label"> Arabic Partner Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl" id="prtn_name_ar" name="prtn_name_ar" value="<?php echo $partner_name_ar; ?>" placeholder="أضف العنوان بالعربي">
																  </div>
																</div>
																<!--
																<div class="form-group form-inline">
																  <label for="prtn_content_ar" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10 rtl">
																	<textarea rows="8" cols="80" class="form-control" id="editorXXX2XXX" name="prtn_content_ar"><?php echo $partner_content_ar;?></textarea>
																  </div>
																</div> -->																
															</div>
															
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="update" id="update-partner" class="btn btn-outline-info mt-3 "> <i class="icon-refresh"></i> Update </button>
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
									
									
									<?php else: ?>	<!-------  	Else : Show Listing Partners	 ------>
										
										<!----------  Listing partners  ------------------------------->
										<div class="col-md-12" style=" display: flex; ">
											
											<table class="table table-hover partners-table">
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
													# --- Partners listing ...
													getAllPartners();
											?>
												   
												</tbody>
											</table>
										</div>
										
										
										
										<?php
												# --- Delete partners function
												deletePartners()
										?>
									
									<?php endif; ?>	
								
								</div>
						</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>