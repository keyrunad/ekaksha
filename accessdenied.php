<html>
<?php include('nheader.php'); ?>
<!-- MAIN CONTENT -->
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
			<h1>ACCESS DENIED</h1>
			<div id="failindex">
Please <a href="index.php" class="btn color-111 size-2 hover-111" style="margin-right: 0px !important;">LOG IN</a> or <a href="index.php" class="btn color-111 size-2 hover-111" style="margin-right: 0px !important;">REGISTER</a> to access the content or contact administrator. If you are logged in, check you have proper credentials to access the content.</div>
		</div>

	</div>

	<?php include('footer.php'); ?>
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
							<input class="input-signtype" type="email" name="email" required="" placeholder="Your email">
						</div>
						<div class="col-md-6">
							<input class="input-signtype" type="password" name="password" required="" placeholder="Password">
						</div>
						
						<div class="col-md-6">

							<a href="blog-detail-2.html" class="link-large-popup" style="color: white; font-weight: bold; margin-left: 15px;">Forgot password?</a>
						</div>
						<div class="col-xs-6 for-signin">
							<input type="submit" name="submit" class="be-popup-sign-button" value="LOG IN">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>