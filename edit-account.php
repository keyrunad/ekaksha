<?php 
include('session.php');
?>
<html>
	
<?php include('header.php'); ?>

<?php
	
	$id=$ekaksha_session;
	
	if(isset($_POST['upd_cimg'])){
	$submfile = rand(10000,10000000)."-".$_FILES['updcfile']['name'];
	$folder="displayimg/";
	$file_loc = $_FILES['updcfile']['tmp_name'];
	$new_file_name = strtolower($submfile);
	$final_file=str_replace(' ','-',$new_file_name);
	if (($_FILES["updcfile"]["type"] == "image/jpeg")
  || ($_FILES["updcfile"]["type"] == "image/png" ) 
  && ($_FILES["updcfile"]["size"] < 80000))
  {
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	$sql_as=mysqli_query($conn, "UPDATE user
						SET
							pp_file='$final_file'
							WHERE
							user_id=$id
					");
	
				
if($sql_as==true){
	$msg = "<div id='success'>Class image changed successfully.</div>";
}
else
	$msg = "<div id='fail'>Failed to change class image. Try again.</div>";

}
}
else 
	$msg = "<div id='fail'>Only png and jpeg/jpg formats are allowed. Image should be less than 800kb.</div>";
}	


	if(isset($_POST['btn_sub'])){
	$f_name=mysqli_real_escape_string($conn, $_POST['f_name']);
	$l_name=mysqli_real_escape_string($conn, $_POST['l_name']);
	$gender=mysqli_real_escape_string($conn, $_POST['gender']);
	$add_street=mysqli_real_escape_string($conn, $_POST['street']);
	$add_city=mysqli_real_escape_string($conn, $_POST['city']);
	$add_country=mysqli_real_escape_string($conn, $_POST['country']);
	$phone=mysqli_real_escape_string($conn, $_POST['phone']);
	$institution=mysqli_real_escape_string($conn, $_POST['institution']);
	$dob=$_POST['yy'].'-'.$_POST['mm'].'-'.$_POST['dd'];
	$about_me=mysqli_real_escape_string($conn, $_POST['about_me']);
	
	$sql_ins=mysqli_query($conn, "Update user SET
							
							f_name='$f_name',
							l_name='$l_name' ,
							add_street='$add_street',
							add_city='$add_city',
							add_country='$add_country',	
							phone='$phone',
							institution='$institution',
							gender='$gender',
							dob='$dob',
							about_me='$about_me'
							
							WHERE
								user_id=$id
					");
if($sql_ins==true){
	$msg = "<div id='success'>User Information Updated.</div>";
	
}
else
$msg = "<div id='fail'>User Information Failed to Update.</div>";
	
}

?>
	<!-- MAIN CONTENT -->
	
	
	<?php

	$sql_upd=mysqli_query($conn, "SELECT * FROM user WHERE user_id=$id");
	$rs_upd=mysqli_fetch_array($sql_upd, MYSQLI_ASSOC);

$f_nameupd= $rs_upd['f_name'];
	   $l_nameupd= $rs_upd['l_name'];
	   $genderupd=$rs_upd['gender'];
	   $streetupd=$rs_upd['add_street'];
	   $cityupd=$rs_upd['add_city'];
	   $countryupd=$rs_upd['add_country'];
	   $passwordupd=$rs_upd['password'];
	   $phoneupd=$rs_upd['phone'];
	   $institutionupd=$rs_upd['institution'];
	   list($y,$m,$d)=explode('-',$rs_upd['dob']);
	   
if(isset($_POST['change_pw'])){
	$oldpass=mysqli_real_escape_string($conn, $_POST['oldpass']);
	$foldpass=md5($oldpass);
	$newpass=mysqli_real_escape_string($conn, $_POST['newpass']);
	$fnewpass=md5($newpass);
	$repeatpass=mysqli_real_escape_string($conn, $_POST['repeatpass']);
	$frepeatpass=md5($repeatpass);
	
	if($foldpass==$passwordupd)
	{	
		if($newpass==$repeatpass)
		{
			$sql_pw=mysqli_query($conn, "Update user SET
							password= '$fnewpass'
							WHERE
								user_id=$id
					");
					
				if($sql_pw==true) {
	$msg = "<div id='success'>Password changed successfully.</div>";
				}
			else {
	$msg = "<div id='fail'>Password failed to change.</div>";
			}
		}
	else {
	$msg = "<div id='fail'>New and Repeat Password didn't match.</div>";
	}
	}
	else
	$msg = "<div id='fail'>You current password is incorrect.</div>".' '.$oldpass.' '.$rs_upd['password'];

}

?>
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-3 left-feild">
					<div class="be-vidget back-block">
						<a class="btn full color-1 size-1 hover-1" href="account.php">MY ACCOUNT</a>
					</div>
				</div> 
				
				<div class="col-xs-12 col-md-9 _editor-content_">
					<div class="be-large-post">
						<?php
if (isset($msg)){ echo $msg;}
?>
							<div class="info-block style-2">
								<div class="be-large-post-align "><h3 class="info-block-label">Edit Account</h3></div>
							</div>
							
								<form method="POST" enctype="multipart/form-data">
							<div class="be-large-post-align" style="margin-bottom: 20px; border-bottom: 1px solid #0d58c8">
								<div class="form-label">Image Preview</div>
								<div class="be-change-ava">
									<a class="be-ava-user style-2" href="">
										<img src="displayimg/<?php echo $rs_upd['pp_file']; ?>" alt=""> 
									</a>
									<div class="form-label">Change Profile Image</div>
									<input type="file" name="updcfile" required=""> <em>500px*500px or square image recommended.</em>
									<div class="form-label"><em>Only png and jpeg/jpg formats are allowed. Image should be less than 800kb.</em></div>
									<input type="submit" name="upd_cimg" class="btn color-1 size-2 hover-1 btn-right" value="Update Image" />
										</br>
										</br>
								</div>
							</div>
							</form>
							
						<form method="POST">
							<div class="be-large-post-align">
								<div class="row">
									<div class="input-col col-xs-12 col-sm-6">
										<div class="form-group fg_icon focus-2">
											<div class="form-label">First Name</div>
											<input class="form-input" type="text" maxlength="100" name="f_name" value="<?php echo $rs_upd['f_name']; ?>">
										</div>							
									</div>
									<div class="input-col col-xs-12 col-sm-6">
										<div class="form-group focus-2">
											<div class="form-label">Last Name</div>									
											<input class="form-input" maxlength="100" type="text" name="l_name" value="<?php echo $rs_upd['l_name']; ?>">
										</div>								
									</div>
									
							<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Gender</div>	

																	
											<select class="be-custom-select" name="gender">
								<?php
                            $gen=array("Male","Female");
                            $i=0;
                            foreach($gen as $gender){
                                $i++;
                                if($i==$genderupd){
										$sel=$sel="selected='selected'";}
									else
										$sel="";
                                echo"<option value='$i' $sel> $gender</option>";		
                            }
                        ?>
							</select>
										</div>								
									</div>
									<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">Street</div>									
											<input class="form-input" type="text" maxlength="50" name="street" value="<?php echo $rs_upd['add_street']; ?>">
										</div>								
									</div>
									<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">City</div>									
											<input class="form-input" type="text" maxlength="50" name="city" value="<?php echo $rs_upd['add_city']; ?>">
										</div>								
									</div>
									<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">Country</div>									
											<input class="form-input" type="text" name="country" maxlength="50" value="<?php echo $rs_upd['add_country']; ?>">
										</div>								
									</div>
									<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">Mobile Number</div>									
											<input class="form-input" type="text" pattern='\d{10}' maxlength="10" placeholder="Mobile No. (10 digits without country code)" name="phone" value="<?php echo $rs_upd['phone']; ?>">
										</div>								
									</div>
									<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">Institution</div>									
											<input class="form-input" type="text" maxlength="100" name="institution" value="<?php echo $rs_upd['institution']; ?>">
										</div>								
									</div>
							<div class="col-md-12 be-date-block">
							<span class="large-popup-text">
								Date of birth
							</span>
							<div class="be-custom-select-block mounth">
								<select name="mm" class="be-custom-select">
									<?php
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                if($i==$m){
										$sel=$sel="selected='selected'";}
									else
										$sel="";
                                echo"<option value='$i' $sel> $mon</option>";		
                            }
                        ?>
                        </select>

								</select>
							</div>
							<div class="be-custom-select-block">
								<select  name="dd" class="be-custom-select">
									
									<?php
							$sel="";
                        for($i=1;$i<=31;$i++){
                        
                        							if($i==$d){
								$sel=$sel="selected='selected'";}
							else
								$sel="";
                        ?>
                        <option value="<?php echo $i ;?>"<?php echo $sel?>">
                        <?php
                        if($i<10)
                            echo"0".$i;
                        else
                            echo"$i";	  
						?>
						</option>	
						<?php 
						}?>
						</select>

							</div>
							<div class="be-custom-select-block">
								<select name="yy" class="be-custom-select">
								
									<?php
							$sel="";
							for($i=1960;$i<=2015;$i++){	
							if($i==$y){
									$sel="selected='selected'";}
								else
								$sel="";
							echo"<option value='$i' $sel>$i </option>";
							}
						?>
									
								</select>
							</div>
							<div class="sec"  data-sec="about-me" >
						<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">About Me</div>	
											<textarea class="form-input" name="about_me" maxlength="800" required=""><?php echo $rs_upd['about_me']; ?></textarea>
										</div>
										</div>
					</div>
									
								<div class="col-xs-12">
								<br>    
										<input type="submit" name="btn_sub" class="btn color-1 size-2 hover-1 btn-right" value="Update" />
									</div>	
									</form>	
									
																
								</div>
							</div>
						</div>
					</div>
					<form method="POST">
					<div class="sec"  data-sec="edit-password">
						<div class="be-large-post">
							<div class="info-block style-2">
								<div class="be-large-post-align"><h3 class="info-block-label">Change Password</h3></div>
							</div>
							<div class="be-large-post-align">
								<div class="row">
									<div class="input-col col-xs-12 col-sm-4">
										<div class="form-group focus-2">
											<div class="form-label">Current Password</div>									
											<input class="form-input" type="password" maxlength="50" name="oldpass" placeholder="" />
										</div>								
									</div>
									<div class="input-col col-xs-12 col-sm-4">
										<div class="form-group focus-2">
											<div class="form-label">New Password</div>									
											<input class="form-input" type="password" maxlength="50" name="newpass" placeholder="" />
										</div>								
									</div>
									<div class="input-col col-xs-12 col-sm-4">
										<div class="form-group focus-2">
											<div class="form-label">Repeat Password</div>									
											<input class="form-input" type="password" maxlength="50" name="repeatpass" placeholder="" />
										</div>								
									</div>
									<div class="col-xs-12">
								
										<input type="submit" name="change_pw" class="btn color-1 size-2 hover-1 btn-right" value="Change Password" />
									</div>																
								</div>
							</div>
						</div>
					</div>		
						</form >
			</div>
			
					
			
                                    
			</form>
		</div>
	</div>

	<?php include('footer.php'); ?>
	<div class="be-fixed-filter"></div>	
	</body>
</html>