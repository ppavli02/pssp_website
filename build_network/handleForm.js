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

// function grabInfo(){
//     var serializedForm = $('form').serialize();
//     console.log(serializedForm);
//     alert("");
// }

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

// function grabInfo() {
//     var aa = $('form').serializeObject();
//     var info = JSON.stringify(aa);
//
//     var result = $.parseJSON(info);
//     $.each(result, function(k, v) {
//         //display the key and value pair
//         console.log(k + ' is ' + v);
//     });
//
// }

function grabInfo() {
    var aa = $('form').serializeObject();
    var info = JSON.stringify(aa);
    console.log(info);
    $.ajax({
        url: "createParameterFile.php",
        type: "POST",
        data: info,
        async: false,
        success: function (data) {
            if (data != "") {
                var pushedErrors = JSON.parse(data);
                console.log(pushedErrors);
            }
            else{
                console.log(data);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

}



