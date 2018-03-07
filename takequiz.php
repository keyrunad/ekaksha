<?php 
include('session.php');
?>
<html>
<?php 
include('header.php');
if(isset($_POST['editquizid']))
	{ $id=$_POST['editquizid'];
	$class_id=$_POST['editquizclassid'];
	if(isset($_POST['btn_takequiz']))
{
$testquesno=mysqli_real_escape_string($conn,$_POST['testnoofques']);
$xcount=1;
while($xcount<=$testquesno){
	$questionid=mysqli_real_escape_string($conn,$_POST['questionid'.$xcount]);
	$answerid=mysqli_real_escape_string($conn,$_POST['answeroption'.$xcount]);
	$sql_tquiz=mysqli_query($conn, "INSERT INTO test_result VALUES(
	NULL,
	$id,
	$ekaksha_session,
	$questionid,
	$answerid
	)"
	);
$xcount=$xcount+1;
	}
}
 ?>
		  	<?php
$sql_class=mysqli_query($conn, "Select * from class where class_id=$class_id");
while($class_row=mysqli_fetch_array($sql_class, MYSQLI_ASSOC))
{	
	?>
<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
				<div class="col-xs-12 col-md-4 left-feild">
					<div class="be-user-block style-3">
						<div class="be-user-detail">
							<a class="be-ava-user style-2" href="class.php?class_id=<?php echo $class_row['class_id']; ?>">
								<img src="displayimg/<?php echo $class_row['cp_file']; ?>" alt=""> 
							</a>
							<br>
							<?php 
							if($ekaksha_session==$class_row['c_user_id']) {
							?>
							<form action="edit-class.php" method="POST">
							<input type="hidden" name="class" value="<?php echo $class_row['class_id'];?>" />	
							<input type="submit" name="edit_class" class="btn color-1 size-2 hover-1 btn-center"  value="EDIT" />						
						</form>
							<?php } 
							else { ?>
							<?php 
							$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where class_id=$class_id AND user_id=$ekaksha_session AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
	if($sql_rows['COUNT(*)']==0) {
		
		$query_r =mysqli_query($conn, "Select COUNT(*) from join_class where class_id=$class_id AND user_id=$ekaksha_session"
							);
$sql_rows_r=mysqli_fetch_assoc($query_r);
if($sql_rows_r['COUNT(*)']!=0) { 
							?>
							<form method="POST">
							<?php if($class_row['class_type']=='Online') { ?>
							
							
							<input type="button" name="rj_class" class="btn color-1 size-2 hover-1 btn-center" data-toggle="modal" data-target="#rejoinclass" value="Rejoin" />
							<div id="rejoinclass" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to Rejoin?</h4>
        </div>
        <div class="modal-body">

	<br>
		<br>
		<input type="submit" name="rejoin_class" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" />
		
		<br>
		<br>
        </div>
      </div>

</div>
</div>
							
							
							<?php } else { ?>
	<input type="button" class="btn color-1 size-2 hover-1 btn-center" data-toggle="modal" data-target="#reinvitecode" value="Rejoin" />
							<div id="reinvitecode" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invite Code</h4>
        </div>
        <div class="modal-body">
    <input class="input-signtype" type="text" name="reinvcode" required="" placeholder="Enter Invite Code">
	<br>
		<br>

<input type="submit" class="btn color-1 size-2 hover-1 btn-center" name="rebtn_inv" value="Submit" />
        </div>
      </div>

</div>
</div>	
							<?php } ?>
						</form>
<?php } else { ?>
							<form method="POST">
							<?php if($class_row['class_type']=='Online') { ?>
								<input type="button" name="j_class" class="btn color-1 size-2 hover-1 btn-center" data-toggle="modal" data-target="#joinclass" value="Join" />
							<div id="joinclass" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to Join?</h4>
        </div>
        <div class="modal-body">

	<br>
		<br>
		<input type="submit" name="join_class" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" />
		
		<br>
		<br>
        </div>
      </div>

</div>
</div>
							<?php } else { ?>
							<input type="button" name="join_class" class="btn color-1 size-2 hover-1 btn-center" data-toggle="modal" data-target="#invitecode" value="Join" />
							<div id="invitecode" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invite Code</h4>
        </div>
        <div class="modal-body">
    <input class="input-signtype" type="text" name="invcode" required="" placeholder="Enter Invite Code">
	<br>
		<br>

<input type="submit" class="btn color-1 size-2 hover-1 btn-center" name="btn_inv" value="Submit" />
        </div>
      </div>

</div>
</div>
							<?php } ?>						
						</form>
							<?php } ?>
	<?php }  ?>						
								<div class="be-user-info">
								Joined on: <?php echo $sql_rows['doj']; ?>
							</div>
							
	
							<?php } ?>
							<p class="be-use-name"><?php echo $class_row['class_name']; ?></p>
							<div class="be-user-info">
								Type: <?php echo $class_row['class_type']; ?>
							</div>
							<div class="be-user-info">
							<?php if($class_row['c_user_id']==$ekaksha_session) { ?>
							
								Invite Code: <?php if($class_row['class_type']=='On-Campus') echo $class_row['invite_code'];
								else echo 'N/A';
							} ?>
							</div>
							<div class="be-text-tags style-2">
								<a href="page1.html" class="be-post-tag">Category: <?php 
												$sql_cat=mysqli_query($conn, "Select cat_name from category where cat_id = $class_row[class_cat_id]");
												while ($cat_row = mysqli_fetch_array($sql_cat, MYSQLI_ASSOC)){
												echo $cat_row['cat_name'];  } ?>
												</a>
							</div>
							<div class="be-user-info">
								Created on: <?php echo $class_row['doc']; ?>
							</div>
								
						</div>
						<div class="be-user-statistic">
							<div class="stat-row clearfix"><i class="fa fa-user"></i>  Students<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where class_id=$class_row[class_id] AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>
							<div class="stat-row clearfix"><i class="fa fa-book"></i>  Study Materials<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*) from note where class_id=$class_row[class_id]"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>
							<div class="stat-row clearfix"><i class="fa fa-play-circle"></i>  Videos<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*) from lecture where class_id=$class_row[class_id]"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>
