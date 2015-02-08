$(document).ready(function(){
$("#submit").click(function () {


     $.ajax({	
	url: 'start_activity.php',
	data: {
		"user_id": $.cookie("user_id"),
		"name": $("#description").val(),
		"end_date": $("#end_date").val()

	},
		
	success: function(resource){
	window.location.assign("load_balance.php");

	}
	});
});
});	
		
