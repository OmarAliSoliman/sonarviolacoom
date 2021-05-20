<?php include_once("session.php"); ?>  <!-- session.php including config.php -->
<?php include_once("functions.php"); ?>


<?php
	$prefix = '';
	$lang = 'en'; 	// default language : change multilange to 1 langue (english)
	
	
	// return to login page if user isnt logged or isnt admin
	
	if(basename($_SERVER['PHP_SELF']) != 'login.php')
	{
		if(!isset($_SESSION['u_id']) OR  ($_SESSION['u_role'] != 'admin' AND  $_SESSION['u_role'] != 'sup-admin') )
		{
			header("Location: login.php");
			//echo 'not logged';
		}
	}



	# --- Redirect to ads.php if the current page is index.php (Maintenance Mode)
	if($currentPage == 'index.php')
	{
		header("Location: services.php");
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo $site_name; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!--<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/> -->
	<link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.min.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	
	
	<!-- Line Icon -->
    <link rel="stylesheet" type="text/css" href="../assets/fonts/line-icons.css">
	
	<!--  ckeditor 5  -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script> 
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>-->

	
</head>
<body>
	<div class="wrapper">
		
		<?php  if($currentPage != 'login.php') : ?>  	<!-- dont show navbar in login page .. --> 
		
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.php" class="logo">
				<!--	<img src="../<?php echo $site_logo; ?>" alt="navbar brand" class="navbar-brand w-150">   -->
					<img src="../assets/img/logo_icon.png" alt="navbar brand" class="navbar-brand iconic-logo">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<!-- <form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form> -->
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
					<!--		<a class="nav-link dropdown-toggle" href="contact.php" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  -->
							<a class="nav-link dropdown-toggle" href="contact.php" role="button">
								<i class="fa fa-envelope"></i>
						<?php
							$all_msgs_query = mysqli_query($db_connect, "SELECT * FROM contact");
							$count_all_msgs = mysqli_num_rows($all_msgs_query);
						?>
							<span class="notification"> <?php echo $count_all_msgs; ?> </span>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Messages 									
										<a href="#" class="small">Mark all as read</a>
									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-img"> 
													<img src="assets/img/jm_denis.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Jimmy Denis</span>
													<span class="block">
														How are you ?
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						  
						
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
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../<?php echo $userImage; ?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									
								
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../<?php echo $userImage; ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $userName; ?></h4>
												<p class="text-muted"><?php echo $userEmail; ?></p><a href="users.php?action=edit&user_id=<?php echo $uid; ?>" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="users.php?action=edit&user_id=<?php echo $uid; ?>">My Profile</a>
										<!--<a class="dropdown-item" href="#">My Balance</a>  -->
										<a class="dropdown-item" href="contact.php">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="settings.php">Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="logout.php?id=<?php echo $_SESSION['u_id']; ?>">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		
		<?php endif; ?>