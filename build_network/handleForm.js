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

function grabInfo() {
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
                        // alert('Neuron field should only hold integer numbers.');
                        errors += "Neuron field should only hold integer numbers.\n";
                    }
                    if (errorNumber == 2) {
                        // alert('');
                        errors += "Previous Layer: Please follow the example shown in the placeholder.\n";
                    }
                    if (errorNumber == 3) {
                        // alert('Next Layer: Please follow the example shown in the placeholder.');
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
            }
            catch (err) {
                token = data;
                // console.log(token);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

}



