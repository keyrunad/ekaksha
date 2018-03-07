<?php
ob_start();
include('config.php');
session_start();
if(isset($_SESSION['ekaksha'])) {
     header("Location:account.php");
     exit();
}
?>
<html>	
<?php
if(isset($_POST['submit']))
{
    $pass=mysqli_real_escape_string($conn,$_POST['password']);
    $fpassword=md5($pass);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $fetch=mysqli_query($conn,"SELECT user_id FROM user WHERE email='$email' and password='$fpassword'");
    $count=mysqli_num_rows($fetch);
    if($count!="")
    {	
    	$_SESSION['ekaksha']=$email;
    	header("Location:account.php");
     	exit();
    }
    else
    {  
$msg = "<div id='failindex'>Email or password incorrect. Please try again.</div>";
       
    }
	}
?>
<?php include("header.php"); ?>
	<!-- MAIN CONTENT -->
	<?php
	include('functions.php');
	if(isset($_POST['forgot_pw']))
	{
	$femail=mysqli_real_escape_string($conn,$_POST['forgotpwemail']);	
	$fquery =mysqli_query($conn, "Select COUNT(*) from user where email='".$femail."'");
	$fsql_rows=mysqli_fetch_assoc($fquery);
	$fpassword=generatePassword(8);
	$fpwpassword=md5($fpassword);
	if($fsql_rows['COUNT(*)']!=0) {
			$fpw_upd=mysqli_query($conn, "UPDATE user SET password='$fpwpassword' WHERE email='".$femail."'");
			if($fpw_upd==true){
					//send email on password
				$to = $femail;
				$subject = "eKaksha - Password Reset";
				$txt = "<html><body><p>You recently requested for password reset."."\n</p>"."<p>Your email: ".$femail."\n</br></p>"."<p>Your new password: ".$fpassword."\n</br></p>"."<p>Please login http://keyrunad.com/ekaksha to access your account using above information."."\n</br></p>"."<p>Thank you,</br></p>"."\n"."<p>eKaksha Team"."\n</br></p>"."</body></html>";
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				$headers .= "From: keyrunad@gmail.com" . "\r\n" .
				"CC: somebodyelse@example.com";
				mail($to,$subject,$txt,$headers); 
				$msg = "<div id='successindex' style='margin-top: 10px;'>Password reset successful. New password is sent to your email.</div>";

									}
					else
					$msg = "<div id='failindex' style='margin-top: 10px;'>Failed to reset password.Please try again.</div>";
	}
	else {
		$msg= "<div id='failindex' style='margin-top: 10px;'>Email is not registered.</div>";
	}
	}
	if(isset($_POST['btn_sub'])){
	$f_name=mysqli_real_escape_string($conn,$_POST['fname']);
	$l_name=mysqli_real_escape_string($conn,$_POST['lname']);
	$gender=mysqli_real_escape_string($conn,$_POST['gender']);
	$add_street=mysqli_real_escape_string($conn,$_POST['street']);
	$add_city=mysqli_real_escape_string($conn,$_POST['city']);
	$add_country=mysqli_real_escape_string($conn,$_POST['country']);
	$remail=mysqli_real_escape_string($conn,$_POST['email']);	
	$password=generatePassword(8);
	$finalpassword=md5($password);
	$phone=mysqli_real_escape_string($conn,$_POST['phone']);
	$institution=mysqli_real_escape_string($conn,$_POST['institution']);
	$dob=mysqli_real_escape_string($conn,$_POST['yy'].'-'.$_POST['mm'].'-'.$_POST['dd']);
	$doj= date("y-m-d"); 
	$query =mysqli_query($conn, "Select COUNT(*) from user where email='".$remail."'");
	$sql_rows=mysqli_fetch_assoc($query);
	if($sql_rows['COUNT(*)']==0) {
	$sql_ins=mysqli_query($conn, "INSERT INTO user 
						VALUES(
							NULL,
							'$f_name',
							'$l_name' ,
							'$remail',
							'$finalpassword',
							'$add_street',
							'$add_city',
							'$add_country',	
							'$phone',
							'$institution',
							'$gender',
							'$dob',
							'$doj',
							'noone.png',
							''
							)
					");
					if($sql_ins==true){
					//send email on addtion
				$to = $remail;
				$subject = "Your login information from eKaksha";
				$txt = "<html><body><p>Dear ".$f_name.","."\n</p>"."<p>Welcome to eKaksha. Thank you for chosing us.</p><p>Your email: ".$remail."\n</br></p>"."<p>Your password: ".$password."\n</br></p>"."<p>Please login http://keyrunad.com/ekaksha to access your account."."\n</br></p>"."<p>Thank you,</br>"."\n</p>"."<p>eKaksha Team"."\n</br></p>"."<p><em>*If you didn't registered on eKaksha or if you feel you received this email by mistake, kindly disregard this email.</em></p></body></html>";
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				$headers .= "From: keyrunad@gmail.com" . "\r\n" .
				"CC: somebodyelse@example.com";
				mail($to,$subject,$txt,$headers); 
				$msg = "<div id='successindex' style='margin-top: 10px;'>Registered Successfully. Please check email you entered for login information and password.</div>";

									}
					else
					$msg = "<div id='failindex' style='margin-top: 10px;'>Failed to register. Try again.</div>";


				}
				else
				 $msg = "<div id='failindex' style='margin-top: 10px;'>Email already registered.</div>";

					}	


?>	
	<div id="content-block">
	<?php 
							if(isset($msg)) {
							echo $msg; } ?>
		<div class="head-bg">
			<div class="head-bg-img"></div>
			<div class="head-bg-content">
				<h1>Learn anything, anywhere, anytime!</h1>
				<p></p>
				<a class="be-register btn color-111 size-1 hover-111" style="font-weight: bold; font-size: 25px;"><i class="fa fa-unlock" style="font-weight: bold; font-size: 25px; color: white;"></i>GET ENROLLED NOW!</a>
			</div>	
		</div>
		<div class="container-fluid custom-container">
			<div class="row">

				<div class="col-md-2 left-feild">
				
				<div class="input-search">
				<h3 class="letf-menu-article">
							Search
						</h3>
						<input name="search_text" id="search_text" type="text" placeholder="Enter Class Name">
					</div>		
				</div>

				<!--search result -->
				<div class="col-md-10" style="min-height: 550px;">
					<div id="container-mix"  class="row _post-container_">
				<div id="searchresult">
				<?php 
		$sql_class=mysqli_query($conn, "Select * from class where c_status = 'Active' ORDER BY doc");
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
				<!-- end search result -->

			</div>
		</div>	
	</div>
	<!-- THE FOOTER -->
	
<?php include('footer.php'); ?>
	<!-- THE FOOTER END -->
<div class="be-fixed-filter"></div>
	<div class="large-popup login">
		<div class="large-popup-fixed"></div>
		<div class="container large-popup-container">
			<div class="row">
				<div class="col-md-8 col-md-push-2 col-lg-6 col-lg-push-3  large-popup-content">
					<div class="row">
						<div class="col-md-12">
							<i class="fa fa-times close-button"></i>
							<h5 class="large-popup-title">Log in</h5>
						</div>	
						<form  method="post" class="popup-input-search">
						<div class="col-md-6">
							<input class="input-signtype" type="email" name="email" required="" maxlength="50" placeholder="Your email">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="password" name="password" required="" maxlength="50" placeholder="Password">
						</div>
						
						<div class="col-md-6">
						<a data-toggle="modal" href="#forgotpassword"  title="Delete Quiz"  style="color: white; font-size: 20px; font-weight: bold;">Forgot Password?</a>
						</div>
						<div class="col-xs-6 for-signin">
							<input type="submit" name="submit" class="be-popup-sign-button" value="LOG IN">
						</div>
						<div class="col-md-12">
						</br>
						</br>
							<center><span class="link-large-popup" style="color: white; font-weight: bold; margin-left: 15px;">Don't have an account?</span></center>
						</br>
						</br>
						<center>
						<a class="be-register btn color-111 size-1 hover-111" style="font-weight: bold; font-size: 25px;"><i class="fa fa-unlock" style="font-weight: bold; font-size: 25px; color: white;"></i>GET ENROLLED NOW!</a></center>
						</div>
						</form>
						
						<div id="forgotpassword" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important; margin-top: 100px;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot Password?</h4>
        </div>
        <div class="modal-body">
<div class="row">	
								<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST">
											<div class="form-label">Your Email Address</div>
											<input class="input-signtype" type="email" name="forgotpwemail" maxlength="50" placeholder="Enter Your Email Address..." style="border: 1px solid #222;" required=""/>
											</br>
											</br>
											<em>New password will be sent to your email address if it exist in our database.</em>
											</br>
											</br>
											<input type="submit" name="forgot_pw" class="btn color-1 size-2 hover-1 btn-right" value="Send Password" />
										</form>
										</div>						
									</div>
</div>
        </div>
      </div>
</div>
</div>
							
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="large-popup register">
		<div class="large-popup-fixed"></div>
		<div class="container large-popup-container">
			<div class="row">
				<div class="col-md-10 col-md-push-1 col-lg-8 col-lg-push-2 large-popup-content">
					<div class="row">
						<div class="col-md-12">
							<i class="fa fa-times close-button"></i>
							<h5 class="large-popup-title">Register</h5>
						</div>
						<!--Sign up -->
						<form  class="popup-input-search" method="post">
						<div class="col-md-6">
							<input class="input-signtype" type="text" name="fname" maxlength="100" required="" placeholder="First Name">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" name ="lname" required="" maxlength="100" placeholder="Last Name">
						</div>
						<div class="col-md-6">
							<select class="be-custom-select" name="gender" required>
								<option value="" disabled selected>
									Gender
								</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" name="street" required="" maxlength="50" placeholder="Street">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" name="city" required="" maxlength="50" placeholder="City">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" name="country" required="" maxlength="50" placeholder="Country">
						</div>
						
						<div class="col-md-6">
							<input class="input-signtype" type="email" name="email" required="" maxlength="50" placeholder="Email">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" pattern='\d{10}' name="phone" maxlength="10" required="" placeholder="Mobile No. (10 digits without country Code)">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="text" name="institution" maxlength="100" required="" placeholder="Institution">
						</div>
						
						<div class="col-md-12 be-date-block">
							<span class="large-popup-text">
								Date of birth
							</span>
							<div class="be-custom-select-block mounth">
								<select name="mm" class="be-custom-select" required>
									<option value="" disabled selected>
										Month
									</option>
									<?php
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                echo"<option value='$i'> $mon</option>";		
                            }
                        ?>
                        </select>

								</select>
							</div>
							<div class="be-custom-select-block">
								<select  name="dd" class="be-custom-select" required>
									<option value="" disabled selected>
										Day
									</option>
									<?php
                        for($i=1;$i<=31;$i++){
                        ?>
                        <option value="<?php echo $i; ?>">
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
								<select name="yy" class="be-custom-select" required>
									<option value="" disabled selected>
										Year
									</option>
									<?php
							for($i=1960;$i<=2015;$i++){	
							echo"<option value='$i'>$i</option>";
							}
						?>
									
								</select>
							</div>

							
						</div>
						<!-- <div class="col-md-6">
							<div class="be-checkbox">
								<label class="check-box">
								    <input class="checkbox-input" type="checkbox" required="required" value="" > <span class="check-box-sign"></span>
								</label>
								<span class="large-popup-text">
									I have read and agree to the <a class="be-popup-terms" href="blog-detail-2.html">Terms of Use</a> and <a class="be-popup-terms" href="blog-detail-2.html">Privacy Policy</a>.
								</span>
							</div>
							
						</div> -->
						<div class="col-md-6 for-signin">
							<input type="submit" name="btn_sub" class="be-popup-sign-button" value="REGISTER" >
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- SCRIPTS	 -->
	</body>
</html>