var selected_shape  = null;
var map;
var polygons = [];
var directionsDisplay;
var directionsService= new google.maps.DirectionsService();
var geocoder;
var marker =[];
var marker1 = [];
var drawingManager;
var contextmenuDir ="";
var index;
var infowindow;
var image ="https://png.icons8.com/ultraviolet/50/000000/marker.png";
var x_ult;
var y_ult;
var addr;
var cidade = "Presidente Prudente";
var estado = "SP";
var forma;
var placa;
var email;


function initialize() {
    infowindow = new google.maps.InfoWindow();
    directionsDisplay = new google.maps.DirectionsRenderer({
        preserveViewport: true
    });
    var latlng = new google.maps.LatLng(-22.119227, -51.407250);

    var options = {
        zoom: 14,
        center: latlng,
        disableDoubleClickZoom: true,
        fullscreenControl: false,
        mapTypeControl:false,
        streetViewControl:false,
        gestureHandling: 'greedy',
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
    geocoder = new google.maps.Geocoder();
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("trajeto-texto"));
    marker = initializeMarker();
    marker1 = initializeMarker();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            pontoPadrao = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(pontoPadrao);

            //var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                    "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
                },
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $("#entrada1").val(results[0].formatted_address);
                    }
                });
        });
    }

    drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.LEFT,
            drawingModes: ['polygon']},
        polygonOptions:{
            draggable: false,
            editable: false,
            rotas: "",
            identificador: 0,
            fillColor: '#ff0000',
        }
    });
    drawingManager.setMap(map);


}

initialize();


/*
    REMOVER POLIGONOS E EXCLUI DO VETOR
 */
function rmvPolygon() {
    index = polygons.indexOf(selected_shape);
    removerPoligono();
    polygons.splice(index,1);
    index = null;
    selected_shape.setMap(null);
    contextMenu.hide();
    selected_shape = null;
    limparRotas();
    apagarTabela();
    Materialize.toast('Polígono Excluído!', 1000);
}

// /*
//     REMOVER MARCADOR;
//  */
// function rmvMarker(){
//     var indexMarker = selected_shape.checkpoint.indexOf(checkpoint);
//     checkpoint.setMap(null);
//     selected_shape.checkpoint.splice(indexMarker, 1);
//     contextMenuMarkerMap.hide();
// }
/*
    LIMPAR ROTAS E PONTOS
 */
function limparRotas(){
    drawingManager.setDrawingMode(null);

    directionsDisplay.setMap(null);
    directionsDisplay.setPanel(null);
    directionsDisplay = new google.maps.DirectionsRenderer({
        preserveViewport: true,
        draggable: false,
    });
    directionsDisplay.setMap(map);
    marker.setMap(null);
    marker = initializeMarker({
        draggable: false
    });
    // eventsMarker(marker);
}

/*
    CRIAR ROTAS E SALVAR DENTRO DO POLIGONO
    A partir dos pontos inseridos as rotas iram sendo salvas dentro do poligonos
    e a todo momento a rota será recalculada.
 */
