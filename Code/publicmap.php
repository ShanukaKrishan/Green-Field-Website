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
        var locations = <?php get_confirmed_locations() ?>;
        var myOptions = {
            zoom: 13,
            center: new google.maps.LatLng(6.9271, 79.8612),
            mapTypeId: 'roadmap'
        };
        map = new google.maps.Map(document.getElementById('map'), myOptions);
       

       
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
               
               
                "<td><img src='"+locations[i][4]+"' width=100px height=100px </td>"+
                "<td></td><td></td></table>\n" +
                "</div>"
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow = new google.maps.InfoWindow();
                    confirmed =  locations[i][4] === '1' ?  'checked'  : locations[i][4] === '2' ?  'checked' :  locations[i][4] === '3' ?  'checked' : 0;
                    $("#confirmed").prop(confirmed,locations[i][4]);
                    $("#id").val(locations[i][0]);
                    $("#description").val(locations[i][3]);
                    $("#name").val(locations[i][6]);
                    $("#form").show();
                    var location =  new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.setCenter(location);
                    map.setZoom(17);
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

   


    </script>





<?php
include_once 'footer.php';

?>
