$(document).ready(function () {

    $("#username_login").focus(function () {
        var temp = $("#username_login").val();
        if (temp.localeCompare("a@a.com") == 0)
            $("#username_login").val("");

    });

    $("#password_login").focus(function(){
        var temp = $("#password_login").val();
        if (temp == 123)
            $("#password_login").val("");
    });

    $('#logIn_form').submit(function () {
        $.ajax({
            url: "php_login.php",
            type: "POST",
            data: logInFormToJSON(),
            async: false,
            success: function (data) {
                if (data != "") {
                    var pushedErrors = JSON.parse(data);
                    $.each(pushedErrors, function (i, errorNumber) {
                        if (errorNumber == 1) {
                            alert('You have not been verified yet. Please contact the administrator.');
                        }
                        if (errorNumber == 2) {
                            alert('Member not found.');
                        }
                        if (errorNumber == 3) {
                            alert('There is something wrong with the database. Please contact an engineer.');
                        }
                    });
                }
                else{
                    location.reload();
                }
                // else{
                //     alert("f");
                //     var url = window.location.href;
                //     alert(url);
                //     var res = url.split("/");
                //     var newURL = res[0]+"/"+res[1]+"/"+res[2]+"/"+res[3]+"/"+res[4]+"/";
                //     alert(newURL);
                //     window.location = newURL;
                // }
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