function criarRota(){
    var tam = table.rows.length-1;
    if(tam>1){
        var enderecoPartida = table.rows[1].cells[0].innerHTML;
        var enderecoPartida_x = table.rows[1].cells[1].innerHTML;
        var enderecoPartida_y = table.rows[1].cells[2].innerHTML;
        var enderecoChegada = table.rows[tam].cells[0].innerHTML;
        var enderecoChegada_x = table.rows[tam].cells[1].innerHTML;
        var enderecoChegada_y = table.rows[tam].cells[2].innerHTML;

        marker.setMap(null);
        marker = initializeMarker({
            draggable: false
        });
        // eventsMarker(marker);
        var waypts =[];
        var wayptsaux = [];
            for(var i=2; i<tam;i++){
                waypts.push({location: table.rows[i].cells[0].innerHTML});
                wayptsaux.push(
                    {location: table.rows[i].cells[0].innerHTML, 
                    x: table.rows[i].cells[1].innerHTML,
                    y: table.rows[i].cells[2].innerHTML});
            }
        var request = { // Novo objeto google.maps.DirectionsRequest, contendo:
            origin: enderecoPartida, // origem
            destination: enderecoChegada, // destino
            waypoints: waypts,
            travelMode: google.maps.TravelMode.DRIVING // meio de transporte, nesse caso, de carro
        };
        directionsService.route(request, function(result, status){
            if (status == google.maps.DirectionsStatus.OK) { // Se deu tudo certo
                directionsDisplay.setDirections(result); // Renderizamos no mapa o resultado
            }else{
                window.alert('Falhou ao criar rota: ' + status);
            }
        });

        //SALVA DENTRO DO POLIGONO A ROTA;
        selected_shape.rotas = {
            origin: enderecoPartida,
            origem_x: enderecoPartida_x,
            origem_y: enderecoPartida_y,
            destino_x: enderecoChegada_x,
            destino_y: enderecoChegada_y,
            destination: enderecoChegada,
            waypoints: wayptsaux
        };
        // google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
        //     console.log(directionsDisplay.directions.routes[0].legs[0].via_waypoints);
        //   });
        
        // armazenarRota(selected_shape);
    }
}

/*
    A ROTA E TABELA SALVA DENTRO DE UM DETERMINADO POLIGONOS SERÃO CARREGADAS
 */
function carregarRotas(shape) {
    index = polygons.indexOf(selected_shape);
    limparRotas(); //LIMPAR A ROTA JÁ EXISTENTE.
    apagarTabela();
    if(shape.rotas != "") {
        var tam = shape.rotas.waypoints.length;
        $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.origin + '</td><td>'+shape.rotas.origem_x+
            '</td><td>'+shape.rotas.origem_y+'</td>');
        if (tam > 0) {
            for (var i = 0; i < tam; i++) {
                $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.waypoints[i].location + '</td>'+
                    '<td>'+shape.rotas.waypoints[i].x + '</td><td>'+shape.rotas.waypoints[i].y + '</td>');
            }
        }
        $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.destination + '</td><td>'+shape.rotas.destino_x+
            '</td><td>'+shape.rotas.destino_y+'</td>');
        selectedRowToInput();
        criarRota();
        }
}

/*
    Atualizar Indice do poligono selecionado
 */
function atualizarPolygon(shape){

    selected_shape = shape;
    index = polygons.indexOf(shape);
    selected_shape.setEditable(true);
}

/*
    DESATIVAR EDICAO POLIGONO
 */
function disablePolygon(polygon){
    if(polygon != null){
        polygon.setEditable(false);
    }
}


/*
    POSICIONAR MARCADOR.
 */
function positionMarker(event){
    x_ult = event.latLng.lat();
    y_ult = event.latLng.lng();
    var coord = new google.maps.LatLng(x_ult, y_ult);
    geocoder.geocode({'latLng': coord}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                addr = results[0].formatted_address;
                $('#entrada1').val(addr);
                    marker.setPosition(coord);
                }

        }
    });
}

function recuperarAddress(address){
    geocoder.geocode({'address':address}, function (results, status) {
        if(status == 'OK'){
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
        }else{
            alert('Não foi possivel concluir essa ação: ' + status);
        }
    });
}

/*
INICIALIZAR MARCADOR
 */
function initializeMarker(){
    var marker =  new google.maps.Marker({
        map: map,
        draggable: false,
        icon:image,
    });
    // eventsMarker(marker);
    return marker;
}

/*TROCAR COR DO POLIGONO */
function changeColor(){
    console.log("ALTERANDO COR");
    // var polygonOptions = drawingManager.get('polygonOptions');
    // polygonOptions.fillColor ="#bfbfbf";
    // drawingManager.set('polygonOptions', polygonOptions);

    if(selected_shape.fillColor == '#ff0000'){
        selected_shape.set('fillColor', '#333333');
    }else{selected_shape.set('fillColor', '#ff0000');}

}
