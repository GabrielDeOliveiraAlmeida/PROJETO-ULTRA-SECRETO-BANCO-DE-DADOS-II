function criarBotao(controlDiv, msg , msg2, qual) {
    // Set CSS for the control border.
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#fff';
    controlUI.style.border = '2px solid #fff';
    controlUI.style.borderRadius = '3px';
    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    controlUI.style.cursor = 'pointer';
    controlUI.style.marginBottom = '22px';
    controlUI.style.marginLeft = '15px';
    controlUI.style.marginRight = '15px';
    controlUI.style.textAlign = 'center';
    controlUI.title = msg2;

    controlDiv.appendChild(controlUI);
    // Set CSS for the control interior.
    var controlText = document.createElement('div');
    $(controlText).html(msg);
    controlUI.appendChild(controlText);
    // Setup the click event listeners: simply set the map to Chicago.
    switch(qual){
        case "ADICIONAR":
            controlUI.addEventListener('click', function() {
                addTabela();
            });
        break;
        case "DELETAR":
            controlUI.addEventListener('click', function() {
                removerTabela();
            });
        break;
        case "EDITAR":
            controlUI.addEventListener('click', function() {
                editarTabela();
            });
        break;
    }
}

function initbutton(){
    var control = document.createElement('div');
    var centerControl = new criarBotao(control,'<i class="small material-icons">add_box</i>', 'Adicionar ponto', "ADICIONAR");
    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(control );
  
    control = document.createElement('div');
    centerControl = new criarBotao(control, '<i class="small material-icons">edit_location</i>', 'Substituir',"EDITAR");
    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(control);
  
    control = document.createElement('div');
    centerControl = new criarBotao(control, '<i class="small material-icons">delete</i>', 'Deletar ponto',"DELETAR");
    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(control);

    // control = document.createElement('div');
    // centerControl = new criarBotao(control, '<i class="small material-icons">save</i>', 'Salvar no banco de dados',"SALVAR");
    // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

    control = document.createElement('div');
    // enterControl = new criarBotao(control,  '<div class="localidade-autocomplete"><form id="form" method="post"><input type="text" placeholder="Ex: Presidente Prudente - SP" id="campo-busca" class="autocomplete"></form></div>',
    //  "Local da Coleta", "0");
    enterControl = new criarBotao(control,'<div class="localidade-autocomplete"><input type="text" onclick="abrirModal();"  value="Presidente Prudente (SP)" id="campo"></input></div>', "0");
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

    control = document.createElement('div');
    enterControl = new criarBotao(control,'<div class="localidade"><input readonly="true" type="text" name="entrada1" id="entrada1" placeholder="Localização"></input></div>',
     "Localização do ponto", "0");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

}

initbutton();


/**
 * Abrir modal para selecionar a cidade
 */
function abrirModal(){
    $('#modal').modal('open');
    console.log(cidade +"----"+ estado);
}


/**
 * Selecionar cidade;
 */


$("#aceito").click(function(){
    var testes = regexCampo();
    console.log(testes);
    if(testes != null){
        $.ajax({
            url:"rota_cidades_validar.php",
            method:"POST",
            data:{cidade:testes[0], estado: testes[1]},
            dataType:"html",
            success:function(data){
                if(data== "TRUE"){
                    $("#campo").val($("#campo-busca").val());
                    cidade = testes[0];
                    estado = testes[1];
                    getLocation();
                    for(var i=0 ; i<polygons.length; i++){
                        polygons[i].setMap(null);
                    }
                    polygons = [];
                    limparRotas();
                    recarregarPolygons();
                    Materialize.toast('Cidade encontrada!', 1000);
                }else{
                    Materialize.toast('Cidade não encontrada! Selecione a partir das sugestões e tente novamente', 4000);
                }
            }
        });   
        
    }
});

function regexCampo(){
    var campo = $("#campo-busca").val();
    var teste = campo.match("\\([A-Z][A-Z]\\)");
    console.log(campo.length);
    if(teste != null){
        teste = teste[0];
        teste = teste.substring(1,3);
        testecidade = campo.substring(0, campo.length -5);
        return [testecidade, teste];
    }
    Materialize.toast('Cidade não encontrada! Selecione a partir das sugestões e tente novamente', 4000);
    return null;
}