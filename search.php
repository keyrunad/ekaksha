<?php 
include('session.php');
?>
<html>
	<?php include('header.php'); ?>
	<!-- MAIN CONTENT -->
	<div id="content-block">
		<br>
		<br>
		<div class="container-fluid custom-container">
			<div class="row">

				<div class="col-md-2 left-feild">
				
				<div class="input-search">
				<h3 class="letf-menu-article">
							Search
						</h3>
						<input name="search_text_s" id="search_text_s" type="text" placeholder="Enter Class Name">
					</div>			
				</div>

				<div class="col-md-10" style="min-height:550px;">
					<div id="container-mix"  class="row _post-container_">
					<div id="searchresult_s">
				<?php 
		$sql_class=mysqli_query($conn, "Select * from class WHERE c_user_id != $ekaksha_session AND c_status = 'Active' ORDER BY doc");
		while ($class_row = mysqli_fetch_array($sql_class, MYSQLI_ASSOC)){
	  ?>
						<div class="category-1 custom-column-5">
						<div class="be-post">
											<a href="class.php?class_id=<?php echo $class_row['class_id']; ?>" class="be-img-block">
											
											<img src="displayimg/<?php echo $class_row['cp_file']; ?>">
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
												<span>by <a href="profile.php?p_user_id=<?php echo $class_row['c_user_id']; ?>">
												<?php 
												$sql_user=mysqli_query($conn, "Select f_name, l_name from user where user_id = $class_row[c_user_id]");
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
						<?php } ?>
				
				</div>  
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- THE FOOTER -->
	<?php include('footer.php'); ?>
	<div class="be-fixed-filter"></div>
	</body>
</html>