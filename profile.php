<?php 
include('session.php');
?>
<html>
	
	<!-- THE HEADER -->
<?php include('header.php');
 ?>

	<!-- MAIN CONTENT -->
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
			<?php
			if(isset($_GET['p_user_id']))
			{
				$p_user_id=$_GET['p_user_id'];

			?>
				<div class="col-xs-12 col-md-4 left-feild">
					<div class="be-user-block style-3">
						
							<?php	
							$sql=mysqli_query($conn, "Select * from user where user_id=$p_user_id");
						while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC)) { ?>
						<div class="be-user-detail">
							<a class="be-ava-user style-2" href="">
								<img src="displayimg/<?php echo $row['pp_file'] ;?>" alt="<?php echo $row['f_name'].' '. $row['l_name'] ;?>"> 
							</a>
							
							<p class="be-use-name">
							<?php echo $row['f_name'].' '. $row['l_name'] ;?>

						</p>
							<div class="be-user-info">
								<?php echo $row['add_street'].', '. $row['add_city'].', '.$row['add_country'] ;
						?>
							</div>		
						<div class="be-user-info">
								<?php echo $row['institution'];?>
							</div>	
							
						<div class="be-user-info">
								<?php echo 'Date of Join:'.' '.$row['doj'];
						?>
							</div>	
						</div>
						
						<div class="be-user-statistic">
<div class="stat-row clearfix"><i class="fa fa-user"></i>  Joined Classes<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where user_id=$p_user_id AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>							
							<div class="stat-row clearfix"><i class="fa fa-book"></i>  Created Classes<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*) from class where c_user_id=$p_user_id"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>
						</div>
					</div>
															
				</div>
				<div class="col-xs-12 col-md-8">
                    <div class="tab-wrapper style-1">
                        <div class="tab-nav-wrapper">
                            <div  class="nav-tab  clearfix">
                                <div class="nav-tab-item active">
                                    <span>Created Classes</span>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>Joined Classes</span>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>About</span>
                                </div> 
                               <!-- <div class="nav-tab-item ">
                                    <span>Collections</span>
                                </div>  -->                                                       
                            </div>
                        </div>
                        <div class="tabs-content clearfix">
							<!-- My classes  start -->
		
                            <div class="tab-info active"> 
							
							<div class="row">
							<?php 
		
		$sql_class=mysqli_query($conn, "Select * from class where c_user_id = $p_user_id ORDER BY doc");
		if(mysqli_num_rows($sql_class)!=0){
		while ($class_row = mysqli_fetch_array($sql_class, MYSQLI_ASSOC)){
	  ?>
									<div class="col-ml-12 col-xs-6 col-sm-4">
										<div class="be-post">
											<a href="class.php?class_id=<?php echo $class_row['class_id']; ?>" class="be-img-block">
											
											<img src="displayimg/<?php echo $class_row['cp_file']; ?>" alt="omg">
											</a>
											<a href="class.php?class_id=<?php echo $class_row['class_id']; ?>" class="be-post-title"><?php echo $class_row['class_name']; ?></a>
											<span>
												<span class="be-post-tag">Category: <?php 
												$sql_cat=mysqli_query($conn, "Select cat_name from category where cat_id = $class_row[class_cat_id]");
												while ($cat_row = mysqli_fetch_array($sql_cat, MYSQLI_ASSOC)){
												echo $cat_row['cat_name'];  } ?>
												</span>
																							
											</span>
											<span>
												Type: <?php echo $class_row['class_type']; ?>
																							
											</span>
											<div class="author-post">
											
												<?php 
												$sql_user=mysqli_query($conn, "Select user_id, f_name, l_name from user where user_id = $p_user_id");
												while ($user_row = mysqli_fetch_array($sql_user, MYSQLI_ASSOC)){ ?>
													<span>by <a href="profile.php?p_user_id=<?php echo $user_row['user_id']; ?>">
												<?php echo $user_row['f_name'].' '.$user_row['l_name'];  } ?>
												</a></span>
											</div>
											<div class="info-block">
												<span>Students: <?php
$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where class_id=$class_row[class_id] AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?>
												</span>
											</div>
										</div>									
									</div>
		<?php } } else echo "<div id='failquiz'>No classes created yet.</div>"; ?>
									
                            </div>
							</div>
							
							<!-- My classes end -->
							
                            <div class="tab-info">
								<div class="row">
							<?php 
		
		$sql_class=mysqli_query($conn, "Select class_id, doj from join_class where user_id = $p_user_id AND j_status=1 ORDER BY doj");
		if(mysqli_num_rows($sql_class)!=0){
		while ($class_row = mysqli_fetch_array($sql_class, MYSQLI_ASSOC)){
			$sql_join=mysqli_query($conn, "Select * from class where class_id=$class_row[class_id]");
			while ($join_row=mysqli_fetch_array($sql_join, MYSQLI_ASSOC)) {
			
	  ?>
									<div class="col-ml-12 col-xs-6 col-sm-4">
										<div class="be-post">
											<a href="class.php?class_id=<?php echo $join_row['class_id']; ?>" class="be-img-block">
											
											<img src="displayimg/<?php echo $join_row['cp_file']; ?>" alt="omg">
											</a>
											<a href="class.php?class_id=<?php echo $join_row['class_id']; ?>" class="be-post-title"><?php echo $join_row['class_name']; ?></a>
											<span>
												<span class="be-post-tag">Category: <?php 
												$sql_cat=mysqli_query($conn, "Select cat_name from category where cat_id = $join_row[class_cat_id]");
												while ($cat_row = mysqli_fetch_array($sql_cat, MYSQLI_ASSOC)){
												echo $cat_row['cat_name'];  } ?>
												</span>
																							
											</span>
											<span>
												Type: <?php echo $join_row['class_type']; ?>
																							
											</span>
											<span>
												Joined on: <?php echo $class_row['doj']; ?>
																							
											</span>
											<div class="author-post">
												
												<?php 
												$sql_user=mysqli_query($conn, "Select user_id, f_name, l_name from user where user_id = $join_row[c_user_id]");
												while ($user_row = mysqli_fetch_array($sql_user, MYSQLI_ASSOC)){ ?>
												<span>by <a href="profile.php?p_user_id=<?php echo $user_row['user_id']; ?>">
												<?php echo $user_row['f_name'].' '.$user_row['l_name'];  } ?>
												</a></span>
											</div>
											<div class="info-block">
												<span>Students: <?php
$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where class_id=$class_row[class_id] AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span>
											</div>
										</div>									
									</div>
		<?php } } } else echo "<div id='failquiz'>No classes joined yet.</div>"; ?>
									
                            </div>
                            </div>
                            <div class="tab-info">
								<div class="row">
							<div class="be-large-post-align">								
							<?php echo $row['about_me']; ?>
							</div>																										
								</div>                                                                 
                            </div>
						
                         <!--  <div class="tab-info">
                            	<div class="row">
								What?
								</div> -->
                            </div>                          
                        </div>
                    </div> 			
			<?php } } 
			else {
				echo "<div id='failquiz'>No user selected.</div>";
			}
			?>						
				</div>				
			</div>
		</div>
	</div>
						


		<?php include('footer.php'); ?>

	<div class="be-fixed-filter"></div>	
	</body>
</html>