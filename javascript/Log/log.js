

function getlogmotorista(){
    $.ajax({
        method:"post",
        url:"../hipertext/logs/logmotorista.php",
        success: function(data){
            $("#logm").html(data);
        }
    });         
}

function getlogcaminhao(){
    $.ajax({
        method:"post",
        url:"../hipertext/logs/logcaminhao.php",
        success: function(data){
            $("#logc").html(data);
        }
    });         
}


function getlogadm(){
    $.ajax({
        method:"post",
        url:"../hipertext/logs/logadm.php",
        success: function(data){
            $("#loga").html(data);
        }
    });         
}
getlogmotorista();
getlogcaminhao();
getlogadm();


$(document).ready(function(){

    /*
        CADASTRO DE MOTORISTAS, EM SEGUIDA RECARREGA TODA A TABELA.
    */
    $("#submit_driver").click(function(){
        var email = $("#email").val();
        var password = $("#password").val();
    
        var data ="email=" + email+  "&password=" + password;
        console.log(data);
        $.ajax({
            method:"post",
            url:"../hipertext/logs/adm.php",
            data:data,
            success: function(data){
                    var resp = JSON.parse(data);
                    $("#resp").html(resp.msg);
                    if(resp.sucesso){
                        limparForm();
                    }
                }
        });
    });

});


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

$("#confirm_password").on("onkeyup", function (e) {
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

/**
 * FIM DA VALIDAÇÃO DA SENHA
 */


 /**
  *  LIMPAR TODOS OS CAMPOS DO FORMULARIO
  */
function limparForm(){
    $("#email").val("");
    $("#password").val("");
    $("#confirm_password").val("");
}