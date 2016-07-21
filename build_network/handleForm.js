var carouselSize = 1;

function createCarousel(){
    carouselSize++;
    if (carouselSize>10){
        alert('Sorry, you can only use 10 layers for now.');
    }
    else{
        var tabID = 'tab'+carouselSize;
        tabID = '#'+tabID;
        addTabs(tabID, carouselSize);
        $("#layers_layer").text(carouselSize);
    }
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

function grabInfo(){
    $(".no_neurons").each(function(){
        alert($(this).val());
    });
}