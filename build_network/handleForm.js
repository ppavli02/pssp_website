var carouselSize = 1;
var locateParameterFile = 0;
var tabNumber = 1;

/**
 * Create the carousel and writes in a label the active tab.
 * Note: It allows only 10 layers to the network. In case of change,
 * simply change the if statement.
 */
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

/**
 * Adds new tabs to the carousel.
 * @param tabID, the current tab number
 * @param carouselSize, the total size of the carousel
 * @return void.
 */
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

/**
 * Serializes the form and converts the object to an array
 * JSON.parse understands.
 * @return "" - if input fields are empty.
 *         array o - the serialized form.
 */
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    var error=false;

    $.each(a, function () {
        if (this.name != 'md5_code'){
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                if (this.value=='' || this.value=="" || this.value==undefined){
                    sweetAlert("Error:", "Please fill in all gaps.", "error");
                    error = true;
                }else{
                    o[this.name].push(this.value);
                }
            } else {
                if (this.value=='' || this.value=="" || this.value==undefined){
                    sweetAlert("Error:", "Please fill in all gaps.", "error");
                    error = true;
                }else{
                    o[this.name] = this.value;
                }
            }
        }
    });
    if (error)
        return "";
    else
        return o;
};

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

/**
 * Calls the serializeObject function, then calls the php script to create
 * the parameter file based on what the user entered and finally informs the
 * user if the php file returned any errors.
 *
 * @return returnValue 0 - something went wrong in the php file.
 *         returnValue 1 - everything is ok so far.
 */
function grabInfo() {
    var returnValue = 0;
    var temporary_array = $('form').serializeObject();
    if (temporary_array!=""){
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
                try {
                    var pushedErrors = JSON.parse(data);
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
                    sweetAlert("Error:", errors, "error");
                    returnValue = 0;
                }
                catch (err) {
                    returnValue = 1;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

    return returnValue;
}

/**
 * Calls the php file which checks the files.
 *
 * @return void.
 */
function crossCheck() {
    $.ajax({
        url: "checkFiles.php",
        type: "POST",
        async: true,
        success: function (data) {
            if (data!=""){
                sweetAlert("Error:", data, "error");
            }
        }
    });
}

/**
 * Calls a php file to copy the default parameter file.
 *
 * @return returnValue 0 - something went wrong in the php file.
 *         returnValue 1 - everything is ok so far.
 */
function handleDefaultParameter() {
    var returnValue = 0;
    $.ajax({
        url: "defaultSession.php",
        type: "POST",
        async: false,
        success: function (data) {
            if (data == "1") {
                sweetAlert("Oops...", "Something went wrong!", "error");
            } else {
                returnValue = 1;
            }
        }
    });
    return returnValue;
}

/**
 * Calls a php file to change the $_SESSION["token"] variable.
 *
 * @return returnValue 0 - something went wrong in the php file.
 *         returnValue 1 - everything is ok so far.
 */
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

/**
 * Handles the three different ways to run the application. If everything
 * was ok during the testing, calls the function to run the application.
 *
 * @return void.
 */
function buildTheNetwork() {
    switch (locateParameterFile) {
        case 0:
            if (handleDefaultParameter()) {
                if (grabFiles()) {
                    crossCheck();
                }
            }
            break;
        case 1:
            if (handleReuseParameter()) {
                if (grabFiles()) {
                    crossCheck();
                }
            }
            break;
        case 2:
            if (grabInfo()) {
                if (grabFiles()) {
                    crossCheck();
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