$(document).ready(function(){
	
	$("#end_date").datepicker();
	$("#submit").click(function(){
		

	$.ajax({
		url: 'create_activity.php',
		data: {
			"user_id" : $.cookie("user_id"),
			"name":$("#description").val(),
			"start_date" : new Date().getTime(),
			"end_date": $("#end_date").val(),
			"amount" :$("#amount").val(),
		},
		success:
			function(response){
				window.location.assign("index.php");
			}
	});
		});
});