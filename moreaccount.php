<?php include('session.php'); ?>
<?php
	$resultsPerPage=10;
    if(isset($_POST['page'])):
    $paged=$_POST['page'];
    $sql="Select * from join_class JOIN activity ON join_class.class_id=activity.class_id WHERE join_class.user_id=$ekaksha_session AND join_class.j_status=1  ORDER BY activity.activity_date DESC";
    if($paged>0){
           $page_limit=$resultsPerPage*($paged-1);
           $pagination_sql=" LIMIT  $page_limit, $resultsPerPage";
           }
    else{
    $pagination_sql=" LIMIT 0 , $resultsPerPage";
    }
    $result=mysqli_query($conn, $sql.$pagination_sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
    while($class_activity=mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
 
 <div class="col-ml-12 col-xs-6 col-sm-12" style="padding: 5px 0px 5px 0px;">
								<div class="be-post" style="padding:5px 0px 5px 0px; display: inline-block; background: #f3f3f3; margin-bottom: 5px !important; border-radius: 10px !important;">			
								<div class="be-post" style="margin-left: 15px; display: inline-block;   border-top: 0px; border-left:0px; border-right: 0px; border-bottom: 0px solid #fff; margin-bottom: 0px !important; padding-bottom: 0px !important; padding-right: 22px !important; color: #0d58c8;">
								<?php $class_act_id=$class_activity['class_id'];
								$sql_class_act=mysqli_query($conn, "Select class_name from class where class_id=$class_act_id");
								$sql_class_name=mysqli_fetch_assoc($sql_class_act);
								?>
								<a href="class.php?class_id=<?php echo $class_act_id; ?>">
								<?php echo $class_activity['activity_content']." in class <strong><q>".$sql_class_name['class_name']."</q></strong>"; ?>
								</a>
								</div> <span style="float: right; color: #222;">
								<i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php 
								$date_activity=strtotime($class_activity['activity_date']);
								echo date('Y-m-d H:i', $date_activity); ?>								
								</span>
								</div>
								</div>
   <?php } 
    }
    if($num_rows == $resultsPerPage){?>
    <li class="loadbutton"><button class="loadmore" id="loadmoreaccact" data-page="<?php echo  $paged+1 ;?>">Load More</button></li>
 <?php
  }else{
    echo "No more activities...";
 }
 endif;
 ?>