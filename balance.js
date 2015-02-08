$(document).ready(function(){
$("#submit").click(function () {


     $.ajax({
        url: 'balance.php',
        data: {
                "amount": $("#amount").val(),
                "payment_info": $("#payment_info").val()
        },
	
	success: function(response){
        
	$.ajax({
                        url: 'generateCheckpoints.php',
                        data: {
				"campaign_id": $.cookie("campaign_id"),
                                "start_date": new Date(),
                                "end_date": $.cookie("end_date")
                },
		
		success: function(response){
		
		window.location = 'index.php';	
		}
		});

        $.get("findPartner.php");        

	}
        });

});
});
