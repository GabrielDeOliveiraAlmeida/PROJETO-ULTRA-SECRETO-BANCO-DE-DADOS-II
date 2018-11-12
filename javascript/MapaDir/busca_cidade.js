/*
    AUTO COMPLETE DE CIDADES
*/


// $("#localidade2").on('click','#campo-busca', function(){
    $('#campo-busca').autocomplete({
        minLength: 2,
        autoFocus: true,
        delay: 300,
        appendTo: '#form',
        source: function(request, response){
            $.ajax({
                url: 'rota_cidades.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    'termo': request.term
                }
            }).done(function(data){
                if(data.length > 0){
                    data = data.split(',');
                    response( $.each(data, function(key, item){
                        return({
                            label: item
                        });
                    }));
                }
            });
        }
    });
    


/*
    ATUALIZAR O MAPA NO LOCAL ESCOLHIDO
*/
function getLocation() {
    geocoder.geocode({ 'address': $('#campo-busca').val() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()), 10);
            } else {
                alert("Request failed.")
                map.setCenter(coord = new google.maps.LatLng(-22.119227, -51.407250), 10);

            }
        });
};


/**
 * TEMPO LIMITE PARA ATUALIZAR MAPA
 */
var typingTimer; //timer identifier
var doneTypingInterval = 3000; //time in ms, 1 second for example

/**
 * CAMPO BUSCA É ONDE SERÁ DIGITADO O LOCAL E APOS DETERMINADO TEMPO ATUALIZARÁ O MAPA
 */

// $('#campo-busca').on("keyup",function(){
//     clearTimeout(typingTimer);
//     if ($('#myInput').val) {
//         typingTimer = setTimeout(getLocation, doneTypingInterval);
//     }
// });

