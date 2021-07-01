<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
a{
    text-decoration: none;
}
#Confirm {
    font-family: Hack, monospace;
    background: #bbff00;
    color: #1d1d1d;
    cursor: pointer;
    font-size: 1em;
    padding: 1.5rem;
    border: 0;
    transition: all 0.5s;
    border-radius: 10px;
    width: auto;
    position: relative;
    min-width: 50px;

    &::after {
        content: "\f2f6";
        font-family: "Font Awesome 5 Pro";
        font-weight: 400;
        position: absolute;
        left: 80%;
        top: 54%;
        right: 0;
        bottom: 0;
        opacity: 0;
        transform: translate(-50%, -50%);

    }

    &:hover {
        background: #2b2bff;
        transition: all 0.5s;
        border-radius: 10px;
        box-shadow: 0px 6px 15px #0000ff61;
        padding: 1.5rem 3rem 1.5rem 1.5rem;
        color: #ffffff;

        &::after {
            opacity: 1;
            transition: all 0.5s;
            color: #ffffff;

        }
    }


}

    </style>
</head>
</html>
<?php
include_once 'header.php';
include 'locations_model.php';
//get_unconfirmed_locations();exit;
?>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?language=en&keyAIzaSyCoB_bQi6SDqu05yHidXbPo8wsJpyAPnQk">
    </script>

    <div id="map"></div>
    <script>alert("Allow Location to See your current location");</script>
    <script>
        /**
         * Create new map
         */
        var infowindow;
        var infoWindow;
        var map;
        var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
        var pending_icon =  'wait.png' ;
        var farmergreen = 'mapbox-icon1.png';
    var farmerblue = 'mapbox-icon.png';
    var farmerred = 'mapbox-icon0.png';
    var farmerval = 'mapbox-icon-val.png';
        var locations = <?php get_confirmed_locations() ?>;
        var myOptions = {
            zoom: 13,
            center: new google.maps.LatLng(6.9271, 79.8612),
            mapTypeId: 'roadmap'
        };
        map = new google.maps.Map(document.getElementById('map'), myOptions);
        infoWindow = new google.maps.InfoWindow;
        //shows the current location of the user
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Your Current Location');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {

          handleLocationError(false, infoWindow, map.getCenter());
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
                                'Error: The Geolocation service failed.' :
                                'Error: Your browser doesn\'t support geolocation.');
          infoWindow.open(map);
        }
        /**
         * Global marker object that holds all markers.
         * @type {Object.<string, google.maps.LatLng>}
         */
        var markers = {};

        /**
         * Concatenates given lat and lng with an underscore and returns it.
         * This id will be used as a key of marker to cache the marker in markers object.
         * @param {!number} lat Latitude.
         * @param {!number} lng Longitude.
         * @return {string} Concatenated marker id.
         */
        var getMarkerUniqueId= function(lat, lng) {
            return lat + '_' + lng;
        };

        /**
         * Creates an instance of google.maps.LatLng by given lat and lng values and returns it.
         * This function can be useful for getting new coordinates quickly.
         * @param {!number} lat Latitude.
         * @param {!number} lng Longitude.
         * @return {google.maps.LatLng} An instance of google.maps.LatLng object
         */
        var getLatLng = function(lat, lng) {
            return new google.maps.LatLng(lat, lng);
        };

        /**
         * Binds click event to given map and invokes a callback that appends a new marker to clicked location.
         */
        var addMarker = google.maps.event.addListener(map, 'click', function(e) {
            var lat = e.latLng.lat(); // lat of clicked point
            var lng = e.latLng.lng(); // lng of clicked point
            var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
            var marker = new google.maps.Marker({
                position: getLatLng(lat, lng),
                map: map,
                animation: google.maps.Animation.DROP,
                id: 'marker_' + markerId,
                html: "    <div id='info_"+markerId+"'>\n" +
                "        <table class=\"map1\">\n" +
          
              
                "            <tr><td></td><td><button id='Confirm'><a href='addincident.php?lat= "+lat+" &lng= "+lng+"'>Confirm Location</a></button></td></tr>\n" +
               
                "        </table>\n" +
                "    </div>"
            });
            markers[markerId] = marker; // cache marker in markers object
            bindMarkerEvents(marker); // bind right click event to marker
            bindMarkerinfo(marker); // bind infowindow with click event to marker
        });

        /**
         * Binds  click event to given marker and invokes a callback function that will remove the marker from map.
         * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
         */
        var bindMarkerinfo = function(marker) {
            google.maps.event.addListener(marker, "click", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                infowindow = new google.maps.InfoWindow();
                infowindow.setContent(marker.html);
                infowindow.open(map, marker);
                // removeMarker(marker, markerId); // remove it
            });
        };

        
        var bindMarkerEvents = function(marker) {
            google.maps.event.addListener(marker, "rightclick", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                removeMarker(marker, markerId); // remove it
            });
        };

       //remove marker
        var removeMarker = function(marker, markerId) {
            marker.setMap(null); // set markers setMap to null to remove it from map
            delete markers[markerId]; // delete marker instance from markers object
        };


// <?php 
// $db = mysqli_connect("localhost","root","","demo");
// $sql = "SELECT * FROM locations Where img='1' ";
// $result = mysqli_query($db,$sql);

// while ($row = mysqli_fetch_array($result)) {
        
//     echo "<div id='img_div'>";
//     echo "<img src='".$row['image']."'";
//     echo "<h2>".$row['name']."</h2>";
//     echo "<p>".$row['description']."</p>";
   

//     echo "</div>";
    

// }
?>//retrieve the images and data to display on the map itself through php

       
        var i ; var confirmed = 0;
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon :   locations[i][5] === '1' ?  farmergreen  : locations[i][5] === '2' ? farmerblue : locations[i][5] === '3' ? farmerred : pending_icon,
                html: "<div>\n" +



                "<table class=\"map1\">\n" +
                "<tr>\n" +
                "<td>"+locations[i][6]+"</td><tr/>" +
               
                "<td>"+locations[i][3]+"</td></tr>\n" +
                "<td><img src='"+locations[i][4]+"' width=100px height=100px </td>"+
                "<td></td><td></td></table>\n" +
                "</div>"
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow = new google.maps.InfoWindow();
                    confirmed =  locations[i][4] === '1' ?  'checked'  : locations[i][4] === '2' ?  'checked' :  locations[i][4] === '3' ?  'checked' : locations[i][4] === '4' ?  'checked': 0;
                    $("#confirmed").prop(confirmed,locations[i][4]);
                    $("#id").val(locations[i][0]);
                    $("#description").val(locations[i][3]);
                    $("#name").val(locations[i][6]);
                    $("#form").show();
                    var location =  new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.setCenter(location);
                    map.setZoom(15);
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

       //saves the marker
        function saveData(lat,lng) {
           
                    var markerId = getMarkerUniqueId(lat,lng); // get marker id by using clicked point's coordinate
                    var manual_marker = markers[markerId]; // find marker
                    manual_marker.setIcon(pending_icon);
                    infowindow.close();
                    infowindow.setContent("<div style=' color: purple; font-size: 25px;'> Waiting for Validation</div>");
                    infowindow.open(map, manual_marker);
               
          
        }

        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    callback(request.responseText, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }


    </script>





<?php
include_once 'footer.php';

?>

