$(document).ready(function () {

    var lgn = document.getElementById("login_btn");
    if (!flag){
        var h = document.createElement("a");
        h.setAttribute("href", "./member_functionality/login.php");
        h.setAttribute("class", "button special");
        var text = document.createTextNode("Log In");
        h.appendChild(text);
        lgn.appendChild(h);
    }
    else{
        var h = document.createElement("a");
        h.setAttribute("class", "button special");
        h.setAttribute("href", "./member_functionality/logout.php");
        var text = document.createTextNode("Log Out");
        h.appendChild(text);
        lgn.appendChild(h);
        // $.ajax({
        //     url: "member_functionality/logout.php",
        //     type: "POST",
        //     async: false,
        //     cache: false,
        //     success: function(){
        //         flag=false;
        //         window.location="index.php";
        //     },
        //     contentType: false,
        //     processData: false
        // });
    }



});