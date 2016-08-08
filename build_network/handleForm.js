var carouselSize = 1;
var locateParameterFile = 0;
var tabNumber = 1;

function createCarousel() {

    carouselSize++;

    $('#formCarousel').on('slide.bs.carousel', function (ev) {
        var id = ev.relatedTarget.id;
        tabNumber = id.charAt(id.length - 1);
        var layer_context = tabNumber + '/' + carouselSize;
        $("#layers_layer").text(layer_context);
    });

    if (carouselSize > 10) {
        alert('Sorry, you can only use 10 layers for now.');
    }
    else {
        var tabID = 'tab' + carouselSize;
        tabID = '#' + tabID;
        addTabs(tabID, carouselSize);
        var layer_context = tabNumber + '/' + carouselSize;
        $("#layers_layer").text(layer_context);
    }
}


function addTabs(tabID, carouselSize) {
    var dot = $("<li></li>");
    var newCarouselSize = carouselSize - 1;
    dot.attr("data-target", "#formCarousel");
    dot.attr("data-slide-to", newCarouselSize);
    $('#carouselIndicators').append(dot);

    //Add form to the carousel
    $(tabID).addClass("item");
    $.ajax({
        url: "layer.html",
        success: function (data) {
            $(tabID).append(data);
        },
        dataType: 'html'
    });
}


$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


function grabFiles() {
    var formData = new FormData();
    var returnValue = 0;
    formData.append('fasta_training_file', $('input[type=file]')[0].files[0]);
    formData.append('fasta_testing_file', $('input[type=file]')[1].files[0]);
    formData.append('msa_training_file', $('input[type=file]')[2].files[0]);
    formData.append('msa_testing_file', $('input[type=file]')[3].files[0]);

    $.ajax({
        url: "uploadFiles.php",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
            if (data == "1")
                returnValue = 1;
            else {
                returnValue = 0;
                sweetAlert("Error!", data, "error");
            }
        },
        contentType: false,
        processData: false,
    });
    return returnValue;
}

function grabInfo() {
    var returnValue = 0;
    var temporary_array = $('form').serializeObject();
    var info = JSON.stringify(temporary_array);
    console.log(info);
    $.ajax({
        url: "createParameterFile.php",
        type: "POST",
        data: info,
        async: false,
        //If the returned data is an array of errors, parse it and handle errors.
        //Otherwise, take the token to handle the files.
        success: function (data) {
            var token;
            try {
                var pushedErrors = JSON.parse(data);
                // console.log(pushedErrors);
                var errors = "";
                $.each(pushedErrors, function (i, errorNumber) {
                    if (errorNumber == 1) {
                        errors += "Neuron field should only hold integer numbers.\n";
                    }
                    if (errorNumber == 2) {
                        errors += "Previous Layer: Please follow the example shown in the placeholder.\n";
                    }
                    if (errorNumber == 3) {
                        errors += "Next Layer: Please follow the example shown in the placeholder.\n";
                    }
                    if (errorNumber == 4) {
                        errors += "Learning Rate: Please follow the example shown in the placeholder. You can also pass an integer value.\n";
                    }
                    if (errorNumber == 5) {
                        errors += "Momentum: Please follow the example shown in the placeholder. You can also pass an integer value.\n";
                    }
                    if (errorNumber == 6) {
                        errors += "Delay Unit: Please follow the example shown in the placeholder.\n";
                    }
                    if (errorNumber == 7) {
                        errors += "Iterations: Please follow the example shown in the placeholder.\n";
                    }
                });
                alert(errors);
                returnValue = 0;
            }
            catch (err) {
                token = data;
                alert(token);
                returnValue = 1;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return returnValue;
}

function crossCheck() {
    $.ajax({
        url: "checkFiles.php",
        type: "POST",
        async: true,
        success: function (data) {
            if (data == "1" || data == "11") {
                alert("Could not send the email.");
            }
        }
    });
}

function handleDefaultParameter() {
    var returnValue = 0;
    $.ajax({
        url: "defaultSession.php",
        type: "POST",
        async: false,
        success: function (data) {
            alert(data);
            if (data == "1") {
                sweetAlert("Oops...", "Something went wrong!", "error");
            } else {
                returnValue = 1;
            }
        }
    });
    return returnValue;
}

function handleReuseParameter() {
    var returnValue = 0;
    var md5 = $("#md5_code").val();
    if (md5 == undefined || md5 == "") {
        sweetAlert("No code.", "Please provide the code is been sent to you.", "error");
    }
    else {
        $.ajax({
            url: "updateSession.php",
            type: "POST",
            data: JSON.stringify({
                "md5": md5,
            }),
            async: false,
            success: function (data) {
                alert(data);
                if (data == "1") {
                    sweetAlert("Please try again.", "Something went wrong!", "error");
                } else if (data == "2") {
                    sweetAlert("Invalid code.", "Please check the code and try again.", "error");
                } else {
                    returnValue=1;
                }
            }
        });
    }
    return returnValue;
}


function buildTheNetwork() {

    alert("param value "+locateParameterFile);

    //If the user has successfully build the network, check the files.

    switch (locateParameterFile) {
        case 0:

            // handleDefaultParameter();

            if (handleDefaultParameter()) {
                alert("passed handleDefaultParameter");
                if (grabFiles()) {
                    alert("check");
                    crossCheck();
                    alert("check2");
                }
            }

            break;
        case 1:
            // handleReuseParameter();
            if (handleReuseParameter()) {
                alert("passed handleReuseParameter");
                if (grabFiles()) {
                    alert("check3");
                    crossCheck();
                    alert("check4");
                }
            }

            break;
        case 2:
            if (grabInfo()) {
                if (grabFiles()) {
                    crossCheck();
                    alert("");
                }
            }
            break;
        default:
            sweetAlert("Oops...", "Something went wrong!", "error");
    }
}

$(document).ready(function () {

    /*
     locateParameterFile variable is set to define the source of the parameter file.
     0: use the default file
     1: retrieve a known file
     2: build your own
     */

    // 8d0e982d4f6e8b5ca6433d1049fe1ca8
    // f67dd0f6967553a77320ee3f10352c71

    $("[name='wizard_1']").bootstrapSwitch();
    $("[name='wizard_2']").bootstrapSwitch();

    $("#wizard_div_2").hide();

    $(".virtual_box").hide();


    $('input[name="wizard_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
        if (!state) {
            $("#wizard_div_2").show();
            $("#wizard_div_1").hide();
            locateParameterFile = 1;
        }
    });

    $('input[name="wizard_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
        if (!state) {
            $(".virtual_box").show();
            locateParameterFile = 2;
        }
        else {
            $(".virtual_box").hide();
            locateParameterFile = 1;
        }

    });
});