
/*
    CARREGA TODO OS MOTORISTAS ARMAZENADO NO BANCO DE DADOS PARA A APLICAÇÃO
*/
function carregarTabela(){

    $.ajax({
        url:"driver_tabela.php",
        method:"POST",
        success:function(data){
            $('#table_driver').html(data);
        }
    });
    
}
carregarTabela();


$(document).ready(function(){

    /*
        CADASTRO DE MOTORISTAS, EM SEGUIDA RECARREGA TODA A TABELA.
    */
    $("#submit_driver").click(function(){
        var nome = $("#nome_driver").val();
        var sobrenome = $("#sobrenome_driver").val();
        var email = $("#email_driver").val();
        var telefone = $("#telefone_driver").val();
        var password = $("#password_driver").val();
    
        var data = "nome_driver=" + nome + "&sobrenome_driver=" + sobrenome+
        "&email_driver=" + email + "&telefone_driver=" + telefone +
        "&password_driver=" + password;

        $.ajax({
            method:"post",
            url:"driver_mensagem.php",
            data:data,
            success: function(data){
                    var resp = JSON.parse(data);
                    $("#resp").html(resp.msg);
                    carregarTabela();
                    console.log(resp);
                    console.log(resp.sucesso);
                    if(resp.sucesso){
                        limparForm();
                    }
                }
        });
    });

});


/*
    REMOVER MOTORISTAS, EM SEGUIDA RECARREGA TODA A TABELA.
 */
function remover(obj){
    $('#modal1').modal('open');
    $("#aceito").click(function(){
        var data=obj.id;
        $.ajax({
            url:"driver_delete.php",
            method:"post",
            data:{id:data},
            dataType:"text",
            success:function(data){
                carregarTabela();
            }
        });   
    });
}

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

$(".datepicker").pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'HOJE',
    clear: 'LIMPAR',
    close: 'OK',
    closeOnSelect: true, // Close upon selecting a date,
    container: undefined // ex. 'body' will append picker to body
});

/**
 * FIM DA VALIDAÇÃO DA SENHA
 */


 /**
  *  LIMPAR TODOS OS CAMPOS DO FORMULARIO
  */
function limparForm(){
    $("#nome_driver").val("");
    $("#sobrenome_driver").val("");
    $("#email_driver").val("");
    $("#telefone_driver").val("");
    $("#password_driver").val("");
    $("#confirm_password").val("");
}