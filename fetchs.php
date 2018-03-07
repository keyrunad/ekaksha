		<?php 
		include('session.php');
		if((!isset($_POST['searchs'])==true)||empty($_POST['searchs'])){
		$sql_class=mysqli_query($conn, "Select * from class WHERE c_status = 'Active' AND c_user_id != $ekaksha_session ORDER BY doc");
		}
		else {
		$keyword=mysqli_real_escape_string($conn,$_POST['searchs']);
		$sql_class=mysqli_query($conn, "Select * from class WHERE c_status = 'Active' AND c_user_id != $ekaksha_session AND class_name like '%$keyword%' ORDER BY doc");
		}
		if(mysqli_num_rows($sql_class)) {
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
		<?php } } else echo "<div id='failindex'>No results found</div>"; ?>