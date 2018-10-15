/*
    FUNÇÕES PARA TABELA E INTERFACE
 */
var indexTable;
var table = document.getElementById("table");

var salvar = false;

//PERGUNTAR SE REALMENTE DESEJA SAIR
window.onbeforeunload = confirmExit;
function confirmExit()
{
    if(salvar == false){
        return "Deseja realmente sair desta página?";
    }
}

/*
    TABELA
 */
function selectedRowToInput(){ //LINHA SELECIONADA TABELA 1
    for(var i = 0; i < table.rows.length; i++){
        table.rows[i].onclick = function(){
            indexTable = this.rowIndex;
            if(indexTable != 0){
                removerEfeito(table);
                this.classList.toggle("selecionado"); //APLICAR O EFEITO
                recuperarAddress(this.cells[0].innerHTML);
                $('.tabs').tabs('select_tab', 'googlemaps');
                document.getElementById("entrada1").value = this.cells[0].innerHTML;
            }
        };

    }
}
selectedRowToInput();


// function selectedRowTableWeek(table){ //LINHA SELECIONADA TABELA DA SEMANA
//     for(var i = 0; i < table.rows.length; i++){
//         table.rows[i].onclick = function(){
//             var index = this.rowIndex;
//             if(index != 0){
//                 removerEfeito(table);
//                 this.classList.toggle("selecionado"); //APLICAR O EFEITO
//             }
//         };
//     }
// }
function removerEfeito(tabela){
    for(var i=1; i<tabela.rows.length;i++){
        tabela.rows[i].classList.remove("selecionado");
    }
}

function editarTabela(){
    var entrada1 = document.getElementById("entrada1").value;
    if(entrada1 !="" && indexTable != 0){
        table.rows[indexTable].cells[0].innerHTML = entrada1;
        criarRota();
        Materialize.toast('Endereço Substituido!', 1000);
    }

}

function removerTabela(){ //REMOVER LINHA DA TABELA 1
    if(indexTable != 0 ){
        if(table.rows.length <=3){
            limparRotas();
        }
        table.deleteRow(indexTable);
        document.getElementById("entrada1").value = "";
        criarRota();
        Materialize.toast('Endereço Removido!', 1000);
    }
}

function addTabela(){
    var entrada1 = document.getElementById("entrada1").value;
    if(entrada1 != "") {
        $('#table tr:last').after('<tr scope="row"> <td>' + entrada1);
        selectedRowToInput();
        document.getElementById("entrada1").focus();
        document.getElementById("entrada1").select();
        criarRota();
        Materialize.toast('Adicionado!', 1000);
        document.getElementById("entrada1").value = "";

    }
}
//
function apagarTabela() {
    var tam = table.rows.length-1;
    if(tam >0) {
        for (var i =tam; i > 0; i--) {
            table.deleteRow(i);
        }
    }
}

/*
    CONTEXT MENU DENTRO DO MAPS
 */

function showContext() {
    var projection;
    projection = map.getProjection() ;
    $('.contextmenu').remove();
    contextmenuDir = document.createElement("div");
    contextmenuDir.className  = 'contextmenu';
    contextmenuDir.innerHTML = htmlTableWeek;
    $(map.getDiv()).append(contextmenuDir);
    //setMenuXY(caurrentLatLng);
    contextmenuDir.style.visibility = "visible";
    loadTable();
}

/*
    OCULTAR TABELA DE HORARIOS E SALVA-LA EM UM MATRIZ;
 */
function hiddenTable(){
    if(contextmenuDir !== "" ) {
        contextmenuDir.style.display = "none";
        $('#c').addClass('disabled');
    }
}

/*
    SALVAR TABELA DE HORARIOS
 */

function saveTable() {
    var tableWeek = document.getElementById("tableWeek");
    var coleta = [];
    for(var i=1; i<8; i++) {
        coleta[i - 1] = tableWeek.rows[i].cells[1].children[0].value;

    }
    selected_shape.coleta = coleta;
    polygons[index].coleta = coleta;

    hiddenTable();
}

/*
    CARREGAR TABELA DE HORARIOS
 */
function loadTable(){
    var tableWeek = document.getElementById("tableWeek");
    if(selected_shape.coleta != [])
        for(var i=1; i<8; i++){
            tableWeek.rows[i].cells[1].children[0].value = polygons[index].coleta[i-1];
        }
}

function coletores(dia){
    $('#c').removeClass('disabled');
    $('.tabs').tabs('select_tab', 'caminhao');
}



//$('input.autocomplete').autocomplete({
//     source: function (request, response) {
//         geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
//             response($.map(results, function (item) {
//                 return {
//                     label: item.formatted_address,
//                     value: item.formatted_address,
//                     latitude: item.geometry.location.lat(),
//                     longitude: item.geometry.location.lng()
//                 }
//             }));
//         })
//     }

//});
// $("#entrada1").autocomplete({

// });
