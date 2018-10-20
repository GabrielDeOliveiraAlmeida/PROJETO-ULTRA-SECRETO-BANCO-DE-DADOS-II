/**
 * Eventos da pagina
 */
$(document).ready(function(){

    /**
     * Cadastrar Caminhão
     */
    $("#submit_driver").click(function(){
    var placa = $("#placa_truck").val();
    var ano = $("#ano_truck").val();
    var serie = $("#serie_truck").val();
    var modelo = $("#modelo_truck").val();

    var data = "placa_truck=" + placa + "&ano_truck=" + ano + 
    "&serie_truck=" + serie + "&modelo_truck=" + modelo;

    $.ajax({
        method:"post",
        url:"truck_mensagem.php",
        data:data,
        success:function(data){
            var resp = JSON.parse(data);
            $('#truck_resposta').html(resp.msg);
            carregarTabela(); // RECARREGAR TODA A TABELA
            if(resp.sucesso){
                limparForm();
            }
        }
    });
    });
});

/*
    REMOVER CAMINHAO, EM SEGUIDA RECARREGA TODA A TABELA.
 */
function remover(obj){
    $('#modal').modal('open');
    $("#aceito").click(function(){
        var data=obj.id;
        $.ajax({
            url:"truck_delete.php",
            method:"post",
            data:{id:data},
            dataType:"text",
            success:function(data){
                carregarTabela();
            }
        });   
    });
}

/**
 * CARREGA TODOS OS CAMINHÕES
 */
function carregarTabela(){

    $.ajax({
        url:"truck_tabela.php",
        method:"POST",
        success:function(data){
            
            $('#table_truck').html(data);
        }
    });
}

carregarTabela();


/**
 * LIMPAR TODOS OS CAMPOS DO FORMULARIO
 */
function limparForm(){
    console.log("limpar");
    $("#placa_truck").val("");
    $("#ano_truck").val("");
    $("#serie_truck").val("");
    $("#modelo_truck").val("");
}
