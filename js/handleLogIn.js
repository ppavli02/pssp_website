$( document ).ready(function() {

    $("#username_login").focus(function(){
        var temp = $("#username_login").val();
        if (temp.localeCompare("a@a.com")==0)
            $("#username_login").val("");

    });


    $('#logIn_form').submit(function() {

        $.ajax({
            url: "members/php_login.php",
            type: "POST",
            data: logInFormToJSON(),
            async: false,
            success: function (data) {
                alert(data);
                if (data==1){

                    alert("Wrong Email or Password");
                }
                else{
                    alert("ok");
                }
            },

            cache: false,
            contentType: false,
            processData: false
        });


    });

    function logInFormToJSON() {
        return JSON.stringify({
            "username_login": $('#username_login').val(),
            "password_login": $('#password_login').val()
        })
    }

});

