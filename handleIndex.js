$(document).ready(function () {
    var lgn = document.getElementById("login_btn");
    var createOwn = document.getElementById("create_network");
    if (!flag){
        // LogIn
        var h = document.createElement("a");
        h.setAttribute("href", "./member_functionality/login.php");
        h.setAttribute("class", "button special");
        var text = document.createTextNode("Log In");
        h.appendChild(text);
        lgn.appendChild(h);
        createOwn.removeChild(createOwn.childNodes[0]);
    }
    else{
        // LogOut
        var h = document.createElement("a");
        h.setAttribute("class", "button special");
        h.setAttribute("href", "./member_functionality/logout.php");
        var text = document.createTextNode("Log Out");
        h.appendChild(text);
        lgn.appendChild(h);
        
        // Build
        var k = document.createElement("a");
        k.setAttribute("href", "./build_network/buildNetwork.php");
        var text2 = document.createTextNode("Build a network");
        k.appendChild(text2);
        createOwn.appendChild(k);
    }
});