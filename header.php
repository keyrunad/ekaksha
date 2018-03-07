<head>
		<title>eKaksha</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="img/favicon.png">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="font/css/font-awesome.min.css">
		<link rel="stylesheet" href="style/icon.css">
		<link rel="stylesheet" href="style/loader.css">
		<link rel="stylesheet" href="style/idangerous.swiper.css">
		<link rel="stylesheet" href="style/jquery-ui.css">
		<link rel="stylesheet" href="style/stylesheet.css">
		<link rel="stylesheet" href="style/bootstrap.min.css">
		<link rel="stylesheet" href="style/bootstrap.css">
		<!--[if lt IE 10]>
			<link rel="stylesheet" type="text/css" href="style/ie-9.css" />
		<![endif]-->		
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
	</head>
	<body >

	<!-- THE LOADER -->

<!-- <div class="be-loader">
    	<div class="spinner">
			<img src="img/logo-loader.png"  alt="">
			<p class="circle">
			  <span class="ouro">
			    <span class="left"><span class="anim"></span></span>
			    <span class="right"><span class="anim"></span></span>
			  </span>
			</p>
		</div>
    </div> -->
	<!-- THE HEADER -->
	<header>
	
		
		 <div class="container-fluid custom-container">
			<div class="row no_row row-header">
				<div class="brand-be">
					<a href="index.php">
						<img class="logo-c active be_logo" style="float: left !important;"  src="img/logo.png" alt="logo">
					</a>
				</div>
	
	
	<?php if(!isset($_SESSION['ekaksha']))
		{ ?>
	
			
			<div class="login-header-block">
					<div class="login_block">
					<a class="btn-login btn color-1 size-2 hover-2" style="font-weight: bold; font-size: 14px;" ><i class="fa fa-user" style="font-weight: bold; font-size: 14px; color: white;"></i>
						Log in</a>
					</div>	
	
			</div> 
		
	<?php 
		}
	else {   
	 ?>
	
	 <div class="login-header-block">
					<div class="login_block">																		
							<?php  	
						$sql=mysqli_query($conn, "Select * from user where user_id=$ekaksha_session");
						while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC)){ ?>
						<a style="color: white; margin-right: 20px; font-size: 20px;" href="search.php" title="Search Classes"><i class="fa fa-search"></i></a>						
						<a style="color: white; margin-right: 20px; font-size: 20px;" href="create-class.php" title="Create New Class"><i class="fa fa-plus" aria-hidden="true"></i></a>
						<a class="btn color-1 size-2 hover-2" style="margin-top: -5px !important; font-weight: bold;" href="logout.php">LOG OUT</a>
						
						<div class="be-drop-down login-user-down">
						
							<img class="login-user" src="displayimg/<?php echo $row['pp_file'] ;?>" alt="">
							<span class="be-dropdown-content" style="color: white;">Hi, <span>
							<?php echo $row['f_name'] ; ?>
						<?php } ?>
						</span></span>
							<div class="drop-down-list a-list">
							<a href="profile.php?p_user_id=<?php echo $ekaksha_session; ?>" style="color: #0d58c8 !important; background: white !important;">My Profile</a>
								<a href="account.php" style="color: #0d58c8 !important; background: white !important;">My Account</a>
								<a href="logout.php" style="color: #0d58c8 !important; background: white !important;">Log Out</a>
							</div>
						</div>
					</div>	
				</div>			
			</div>
		</div>
			<?php 
		}
?>


				
			</div>
		</div>
	
	</header>