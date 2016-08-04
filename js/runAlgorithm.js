function runAlgorithm(){
    // alert("in the");
    if ($('#email').val() == ""){
        // alert("dfsfdf");
        anonymousResponse();
    }
    else{
        emailResponse();
    }

}

function anonymousResponse(){
    var pendingResults=0;
    $.ajax({
        url: "anonymous_system/pending_results.php",
        type: "GET",
        async: false,
        success: function (data) {
            pendingResults = data;
        },
        cache: false,
        contentType: false,
        processData: false
    });

    if (pendingResults > 3){
        alert("Unfortunately our server is currently occupied with other processes. Please again later.");
        return;
        }
    else{
        //alert("An email will be sent to you shortly.");
    }

    //Generate MD5 code and create a record in the db.
    $.ajax({
        url: "anonymous_system/generateMD5.php",
        type: "GET",
        async: true,
        success: function (data) {
            alert("Please save this code:"+data);
            $.ajax({
                url: "anonymous_system/runTheApplication.php",
                type: "GET",
                data: "q="+data,
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

function emailResponse(){

    var pendingResults=0;
    //Get the number of pending results
    $.ajax({
        url: "anonymous_system/pending_results.php",
        type: "GET",
        async: false,
        success: function (data) {
            pendingResults = data;
        },
        cache: false,
        contentType: false,
        processData: false
    });

    //if the number overpasses the number 3, then ignore the request.
    if (pendingResults > 3){
        alert("Unfortunately our server is currently occupied with other processes. Please again later.");
        return;
    }

    $.ajax({
        url: "mailing_functionality/send_mail.php",
        type: "POST",
        data: runToJSON(),
        async: false,
        success: function (data) {
            alert("Please check your email, once in a while!");
            // alert(data);
            //if (data==1){
            //    alert("An email will be sent to you shortly.");
            //}
            //else{
            //    alert("Oh oh. Something went wrong.");
            //}
        },

        cache: false,
        contentType: false,
        processData: false
    });
}

function runToJSON() {
    var nameField = $('#category').val();
    if (nameField == ""){
        nameField = "Unknown Receiver";
    }
    return JSON.stringify({
        "name_trained": nameField,
        "email_trained": $('#email').val()
    })
}

function retrieveResults(){
    //var md5 = $('#md5_password').val();
    //if (md5 == ""){
    //    alert("Please provide your md5 password.");
    //}
    var md5 = $('#getResults').val();

    $.ajax({
        url: "anonymous_system/check_results.php",
        type: "GET",
        data: "q="+md5,
        async: false,
        success: function (data) {
            // alert(data);
            $.ajax({
                url: "anonymous_system/download.php",
                type: "POST",
                data: "q="+md5,
                async: false,
                success: function (data) {
                    window.location.assign('anonymous_system/download.php?q='+md5);
                },
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