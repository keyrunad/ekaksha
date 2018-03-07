<?php 
include('session.php');
?>
<html>
	
	<!-- THE HEADER -->
<?php include('header.php'); ?>

	<!-- MAIN CONTENT -->
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-4 left-feild">
					<div class="be-user-block style-3">
						
							<?php
							$sql=mysqli_query($conn, "Select * from user where user_id=$ekaksha_session");
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
<br>						<form action="edit-account.php" method="POST">
							<input type="submit" name="edit_account" class="btn color-1 size-2 hover-1 btn-center"  value="EDIT" />						
						</form>					
						</div>
						
						<div class="be-user-statistic">
<div class="stat-row clearfix"><i class="fa fa-user"></i>  Joined Classes<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where user_id=$ekaksha_session AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>							
							<div class="stat-row clearfix"><i class="fa fa-book"></i>  Created Classes<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*) from class where c_user_id=$ekaksha_session"
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
                                    <span>My Classes</span>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>Joined Classes</span>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>About Me</span>
                                </div> 
                               <div class="nav-tab-item ">
                                    <span>Recent Acitivy</span>
                                </div>                                                     
                            </div>
                        </div>
                        <div class="tabs-content clearfix">
							<!-- My classes  start -->
		
                            <div class="tab-info active"> 
							
							<div class="row">
							<?php 
		
		$sql_class=mysqli_query($conn, "Select * from class where c_user_id = $ekaksha_session ORDER BY doc");
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
												Status: <?php echo $class_row['c_status']; ?>										
											</span>
											<span>
												Type: <?php echo $class_row['class_type']; ?>
																							
											</span>
											<div class="author-post">
												<span>by <a href="profile.php?p_user_id=<?php echo $class_row['c_user_id']; ?>">
												<?php 
												$sql_user=mysqli_query($conn, "Select f_name, l_name from user where user_id = $ekaksha_session");
												while ($user_row = mysqli_fetch_array($sql_user, MYSQLI_ASSOC)){
												echo $user_row['f_name'].' '.$user_row['l_name'];  } ?>
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
		<?php } } else echo "<div id='failquiz'>You have not created any classes yet.</div>"; ?>
									
                            </div>
							</div>
							<!-- My classes end -->
                            <div class="tab-info">
								<div class="row">
							<?php 
		
		$sql_class=mysqli_query($conn, "Select class_id, doj from join_class where user_id = $ekaksha_session AND j_status=1 ORDER BY doj");
		if(mysqli_num_rows($sql_class)!=0){
		while ($class_row = mysqli_fetch_array($sql_class, MYSQLI_ASSOC)){
			$sql_join=mysqli_query($conn, "Select * from class where class_id=$class_row[class_id] AND c_status='Active'");
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
												<span>by <a href="profile.php?p_user_id=<?php echo $join_row['c_user_id']; ?>">
												<?php 
												$sql_user=mysqli_query($conn, "Select f_name, l_name from user where user_id = $join_row[c_user_id]");
												while ($user_row = mysqli_fetch_array($sql_user, MYSQLI_ASSOC)){
												echo $user_row['f_name'].' '.$user_row['l_name'];  } ?>
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
		<?php } } } else echo "<div id='failquiz'>You have not joined any classes yet.</div>";?>
									
                            </div>
                            </div>
                            <div class="tab-info">
								<div class="row">
							<div class="be-large-post-align">								
							<?php echo $row['about_me']; ?>
							</div>																										
								</div>                                                                 
                            </div>
                          <div class="tab-info">
                            	<div class="row">
								<div class="accactivitylist">
								<div class="form-label" style="font-weight: bold; font-size: 18px;">Recent activity in classes you have joined</div>
								<?php
								$sql_activity=mysqli_query($conn, "Select * from join_class JOIN activity ON join_class.class_id=activity.class_id WHERE join_class.user_id=$ekaksha_session AND join_class.j_status=1  ORDER BY activity.activity_date DESC LIMIT 0 , 10");
								if(mysqli_num_rows($sql_activity)!=0){
								while ($class_activity = mysqli_fetch_array($sql_activity, MYSQLI_ASSOC)){
								?>
								<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
								<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 5px !important; border-radius: 10px !important;">			
								<div class="be-post" style="margin-left: 15px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 0px solid #fff; margin-bottom: 0px !important; padding-bottom: 0px !important; padding-right: 22px !important; color: #0d58c8;">
								<?php $class_act_id=$class_activity['class_id'];
								$sql_class_act=mysqli_query($conn, "Select class_name from class where class_id=$class_act_id");
								$sql_class_name=mysqli_fetch_assoc($sql_class_act);
								?>
								<a href="class.php?class_id=<?php echo $class_act_id; ?>">
								<?php echo $class_activity['activity_content']." in class <strong><q>".$sql_class_name['class_name']."</q></strong>"; ?>
								</a>
								</div> <span style="float: right; color: #222;">
								<i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php 
								$date_activity=strtotime($class_activity['activity_date']);
								echo date('Y-m-d H:i', $date_activity); ?>								
								</span>
								</div>
								</div>
								<?php } if(mysqli_num_rows($sql_activity)>=10){ ?> 
								<li class="loadbutton"><button class="loadmore" id="loadmoreaccact" data-page="2">Load More</button></li>
								<?php }} else echo "<div id='failquiz'>No activity yet.</div>"; ?>
								</div>
								</div>
                            </div>                          
                        </div>
                    </div> 				
				</div>				
			</div>
		</div>
	</div>
						<?php } ?>


		<?php include('footer.php'); ?>

	<div class="be-fixed-filter"></div>
	</body>
</html>