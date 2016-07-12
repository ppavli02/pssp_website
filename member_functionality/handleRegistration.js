$( document ).ready(function() {


    $("#user_username").focus(function(){
        var temp = $("#user_username").val();
        if (temp.localeCompare("a@a.com")==0)
            $("#user_username").val("");

    });

    $("#user_password").focus(function(){
        var temp = $("#user_password").val();
        if (temp == 123)
            $("#user_password").val("");
    });

    $('#signUp_form').submit(function() {
        $.ajax({
            url: 'php_signup.php',
            type: "POST",
            data: signUpFormToJSON(),
            async: false,
            success: function (data) {
                if (data != "") {
                    var pushedErrors = JSON.parse(data);
                    $.each(pushedErrors, function (i, errorNumber) {
                        if (errorNumber == 1) {
                            alert('First name contains something else than letters.');
                        }
                        if (errorNumber == 2) {
                            alert('Last name contains something else than letters.');
                        }
                        if (errorNumber == 3) {
                            alert('Password and Repeat Password are not the same.');
                        }
                        if (errorNumber == 4) {
                            alert('Invalid email format.');
                        }
                        if (errorNumber == 5) {
                            alert('There is something wrong with the database. Please contact an engineer.');
                        }
                        if (errorNumber == 6) {
                            alert('Email can not be sent. Please contact an engineer.');
                        }
                    });
                }
                else{
                    alert('Thank you! Please wait for approval. An email will be sent to you shortly.');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    function signUpFormToJSON() {
        return JSON.stringify({
            "user_firstname": $('#user_firstname').val(),
            "user_lastname": $('#user_lastname').val(),
            "user_username": $('#user_username').val(),
            "user_password": $('#user_password').val(),
            "user_repeat_password": $('#user_repeat_password').val(),
            "user_reason": $('#user_reason').val()
        })
    }
});