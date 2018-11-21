function carregardriver(){

    $.ajax({
        url:"driver_tabela.php",
        method:"POST",
        success:function(data){
            $('#table_driver').html(data);
        }
    });
}


function carregartruck(){

    $.ajax({
        url:"truck_tabela.php",
        method:"POST",
        success:function(data){
            $('#table_truck').html(data);
        }
    });
}