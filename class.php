<?php 
include('session.php');
?>
<html>
	<?php include('header.php'); ?>
	<?php
	if(isset($_GET['class_id']))
{
	$class_id=$_GET['class_id'];
}

?>

<?php

if(isset($_POST['btn_addquiz'])){
	$noofques = mysqli_real_escape_string($conn, $_POST['noofques']);
	$qdate = date('Y-m-d');
	$quiztitle = mysqli_real_escape_string($conn, $_POST['quiztitle']);
	$qclassid= $class_id;
	$qstatus= 1;
	$sql_quiz = mysqli_query($conn, "Insert INTO test Values (
												NULL,
												$qclassid,
												'$qdate',
												'$quiztitle',
												$noofques,
												$qstatus) ");
		
		if($sql_quiz==true)
		{
		$quiz_id = mysqli_insert_id($conn);
		$c = 1;
		while($c <= $noofques) {
		$question = mysqli_real_escape_string($conn, $_POST['question'.$c]);
		$sql_question = mysqli_query($conn, "Insert INTO test_question Values (
												NULL,
												$quiz_id,
												'$question'
												) ");
		if($sql_question==true)
		{
		$question_id = mysqli_insert_id($conn);
		$a = 1;
		while($a <= 4) {
		$option = mysqli_real_escape_string($conn, $_POST['option'.$a.'q'.$c]);
		$correct = mysqli_real_escape_string($conn, $_POST['correctoption'.$c]);
		if($correct==$a){
			$yes=1;
		}
		else {
			$yes=0;
		}
		$sql_answer = mysqli_query($conn, "Insert INTO test_answer Values (
												NULL,
												$question_id,
												'$option',
												$yes
												) ");
		$a=$a+1;
		}
		}
		$c=$c+1;
		}
		$activity_content="Quiz"." <strong><q>".$quiztitle."</q></strong> "."has been added";
		date_default_timezone_set('Asia/Kathmandu');
		$activity_date = date('Y-m-d H:i');
		$sql_activity = mysqli_query($conn, "Insert INTO activity Values (
												NULL,
												$class_id,
												'$activity_content',
												'$activity_date'
												) ");
		$msg = "<div id='success'>Quiz successfully added.</div>";
     	}
		else 
		{
		$msg = "<div id='fail'>Quiz failed to add. Try again.</div>";
	}
	} 
	

if(isset($_POST['delete_post'])){
	$post = mysqli_real_escape_string($conn, $_POST['delpost']);
	$sql_post = mysqli_query($conn, "Delete from qa_question where ques_id=$post");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Post deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	} 
	
if(isset($_POST['edit_post'])){
	$edit_id = mysqli_real_escape_string($conn, $_POST['edpostid']);
	$edit_text = mysqli_real_escape_string($conn, $_POST['edposttext']);
	$sql_post = mysqli_query($conn, "Update qa_question SET question='$edit_text' where ques_id=$edit_id");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Post edited successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to edit. Try again.</div>";
	}
	} 
	
	if(isset($_POST['acc_subm'])){
	$acc_id = mysqli_real_escape_string($conn, $_POST['accsubmid']);
	$acc_comm = mysqli_real_escape_string($conn, $_POST['acccomment']);
	$sql_post = mysqli_query($conn, "Update submission SET s_status=2, s_comment='$acc_comm' where subm_id=$acc_id");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Accepted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to accept. Try again.</div>";
	}
	} 
	
	if(isset($_POST['rej_subm'])){
	$rej_id = mysqli_real_escape_string($conn, $_POST['rejsubmid']);
	$rej_comm = mysqli_real_escape_string($conn, $_POST['rejcomment']);
	$sql_post = mysqli_query($conn, "Update submission SET s_status=1, s_comment='$rej_comm' where subm_id=$rej_id");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Rejected successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to Reject. Try again.</div>";
	}
	} 

