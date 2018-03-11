var marker;
var infowindow;
$(document).ready(function() {
    var uluru = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: uluru
    });
    var geocoder = new google.maps.Geocoder();
    infowindow = new google.maps.InfoWindow;

    createMarker(geocoder, map, uluru);


    document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
    });
})

function createMarker(geocoder, map, position){
    marker = new google.maps.Marker({
        map: map,
        position: position,
        draggable:true
    });


    marker.addListener("dragend", function(){
        map.setCenter(marker.position);
        document.getElementById('location').value = marker.position.lat().toFixed(5) + "," + marker.position.lng().toFixed(5);
        geocodeLatLng(geocoder, map, marker.position);
    })
}

function geocodeAddress(geocoder, resultsMap) {
    console.log("test");
    var address = document.getElementById('location').value;
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            marker.setMap(null);
            createMarker(resultsMap, results[0].geometry.location)

        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function geocodeLatLng(geocoder, map, infowindow) {
    var input = document.getElementById('location').value;
    var latlngStr = input.split(',', 2);
    var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                marker.setMap(null);
                createMarker(geocoder, map, latlng);
                document.getElementById("location").value = results[0].formatted_address;
            } else {
                window.alert('No results found');
            }
        } else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });
}