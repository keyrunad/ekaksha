$(document).on("click", ".del_post", function () {
    var delpid = $(this).data('id');
    $(".modal-body #delpostid").val( delpid );
	});

$(document).on("click", ".del_comment", function () {
    var delcid = $(this).data('id');
    $(".modal-body #delcommentid").val( delcid );
	});
	
$(document).on("click", ".del_sm", function () {
    var delsmid = $(this).data('id');
    $(".modal-body #delsmid").val( delsmid );
	});

$(document).on("click", ".del_v", function () {
    var delvid = $(this).data('id');
    $(".modal-body #delvideoid").val( delvid );
	});
	
$(document).on("click", ".del_assign", function () {
    var delaid = $(this).data('id');
    $(".modal-body #delassignid").val( delaid );
	});
	
$(document).on("click", ".acc_subm", function () {
    var accid = $(this).data('id');
    $(".modal-body #accsubm").val( accid );
	});
	
$(document).on("click", ".rej_subm", function () {
    var rejid = $(this).data('id');
    $(".modal-body #rejsubm").val( rejid );
	});
	
$(document).on("click", ".re_subm", function () {
    var resubmid = $(this).data('id');
    $(".modal-body #resubm").val( resubmid );
	});
	
$(document).on("click", ".asss_subm", function () {
    var assubmid = $(this).data('id');
    $(".modal-body #assubm").val( assubmid );
	});

$(document).on("click", ".del_q", function () {
    var delqid = $(this).data('id');
    $(".modal-body #delq").val( delqid );
	});
	
$(document).on("click", ".del_class", function () {
    var delcid = $(this).data('id');
    $(".modal-body #delc").val( delcid );
	});
	
$(document).on("click", ".rem_stu", function () {
    var remstuid = $(this).data('id');
    $(".modal-body #remstu").val( remstuid );
	});	

$("#fail").delay(3200).fadeOut(2000);
$("#success").delay(3200).fadeOut(2000);

$(document).ready(function(){  
      $('#search_text').keyup(function(){  
           var txt = $(this).val();  
        
$.post('fetch.php', {search: txt}, function(data){
                         $('#searchresult').html(data);
                     });		   
      });  
 });  
 
$(document).ready(function(){  
      $('#search_text_s').keyup(function(){  
           var txts = $(this).val();  
        
$.post('fetchs.php', {searchs: txts}, function(data){
                         $('#searchresult_s').html(data);
                     });		   
      });  
 });  
 
 $(document).on('click','#loadmoreaccact',function () {
  $(this).text('Loading...');
    var ele = $(this).parent('li');
        $.ajax({
      url: 'moreaccount.php',
      type: 'POST',
      data: {
              page:$(this).data('page'),
            },
      success: function(response){
           if(response){
             ele.hide();
                $(".accactivitylist").append(response);
              }
            }
   });
});
