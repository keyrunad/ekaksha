<?php 
include('session.php');
if(isset($_POST['btn_takequiz']))
{
$testquesno=mysqli_real_escape_string($conn,$_POST['testnoofques']);
$xcount=1;
while($xcount<=$testquesno){
	$questionid=mysqli_real_escape_string($conn,$_POST['questionid'.$xcount]);
	$answerid=mysqli_real_escape_string($conn,$_POST['answeroption'.$xcount]);
	$sql_tquiz=mysqli_query($conn, "INSERT INTO test_result VALUES(
	NULL,
	$ekaksha_session,
	$questionid,
	$answerid
	)"
	);
$xcount=$xcount+1;
	}
	header("Location:takequiz.php");
}
?>