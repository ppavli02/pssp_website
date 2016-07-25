var carouselSize = 1;

function createCarousel(){

    carouselSize++;
    var tabNumber = 1;

    $('#formCarousel').on('slide.bs.carousel', function (ev) {
        var id = ev.relatedTarget.id;
        tabNumber = id.charAt(id.length - 1);
        // alert(tabNumber);
        var layer_context = tabNumber+'/'+carouselSize;
        $("#layers_layer").text(layer_context);
    });

    if (carouselSize>10){
        alert('Sorry, you can only use 10 layers for now.');
    }
    else{
        var tabID = 'tab'+carouselSize;
        tabID = '#'+tabID;
        addTabs(tabID, carouselSize);
        var layer_context = tabNumber+'/'+carouselSize;
        $("#layers_layer").text(layer_context);
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
    // $(".no_neurons").each(function(){
    //     var value = $(this).val();
    //     if (value == "")
    //         value = $(this).placeholder().text();
    //     alert(value);
    // });

    // $(".delay_unit").each(function(){
    //     alert($(this).val());
    // });

    var serializedForm = $('form').serialize();
    console.log(serializedForm);

    alert("");

}