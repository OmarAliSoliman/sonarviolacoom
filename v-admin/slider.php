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
	
	$slide_title ='';
	$slide_description ='';
	$slide_title_ar ='';
	$slide_description_ar ='';
	
?>

	<div class="main-panel">
	    <div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="post-title">Slider</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Slider</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Slide</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><!--Create Slide--> &nbsp;</h4>
										
										<a href="?new-slide" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i> New Slide
										</a>
									</div>
									
									<div class="card-body">

									<!-------  	If : Insert New Slide	 ------>
									<?php if ($_SERVER['QUERY_STRING'] == 'new-slide') : ?>
									<div class="col-md-12 mb-5">
									<!---------  Add Slide Form -------------->	
										<div>
											<?php
												# --- Insert Slider Function
												insertSlider(); 
											
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
														
																<div class="form-group form-inline">
																  <label for="slide_title" class="col-md-2 control-label"> Slide Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control w-100" id="slide_title" name="slide_title" value="<?php echo $slide_title; ?>" placeholder="Add slide title">
																  </div>
																</div>
															
															
																<div class="form-group form-inline">
																  <label for="editorXXX" class="col-md-2 control-label"> Description </label>
																  <div class="col-md-10">
																	<textarea rows="6" class="form-control  w-100" id="editorXXX" name="slide_description">  <?php echo $slide_description; ?> </textarea>
																  </div>
																</div>
																														
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
																
																 <!-- for uploading images in tinymce -->
																 <input name="image" type="file" id="upload" class="d-none" onchange="">
																
																<div class="form-group form-inline">
																  <label for="slide_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-10">
																	<input type="text" class="form-control w-100" id="slide_link" name="slide_link" value="<?php echo $slide_link; ?>" placeholder="http://www.example.com/id=1">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="p_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="p_status" name="slide_status">
																		<option value="published"> Publish </option>
																		<option value="draft"> Draft </option>
																	</select>
																  </div>
																</div>   
															</div>
															
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="slide_title_ar" class="col-md-2 control-label"> Arabic Slide Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl w-100" id="slide_title_ar" name="slide_title_ar" value="<?php echo $slide_title_ar; ?>" placeholder="أضف عنوان السلايد بالعربي..">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="mytextarea" class="col-md-2 control-label"> Arabic Description </label>
																  <div class="col-md-10">
																	<textarea rows="8" class="form-control w-100" id="editor2XXX" name="slide_description_ar">  <?php echo $slide_description_ar; ?> </textarea>
																  </div>
																</div>																
															</div>
															
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="submit" id="submit" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Slide </button>
															</div>
														</div>														
													</div>
												</div>
											</form> <!---------------------->
											
											
											<?php echo $msg_del_sucs; ?>
										</div>
										
									</div>
									
									<!-------  	ElseIf : Edit Slide	 ------>
									<?php elseif (isset($_REQUEST['edit']) && !empty($_REQUEST['edit'])) : ?>
	
										<!---------  Update Slide Form -------------->	
										<!--	<div class="col-md-6 float-right">  -->
										<div class="mb-5">
										<?php
											echo $msg_up_sucs;
											echo $msg;
											echo $msg2;

											if(isset($_GET['edit']))
											{
												$upSlideId = $_GET['edit'];
											
												# --- Update slide function 
													updateSlider();  
										?>		
										
											<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-12">
														
														<!-- view button -->
														<!-- <a href="../slide.php?p_id=<?php echo $slide_id; ?>" class="btn btn-success float-right" target="_blank"><i class="lni-eye"></i></a>
														 -->
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
																   
																  <!--  <label for="p_image" class="col-md-2 control-label"> Image </label>  -->
																  <div class="col-md-5 float-right mt-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																  <div class="col-md-5 mt-3" >
																	<img src="../<?php if($slide_image == NULL){ echo 'assets/img/no-image.jpg';} else {echo $slide_image;} ?>" class="img-thumbnail"/></td>
																  </div>
																</div>
												<!--------------------------------------------------------------------------->
																
																<div class="form-group form-inline">
																  <label for="slide_title" class="col-md-2 control-label"> Slide Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control w-100" id="slide_title" name="slide_title" value="<?php echo $slide_title; ?>" placeholder="Add slide title">
																  </div>
																</div>
															
															
																<div class="form-group form-inline">
																  <label for="editorXXX" class="col-md-2 control-label"> Description </label>
																  <div class="col-md-10">
																	<textarea rows="6" class="form-control  w-100" id="editorXXX" name="slide_description"><?php echo $slide_description; ?> </textarea>
																  </div>
																</div>
																<!--															
																<div class="form-group form-inline">
																  <label for="p_image" class="col-md-2 control-label"> Image </label>
																  <div class="col-md-5">
																	<input type="file" id="p_image" name="p_image">
																  </div>
																</div>
																-->
																 <!-- for uploading images in tinymce -->
																 <input name="image" type="file" id="upload" class="d-none" onchange="">
																
																<div class="form-group form-inline">
																  <label for="slide_link" class="col-md-2 control-label"> Button Link </label>
																  <div class="col-md-10">
																	<input type="text" class="form-control w-100" id="slide_link" name="slide_link" value="<?php echo $slide_link; ?>" placeholder="http://www.example.com/id=1">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="p_status" class="col-md-2 control-label">  Status </label>
																  <div class="col-md-2">
																	<select class="form-control" id="p_status" name="slide_status">
																		<option value="published" <?php if($slide_status == 'published'){ echo 'selected';} ?> > Published </option>
																		<option value="draft" <?php if($slide_status == 'draft'){ echo 'selected';} ?> > Draft </option>
																	</select>
																  </div>
																</div>   
															</div>
																
												<!----------------------------------------------------------------->
																
														
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																
																<div class="form-group form-inline">
																  <label for="p_title" class="col-md-2 control-label"> Arabic Slide Title </label>
																  <div class="col-md-4">
																	<input type="text" class="form-control rtl w-100" id="p_title" name="slide_title_ar" value="<?php echo $slide_title_ar; ?>" placeholder="أضف عنوان السلايد بالعربي..">
																  </div>
																</div>
																
																<div class="form-group form-inline">
																  <label for="editor2XX" class="col-md-2 control-label"> Arabic Content </label>
																  <div class="col-md-10">
																	<textarea rows="8" class="form-control rtl w-100" id="editor2XX" name="slide_description_ar"><?php echo $slide_description_ar; ?> </textarea>
																  </div>
																</div>																
															</div>
															
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<div class="col-md-offset-2 col-md-10">
																<button type="submit" name="update" id="update-slide" class="btn btn-outline-info mt-3 "> <i class="icon-refresh"></i> Update </button>
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
									
									
									<?php else: ?>	<!-------  	Else : Show Listing Slider	 ------>
										
										<!----------  Listing slides  ------------------------------->
										<div class="col-md-12" style=" display: flex; ">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">Title</th>
														<th scope="col">Image</th>
														<th scope="col">Status</th>
														<th style="text-align: center;">Action</th>
													</tr>
												</thead>
												<tbody>
									   
											<?php
													# --- Slider listing ...
													getAllSlider();
											?>
												   
												</tbody>
											</table>
										</div>
										
										
										
										<?php
												# --- Delete slides function
												deleteSlider()
										?>
									
									<?php endif; ?>	
								
								</div>
						</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>