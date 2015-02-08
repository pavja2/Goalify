$(document).ready(function () {
    $("#register-button").click(function () {
        $.ajax({
            url: 'registerUser.php',
            data: {
                "user_name": $("#user_name").val(),
                "email": $("#email").val(),
                "first_name": $("#first_name").val(),
                "last_name": $("#last_name").val(),
                "access_token" : $.url().fparam("access_token")
            },
            success: function(response){
                $.cookie("user_id", response, { expires: 7, path: '/' });
                localStorage.setItem("user_id", response);
                localStorage.setItem("access_token", $.url().fparam("access_token"));
                window.close(); 
                window.opener.location.reload()
            }
        });
    });
});

