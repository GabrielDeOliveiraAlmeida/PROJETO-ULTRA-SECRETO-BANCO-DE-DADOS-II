/*
    EVENTOS MAPA
 */
map.addListener('click', function(event){
    disablePolygon(selected_shape);
    contextMenu.hide();
});

map.addListener("zoom_changed", function () {
    contextMenu.hide();
})  


map.addListener('dragstart', function(){
    contextMenu.hide();
})

map.addListener('dblclick', function(){
    contextMenu.hide();
    hiddenTable();
})

/*
    EVENTOS MARCADOR
 */
marker.addListener( 'dragend', function () {
    geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                $('#entrada1').val(results[0].formatted_address);
                $('#txtLatitude').val(marker.getPosition().lat());
                $('#txtLongitude').val(marker.getPosition().lng());
            }
        }
    });
});
//-------------------------------------------------------


/*
    EVENTO POLIGONO
 */
drawingManager.addListener('polygoncomplete', function(polygon){
    //DESMARCAR O POLIGONO ANTIGO
    limparRotas();
    apagarTabela();
    disablePolygon(selected_shape);

    //CRIAR ROTAS, SELECIONAR COORDENADAS
    polygon.addListener('click', function(event){
        contextMenu.hide();
        if(polygon == selected_shape) {
            positionMarker(event);
        }
    });

    //EDITAR POLIGONOS
    polygon.addListener('dblclick', function(){
        hiddenTable();
        contextMenu.hide();
        disablePolygon(selected_shape);
        this.setEditable(true);
        setSelection(this);
    });

    //CONFIGURAÇÕES DO POLIGONOS (CONTEXT MENU)
    polygon.addListener('rightclick', function (event) {
        hiddenTable();
        disablePolygon(selected_shape);
        contextMenu.hide();
        //contextMenuMarkerMap.hide();
        setSelection(this);
        this.setEditable(true);
        selected_shape = this;
        contextMenu.show(event);

    });

    //MODIFICAR VERTICE ATUALIZARÁ O VETOR DE POLIGONO
    polygon.getPath().addListener('insert_at', function () {
        console.log(polygon);
    });
    polygon.getPath().addListener('set_at', function () {

    });



    //ADICIONAR AO VETOR DE POLIGONOS
    polygons.push(polygon);

    //ATUALIZAR POLIGONO
    atualizarPolygon(polygon);
    //selected_shape=polygon;
    //selected_shape.setEditable(true);

    console.log(polygons);
    //SELECIONAR DIAS DA SEMANA
    showContext();
});

    //SELECIONAR NOVO POLIGONO E CARREGAR SUA ROTA
    setSelection = function(shape){
    selected_shape=shape;
    carregarRotas(shape);
}

/*
    EVENTOS CONTEXT MENU
 */
    contextMenu.addListener('menu_item_selected', function(latLng, event){
        switch (event){
            case 'excluir_click':
                rmvPolygon();
                break;
            case 'horario_click':
                showContext();
                break;
            case 'color_click':
                changeColor();
                break;
            case 'center_map_click':
                map.panTo(latLng);
                break;
        }
    });

    // contextMenuMarkerMap.addListener('menu_item_selected', function(event, qual){
    //    switch (qual) {
    //        case 'excluir_marker_click':
    //            contextMenu.hide();
    //            rmvMarker(event);
    //            break;
    //    }
    // });
    //
    //
    // function eventMarker(checkpoint_new) {
    //     checkpoint_new.addListener('rightclick', function(event){
    //         contextMenuMarkerMap.show(event);
    //     });
    // }