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
        var ds = $("#user_reason").val();
        alert(ds);
        $.ajax({
            url: 'php_signup.php',
            type: "POST",
            data: signUpFormToJSON(),
            async: false,
            success: function (data) {
                if (data==1){
                    alert("error 1");
                }
                else if (data==2){

                    alert("error 2");
                }
                else{
                    alert(data);
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

