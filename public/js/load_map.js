var marker;
var infowindow;
var geocoder;
var pos;
var map;
$(document).ready(function () {

    //default marker position is in Australia
    pos = {lat: -25.363, lng: 131.044};

    geocoder = new google.maps.Geocoder();
    infowindow = new google.maps.InfoWindow;

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: pos
    });

    if (document.getElementById("location").value != "") {
        pos = document.getElementById("location").value;
        marker = new google.maps.Marker({
            map: map,
            position: pos,
            draggable: true
        });
        geocodeAddress(geocoder);
    } else {
        createMarker(geocoder, pos);

    }

    document.getElementById('submit').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });
})

function createMarker(geocoder, pos) {
    if (marker != null) {
        marker.setMap(null);
    }
    marker = new google.maps.Marker({
        map: map,
        position: pos,
        draggable: true
    });


    marker.addListener("dragend", function () {
        this.map.setCenter(marker.position);
        document.getElementById('location').value = marker.position.lat().toFixed(5) + "," + marker.position.lng().toFixed(5);
        geocodeLatLng(geocoder, map, marker.position);
    })
}

function geocodeAddress(geocoder) {
    var address = document.getElementById('location').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            createMarker(map, results[0].geometry.location)

        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function geocodeLatLng(geocoder, map, infowindow) {
    var input = document.getElementById('location').value;
    var latlngStr = input.split(',', 2);
    var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
    geocoder.geocode({'location': latlng}, function (results, status) {
        if (status === 'OK') {
            if (results[0]) {
                // marker.setMap(null);
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