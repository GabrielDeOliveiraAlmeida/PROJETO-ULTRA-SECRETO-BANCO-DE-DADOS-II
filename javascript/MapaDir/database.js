
/**
 * Transformará os poligonos em coordenadas codificadas para 
 * em seguida armazenar no banco de dados
 * 
 */
// function salvarPolygons(){
//     var coord, rota;
//     var tam = polygons.length;
//     for(var i = 0; i < tam; i++){   
//         coord =polygonCoord(polygons[i].getPaths());
//         console.log(polygons);
//         // rota = getRota(polygons[i].rota);
//         armazenarRota(polygons[i].rotas);
//         polygons[i].id = armazenarPoligono(coord);

//     }
// }


function salvarPolygons(){
    var coord;
    console.log(selected_shape.getPaths);
    coord = polygonCoord(selected_shape.getPaths());
    // rota = getRota(polygons[i].rota);
    //armazenarRota(selected_shape);
    armazenarPoligono(coord, function(data){
        selected_shape.identificador=data;
    });
    
}



function recarregarPolygons(){
    recarregarPolygonsbd(function(data){
        console.log(data);
        polygons = data;
    });
}
function recarregarPolygonsbd(callback){
    var data = "cidade="+cidade+"&estado="+estado;
    console.log(data);

    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdrecuperar_poligono.php",
        data:data,
        success: function(data){
            for(var i =0 ;i<data.length ; i++){
                var pol = decodificarCoord(data[i].pol);
                var id = data[i].id;
                console.log(data);
                forma = new google.maps.Polygon({
                    path:pol,
                    draggable: false,
                    editable: false,
                    rotas: "",
                    identificador: id,
                    fillColor: data[i].cor
                });
                selected_shape = forma;
                selected_shape.setMap(map);
                eventosPoligono(forma);
                recarregarRota(id, forma, function(data){
                    polygons.push(data);
                    console.log(polygons);
                    callback(polygons);
                    
                }); 
            }
            
        }        
    });
}

function recarregarRota(id, shape, callback){
    var data = "id="+id;
    console.log(data);
    $.ajax({
        method:"post",
        data:data,
        url:"../hipertext/rota_bdrecuperar_rota.php",
        success: function(data){
            var waypts =[];
            var origem = data[0].coord;
            var origem_x = data[0].x;
            var origem_y = data[0].y;
            var destino = data[data.length-1].coord;
            var destino_x = data[data.length-1].x;
            var destino_y = data[data.length-1].y;

            for(var i=1; i<data.length-1; i++){
                    waypts.push({location: data[i].coord, 
                        x: data[i].x,
                        y: data[i].y});
            } 
            shape.rotas = {
                origin: origem,
                origem_x: origem_x,
                origem_y: origem_y,
                destination: destino,
                destino_x: destino_x,
                destino_y: destino_y,
                waypoints: waypts
            };
            callback(shape);
        }
    });
}

function coordtoadress(x,y, callback){
    var coord = new google.maps.LatLng(x, y);
    geocoder.geocode({'latLng': coord}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                callback(results[0].formatted_address)        
            }

        }
    });
}

/**
 * encoding para codificação
 */
function codificarCoord(path){
    path=(path.getArray)?path.getArray():path;
    return google.maps.geometry.encoding.encodePath(path);
}

/**
 * Não utilizado, mas serve para receber as coordenadas
 * @param {} latLng 
 */
function latLong(latLng){
    return([latLng.lat(),latLng.lng()]);
}

/**
 * decodificar poligono;
 */
function decodificarCoord(path){
      return google.maps.geometry.encoding.decodePath(path);
}
  

/**
 * Armazenamento utilizará o ajax, 
 * usamos recuperamos o id da cidade e em seguida armazena
 * @param {*} coord 
 */

function armazenarPoligono(coord,callback){
    var data = "paths="+coord+"&cidade="+cidade+"&estado="+estado+"&id="+selected_shape.identificador+"&cor="+selected_shape.fillColor;
    console.log(data);
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdpoligono.php",
        data:data,
        success: function(data){
                callback(parseInt(data));
            }
    });
}


