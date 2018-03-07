<?php 
include('session.php');
?>
<html>
	
<?php include('header.php'); ?>

<?php  if(isset($_POST['class'])) {
	$id=$_POST['class'];
	?>
<?php

if(isset($_POST['delete_class'])){
	$sql_comment = mysqli_query($conn, "Delete from class where class_id=$id");
		if($sql_comment==true)
		{
		$msg = "<div id='successquiz'>Class deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='failquiz'>Failed to delete. Try again.</div>";
	}
	}

if(isset($_POST['upd_cimg'])){
	$class_id = mysqli_real_escape_string($conn, $_POST['class']);
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
	$sql_as=mysqli_query($conn, "UPDATE class
						SET
							cp_file='$final_file'
							WHERE
							class_id=$class_id
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


if(isset($_POST['submit'])){
	$classname=mysqli_real_escape_string($conn, $_POST['classname']);
	$category=mysqli_real_escape_string($conn, $_POST['category']);
	$classtype=mysqli_real_escape_string($conn, $_POST['classtype']);
	$aboutclass=mysqli_real_escape_string($conn, $_POST['aboutclass']);
	$classstatus=mysqli_real_escape_string($conn, $_POST['classstatus']);
	
	$sql_ins=mysqli_query($conn, "UPDATE class 
						Set
							class_name='$classname',
							class_type='$classtype',
							class_cat_id=$category,
							about_class='$aboutclass',
							c_status='$classstatus'
						where
							class_id=$id
							
							
					");
					if($sql_ins==true){
					$msg = "<div id='success'>Class Updated.</div>";
	
									}
					else
					$msg = "<div id='fail'>Update Error.</div>";


}
	
?>

	<!-- MAIN CONTENT -->
	<?php

	$sql_upd=mysqli_query($conn, "SELECT * FROM class WHERE class_id=$id");
	$rs_upd=mysqli_fetch_array($sql_upd, MYSQLI_ASSOC);


	   $classnameupd= $rs_upd['class_name'];
	   $classcatupd=$rs_upd['class_cat_id'];
	   $classtypeupd=$rs_upd['class_type'];
	   $aboutclassupd=$rs_upd['about_class'];
	   $classstatusupd=$rs_upd['c_status'];
	   ?>
	
	
	<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-3 left-feild">
					<div class="be-vidget back-block">
						<a class="btn full color-1 size-1 hover-1" href="account.php">My Account</a>
					</div>
					<div class="be-vidget hidden-xs hidden-sm" id="scrollspy">
					</div>

				</div>
				
				
				
				<div class="col-xs-12 col-md-9 _editor-content_">
				<?php
				if (isset($msg)){ echo $msg;}
				?>
						
						<div class="be-large-post">
						<?php 
						$sql_check_class=mysqli_query($conn, "SELECT COUNT(*) from class where class_id=$id");
						$sql_checkc=mysqli_fetch_assoc($sql_check_class);
													if($sql_checkc['COUNT(*)']!=0){
						?>
						
							<div class="info-block style-2">
								<div class="be-large-post-align "><h3 class="info-block-label">Edit Class</h3></div>
							</div>
							<div class="be-large-post-align" style="margin-bottom: 20px;">
							<a data-toggle="modal" data-id="<?php echo $id; ?>" href="#deleteclass" class="del_class btn color-1 size-2 hover-1 btn-right" style="background: red; border: 1px solid red !important;"  title="Delete Class" >Delete Class</a>
							</div>
							</br>
							</br>
							<form method="POST">
								<div id="deleteclass" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to delete?</h4>
        </div>
        <div class="modal-body">
<em>This can not be undone.</em>
	<br>
		<br>
		<center>
		<input type="submit" name="delete_class" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delc" name="class" value="">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" />
		</center>
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>
							
							<form method="POST" enctype="multipart/form-data">
							<div class="be-large-post-align" style="margin-bottom: 20px; border-bottom: 1px solid #0d58c8">
								<div class="form-label">Image Preview</div>
								<div class="be-change-ava">
									<a class="be-ava-user style-2" href="">
										<img src="displayimg/<?php echo $rs_upd['cp_file']; ?>" alt=""> 
									</a>
									<div class="form-label">Change Class Image</div>
									<input type="file" name="updcfile" required=""><em>500px*500px or square image recommended.</em>
									<div class="form-label"><em>Only png and jpeg/jpg formats are allowed. Image should be less than 800kb.</em></div>
									<input type="hidden" name="class" value="<?php echo $rs_upd['class_id'];?>" />	
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
											<div class="form-label">Class Name</div>
											<input class="form-input" type="text" maxlength="100" name="classname" value="<?php echo $rs_upd['class_name']; ?>">
										</div>							
									</div>
									<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Category</div>	
											<select class="be-custom-select" name="category">
											<?php $sql=mysqli_query($conn, "SELECT cat_id, cat_name FROM category"); 
while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
 if($row['cat_id']==$classcatupd) {
	 $sel="selected='selected'";
					}
 else  {
	 $sel="";
 }
  echo "<option value=$row[cat_id] $sel>$row[cat_name]</option>";
 }
											?>
											
								
							</select>
										</div>								
									</div>
									
							<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Class Type</div>	

																	
											<select class="be-custom-select" name="classtype">
								<?php
                            $type=array("Online","On-Campus");
                            foreach($type as $classtype){
                                if($classtype==$classtypeupd){
										$sel=$sel="selected='selected'";}
									else
										$sel="";
                                echo"<option value='$classtype' $sel> $classtype</option>";		
                            }
                        ?>
							</select>
										</div>								
									</div>
									
								<div class="col-md-12 be-date-block">
							<div class="be-custom-select-block mounth">
											<div class="form-label">Class Status</div>	

																	
											<select class="be-custom-select" name="classstatus">
								<?php
                            $status=array("Active","Hidden");
                            foreach($status as $classstatus){
                                if($classstatus==$classstatusupd){
										$sel=$sel="selected='selected'";}
									else
										$sel="";
                                echo"<option value='$classstatus' $sel> $classstatus</option>";		
                            }
                        ?>
							</select>
										</div>								
									</div>
									
							
							<div class="sec"  data-sec="about-me" >
						<div class="input-col col-xs-12">
										<div class="form-group focus-2">
											<div class="form-label">About Class</div>
											<em>This is what persuades students to join your class. Make sure to enter everything about your class and the topics you will be covering in this class.</em>											
											<textarea class="form-input" name="aboutclass" maxlength="800" required=""><?php echo $rs_upd['about_class']; ?></textarea>
										</div>
										</div>
					</div>
									
								<div class="col-xs-12">
								<br>    <input type="hidden" name="class" value="<?php echo $rs_upd['class_id'];?>" />	
										<input type="submit" name="submit" class="btn color-1 size-2 hover-1 btn-right" value="Update" />
									</div>	
									</form>	
										<?php } ?>
									<?php } else { ?>
									<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-3 left-feild">
					<div class="be-vidget back-block">
						<a class="btn full color-1 size-1 hover-1" href="account.php">My Account</a>
					</div>
					<div class="be-vidget hidden-xs hidden-sm" id="scrollspy">
					</div>

				</div>
				<div class="col-xs-12 col-md-9 _editor-content_">
									<div class="form-group fg_icon focus-2">
											<div id="fail">You must specify class before editing</div>
											<?php } ?>
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

	<?php include('footer.php'); ?>
	<div class="be-fixed-filter"></div>
	</body>
</html>