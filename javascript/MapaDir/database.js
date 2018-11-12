
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
                forma = new google.maps.Polygon({
                    path:pol,
                    draggable: false,
                    editable: false,
                    rotas: "",
                    coleta: [],
                    identificador: id,
                    fillColor: '#ff0000',
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




// shape.rotas = {
//                 origin: origem,
//                 origem_x: origem_x,
//                 origem_y: origem_y,
//                 destination: destino,
//                 destino_x: destino_x,
//                 destino_y: destino_y,
//                 waypoints: waypts
//             };