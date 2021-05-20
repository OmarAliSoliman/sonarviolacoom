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
					<h4 class="page-title">Post Categories</h4>
					<ul class="breadcrumbs">
						<li class="nav-home"> <a href="#"><i class="flaticon-home"></i></a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">Categories</a></li>
						<li class="separator"><i class="flaticon-right-arrow"></i></li>
						<li class="nav-item"><a href="#">New Category</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
								<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Create New Category</h4>
									</div>
									
									<div class="card-body">
									
									<!---------  Add Category Form -------------->	
										<div class="col-md-6">
											
											
											<!---- insert category function -->
											<?php
												# --- Insert Categories Function
												insertCategories(); 
											
												echo $msg_sucs;
												echo $msg;
											?>
											<form action="" method="post">
												<div class="row">
													<div class="col-sm-12">
															<div class="form-group">
																<label class="col-md-3 col-form-label"> Category Name</label>
																<input type="text" name="cat_name" id="cat_name" class="form-control input-full" placeholder="Enter category name.."> 
																<input type="text" name="cat_name_ar" id="cat_name_ar" class="form-control input-full rtl mt-3" placeholder=" إسم التصنيف بالعربي.. "> 
																<button type="submit" name="submit" id="submit-category" class="btn btn-outline-info btn-sm mt-3"> <i class="icon-plus"></i> Add Category</button>
															</div>
													</div>
												</div>
											</form>
											<?php echo $msg_del_sucs; ?>
										</div>
										
										<!---------  Update Category Form -------------->	
										<div class="col-md-6 float-right">
										<?php
											echo $msg_up_sucs;
											echo $msg2;

											if(isset($_GET['edit']))
											{
												$upCategoryId = $_GET['edit'];
											
												# --- Update category function 
													updateCategories(); 
										?>		
												<form action="" method="post">
													<div class="row">
														<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-md-3 col-form-label"> Update category : <span class="text-info"> <?php echo $cat_name?> </span>  </label>
																	<input type="text" name="cat_name" id="cat_name" class="form-control input-full" value="<?php echo $cat_name?>" placeholder="Enter category name.."> 
																	<input type="text" name="cat_name_ar" id="cat_name_ar" class="form-control input-full rtl mt-3" value="<?php echo $cat_name_ar?>" placeholder=" إسم التصنيف بالعربي.. ">
																	<button type="submit" name="update" id="update-category" class="btn btn-outline-info btn-sm mt-3"> <i class="icon-refresh"></i> Update </button>
																</div>
														</div>
													</div>
												</form>
												<?php echo $msg_del_sucs; ?>
												<?php
													
												}
											?>
											
										</div>
										
										
										<!----------  Listing categories  ------------------------------->
										<div class="col-md-6 float-right">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">Category</th>
														<th style="width: 10%">Action</th>
													</tr>
												</thead>
												<tbody>
									   
											<?php
													# --- Categories listing ...
													getAllCategories();
											?>
												   
												</tbody>
											</table>
										</div>
										
										
										
										<?php
												# --- Delete categories function
												deleteCategories()
										?>
										
									</div>
								</div>
					</div>
					
				</div>
				
			</div>
	    </div>
	    
<?php include_once "inc/footer.php"; ?>