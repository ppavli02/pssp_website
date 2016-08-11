var user_email = "";
var token="";

/**
 * Calls the php file to get user's email.
 *
 * @return void.
 */
function getEmail() {
    $.ajax({
        url: "trained_functionality/getEmail.php",
        type: "POST",
        async: true,
        success: function (data) {
            user_email = data;
        }
    });
}

/**
 * Collects the files and appends them into a FormData object.
 * Then it calls the uploadFiles.php to upload the files.
 *
 * @return returnValue 0 - something went wrong in the php file.
 *         returnValue 1 - everything is ok so far.
 */
function grabFiles() {
    var formData = new FormData();
    var returnValue = 0;
    formData.append("run_fasta_testing", $('input[type=file]')[0].files[0]);
    formData.append("run_msa_testing", $('input[type=file]')[1].files[0]);
    $.ajax({
        url: "trained_functionality/uploadFiles.php",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
            if (data == ""){
                returnValue = 0;
                sweetAlert("Error!", data, "error");
            }
            else {
                token=data;
                returnValue = 1;
            }
        },
        contentType: false,
        processData: false,
    });
    return returnValue;
}

/**
 * Calls the php file which checks the files.
 *
 * @return returnValue 0 - something went wrong in the php file.
 *         returnValue 1 - everything is ok so far.
 */
function crossCheck() {
    var returnValue=0;
    $.ajax({
        url: "trained_functionality/checkFiles.php",
        type: "POST",
        data: JSON.stringify({
            "md5": token,
        }),
        async: false,
        success: function (data) {
            if (data!="1"){
                sweetAlert("Error:", data, "error");
            }else{
                returnValue=1
            }
        }
    });
    return returnValue;
}

/**
 * Checks inputs and runs the algorithm.
 *
 * @return void.
 */
function runAlgorithm() {
    if (grabFiles()){
        swal("Thank you!", "Please wait as we are now checking your files.", "info");
        if (crossCheck()){
            if (flag) {
                getEmail();
                emailResponse();
            } else {
                if (document.getElementById('code').checked) {
                    anonymousResponse();
                }
                else {
                    emailResponse();
                }
            }
        }
    }
}

function anonymousResponse() {
    var pendingResults = 0;
    $.ajax({
        url: "md5_functionality/pending_results.php",
        type: "GET",
        async: false,
        success: function (data) {
            pendingResults = data;
        },
        cache: false,
        contentType: false,
        processData: false
    });

    if (pendingResults > 10) {
        sweetAlert("Error:", "Unfortunately our server is currently occupied with other processes. Please again later.", "error");
        return;
    }

    //Generate MD5 code and create a record in the db.
    $.ajax({
        url: "md5_functionality/generateMD5.php",
        type: "GET",
        async: false,
        success: function (data) {
            swal("Please save this code to retrieve your results:", data, "success");
            $.ajax({
                url: "md5_functionality/executeMD5.php",
                type: "POST",
                data: JSON.stringify({
                    "md5": data,
                    "token": token
                }),
                async: true,
                //success: function (data) {
                //  alert(data);
                //},
                cache: false,
                contentType: false,
                processData: false
            });
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function emailResponse() {

    var pendingResults = 0;
    //Get the number of pending results
    $.ajax({
        url: "md5_functionality/pending_results.php",
        type: "GET",
        async: false,
        success: function (data) {
            pendingResults = data;
        },
        cache: false,
        contentType: false,
        processData: false
    });

    //if the number overpasses the number 10, then ignore the request.
    if (pendingResults > 10) {
        sweetAlert("Error:", "Unfortunately our server is currently occupied with other processes. Please again later.", "error");
        return;
    }

    swal("Thank you!", "Please wait for a few seconds before closing your browser's tab.", "success");

    $.ajax({
        url: "mailing_functionality/executeMail.php",
        type: "POST",
        data: emailToJSON(),
        async: true,
        success: function (data) {
            // alert(data);
            swal({
                title: "Info",
                text: "Please check your email, once in a while!",
                type: "info",
                showCancelButton: false,
                closeOnConfirm: true,
                showLoaderOnConfirm: false,
            });
        },

        cache: false,
        contentType: false,
        processData: false
    });
}

function emailToJSON() {
    if (user_email == "") {
        return JSON.stringify({
            "name_trained": $('#email').val(),
            "email_trained": $('#email').val(),
            "token":token
        });
    } else {
        return JSON.stringify({
            "name_trained": user_email,
            "email_trained": user_email,
            "token":token
        });
    }

}

function retrieveResults() {
    var md5 = $('#getResults').val();

    $.ajax({
        url: "md5_functionality/check_results.php",
        type: "GET",
        data: "q=" + md5,
        async: false,
        success: function (data) {
            if (data != "success") {
                sweetAlert("Error:", data, "error");
            } else {
                $.ajax({
                    url: "md5_functionality/download.php",
                    type: "POST",
                    data: "q=" + md5,
                    async: false,
                    success: function () {
                        window.location.assign('md5_functionality/download.php?q=' + md5);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

$(document).ready(function () {
    var lgn = document.getElementById("login_btn");
    var createOwn = document.getElementById("create_network");
    if (!flag) {
        // LogIn
        var h = document.createElement("a");
        h.setAttribute("href", "./member_functionality/login.php");
        h.setAttribute("class", "button special");
        var text = document.createTextNode("Log In");
        h.appendChild(text);
        lgn.appendChild(h);
    }
    else {
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