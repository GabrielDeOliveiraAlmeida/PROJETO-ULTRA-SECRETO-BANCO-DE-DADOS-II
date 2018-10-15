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
var image ="https://png.icons8.com/ultraviolet/50/000000/marker.png";

function initialize() {
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
            coleta: [],
            //fillColor: '#ff0000',
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
        preserveViewport: true
    });
    directionsDisplay.setMap(map);
    marker.setMap(null);
    marker = initializeMarker();
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
        var enderecoChegada = table.rows[tam].cells[0].innerHTML;

        marker.setMap(null);
        marker = initializeMarker();
        var waypts =[];
            for(var i=2; i<tam;i++){
                waypts.push({location: table.rows[i].cells[0].innerHTML});
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
                window.alert('Directions request failed due to ' + status);
            }
        });

        //SALVA DENTRO DO POLIGONO A ROTA;
        selected_shape.rotas = {
            origin: enderecoPartida,
            destination: enderecoChegada,
            waypoints: waypts
        };
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
        $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.origin + '</td>');
        if (tam > 0) {
            for (var i = 0; i < tam; i++) {
                $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.waypoints[i].location + '</td>');
            }
        }
        $('#table tr:last').after('<tr scope="row"> <td>' + shape.rotas.destination + '</td>');
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
    console.log(index);
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
    var coord = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
    geocoder.geocode({'latLng': coord}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                $('#entrada1').val(results[0].formatted_address);
                $('#txtLatitude').val(event.latLng.lat());
                $('#txtLongitude').val(event.latLng.lng());
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
    return new google.maps.Marker({
        map: map,
        draggable: false,
        icon:image,
    });
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

