// $(document).ready(function() {
//     // var carouselWindows = $("#no_layers").val();
//     // $("#no_layers").change(function(){
//     //     var value = $("#no_layers").val();
//     //     alert(value);
//     // });
//
//
//
// });


// $("p").removeClass("intro");
//
// function changeLayer(){
//     alert("");
//     $("#repeatable-div-1").css("visibility", "hidden");
//     // $("#repeatable-div-2").css("visibility", "visible");
//
// }


var carouselSize = 1;

function createCarousel(){
    carouselSize++;
    var tabID = 'tab'+carouselSize;
    alert(carouselSize);
    jQuery('<div/>', {
        id: tabID,
        class: 'item'
    }).appendTo('#addOns');

    addTabs(tabID);
}

function addTabs(tabID){
    $.ajax({
        url: "layer.html",
        success: function (data) { $('#tabID').append(data); },
        dataType: 'html'
    });
}