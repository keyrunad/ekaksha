<?php 
include('session.php');
include('functions.php');
?>
<html>
<?php include('header.php'); ?>

<?php

if(isset($_POST['btn_sub'])){
	$classname= mysqli_real_escape_string($conn, $_POST['classname']);
	$category= mysqli_real_escape_string($conn, $_POST['category']);
	$classtype= mysqli_real_escape_string($conn, $_POST['classtype']);
	$aboutclass= mysqli_real_escape_string($conn, $_POST['aboutclass']);
	$doc=date("y-m-d");
	$invitecode=generateInviteCode(4);
	$userid=$ekaksha_session;
	$status='Active';
	$file='noone.png';
	$sql_ins=mysqli_query($conn, "INSERT INTO class 
						VALUES(
							NULL,
							'$classname',
							'$category' ,
							'$classtype',
							'$doc',
							'$invitecode',
							'$userid',
							'$status',	
							'$file',
							'$aboutclass'
							
							
							)
					");
	
					if($sql_ins==true){
					$msg = "<div id='success'>Class Added.</div>";
	
									}
					else
					$msg = "<div id='fail'>Insert Error</div>";


}
	
?>

	<!-- MAIN CONTENT -->
	
	
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-3 left-feild">
					<div class="be-vidget back-block">
						<a class="btn full color-1 size-1 hover-1" href="account.php">My Account</a>
					</div>

				</div>
				
				
				
				<div class="col-xs-12 col-md-9 _editor-content_">
					
					<form method="POST">
						<div class="be-large-post">
						<?php
if (isset($msg)){ echo $msg;}
?>
							<div class="info-block style-2">
								<div class="be-large-post-align "><h3 class="info-block-label">Create Class</h3></div>
							</div>
							
							
							<div class="be-large-post-align">
								<div class="row">
									<div class="input-col col-xs-12 col-sm-6">
										<div class="form-group fg_icon focus-2">
											<div class="form-label">Class Name</div>
											<input class="form-input" type="text" maxlength="100" name="classname" value="">
										</div>							
									</div>
								

									<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Category</div>	
											<select class="be-custom-select" name="category">
											<?php $sql=mysqli_query($conn, "SELECT cat_id, cat_name FROM category"); 
while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
echo "<option value=$row[cat_id]>$row[cat_name]</option>"; 
}
?>
											
								
							</select>
										</div>								
									</div>
									

							<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Class Type</div>	

																	
											<select class="be-custom-select" name="classtype">
								<option value="Online">Online</option>
								<option value="On-Campus">On-Campus</option>
							</select>
										</div>								
									</div>
								
							<div class="sec"  data-sec="about-me" >
						<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">About Class</div>	
											<em>This is what persuades students to join your class. Make sure to enter everything about your class and the topics you will be covering in this class.</em>
											<textarea class="form-input" maxlength="800" name="aboutclass" required=""></textarea>
										</div>
										</div>
					</div>
									
								<div class="col-xs-12">
								<br>
										<input type="submit" name="btn_sub" class="btn color-1 size-2 hover-1 btn-right" value="Create" />
									</div>	
									</form>	
									
																
								</div>
							</div>
						</div>
					
				</div>				
			</div>
			
					
			
                                    
			</form>
		</div>
	</div>

	<?php include('footer.php'); ?>
	<div class="be-fixed-filter"></div>	
	</body>
</html>