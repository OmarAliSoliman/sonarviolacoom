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
	
	
?>

	<div class="main-panel">
	    <div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="page-title">Pages</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Pages</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Page</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><!--Create Page--> &nbsp;</h4>
										
										<a href="?new-page" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i> New Page
										</a>
									</div>
									
									<div class="card-body">

									<!-------  	If : Insert New Page	 ------>
									<?php if ($_SERVER['QUERY_STRING'] == 'new-page') : ?>
									<div class="col-md-12 mb-5">
									<!---------  Add Page Form -------------->	
										<div>
											<?php
												# --- Insert Pages Function
												insertPages(); 
											
												echo $msg_sucs;
												echo $msg;
											?>
											<form action="" method="post">
												<div class="row">
													<div class="col-sm-12">
															
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
																	<!--	<label class="col-md-3 col-form-label"> Page Name :   </label>   -->
																	<label class="col-md-2" for="page_name"> Page Title </label>
																	<div class="col-md-4">
																		<input type="text" name="page_name" id="page_name" class="form-control col-md-6 input-full mb-3" placeholder="Enter page name.."> 
																	</div>
																</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="page_slogan"> Page Slogan </label>
																	<div class="col-md-4">
																		<input type="text" name="page_slogan" id="page_slogan" class="form-control col-md-6 input-full mb-3"  placeholder=" Enter page Slogan "> 
																	</div>
																</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="editor"> Page Content </label>
																	<div class="col-md-10">
																		<textarea class="form-control" name="page_content" cols="30" rows="20" id="editor">  </textarea>
																	</div>
																</div>
															</div>
															
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																<div class="form-group form-inline">
																	<label class="col-md-2" for="page_name_ar"> Arabic Title </label>
																	<div class="col-md-4">
																		<input type="text" name="page_name_ar" id="page_name_ar" class="form-control col-md-6 input-full mb-3 mt-3 rtl" placeholder="إسم الصفحة بالعربي..">
																	</div>
																	</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="editor2"> Arabic Content </label>
																	<div class="col-md-10">
																		<textarea class="form-control" name="page_content_ar" cols="30" rows="20" id="editor2">  </textarea>
																	</div>
																</div>
															</div>
														</div><!--- Tab content --------->
														
														<div class="form-group form-inline">
															<button type="submit" name="submit" id="insert-page" class="btn btn-outline-info mt-3"> <i class="icon-plus"></i> Add Page </button>
														</div>
													</div>
												</div>
											</form>
											<?php echo $msg_del_sucs; ?>
										</div>
										
									</div>
									
									<!-------  	ElseIf : Edite Page	 ------>
									<?php elseif (isset($_REQUEST['edit']) && !empty($_REQUEST['edit'])) : ?>
	
										<!---------  Update Page Form -------------->	
										<!--	<div class="col-md-6 float-right">  -->
										<div class="mb-5">
										<?php
											echo $msg_up_sucs;
											echo $msg2;

											if(isset($_GET['edit']))
											{
												$upPageId = $_GET['edit'];
											
												# --- Update page function 
													updatePages(); 
										?>		
												<form action="" method="post">
													<div class="row">
														<div class="col-sm-12">
																
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
																	<!--	<label class="col-md-3 col-form-label"> Page Name :   </label>   -->
																<!--	<label class=""> Update page : <span class="text-info"> <?php echo $pg_name; ?> </span>  </label>-->
																	<label class="col-md-2" for="page_name"> Page Title </label>  
																	<div class="col-md-4">
																		<input type="text" name="page_name" id="page_name" class="form-control col-md-6 input-full mb-3" value="<?php echo $pg_name; ?>" placeholder="Enter page name.."> 
																	</div>
																</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="page_slogan"> Page Slogan </label>
																	<div class="col-md-4">
																		<input type="text" name="page_slogan" id="page_slogan" class="form-control col-md-6 input-full mb-3" value="<?php echo $pg_slogan; ?>" placeholder=" Enter page Slogan "> 
																	</div>
																</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="editor"> Page Content </label>
																	<div class="col-md-10">
																		<textarea class="form-control" name="page_content" cols="30" rows="20" id="editor">  <?php echo $pg_content; ?>   </textarea>
																	</div>
																</div>
															</div>
															
															<!-------  Tab 2 : Aditional Arabic Fields ------------------------------------------------------->
															<div class="tab-pane fade show " id="Arabic" role="tabpanel">
																<div class="form-group form-inline">
																	<label class="col-md-2" for="page_name_ar"> Arabic Title </label>
																	<div class="col-md-4">
																		<input type="text" name="page_name_ar" id="page_name_ar" class="form-control col-md-6 input-full mb-3 mt-3 rtl" value="<?php echo $pg_name_ar; ?>" placeholder="إسم الصفحة بالعربي..">
																	</div>
																	</div>
																<div class="form-group form-inline">
																	<label class="col-md-2" for="editor2"> Arabic Content </label>
																	<div class="col-md-10">
																		<textarea class="form-control" name="page_content_ar" cols="30" rows="20" id="editor2"> <?php echo $pg_content_ar; ?> </textarea>
																	</div>
																</div>
															</div>
														</div><!--- Tab content --------->
														 
														<div class="form-group form-inline">
															<button type="submit" name="update" id="update-page" class="btn btn-outline-info mt-3 "> <i class="icon-refresh"></i> Update </button>
														</div>
																
														</div>
													</div>
												</form>
												<?php echo $msg_del_sucs; ?> 
												<?php
												}
											?>
											
										</div>
									</div>
									
									
									<?php else: ?>	<!-------  	Else : Show Listing Pages	 ------>
										
										<!----------  Listing pages  ------------------------------->
										<div class="col-md-12" style=" display: flex; ">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">Page Name</th>
														<th scope="col">Page Slogan</th>
														<th style="width: 10%">Action</th>
													</tr>
												</thead>
												<tbody>
									   
											<?php
													# --- Pages listing ...
													getAllPages();
											?>
												   
												</tbody>
											</table>
										</div>
										
										
										
										<?php
												# --- Delete pages function
												deletePages()
										?>
									
									<?php endif; ?>	
								
								</div>
						</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>