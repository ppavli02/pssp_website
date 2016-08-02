var carouselSize = 1;

function createCarousel() {

    carouselSize++;
    var tabNumber = 1;

    $('#formCarousel').on('slide.bs.carousel', function (ev) {
        var id = ev.relatedTarget.id;
        tabNumber = id.charAt(id.length - 1);
        // alert(tabNumber);
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


    // var x = document.getElementById("training_file");
    // var tr = $('#training_file').val();
    // console.log(tr);

    return o;
};


function grabFiles() {
    var formData = new FormData();

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
            alert(data);
        },
        contentType: false,
        processData: false,
    });
}

function grabInfo() {
    var returnValue=0;
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

function buildTheNetwork(){
    // var returnValue = grabInfo();
    if (grabInfo()){
        grabFiles();
    }
}

// $( document ).ready(function() {
//     $("[name='my-checkbox']").bootstrapSwitch();
// });

