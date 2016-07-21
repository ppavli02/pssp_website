var carouselSize = 1;

function createCarousel(){
    carouselSize++;
    var tabID = 'tab'+carouselSize;
    // alert(carouselSize);
    tabID = '#'+tabID;
    addTabs(tabID, carouselSize);
}


function addTabs(tabID, carouselSize){
    var dot = $("<li></li>");
    var newCarouselSize = carouselSize - 1;
    dot.attr("data-target","#formCarousel");
    dot.attr("data-slide-to", newCarouselSize);
    $('#carouselIndicators').append(dot);

    //Add form to the carousel
    $(tabID).addClass("item");
    $.ajax({
        url: "layer.html",
        success: function (data) { $(tabID).append(data); },
        dataType: 'html'
    });
}