if(isset($_POST['delete_comment'])){
	$comment = mysqli_real_escape_string($conn, $_POST['delcomment']);
	$sql_comment = mysqli_query($conn, "Delete from qa_answer where ans_id=$comment");
		if($sql_comment==true)
		{
		$msg = "<div id='success'>Comment deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	}
	
	if(isset($_POST['delete_t'])){
	$delqid = mysqli_real_escape_string($conn, $_POST['delt']);
	$sql_q = mysqli_query($conn, "Delete from test where test_id=$delqid");
		if($sql_q==true)
		{
		$msg = "<div id='success'>Quiz deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	} 
	
	if(isset($_POST['edit_comment'])){
	$editc_id = mysqli_real_escape_string($conn, $_POST['edcommentid']);
	$editc_text = mysqli_real_escape_string($conn, $_POST['edcommenttext']);
	$sql_post = mysqli_query($conn, "Update qa_answer SET answer='$editc_text' where ans_id=$editc_id");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Comment edited successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to edit. Try again.</div>";
	}
	} 
	
	if(isset($_POST['edit_v'])){
	$editv_id = mysqli_real_escape_string($conn, $_POST['edvid']);
	$editv_title = mysqli_real_escape_string($conn, $_POST['edvtitle']);
	$editv_text = mysqli_real_escape_string($conn, $_POST['edvtext']);	
	$editv_link = mysqli_real_escape_string($conn, $_POST['edvlink']);
	$sql_post = mysqli_query($conn, "Update lecture SET lecture_title='$editv_title', lecture_description='$editv_text', lecture_link='$editv_link' where lecture_id=$editv_id");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Video edited successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to edit. Try again.</div>";
	}
	}


if(isset($_POST['btn_qa'])){
	$post = mysqli_real_escape_string($conn, $_POST['post']);
	date_default_timezone_set('Asia/Kathmandu');
	$datetime = date('Y-m-d H:i');
	$sql_post = mysqli_query($conn, "Insert INTO qa_question Values (
												NULL,
												$class_id,
												$ekaksha_session,
												'$post',
												'$datetime',
												'NULL') ");
												if($sql_post==true)
		{
		$msg = "<div id='success'>Posted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to post. Try again.</div>";
		}
		} 
		
		if(isset($_POST['btn_com'])){
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	$post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
	date_default_timezone_set('Asia/Kathmandu');
	$datetime = date('Y-m-d H:i');
	$sql_post = mysqli_query($conn, "Insert INTO qa_answer Values (
												NULL,
												$post_id,
												$ekaksha_session,
												'$comment',
												'$datetime'
												) ");
												if($sql_post==true)
		{
		$msg = "<div id='success'>Commented successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to comment. Try again.</div>";
		}
		} 

	if(isset($_POST['btn_inv'])){
		$invite_code= mysqli_real_escape_string($conn, $_POST['invcode']);
		$sql_invite=mysqli_query($conn, "Select invite_code from class where class_id=$class_id");
		$invite_row=mysqli_fetch_array($sql_invite, MYSQLI_ASSOC);
		$db_invite=$invite_row['invite_code'];
		$doj=date("y-m-d"); 
		if($invite_code==$db_invite) {
$sql_join = mysqli_query($conn, "Insert INTO join_class Values (
												NULL,
												$class_id,
												$ekaksha_session,
												1,
												'$doj'
)
");

if($sql_join==true)
{
	$msg = "<div id='success'>Class joined successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to join class. Try again.</div>";
	} }
	else 
		{
	$msg = "<div id='fail'>You entered incorrect invite code.</div>";
	}
	}
	
if(isset($_POST['join_class'])){
		
		$doj=date("y-m-d"); 
		
$sql_join = mysqli_query($conn, "Insert INTO join_class Values (
												NULL,
												$class_id,
												$ekaksha_session,
												1,
												'$doj'
)
");

if($sql_join==true)
{
	$msg = "<div id='success'>Class joined successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to join class. Try again.</div>";
	} 
	
	}
	
	
	
	
if(isset($_POST['leave_class'])){
$sql_leave = mysqli_query($conn, "UPDATE join_class SET j_status = 0 
Where class_id=$class_id and user_id=$ekaksha_session
");

if($sql_leave==true)
{
	$msg = "<div id='success'>Class left successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to leave class. Try again.</div>";
}
	}	
	
	if(isset($_POST['rebtn_inv'])){
			$invite_code=mysqli_real_escape_string($conn, $_POST['reinvcode']);
		$sql_invite=mysqli_query($conn, "Select invite_code from class where class_id=$class_id");
		$invite_row=mysqli_fetch_array($sql_invite, MYSQLI_ASSOC);
		$db_invite=$invite_row['invite_code'];
		$dor=date("y-m-d"); 
		if($invite_code==$db_invite) {
$sql_leave = mysqli_query($conn, "UPDATE join_class SET j_status = 1, doj='$dor'
Where class_id=$class_id and user_id=$ekaksha_session
");

if($sql_leave==true)
{
	$msg = "<div id='success'>Class rejoined successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to rejoin class. Try again.</div>";
}
		}
		else 
{
	$msg = "<div id='fail'>You entered incorrect invite code.</div>";
}
	}

	if(isset($_POST['rejoin_class'])){
			
		$dor=date("y-m-d"); 
		
$sql_leave = mysqli_query($conn, "UPDATE join_class SET j_status = 1, doj='$dor'
Where class_id=$class_id and user_id=$ekaksha_session
");
if($sql_leave==true)
{
	$msg = "<div id='success'>Class rejoined successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to rejoin class. Try again.</div>";
}
	}
	
	if(isset($_POST['remove_student'])){
		$resid = mysqli_real_escape_string($conn, $_POST['remstuid']);
		$sql_remove = mysqli_query($conn, "UPDATE join_class SET j_status = 0
		Where class_id=$class_id and user_id=$resid");

if($sql_remove==true)
{
	$msg = "<div id='success'>Student removed successfully.</div>";
}
else 
{
	$msg = "<div id='fail'>Failed to remove student. Try again.</div>";
}
	}

	if(isset($_POST['delete_sm'])){
	$smid = mysqli_real_escape_string($conn, $_POST['delsm']);
	$sql_post = mysqli_query($conn, "Delete from note where note_id=$smid");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Study Material deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	} 


if(isset($_POST['btn_upv'])){
	$lecture_date = date('y-m-d');
	$videotitle = mysqli_real_escape_string($conn, $_POST['videotitle']);
	$videodescription = mysqli_real_escape_string($conn, $_POST['videodescription']);
	$videolink = mysqli_real_escape_string($conn, $_POST['videolink']);
	$sql_post = mysqli_query($conn, "Insert INTO lecture Values (
												NULL,
												'$videotitle',
												'$videodescription',
												'$videolink',
												'$lecture_date',
												$class_id,
												1)");
												
												if($sql_post==true)
		{
		$activity_content="Video"." <strong><q>".$videotitle."</q></strong> "."has been added";
		date_default_timezone_set('Asia/Kathmandu');
		$activity_date = date('Y-m-d H:i');
		$sql_activity = mysqli_query($conn, "Insert INTO activity Values (
												NULL,
												$class_id,
												'$activity_content',
												'$activity_date'
												) ");
		$msg = "<div id='success'>Posted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to post. Try again.</div>";
		}
		} 
if(isset($_POST['delete_v'])){
	$vid = mysqli_real_escape_string($conn, $_POST['delv']);
	$sql_post = mysqli_query($conn, "Delete from lecture where lecture_id=$vid");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Video deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	} 
	
	if(isset($_POST['delete_assign'])){
	$deleteaid = mysqli_real_escape_string($conn, $_POST['delassign']);
	$sql_post = mysqli_query($conn, "Delete from assignment where assign_id=$deleteaid");
		if($sql_post==true)
		{
		$msg = "<div id='success'>Assignment deleted successfully.</div>";
		}
		else 
		{
		$msg = "<div id='fail'>Failed to delete. Try again.</div>";
	}
	} 

		
		
		if(isset($_POST['btn_upsm'])){
	$note_date = date('y-m-d');
	$notetitle = mysqli_real_escape_string($conn, $_POST['notetitle']);
	$notedescription = mysqli_real_escape_string($conn, $_POST['notedescription']);
	$file = rand(10000,10000000)."-".$_FILES['notefile']['name'];
	$folder="notes/";
	$file_loc = $_FILES['notefile']['tmp_name'];
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',$new_file_name);
	if (($_FILES["notefile"]["type"] == "image/gif")
  || ($_FILES["notefile"]["type"] == "image/jpeg")
  || ($_FILES["notefile"]["type"] == "image/png" ) 
  || ($_FILES["notefile"]["type"] == "application/zip" )
  || ($_FILES["notefile"]["type"] == "application/x-rar-compressed" )
  || ($_FILES["notefile"]["type"] == "application/pdf" )
  || ($_FILES["notefile"]["type"] == "application/msword" )
  || ($_FILES["notefile"]["type"] == "application/rtf" )
  || ($_FILES["notefile"]["type"] == "application/vnd.ms-excel" )
  || ($_FILES["notefile"]["type"] == "application/vnd.ms-powerpoint" ) 
  || ($_FILES["notefile"]["type"] == "text/plain" ) 
  || ($_FILES["notefile"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
  || ($_FILES["notefile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
  || ($_FILES["notefile"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
  && ($_FILES["notefile"]["size"] < 100000))
  {
	  	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	$sql_post = mysqli_query($conn, "Insert INTO note Values (
												NULL,
												'$notetitle',
												'$notedescription',
												'$final_file',
												'$note_date',
												$class_id,
												1)");
												
												if($sql_post==true) {
													$activity_content="Study Material"." <strong><q>".$notetitle."</q></strong> "."has been added";
		date_default_timezone_set('Asia/Kathmandu');
		$activity_date = date('Y-m-d H:i');
		$sql_activity = mysqli_query($conn, "Insert INTO activity Values (
												NULL,
												$class_id,
												'$activity_content',
												'$activity_date'
												) ");
		$msg = "<div id='success'>Uploaded successfully.</div>";
												}
		else 
		$msg = "<div id='fail'>Failed to upload. Try again.</div>";
		} 		
  }
	else 
		$msg = "<div id='fail'>Only gif, jpeg, png, zip, rar, pdf, doc, docx, rtf, xls, xlsx, ppt, pptx or txt extensions are accepted and file must be less than 10,0000 kb</div>";
    }		
		
		
		if(isset($_POST['edit_sm'])){
	$edsmid=mysqli_real_escape_string($conn, $_POST['edsmid']);
    $title=mysqli_real_escape_string($conn, $_POST['edsmtitle']);
	$content=mysqli_real_escape_string($conn, $_POST['edsmcontent']);
	$file = rand(10000,10000000)."-".$_FILES['edsmfile']['name'];
	$folder="notes/";
	$file_loc = $_FILES['edsmfile']['tmp_name'];
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',$new_file_name);	
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	if (($_FILES["edsmfile"]["type"] == "image/gif")
  || ($_FILES["edsmfile"]["type"] == "image/jpeg")
  || ($_FILES["edsmfile"]["type"] == "image/png" ) 
  || ($_FILES["edsmfile"]["type"] == "application/zip" )
  || ($_FILES["edsmfile"]["type"] == "application/x-rar-compressed" )
  || ($_FILES["edsmfile"]["type"] == "application/pdf" )
  || ($_FILES["edsmfile"]["type"] == "application/msword" )
  || ($_FILES["edsmfile"]["type"] == "application/rtf" )
  || ($_FILES["edsmfile"]["type"] == "application/vnd.ms-excel" )
  || ($_FILES["edsmfile"]["type"] == "application/vnd.ms-powerpoint" ) 
  || ($_FILES["edsmfile"]["type"] == "text/plain" ) 
  || ($_FILES["edsmfile"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
  || ($_FILES["edsmfile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
  || ($_FILES["edsmfile"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
  && ($_FILES["edsmfile"]["size"] < 100000))
  {
	$sql_ins=mysqli_query($conn, "Update note SET
							note_title = '$title',
							note_file = '$final_file',
							note_content = '$content'
							where note_id= $edsmid
					");
  }

else 
	$msg = "<div id='fail'>Only gif, jpeg, png, zip, rar, pdf, doc, docx, rtf, xls, xlsx, ppt, pptx or txt extensions are accepted and file must be less than 10,0000 kb</div>";
 }
 else { 
	 $sql_ins=mysqli_query($conn, "Update note SET
							note_title = '$title',
							note_content = '$content'
							where note_id= $edsmid
					");
 }
 if($sql_ins==true){
	$msg = "<div id='success'>Note successfully edited.</div>";
}
else
	$msg = "<div id='fail'>Note failed to edit.</div>";
 }
		
		if(isset($_POST['btn_upa'])){
	$title=mysqli_real_escape_string($conn, $_POST['assigntitle']);
	$description=mysqli_real_escape_string($conn, $_POST['assigndescription']);
	$assignfile = rand(10000,10000000)."-".$_FILES['assignfile']['name'];
	$date= date("y-m-d"); 
	$deadlineday=mysqli_real_escape_string($conn, $_POST['deadline']);
	$deadline=date('y-m-d', strtotime($date.' + '.$deadlineday.'days'));
	$folder="assignments/";
	$file_loc = $_FILES['assignfile']['tmp_name'];
	$new_file_name = strtolower($assignfile);
	$final_file=str_replace(' ','-',$new_file_name);
	if (($_FILES["assignfile"]["type"] == "image/gif")
  || ($_FILES["assignfile"]["type"] == "image/jpeg")
  || ($_FILES["assignfile"]["type"] == "image/png" ) 
  || ($_FILES["assignfile"]["type"] == "application/zip" )
  || ($_FILES["assignfile"]["type"] == "application/x-rar-compressed" )
  || ($_FILES["assignfile"]["type"] == "application/pdf" )
  || ($_FILES["assignfile"]["type"] == "application/msword" )
  || ($_FILES["assignfile"]["type"] == "application/rtf" )
  || ($_FILES["assignfile"]["type"] == "application/vnd.ms-excel" )
  || ($_FILES["assignfile"]["type"] == "application/vnd.ms-powerpoint" ) 
  || ($_FILES["assignfile"]["type"] == "text/plain" ) 
  || ($_FILES["assignfile"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
  || ($_FILES["assignfile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
  || ($_FILES["assignfile"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
  && ($_FILES["assignfile"]["size"] < 100000))
  {
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	$sql_a=mysqli_query($conn, "INSERT INTO assignment
						VALUES(
							NULL,
							$class_id,
							$ekaksha_session,
							'$title',
							'$description',
							'$final_file',
							'$date',
							'$deadline',
							1)
					");
	
				
if($sql_a==true){
	$activity_content="Assignment"." <strong><q>".$title."</q></strong> "."has been added";
		date_default_timezone_set('Asia/Kathmandu');
		$activity_date = date('Y-m-d H:i');
		$sql_activity = mysqli_query($conn, "Insert INTO activity Values (
												NULL,
												$class_id,
												'$activity_content',
												'$activity_date'
												) ");
	$msg = "<div id='success'>Assignment uploaded.</div>";
}
else
	$msg = "<div id='fail'>Assignment failed to upload.</div>";

}
}
else 
	$msg = "<div id='fail'>Only gif, jpeg, png, zip, rar, pdf, doc, docx, rtf, xls, xlsx, ppt, pptx or txt extensions are accepted and file must be less than 10,0000 kb</div>";
}
		
		
if(isset($_POST['btn_upas'])){
	$assign_id = mysqli_real_escape_string($conn, $_POST['as_subm']);
	$description= mysqli_real_escape_string($conn, $_POST['submdescription']);
	$submfile = rand(10000,10000000)."-".$_FILES['submfile']['name'];
	$date= date("y-m-d"); 
	$folder="submissions/";
	$file_loc = $_FILES['submfile']['tmp_name'];
	$new_file_name = strtolower($submfile);
	$final_file=str_replace(' ','-',$new_file_name);
	if (($_FILES["submfile"]["type"] == "image/gif")
  || ($_FILES["submfile"]["type"] == "image/jpeg")
  || ($_FILES["submfile"]["type"] == "image/png" ) 
  || ($_FILES["submfile"]["type"] == "application/zip" )
  || ($_FILES["submfile"]["type"] == "application/x-rar-compressed" )
  || ($_FILES["submfile"]["type"] == "application/pdf" )
  || ($_FILES["submfile"]["type"] == "application/msword" )
  || ($_FILES["submfile"]["type"] == "application/rtf" )
  || ($_FILES["submfile"]["type"] == "application/vnd.ms-excel" )
  || ($_FILES["submfile"]["type"] == "application/vnd.ms-powerpoint" ) 
  || ($_FILES["submfile"]["type"] == "text/plain" ) 
  || ($_FILES["submfile"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
  || ($_FILES["submfile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
  || ($_FILES["submfile"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
  && ($_FILES["submfile"]["size"] < 100000))
  {
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	$sql_as=mysqli_query($conn, "INSERT INTO submission
						VALUES(
							NULL,
							$assign_id,
							$ekaksha_session,
							'$final_file',
							'$description',
							'$date',
							0,
							'')
					");
	
				
if($sql_as==true){
	$msg = "<div id='success'>Submission uploaded.</div>";
}
else
	$msg = "<div id='fail'>Submission failed to upload.</div>";

}
}
else 
	$msg = "<div id='fail'>Only gif, jpeg, png, zip, rar, pdf, doc, docx, rtf, xls, xlsx, ppt, pptx or txt extensions are accepted and file must be less than 10,0000 kb</div>";
}	

if(isset($_POST['btn_reupas'])){
	$resubm_id = mysqli_real_escape_string($conn, $_POST['re_subm']);
	$redescription='<span style="font-size: 14px; color: green; font-weight: bold;">Resubmission:</span>'.' '.$_POST['resubmdesc'];
	$submfile = rand(10000,10000000)."-".$_FILES['resubmfile']['name'];
	$date= date("y-m-d"); 
	$folder="submissions/";
	$file_loc = $_FILES['resubmfile']['tmp_name'];
	$new_file_name = strtolower($submfile);
	$final_file=str_replace(' ','-',$new_file_name);
	if (($_FILES["resubmfile"]["type"] == "image/gif")
  || ($_FILES["resubmfile"]["type"] == "image/jpeg")
  || ($_FILES["resubmfile"]["type"] == "image/png" ) 
  || ($_FILES["resubmfile"]["type"] == "application/zip" )
  || ($_FILES["resubmfile"]["type"] == "application/x-rar-compressed" )
  || ($_FILES["resubmfile"]["type"] == "application/pdf" )
  || ($_FILES["resubmfile"]["type"] == "application/msword" )
  || ($_FILES["resubmfile"]["type"] == "application/rtf" )
  || ($_FILES["resubmfile"]["type"] == "application/vnd.ms-excel" )
  || ($_FILES["resubmfile"]["type"] == "application/vnd.ms-powerpoint" ) 
  || ($_FILES["resubmfile"]["type"] == "text/plain" ) 
  || ($_FILES["resubmfile"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
  || ($_FILES["resubmfile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
  || ($_FILES["resubmfile"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
  && ($_FILES["resubmfile"]["size"] < 100000))
  {
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
 {
	$sql_as=mysqli_query($conn, "UPDATE submission
						SET
							subm_content='$redescription',
							subm_file='$final_file',
							s_status=0,
							s_comment='',
							subm_date='$date'
							WHERE
							subm_id=$resubm_id
					");
	
				
if($sql_as==true){
	$msg = "<div id='success'>Resubmitted.</div>";
}
else
	$msg = "<div id='fail'>Failed to resubmit.</div>";

}
}
else 
	$msg = "<div id='fail'>Only gif, jpeg, png, zip, rar, pdf, doc, docx, rtf, xls, xlsx, ppt, pptx or txt extensions are accepted and file must be less than 10,0000 kb</div>";
}	

?>
	<!-- MAIN CONTENT -->
	
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
							<a class="be-ava-user style-2" href="">
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
    <input class="input-signtype" type="text" name="reinvcode" maxlength="4" required="" placeholder="Enter Invite Code">
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
    <input class="input-signtype" type="text" maxlength="4" name="invcode" required="" placeholder="Enter Invite Code">
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
	<?php } else { ?>
	<form method="POST">
	<input type="button" name="lv_class" class="btn color-1 size-2 hover-1 btn-center" data-toggle="modal" data-target="#leaveclass" value="Leave" />
							<div id="leaveclass" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to leave?</h4>
        </div>
        <div class="modal-body">

	</br>
		</br>
		<input type="submit" name="leave_class" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" />
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
 </form>
							
								<div class="be-user-info">
								Joined on: <?php echo $sql_rows['doj']; ?>
							</div>
							
	<?php } ?>
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
echo $sql_rows['COUNT(*)']; ?></span></div>
						</div>
					</div>
													
				</div>

				

		<div class="col-xs-12 col-md-8 _editor-content_">
		<?php 
							if(isset($msg)) {
							echo $msg; } ?>
		<?php 
							$query =mysqli_query($conn, "Select COUNT(*), doj from join_class where class_id=$class_id AND user_id=$ekaksha_session AND j_status=1"
							);
$sql_rows=mysqli_fetch_assoc($query);
	if($sql_rows['COUNT(*)']==0&&$ekaksha_session!=$class_row['c_user_id']) { ?>
					
						<div class="be-large-post">
						
							<div class="info-block style-2">
					
						
								<div class="be-large-post-align "><h3 class="info-block-label">About Class</h3></div>
					</div>
								<div class="be-large-post-align">
								<?php echo $class_row['about_class']; ?>
								</div>			
								</div>
								
								<?php } else { ?>
									  <div class="tab-wrapper style-1">
 <div class="tab-nav-wrapper">
                            <div  class="nav-tab  clearfix">
                                <div class="nav-tab-item active">
								<?php if($ekaksha_session!=$class_row['c_user_id']){ ?>
                                    <span>Activity</span>
								<?php } else { ?>
									 <span>Students</span>
								<?php } ?>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>Discussion</span>
                                </div>
                                <div class="nav-tab-item ">
                                    <span>Study Materials</span>
                                </div> 
                                <div class="nav-tab-item ">
                                    <span>Videos</span>
                                </div> 
<div class="nav-tab-item ">
                                    <span>Assignments</span>
                                </div> 
<div class="nav-tab-item ">
                                    <span>Quiz</span>
                                </div>                                                               
                            </div>
                        </div>

<div class="tab-info active"> 
							<div class="row">
								<?php
								if($ekaksha_session!=$class_row['c_user_id']){
								$sql_activity=mysqli_query($conn, "Select * from activity where class_id = $class_id ORDER BY activity_date DESC");
								if(mysqli_num_rows($sql_activity)!=0){
								while ($class_activity = mysqli_fetch_array($sql_activity, MYSQLI_ASSOC)){
								?>
								<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
								<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 5px !important; border-radius: 10px !important;">			
								<div class="be-post" style="margin-left: 15px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 0px solid #fff; margin-bottom: 0px !important; padding-bottom: 0px !important; padding-right: 22px !important; color: #0d58c8;">
								<?php echo $class_activity['activity_content']; ?>
								</div> <span style="float: right; color: #222;">
								<i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php 
								$date_activity=strtotime($class_activity['activity_date']);
								echo date('Y-m-d H:i', $date_activity); ?>								
								</span>
								</div>
								</div>
								<?php } } else echo "<div id='failquiz'>No activity yet.</div>"; } else { 
								$sql_student=mysqli_query($conn, "Select * from join_class JOIN user ON join_class.user_id=user.user_id WHERE join_class.class_id=$class_id AND join_class.j_status=1 ORDER BY join_class.doj");
								if(mysqli_num_rows($sql_student)!=0){
								while ($class_student = mysqli_fetch_array($sql_student, MYSQLI_ASSOC)){ ?>
								<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
								<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 5px !important; border-radius: 10px !important;">			
								<div class="be-post" style="margin-left: 15px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 0px solid #fff; margin-bottom: 0px !important; padding-bottom: 0px !important; padding-right: 22px !important; color: #0d58c8;">
								<div class="be-img-comment" style="width: 15px; height: 15px; margin-left: 0px; margin-right: 5px;">	
									<a href="profile.php?p_user_id=<?php echo $class_student['user_id']; ?>">
										<img src="displayimg/<?php echo $class_student['pp_file']; ?>" alt="" class="be-ava-comment" style="width: 15px; height: 15px;">
									</a>
								</div>
								<a href="profile.php?p_user_id=<?php echo $class_student['user_id']; ?>">
								<?php echo $class_student['f_name']." ".$class_student['l_name']; ?>
								</a>&nbsp;&nbsp;&nbsp;<a data-toggle="modal" data-id="<?php echo $class_student['user_id']; ?>" class="rem_stu" href="#removestudent"  title="Remove Student"  style="color: red;">X</a>
								</div>
								</div>
								</div>
								<form method="POST">
								<div id="removestudent" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to remove Student?</h4>
        </div>
        <div class="modal-body">
		<em>Student may rejoin class again.</em>
		<br>
		<br>
		<center>
		<input type="hidden" id="remstu" name="remstuid" value="">
		<input type="submit" name="remove_student" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
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

								
								<?php } } else {echo "<div id='failquiz'>No students yet.</div>";} } ?>
</div>
</div>
<div class="tab-info"> 					
							<div class="row">
						
<div class="sec"  data-sec="about-me" >
						<div class="input-col col-xs-12">
										<div class="form-group focus-2">
										<form method="POST">
											<textarea class="form-input" maxlength="300" name="post" style="height:50px;" placeholder="Want to share something? Need to ask any question?" required=""></textarea>
											<input type="submit" name="btn_qa" class="btn color-1 size-2 hover-1 btn-right" style="margin-top: 5px;" value="Post" />

										</form>

										<?php
										
							$sql_post=mysqli_query($conn, "Select * from qa_question where class_id = $class_id ORDER BY qa_date DESC");
							if(mysqli_num_rows($sql_post)!=0){ 
							while ($class_post = mysqli_fetch_array($sql_post, MYSQLI_ASSOC)){
										?>
										</br>
										</br>
											
											<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
										<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 5px !important; border-radius: 10px !important;">
										<?php
$sql_post_user=mysqli_query($conn, "Select user_id, f_name, l_name, pp_file from user where user_id=$class_post[user_id]");
while ($user_post = mysqli_fetch_array($sql_post_user, MYSQLI_ASSOC)){ ?>
<div class="be-img-comment" style="width: 25px; height: 25px; margin-left: 15px;">	
									<a href="profile.php?p_user_id=<?php echo $user_post['user_id']; ?>">
									
										<img src="displayimg/<?php echo $user_post['pp_file']; ?>" alt="" class="be-ava-comment" style="width: 25px; height: 25px;">
									</a>
								</div>
											<span style="float: left; font-size: 16px; padding-left: 7px !important;"><a href="page1.html">
											<?php echo $user_post['f_name'].' '.$user_post['l_name']; ?>	
</a></span> <?php }?>
										<span style="float: right;">
										    <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_post['qa_date']; ?>												
											</span>
											
								<div class="be-post" style="margin-left: 45px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 0px !important; padding-bottom: 0px !important; padding-right: 52px !important;">
								<?php echo $class_post['question']; ?>
								</br>
								<?php if($ekaksha_session==$class_post['user_id']||$ekaksha_session==$class_row['c_user_id']) { ?>
								<?php $deletepostid = $class_post['ques_id']; ?>
								<span style="float:right"><em style="color: blue;"><a data-toggle="modal" data-id="<?php echo $class_post['ques_id']; ?>" data-text="<?php echo $class_post['question']; ?>" class="ed_post" href="#editpost"  title="Edit Post"  style="color: blue;"><i class="fa fa-pencil"></i></a></em>&nbsp;&nbsp;<em><a data-toggle="modal" data-id="<?php echo $class_post['ques_id']; ?>" class="del_post" href="#deletepost"  title="Delete Post"  style="color: red;">X</a></em></span>
								<?php } ?>
								</div>
								<form method="POST">
								<div id="deletepost" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to delete?</h4>
        </div>
        <div class="modal-body">
		<em>This can not be undone.</em>
		</br>
		</br>
		<center><input type="hidden" id="delpostid" name="delpost" value="">
		<input type="submit" name="delete_post" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" />
		</center>
		</br>
		</br>
        </div>
      </div>
</div>
</div>
</form>
<form method="POST">
								<div id="editpost" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Post</h4>
        </div>
        <div class="modal-body">
		</br>
		</br>
		<input type="hidden" id="edpostid" name="edpostid" value="">
		<textarea class="form-input" id="edposttext" maxlength="300" name="edposttext" style="height:50px;" value="" required=""></textarea>
		</br>
		</br>
		<input type="submit" name="edit_post" class="btn color-1 size-2 hover-1 btn-right" value="Edit" />
		</br>
		</br>
        </div>
      </div>
</div>
</div>
</form>
											<span style="float: left; margin-left: 30px;"><a href="">Comments:</a></span>
											<?php
$sql_comment=mysqli_query($conn, "Select * from qa_answer where ques_id = $class_post[ques_id] ORDER BY ans_date");
		
		while ($class_comment = mysqli_fetch_array($sql_comment, MYSQLI_ASSOC)){
										?>
										<div class="be-post" style="display: inline-block; border: 0px; !important; margin-bottom: 0px !important; ">
						<?php
$sql_comment_user=mysqli_query($conn, "Select user_id, f_name, l_name, pp_file from user where user_id=$class_comment[user_id]");
while ($user_comment = mysqli_fetch_array($sql_comment_user, MYSQLI_ASSOC)){ ?>
								<div class="be-img-comment" style="width: 15px; height: 15px; margin-left: 45px;">	
									<a href="profile.php?p_user_id=<?php echo $user_comment['user_id']; ?>">
									
										<img src="displayimg/<?php echo $user_comment['pp_file']; ?>" alt="" class="be-ava-comment" style="width: 15px; height: 15px;">
									</a>
								</div>
											<span style="float: left; padding-left: 7px !important;"><a href="page1.html">
											<?php echo $user_comment['f_name'].' '.$user_comment['l_name']; ?>
											
</a></span> <?php }?>
										
											<span style="float: right;">
										   <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_comment['ans_date']; ?>												
											</span>
											</div>
							<div class="be-post" style="margin-left: 68px; display: inline-block; border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; font-size: 12px; padding-bottom: 5px !important; padding-right: 75px !important;">
								<?php echo $class_comment['answer']; ?>
								</br>
								<?php if($ekaksha_session==$class_comment['user_id']||$ekaksha_session==$class_row['c_user_id']) { ?>
								
								<span style="float:right"><em style="color: blue;"><a data-toggle="modal" data-id="<?php echo $class_comment['ans_id']; ?>" data-text="<?php echo $class_comment['answer']; ?>" class="ed_post" href="#editcomment"  title="Edit Comment"  style="color: blue;"><i class="fa fa-pencil"></i></a></em>&nbsp;&nbsp;<em><a data-toggle="modal" data-id="<?php echo $class_comment['ans_id']; ?>" class="del_comment" href="#deletecomment"  title="Delete Comment"  style="color: red;">X</a></em></span>
								<?php } ?>
								</div>
								<form method="POST">
								<div id="deletecomment" class="modal fade" role="dialog">
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
		<input type="submit" name="delete_comment" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delcommentid" name="delcomment" value="">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" /></center>
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>
<form method="POST">
								<div id="editcomment" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Comment</h4>
        </div>
        <div class="modal-body">
		</br>
		</br>
		<input type="hidden" id="edpostid" name="edcommentid" value="">
		<textarea class="form-input" id="edposttext" maxlength="300" name="edcommenttext" style="height:50px;" value="" required=""></textarea>
		</br>
		</br>
		<input type="submit" name="edit_comment" class="btn color-1 size-2 hover-1 btn-right" value="Edit" />
		</br>
		</br>
        </div>
      </div>
</div>
</div>
</form>
										
		<?php } ?>
											</br>
											<div style="padding: 0 15px 0 45px;">
											<form method="POST">
											<textarea class="form-input" name="comment" maxlength="300" style="height:30px; width: 100%;" placeholder="Comment..." required=""></textarea>
											<input type="hidden" name="post_id" value="<?php echo $class_post['ques_id'];?>" />	
											<input type="submit" name="btn_com" class="btn color-1 size-2 hover-1 btn-right" style="margin-top: 5px; padding: 10px !important;" value="Comment" />

											</form>
											</div>
											
										</div>									
									</div>
										
										<?php
							} } else echo "<div id='failquiz' style='margin-top:60px;'>No discussions yet.</div>";
										?>
										</div>
										</div>
					</div>
</div>
</div>
<div class="tab-info"> 					
							<div class="row">
						<?php 
							if($ekaksha_session==$class_row['c_user_id']) {
							?>
							<form action="class.php" method="POST">
							<input type="button" name="upsm" class="btn color-1 size-2 hover-1 btn-right" data-toggle="modal" data-target="#studymaterials" value="Upload Study Materials" />					
						</form>
							<?php } 
							?>
							
							<div id="studymaterials" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Study Material</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST" enctype="multipart/form-data">
											<div class="form-label">Title</div>
											<input class="form-input" type="text" maxlength="100" name="notetitle" placeholder="Enter Title..." required="">
											</br>
											</br>
											<div class="form-label">Description</div>
											<textarea class="form-input" name="notedescription" maxlength="300" style="height:100px; width: 100%;" placeholder="Enter Description..." required=""></textarea>
											</br>
											</br>
											<div class="form-label">File</div>
											<input type="file" name="notefile" required="">
											</br>
											</br>
											<input type="submit" name="btn_upsm" class="btn color-1 size-2 hover-1 btn-right" value="Upload" />
										</form>
										</div>							
									</div>
</div>
        </div>
      </div>
</div>
</div>
<?php
$sql_sm=mysqli_query($conn, "Select * from note where class_id = $class_id ORDER BY note_date DESC");
		if(mysqli_num_rows($sql_sm)!=0){
		while ($class_sm = mysqli_fetch_array($sql_sm, MYSQLI_ASSOC)){
										?>									
										</br>
<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
										<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 15px !important; border-radius: 10px !important;">

											<span style="float: left; font-size: 18px; font-weight: bold; padding-left: 7px !important; color:#0D58C8 !important;">
		<?php echo $class_sm['note_title'];?>
											
</span> 

											</br>
								<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; padding-bottom: 7px !important; padding-right: 14px !important;">
								<?php echo $class_sm['note_content']; ?>
								</br>
								</div>
								<span style="float: left; color: #484848 !important;"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_sm['note_date']; ?>&nbsp;&nbsp; <?php if($ekaksha_session==$class_row['c_user_id']) { ?>
								<em style="color: blue;"><a data-toggle="modal" data-id="<?php echo $class_sm['note_id']; ?>" data-title="<?php echo $class_sm['note_title']; ?>" data-content="<?php echo $class_sm['note_content']; ?>" class="ed_sm" href="#editsm"  title="Edit Study Material"  style="color: blue;"><i class="fa fa-pencil"></i></a></em>&nbsp;&nbsp;<em><a data-toggle="modal" data-id="<?php echo $class_sm['note_id']; ?>" class="del_sm" href="#deletesm"  title="Delete Study Material"  style="color: red;">X</a></em> <?php } ?> </span> <a download href="notes/<?php echo $class_sm['note_file'] ?>" target="_blank"><input type="button" value="File Download" class="btn color-1 size-2 hover-1 btn-right" style="margin-right: 10px;" title="Download Study Material" name="download"/></a>
								<form method="POST">
								<div id="deletesm" class="modal fade" role="dialog">
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
		<input type="submit" name="delete_sm" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delsmid" name="delsm" value="">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" /></center>
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>
			
<form method="POST" enctype="multipart/form-data">
								<div id="editsm" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Study Material</h4>
        </div>
        <div class="modal-body">
		</br>
		</br>
		<div class="form-group fg_icon focus-2">
		<input type="hidden" id="edsmid" name="edsmid" value="">		
		<div class="form-label">Title</div>
		<input class="form-input" type="text" maxlength="100" name="edsmtitle" id="edsmtitle" value="" required="">
		</br>
		</br>
		<div class="form-label">Description</div>
		<textarea class="form-input" maxlength="300" id="edsmcontent" name="edsmcontent" style="height:50px;" value="" required=""></textarea>
		</br>
		</br>
		<div class="form-label">New File</div>
		<input type="file" name="edsmfile" id="edsmfile" value="">
		<p><em>Leave file field empty to keep existing file</em>
		</br>
		</br>
		<input type="submit" name="edit_sm" class="btn color-1 size-2 hover-1 btn-right" value="Edit" />
		</br>
		</br>
      </div>
	  </div>
	  </div>
</div>
</div>
</form>			

							</div>
</div>
		<?php } } else echo "<div id='failquiz' style='margin-top:60px;'>No study materials yet.</div>"; ?>
</div>
</div>
<div class="tab-info"> 					
							<div class="row">
<?php 
							if($ekaksha_session==$class_row['c_user_id']) {
							?>
							<form action="class.php" method="POST">
							<input type="button" name="videos" class="btn color-1 size-2 hover-1 btn-right" data-toggle="modal" data-target="#videos" value="Add Videos" />					
						</form>
							<?php } 
							?>
							
							<div id="videos" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Video</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST">
											<div class="form-label">Title</div>
											<input class="form-input" type="text" maxlength="100" name="videotitle" placeholder="Enter Title..." required="">
											</br>
											</br>
											<div class="form-label">Description</div>
											<textarea class="form-input" maxlength="300" name="videodescription" style="height:100px; width: 100%;" placeholder="Enter Description..." required=""></textarea>
											</br>
											</br>
											<div class="form-label">Link</div>
											<input class="form-input" type="url" maxlength="100" name="videolink" placeholder="Enter youtube link..." required="">
											</br>
											</br>
											<input type="submit" name="btn_upv" class="btn color-1 size-2 hover-1 btn-right" value="Add Video" />
										</form>
										</div>						
									</div>
</div>
        </div>
      </div>
</div>
</div>
<?php
$sql_v=mysqli_query($conn, "Select * from lecture where class_id = $class_id ORDER BY lecture_date DESC");
		if(mysqli_num_rows($sql_v)!=0){
		while ($class_v = mysqli_fetch_array($sql_v, MYSQLI_ASSOC)){
										?>									
										</br>
<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
										<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 15px !important; border-radius: 10px !important;">

											<span style="float: left; font-size: 18px; font-weight: bold; padding-left: 7px !important; color:#0D58C8 !important;">
		<?php echo $class_v['lecture_title'];?>
											
</span> 

											</br>
								<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; padding-bottom: 7px !important; padding-right: 14px !important;">
								<?php echo $class_v['lecture_description']; ?>
								</br>
								</div>
								<span style="float: left; color: #484848 !important;"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_v['lecture_date']; ?>&nbsp;&nbsp; <?php if($ekaksha_session==$class_row['c_user_id']) { ?>
								<em style="color: blue;"><a data-toggle="modal" data-id="<?php echo $class_v['lecture_id']; ?>" data-title="<?php echo $class_v['lecture_title']; ?>" data-text="<?php echo $class_v['lecture_description']; ?>" data-link="<?php echo $class_v['lecture_link']; ?>" class="ed_v" href="#editvideo"  title="Edit Video"  style="color: blue;"><i class="fa fa-pencil"></i></a></em>&nbsp;&nbsp;<em><a data-toggle="modal" data-id="<?php echo $class_v['lecture_id']; ?>" class="del_v" href="#deletevideo"  title="Delete Videos"  style="color: red;">X</a></em> <?php } ?> </span> <a href="<?php echo $class_v['lecture_link'] ?>" target="_blank"><input type="button" value="Watch Video" title="Watch Video" class="btn color-1 size-2 hover-1 btn-right" style="margin-right: 10px;" name="watch"/></a>
							</div>
							<form method="POST">
								<div id="deletevideo" class="modal fade" role="dialog">
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
		<input type="submit" name="delete_v" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delvideoid" name="delv" value="">
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

<form method="POST">
								<div id="editvideo" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Video</h4>
        </div>
        <div class="modal-body">
		<div class="form-group fg_icon focus-2">		
		<input type="hidden" id="edvid" name="edvid" value="">
		</br>
		</br>
		<div class="form-label">Title</div>
		<input class="form-input" type="text" maxlength="100" id="edvtitle" name="edvtitle" value="" required="">
		</br>
		</br>
		<div class="form-label">Description</div>
		<textarea class="form-input" id="edvtext" maxlength="300" name="edvtext" style="height:50px;" value="" required=""></textarea>
		</br>
		</br>
		<div class="form-label">Link</div>
		<input class="form-input" type="url" maxlength="100" id="edvlink" name="edvlink" value="" required="">
		</br>
		</br>
		<input type="submit" name="edit_v" class="btn color-1 size-2 hover-1 btn-right" value="Edit" />
		</br>
		</br>
        </div>
		</div>
      </div>
</div>
</div>
</form>

</div>
		<?php } } else echo "<div id='failquiz' style='margin-top:60px;'>No videos yet.</div>"; ?>
</div>
</div>
<div class="tab-info"> 					
							<div class="row">
						<?php 
							if($ekaksha_session==$class_row['c_user_id']) {
							?>
							<form action="class.php" method="POST">
							<input type="button" name="upa" class="btn color-1 size-2 hover-1 btn-right" data-toggle="modal" data-target="#assignment" value="Upload Assignment" />					
						</form>
							<?php } 
							?>
							
							<div id="assignment" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 600px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Assignment</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST" enctype="multipart/form-data">
											<div class="form-label">Title</div>
											<input class="form-input" type="text" maxlength="100" name="assigntitle" placeholder="Enter Title..." required="">
											</br>
											</br>
											<div class="form-label">Description</div>
											<textarea class="form-input" name="assigndescription" maxlength="300" style="height:100px; width: 100%;" placeholder="Enter Description..." required=""></textarea>
											</br>
											</br>
											<div class="form-label">File</div>
											<input type="file" name="assignfile" required="">
											</br>
								<div class="form-label">Deadline</div>
						<div class="col-md-12 be-date-block">
							<span style="float: left;">After&nbsp;&nbsp;</span>
							<div style="float: left !important;">
								<select  name="deadline" required>
									<option value="" disabled selected>
										Select
									</option>
									<?php
                        for($i=1;$i<=60;$i++){
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
							<span style="float: left;"> &nbsp;&nbsp;Days</span>
						</div>
						</br>
											<input type="submit" name="btn_upa" class="btn color-1 size-2 hover-1 btn-right" value="Upload" />
										</form>
										</div>							
									</div>
</div>
        </div>
      </div>
</div>
</div>
<?php
$sql_a=mysqli_query($conn, "Select * from assignment where class_id = $class_id ORDER BY assign_date DESC");
		if(mysqli_num_rows($sql_a)!=0){
		while ($class_a = mysqli_fetch_array($sql_a, MYSQLI_ASSOC)){
										?>									
										</br>
<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
										<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 15px !important; border-radius: 10px !important;">

											<span style="float: left; font-size: 18px; font-weight: bold; padding-left: 7px !important; color:#0D58C8 !important;">
		<?php echo $class_a['assign_title'];?>
											
</span> 

											</br>
								<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; padding-bottom: 7px !important; padding-right: 14px !important;">
								<?php echo $class_a['assign_content']; ?>
								</br>
								</div>
<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; padding-bottom: 7px !important; padding-right: 14px !important;">								<span style="float: left; color: #484848 !important;"> <i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo $class_a['assign_date']; ?>&nbsp;&nbsp; <span style="color:red;">Deadline: </i>&nbsp;&nbsp;<?php echo $class_a['assign_deadline']; ?></span>&nbsp;&nbsp; <?php if($ekaksha_session==$class_row['c_user_id']) { ?>
							<em><a data-toggle="modal" data-id="<?php echo $class_a['assign_id']; ?>" class="del_assign" href="#deleteassign"  title="Delete Assignment"  style="color: red;">X</a></em> <?php } ?> </span> <a download href="assignments/<?php echo $class_a['assign_file'] ?>" target="_blank"><input type="button" value="File Download" class="btn color-1 size-2 hover-1 btn-right" style="margin-right: 10px;" name="download"/></a>
								</div>
								
								<form method="POST">
								<div id="deleteassign" class="modal fade" role="dialog">
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
		<input type="submit" name="delete_assign" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delassignid" name="delassign" value="">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" /></center>
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>

							<!--submission -->
											<span style="font-size: 14px; color: #0D58C8; font-weight: bold;">Submission:</span>
											<?php
											if($ekaksha_session==$class_a['user_id'])
											{ $sql_as=mysqli_query($conn, "Select * from submission where assign_id = $class_a[assign_id] ORDER BY s_status, subm_date");
											}
											else {
											$sql_as=mysqli_query($conn, "Select * from submission where assign_id = $class_a[assign_id] AND user_id=$ekaksha_session ORDER BY subm_date");
											}
											while ($class_as = mysqli_fetch_array($sql_as, MYSQLI_ASSOC)){
												
											 ?>
										
											<div class="be-post" style="display: inline-block; border: 0px; !important; margin-bottom: 0px !important; ">
						<?php
$sql_as_user=mysqli_query($conn, "Select f_name, l_name from user where user_id=$class_as[user_id]");
while ($user_as = mysqli_fetch_array($sql_as_user, MYSQLI_ASSOC)){ ?>
											<span style="float: left; padding-left: 21px !important;"><a href="page1.html">
											<?php echo $user_as['f_name'].' '.$user_as['l_name']; ?>
											
</a></span> <?php }?>
										
											<span style="float: right; color:#484848 !important;">
										   <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_as['subm_date']; ?>												
											</span>
											</div>

<div style="border-bottom: 2px solid #fff; margin-bottom: 5px !important; font-size: 12px; padding-left: 21px; padding-bottom: 5px !important; padding-right: 21px !important;">
								<?php echo $class_as['subm_content']; ?>
								</br>
		</div>
		<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-bottom: 5px !important; padding-bottom: 7px !important; padding-right: 14px !important;">								<span style="float: left; color: #484848 !important;"><?php $status = $class_as['s_status'];
											if($ekaksha_session==$class_a['user_id'])
											{ if($status==0) {  ?>   
										<a data-id="<?php echo $class_as['subm_id']; ?>" data-toggle="modal" href="#acceptas" title="Accept Submission" class="acc_subm btn color-1 size-2 hover-1" style="margin-right: 10px;">Accept</a> 
										<a data-id="<?php echo $class_as['subm_id']; ?>" class="rej_subm btn color-1 size-2 hover-1" style="margin-right: 10px; background: red; border: 1px solid red;" data-toggle="modal" href="#rejectas" name="reject">Reject</a>
										
											<?php }
										if($status==1) {
										echo "<span style='color: red; font-weight: bold; font-size: 14px;'>Rejected. Resubmission waiting.</span></br>";
										echo "<span style='color: red; font-weight: bold; font-size: 12px;'>Comment:</span></br>";
										echo $class_as['s_comment'];
										}
										if($status==2) {
										echo "<span style='color: green; font-weight: bold; font-size: 14px;'>Accepted.</span></br>";
										echo "<span style='color: green; font-weight: bold; font-size: 12px;'>Comment:</span></br>";
										echo $class_as['s_comment'];
										}
											?>
											
										<form method="POST">
								<div id="acceptas" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Accept Submission</h4>
        </div>
        <div class="modal-body">

	<br>
		<br>
		<!--acceptsubm-->
		<div class="form-label">Comment</div>
		<textarea class="form-input" name="acccomment" maxlength="100" style="height:100px; width: 100%;" placeholder="Enter Comment..." required=""></textarea>
		</br>
		</br>
		<input type="hidden" name="accsubmid" id="accsubm" value="" />
		<input type="submit" name="acc_subm" class="btn color-1 size-2 hover-1 btn-right" value="Accept" />
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>

<form method="POST">
								<div id="rejectas" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reject Submission</h4>
        </div>
        <div class="modal-body">

	<br>
		<br>
		<div class="form-label">Comment</div>
		<textarea class="form-input" name="rejcomment" maxlength="100" style="height:100px; width: 100%;" placeholder="Enter Comment..." required=""></textarea>
		</br>
		</br>
		<input type="hidden" name="rejsubmid" id="rejsubm" value="" />
		<input type="submit" name="rej_subm" class="btn color-1 size-2 hover-1 btn-right" style="background: red; border: 1px solid red;" value="Reject" />
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>
						
											<?php } else { 
										 
					 $status = $class_as['s_status'];
					 if($status==0)
						 echo "<span style='color: #0D58C8; font-weight: bold; font-size: 14px;'>Pending</span>";
					 if($status==1)
					 {
						  echo "<span style='color:red; font-weight: bold; font-size: 14px;'>Rejected</span>";
						?> 
					<a data-id="<?php echo $class_as['subm_id']; ?>" title='Resubmit' class='re_subm btn color-1 size-2 hover-1' style='margin-right: 10px;' data-toggle='modal' href='#resubmit'>Resubmit<a/> 
					</br>
					<div id="resubmit" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Resubmit Assignment</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST" enctype="multipart/form-data">
											<input type="hidden" name="re_subm" id="resubm" value=""/>	
											<div class="form-label">Description</div>
											<textarea class="form-input" name="resubmdesc" maxlength="300" style="height:100px; width: 100%;" placeholder="Enter Description..." required=""></textarea>
											</br>
											</br>
											<div class="form-label">File</div>
											<input type="file" name="resubmfile" required="">
											</br>
											<input type="submit" name="btn_reupas" class="btn color-1 size-2 hover-1 btn-right" value="Submit" />
										</form>
										</div>							
									</div>
</div>
        </div>
      </div>
</div>
</div>
						  <?php 
						  echo "<br><span style='color: red; font-weight: bold;'>Comment:</span><br>"; 
						  echo $class_as['s_comment']; 
					 }
						if($status==2) {
						 echo "<span style='color:green; font-weight: bold; font-size: 14px;'>Accepted</span>";
					  echo "<br><span style='color: green; font-weight: bold;'>Comment:</span><br>"; 
						echo $class_as['s_comment'];
						}
					} ?>
											
										</span> 
								
								<a download href="submissions/<?php echo $class_as['subm_file'] ?>" target="_blank"><input type="button" value="File Download" class="btn color-1 size-2 hover-1 btn-right" style="margin-right: 10px;" name="download"/></a>
								</div>
		<?php } ?>
	<?php
	$check_user =mysqli_query($conn, "Select COUNT(*) from submission where user_id=$ekaksha_session AND assign_id=$class_a[assign_id]"
							);
$sql_rows=mysqli_fetch_assoc($check_user);
	if($sql_rows['COUNT(*)']==0&&$ekaksha_session!=$class_row['c_user_id']) { ?>
							<a data-id="<?php echo $class_a['assign_id']; ?>" title='Submit' class='asss_subm btn color-1 size-2 hover-1' style='margin-right: 10px;' data-toggle='modal' href='#submission'>Submit<a/> 
							
							<div id="submission" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 468px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Submit Assignment</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST" enctype="multipart/form-data">
											<input type="hidden" name="as_subm" id="assubm" value=""/>	
											<div class="form-label">Description</div>
											<textarea class="form-input" name="submdescription" maxlength="300" style="height:100px; width: 100%;" placeholder="Enter Description..." required=""></textarea>
											</br>
											</br>
											<div class="form-label">File</div>
											<input type="file" name="submfile" required="">
											</br>
											<input type="hidden" name="assign_id" value="<?php echo $class_as['assign_id'];?>" />	
											<input type="submit" name="btn_upas" class="btn color-1 size-2 hover-1 btn-right" value="Submit" />
										</form>
										</div>							
									</div>
</div>
        </div>
      </div>
</div>
</div>
	<?php } ?>
							<!-- submission end --> 
</div>
</div>
		<?php } } else echo "<div id='failquiz' style='margin-top:60px;'>No assignments yet.</div>"; ?>
</div>
</div>
<div class="tab-info"> 					
							<div class="row">
							<?php 
							if($ekaksha_session==$class_row['c_user_id']) {
							?>
						<form action="class.php" method="POST">
						<input type="button" name="addquiz" class="btn color-1 size-2 hover-1 btn-right" data-toggle="modal" data-target="#addquiz" value="Add Quiz" />					
							</form>
							<?php } 
							?>
								<div id="addquiz" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 500px !important;">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Quiz</h4>
        </div>
        <div class="modal-body">
<div class="row">
									<div class="input-col col-xs-12 col-sm-12">
										<div class="form-group fg_icon focus-2">
										<form method="POST">
										<input type="hidden" name="noofques" value="5" />
										<div class="form-label">Quiz Title</div>
											<input class="form-input" type="text" maxlength="100" name="quiztitle" placeholder="Enter Quiz Title..." required="">
											</br>
											</br>
										<?php
											$x = 1;
											while($x <= 5) { ?>
											<div class="form-label">Question <?php echo $x; ?></div>
											<input class="form-input" type="text" maxlength="300" name="question<?php echo $x; ?>" placeholder="Enter Question <?php echo $x; ?>..." required="">
											</br>
											</br>
											<table class="table">
											<tr>
											<td>
											<div class="form-label">Option 1</div>
											<input class="form-input" type="text" maxlength="100" name="option1q<?php echo $x; ?>" placeholder="Enter Option 1..." required="">
											</td>
											<td>
											<div class="form-label">Option 2</div>
											<input class="form-input" type="text" maxlength="100" name="option2q<?php echo $x; ?>" placeholder="Enter Option 2..." required="">
											</td>
											</tr>
											<tr>
											<td>
											<div class="form-label">Option 3</div>
											<input class="form-input" type="text" maxlength="100" name="option3q<?php echo $x; ?>" placeholder="Enter Option 3..." required="">
											</td>
											<td>
											<div class="form-label">Option 4</div>
											<input class="form-input" type="text" maxlength="100" name="option4q<?php echo $x; ?>" placeholder="Enter Option 4..." required="">
											</td>
											</tr>
											</table>
											<div class="col-md-12 be-date-block">
											<div class="be-custom-select-block mounth">
											<div class="form-label">Select Correct Option</div>
											<select class="be-custom-select" name="correctoption<?php echo $x; ?>" required>
											<option value="" selected="selected">Select</option>
											<option value="1">Option 1</option>
											<option value="2">Option 2</option>
											<option value="3">Option 3</option>
											<option value="4">Option 4</option>
											</select>
											</div>
											</div>
											</br>
											</br>
											<?php $x=$x+1; } ?>
											<input type="submit" name="btn_addquiz" class="btn color-1 size-2 hover-1 btn-right" value="Add Quiz" />
										</form>
										</div>							
									</div>
</div>
        </div>
      </div>
</div>
</div>

<?php
$sql_t=mysqli_query($conn, "Select * from test where class_id = $class_id ORDER BY test_date DESC");
		if(mysqli_num_rows($sql_t)!=0){
		while ($class_t = mysqli_fetch_array($sql_t, MYSQLI_ASSOC)){
										?>									
										</br>
<div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px; width: 100%;">
										<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 15px !important; border-radius: 10px !important;">

											<span style="float: left; font-size: 14px; font-weight: bold; padding-left: 7px !important; color:#0D58C8 !important;">
											<?php echo $class_t['test_title'];?>									
											</span> 
								<div class="be-post" style="margin-left: 7px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #fff; margin-top: -20px; margin-bottom: 10px !important; padding-bottom: 0px !important; padding-right: 14px !important;">
								<?php echo $class_v['lecture_description']; ?>
								</br>
								</div>
								<span style="float: left; color: #484848 !important;"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $class_t['test_date']; ?>&nbsp;&nbsp; <?php if($ekaksha_session==$class_row['c_user_id']) { ?>
								<em><a data-toggle="modal" data-id="<?php echo $class_t['test_id']; ?>" class="del_q" href="#deletequiz"  title="Delete Quiz"  style="color: red;">X</a></em> <?php } ?></span> 
								<form action="takequiz.php" method="POST">
								<input type="hidden" name="editquizid" value="<?php echo $class_t['test_id']; ?>" />
								<input type="hidden" name="editquizclassid" value="<?php echo $class_id; ?>" />
									<?php 
													$sql_check=mysqli_query($conn, "SELECT COUNT(*) from test_result where test_id=$class_t[test_id] and user_id=$ekaksha_session");
													$sql_checkq=mysqli_fetch_assoc($sql_check);
													if($sql_checkq['COUNT(*)']==0&&$ekaksha_session!=$class_row['c_user_id']){
													?>
								<input type="submit" title="Take Quiz" name="editq" class="ed_q btn color-1 size-2 hover-1 btn-right" value="Take Quiz"/>
													<?php } else if($sql_checkq['COUNT(*)']!=0&&$ekaksha_session!=$class_row['c_user_id']) { ?>
								<input type="submit" title="Review Quiz" name="editq" class="ed_q btn color-1 size-2 hover-1 btn-right" value="Review Quiz"/>

													<?php } ?>
								</form>
							</div>
							<form method="POST">
								<div id="deletequiz" class="modal fade" role="dialog">
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
		<input type="submit" name="delete_t" class="btn color-1 size-2 hover-1 btn-center"  value="Yes" />
		<input type="hidden" id="delq" name="delt" value="">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="no" class="btn color-1 size-2 hover-1 btn-center" data-dismiss="modal" style="background: red; border: 1px solid red !important;" value="No" /></center>
		
		<br>
		<br>
        </div>
      </div>
</div>
</div>
</form>
</div>
		<?php } } else echo "<div id='failquiz' style='margin-top:60px;'>No quizzes yet.</div>"; ?>
</div>
</div>
</div>		
	<?php } ?>	
								</div>			
			</div>
		</div>	 
	
	</div>
	
<?php } ?>



	<?php include('footer.php'); ?>

	<div class="be-fixed-filter"></div>
	</body>
</html>