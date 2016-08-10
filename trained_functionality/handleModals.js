// Variable flag is true if the user is loggen in.

$(document).ready(function () {
    $("#defineContact").click(function () {
        if (flag) {
            runAlgorithm();
        }
        else {
            $("#modal_email_generateCode").modal();
        }
    });

    $("#submit").click(function () {
        if ($("#getResults").val() != "") {
            retrieveResults();
            $("#div_placeCode").removeClass('has-error has-feedback');
            $("#placeCode_required").css("display", "none");
            $("#placeCode_ErrorStatus").css("display", "none");
            $("#placeCode_xMark").css("display", "none");
        } else {
            $("#div_placeCode").addClass('has-error has-feedback');
            $("#placeCode_required").css("display", "block");
            $("#placeCode_ErrorStatus").css("display", "block");
            $("#placeCode_xMark").css("display", "block");
        }
    });

    $("#modelSubmit").click(function () {
        if (!$("#email").val() && !$("#code").is(":checked")) {
            $("#modalA_body").parents('div').addClass('has-error has-feedback');
            $("#choose").css("display", "block");
        } else {
            runAlgorithm();
            $("#modalA_body").parents('div').removeClass('has-error has-feedback');
            $("#choose").css("display", "none");
            $("#modal_email_generateCode").modal('hide');
        }
    });
});