<div class="stat-row clearfix"><i class="fa fa-question"></i>  Quizzes<span class="stat-counter"><?php
$query =mysqli_query($conn, "Select COUNT(*) from test where class_id=$class_row[class_id]"
							);
$sql_rows=mysqli_fetch_assoc($query);
echo $sql_rows['COUNT(*)']; ?></span></div>						</div>

					</div>
					</div>
													
													<!-- if not test taken -->
													<?php 
													$sql_check=mysqli_query($conn, "SELECT COUNT(*) from test_result where test_id=$id and user_id=$ekaksha_session");
													$sql_checkq=mysqli_fetch_assoc($sql_check);
													if($sql_checkq['COUNT(*)']==0){
													?>
				
									<form method="POST">
									<div class="input-col col-xs-12 col-sm-8">
										<div class="form-group fg_icon focus-2">
										<?php 
										$sql_edit=mysqli_query($conn, "Select * from test where test_id=$id");
										while ($class_edit = mysqli_fetch_array($sql_edit, MYSQLI_ASSOC)){
										?>
											<div class="info-block style-2">
								<div class="be-large-post-align "><h3 class="info-block-label">Take Quiz</h3></div>
					</div>
										<div class="form-label"><h1 class="info-block-label">Title: <?php echo $class_edit['test_title']; ?></h1></div>
										<?php
										$x=1;
										$sql_question=mysqli_query($conn, "Select * from test_question where test_id=$id");
											while ($class_question = mysqli_fetch_array($sql_question, MYSQLI_ASSOC)){
											?>
											<div class="form-label"><h3 class="info-block-label">Question <?php echo $x; ?>: <?php echo $class_question['tq_question']; ?></h3></div>
											<input type="hidden" name="questionid<?php echo $x;?>" value="<?php echo $class_question['tq_id'];?>" />	
												<div class="col-md-12 be-date-block">
											<select class="be-custom-select" name="answeroption<?php echo $x; ?>" required>
											<option value="" selected="selected">Select Answer</option>
											<?php $optc=1;
											$quesid=$class_question['tq_id'];
											$sql_answer=mysqli_query($conn, "Select * from test_answer where tq_id=$quesid");
											while ($class_answer = mysqli_fetch_array($sql_answer, MYSQLI_ASSOC)){	
											?>
											<option value="<?php echo $class_answer['ta_id']; ?>"><?php echo $class_answer['ta_answer']; ?></option>
											<?php 
											$optc=$optc+1;
											}
											?>
											</select>
											</div>
											<?php 
											$x=$x+1;
											}
											?>
											<input type="hidden" name="editquizid" value="<?php echo $class_edit['test_id']; ?>" />
											<input type="hidden" name="editquizclassid" value="<?php echo $class_id; ?>" />
											<input type="hidden" name="testnoofques" value="<?php echo $class_edit['t_ques_no'];?>" />	
											<input type="submit" name="btn_takequiz" class="btn color-1 size-2 hover-1 btn-right" value="Submit Answers" />
											<?php
											} ?>
										
										</br>
										</br>
										</div>												
									</div>
									</form>
												<?php } else { ?>
									<!-- end if not test taken -->
									
									<!-- if test taken -->
									<div class="input-col col-xs-12 col-sm-8">
										<div class="form-group fg_icon focus-2">
										<?php 
										$sql_edit=mysqli_query($conn, "Select * from test where test_id=$id");
										while ($class_edit = mysqli_fetch_array($sql_edit, MYSQLI_ASSOC)){
										?>
											<div class="info-block style-2">
								<div class="be-large-post-align "><h3 class="info-block-label">Quiz Results</h3></div>
					</div>
										<div class="form-label"><h1 class="info-block-label">Title: <?php echo $class_edit['test_title']; ?></h1></div>
										
										<?php
										$x=1;
										$corrcount=0;
										$sql_question=mysqli_query($conn, "Select * from test_question where test_id=$id");
											while ($class_question = mysqli_fetch_array($sql_question, MYSQLI_ASSOC)){
											?>
											<div class="form-label"><h3 class="info-block-label">Question <?php echo $x; ?>: <?php echo $class_question['tq_question']; ?></h3></div>
											<input type="hidden" name="questionid<?php echo $x;?>" value="<?php echo $class_question['tq_id'];?>" />	
												
											<?php 
											$quesid=$class_question['tq_id'];
											$sql_canswer=mysqli_query($conn, "Select * from test_answer where tq_id=$quesid AND ta_correct=1");
											$class_canswer = mysqli_fetch_assoc($sql_canswer);	
											$sql_answer=mysqli_query($conn, "Select * from test_result where ques_id=$quesid AND user_id=$ekaksha_session");
											$class_answer = mysqli_fetch_assoc($sql_answer);
											if($class_canswer['ta_id']==$class_answer['ans_id']) {
												$corrcount=$corrcount+1;
											?>
											<div class="form-label">Your Answer:&nbsp;<span style="color: green; font-weight: bold;"><?php echo $class_canswer['ta_answer']; ?></span>&nbsp;<span style="color: green;">is <em>Correct</em>&nbsp;<i class="fa fa-check-circle"></i></span></div>
											<?php } else {
											$sql_danswer=mysqli_query($conn, "SELECT * from test_answer where ta_id=$class_answer[ans_id]");
											$class_danswer=mysqli_fetch_assoc($sql_danswer);
											?>
											<div class="form-label">Your Answer:&nbsp;<span style="color: red; font-weight: bold;"><?php echo $class_danswer['ta_answer']; ?></span>&nbsp;<span style="color: red;">is <em>Incorrect</em>&nbsp;<i class="fa fa-times-circle"></i></span></div>
											<div class="form-label">Correct Answer is:&nbsp;<span style="color: green; font-weight: bold;"><?php echo $class_canswer['ta_answer']; ?></span></div>
											<?php 
											}
											$x=$x+1;
										}}
											?>
											<div id="successquiz"><em>You answered <?php echo $corrcount; ?> Questions correctly out of 5.</em></div>
										</br>
										</br>
										</div>							
									</div>
													<?php } ?>
									<!-- end if test taken -->
</div>
</div>
</div>
<?php }} else { 
?>
<div id="content-block">
		<div class="container be-detail-container">
			<div class="row">
			<div class="input-col col-xs-12 col-sm-12">
			<div id="failquiz">No quiz selected.</div>
			</div>
</div>
</div>
</div>			<?php } ?>
		<?php include('footer.php'); ?>

	<div class="be-fixed-filter"></div>
	</body>
	</html>