$(document).ready(function(){
$("#submit").click(function () {


     $.ajax({	
	url: 'start_activity.php',
	data: {
		"user_id": $.cookie("user_id"),
		"name": $("#description").val(),
		"begin_date": new Date(),
		"end_date": $("#enddate").val(),
		"campaign_status": "OPEN"
	},

	});
});
});	
		
