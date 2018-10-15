$('#campo-busca').autocomplete({
    minLength: 2,
    autoFocus: true,
    delay: 300,
    appendTo: '#form',
    source: function(request, response){
        $.ajax({
            url: 'busca_cidade.php',
            type: 'get',
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


function getLocation(address) {
    geocoder.geocode({ 'address': $('#campo-busca').val() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()), 10);
            } else {
                alert("Request failed.")
                map.setCenter(coord = new google.maps.LatLng(-22.119227, -51.407250), 10);

            }
        });
};

var typingTimer; //timer identifier
var doneTypingInterval = 3000; //time in ms, 1 second for example

$('#campo-busca').on("keyup",function(){
    clearTimeout(typingTimer);
    if ($('#myInput').val) {
        typingTimer = setTimeout(getLocation, doneTypingInterval);
    }
});

