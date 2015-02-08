$(document).ready(function() {
    $("#submit").click(function() {


        $.ajax({
            url: 'balance.php',
            data: {
                "amount": $("#amount").val(),
                "payment_info": $("#payment_info").val()
            },

            success: function(response) {
				var date = new Date();
                $.ajax({
                    url: 'generateCheckpoints.php',
                    data: {
                        "campaign_id": $.cookie("campaign_id"),
                        "start_date": date,
                        "end_date": $.cookie("end_date")
                    },

                    success: function(response) {

                        window.location = 'index.php';
                    }
                });

                $.get("findPartner.php");

            }
        });

    });
});
// This is just a sample script. Paste your real code (javascript or HTML) here.

if ('this_is' == /an_example/) {
    of_beautifer();
} else {
    var a = b ? (c % d) : e[f];
}