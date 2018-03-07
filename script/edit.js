$(document).on("click", ".ed_post", function () {
    var edid = $(this).data('id');
	var edpost = $(this).data('text'); 
    $(".modal-body #edpostid").val( edid );
	$(".modal-body #edposttext").val( edpost );

	});
	
$(document).on("click", ".ed_comment", function () {
    var edcid = $(this).data('id');
	var edcomment = $(this).data('text'); 
    $(".modal-body #edcommentid").val( edcid );
	$(".modal-body #edcommenttext").val( edcomment );

	});

$(document).on("click", ".ed_sm", function () {
    var edsmid = $(this).data('id');
	var edsmtitle = $(this).data('title'); 
	var edsmcontent = $(this).data('content'); 
    $(".modal-body #edsmid").val( edsmid );
	$(".modal-body #edsmtitle").val( edsmtitle );
	$(".modal-body #edsmcontent").val( edsmcontent );

	});

$(document).on("click", ".ed_v", function () {
    var edvid = $(this).data('id');
	var edvtitle = $(this).data('title'); 
	var edvtext = $(this).data('text'); 
	var edvlink = $(this).data('link'); 
    $(".modal-body #edvid").val( edvid );
	$(".modal-body #edvtitle").val( edvtitle );
	$(".modal-body #edvtext").val( edvtext );
	$(".modal-body #edvlink").val( edvlink );

	});