function editarArmazenamento(indice){
    // var data = "id="+selected_shape.identificador+"&x_coord="+x_ult+ "&y_coord="+y_ult+"&qual="+indice;
    var data = "id="+selected_shape.identificador+"&coord="+addr+"&qual="+indice+"&x="+x_ult+"&y="+y_ult;
    console.log(data);
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdedit.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });
}

function armazenarCoord(){
    // var data = "id="+selected_shape.identificador+"&x_coord="+x_ult+ "&y_coord="+y_ult;
    var data = "id="+selected_shape.identificador+"&coord="+addr+"&x="+x_ult+"&y="+y_ult;
    console.log(data); 
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdcoord.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });
}

function removerArmazenamento(indice){
    var data = "id="+selected_shape.identificador+"&qual="+indice;
    console.log(data);
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdremover.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });
}

function addressToCoord(address, callback){
    geocoder.geocode({'address':address}, function (results, status) {
        if(status == 'OK'){
            var resultado = [results[0].geometry.location.lat(), results[0].geometry.location.lng()];
            callback(resultado);
        }else{
            alert('Não foi possivel concluir essa ação: ' + status);
        }
    });
}


function removerPoligono(){
    var data = "id="+selected_shape.identificador;
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bddeletepoligono.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });
}


function changeColorBD(){
    var data ="id="+selected_shape.identificador+"&color="+selected_shape.fillColor;
    console.log(data);
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdchange_color.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });   
}


function atualizarPolygonBD(){
    console.log(selected_shape);
    var data ="id="+selected_shape.identificador+"&coord="+polygonCoord(selected_shape.getPaths());
    console.log(data);
    $.ajax({
        method:"post",
        url:"../hipertext/rota_bdupdatepolygon.php",
        data:data,
        success: function(data){
            console.log(data);
        }
    });      
}

/**
 * Receberá todas as coordenadas dos vertices dos poligonos getPaths
 */
function polygonCoord(paths){
    var r=[];
    paths=(paths.getArray)?paths.getArray():paths;
    for(var i=0;i<paths.length;++i){
        r.push(codificarCoord(paths[i]));
      }
     return r;
  }

function selecaoDriverDB(){
    var data ="dia="+diasemana;
    $.ajax({
        method:"post",
        url:"../hipertext/rota_dbtabela_driver.php",
        data:data,
        success: function(data){
            $("#tabelas").html(data);
            var table = document.getElementById("selecionardrivers");
            selectedDriver(table);
        }
    });         
}

function selecaoTruckDB(){
    var data ="dia="+diasemana;
    $.ajax({
        method:"post",
        url:"../hipertext/rota_dbtabela_truck.php",
        data:data,
        success: function(data){
            $("#tabelas").html(data);
            var table = document.getElementById("selecionartrucks");
            selectedTruck(table);
        }
    });         
}


function cronogramaSalvar(){
    var data = "id="+selected_shape.identificador+"&email="+email+"&placa="+placa
    +"&dia="+diasemana+"&hora="+$("#hora").val();
    $.ajax({
        method:"post",
        url:"../hipertext/cronograma_salvar.php",
        data:data,
        success: function(){
            Materialize.toast('Coletores Salvos!', 1000);
        }
    });
}

function cronogramaCarregar(){
    var data = "id="+selected_shape.identificador+"&dia="+diasemana;
    $.ajax({
            method:"post",
            url:"../hipertext/cronograma_carregar.php",
            data:data,
            success: function(data){
                $("#selecaodriver").val(data.nome);
                $("#selecaotruck").val(data.modelo);
                console.log(data.hora);
                $("#hora").val(data.hora);
                email = data.email;
                placa = data.placa;
           }
        });   
}

function cronogramaRemover(){
    var data = "id="+selected_shape.identificador+"&dia="+diasemana;
    $.ajax({
            method:"post",
            url:"../hipertext/cronograma_remover.php",
            data:data,
            success: function(){
                $("#selecaodriver").val("");
                $("#selecaotruck").val("");
                $("#hora").val("00:00");
                email = "";
                placa = "";
                Materialize.toast('Coletores Removidos!', 1000);
           }
        });   
}