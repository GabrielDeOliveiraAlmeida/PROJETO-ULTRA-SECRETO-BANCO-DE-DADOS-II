
/*
    VALIDAÇÃO DO CAMPO SENHA
 */
$("#password").on("focusout", function (e) {
    if ($(this).val() != $("#confirm_password").val()) {
        $("#confirm_password").removeClass("valid").addClass("invalid");
    } else {
        $("#confirm_password").removeClass("invalid").addClass("valid");
    }
});

$("#confirm_password").on("keyup", function (e) {
    if ($("#password").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
});

function tamanhoSenha(e) {
    console.log("ooi");
    if(e.value.length < 5){
        $(this).removeClass("valid").addClass("invalid");
    }else{
        $(this).removeClass("invalid").addClass("valid");
    }
}

$(".datepicker").pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'HOJE',
    clear: 'LIMPAR',
    close: 'OK',
    closeOnSelect: true, // Close upon selecting a date,
    container: undefined // ex. 'body' will append picker to body
});