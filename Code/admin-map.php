<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
a {
  background-color: #5D6D7E;
  
  color: black;
  position: relative;
  text-decoration: none;
  padding: 6px;
}

a:hover {
  background-color: black;
  color: white;
}

a:active {
  box-shadow: none;
  top: 5px;
}

.pagination{
     background: #dfdfdf;
   color: black;
  border-radius: 4px;
  border: 6px solid #171717;
  text-align: center;
  font-size: 18px;
}
        
      #validate{
    background:black;
    @include bm($bm-pd: 8px 16px, $bm-mg: 16px 0 50px 0);
    @include tf(#fff);
    border: none;
    color: white;
    @include other($ot-br: 4px, $ot-cr: pointer, $ot-bs: $o-b);
        &:hover{
            @include tf($tf-ls: 2px);
            @include other($ot-bs: none)
        }
}
 #gb{
    background:#7FFF00;
    @include bm($bm-pd: 8px 16px, $bm-mg: 16px 0 50px 0);
    @include tf(#fff);
    border: none;
    @include other($ot-br: 4px, $ot-cr: pointer, $ot-bs: $o-b);
        &:hover{
            @include tf($tf-ls: 2px);
            @include other($ot-bs: none)
        }
}
   #bb{
    background:blue;
    @include bm($bm-pd: 8px 16px, $bm-mg: 16px 0 50px 0);
    @include tf(#fff);
    border: none;
    @include other($ot-br: 4px, $ot-cr: pointer, $ot-bs: $o-b);
        &:hover{
            @include tf($tf-ls: 2px);
            @include other($ot-bs: none)
        }
}
   #rb{
    background:red;
    @include bm($bm-pd: 8px 16px, $bm-mg: 16px 0 50px 0);
    @include tf(#fff);
    border: none;
    @include other($ot-br: 4px, $ot-cr: pointer, $ot-bs: $o-b);
        &:hover{
            @include tf($tf-ls: 2px);
            @include other($ot-bs: none)
        }
}


    </style>
</head>

</html>
<?php
include_once 'adminheader.php';
include_once 'locations_model.php';
?>

<div id="list">
    
    <?php
    $db = mysqli_connect("localhost","root","","demo");
    $sql = "SELECT * FROM locations Where img='1' ";
    $result = mysqli_query($db,$sql);
    $results_per_page = 5;
    $no_of_results = mysqli_num_rows($result);
    
    // to round of the value : ceil() is used
    $no_of_pages = ceil($no_of_results/$results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;

}
else
{

    $page = $_GET['page'];


}


$this_page_first_result = ($page-1)* $results_per_page;
    $sql = "SELECT * FROM locations where img='1' LIMIT ".$this_page_first_result.','.$results_per_page;
    $result = mysqli_query($db,$sql);
echo "<div class='pagination'>";
    while ($row = mysqli_fetch_array($result)) {
        
        echo "<div id='img_div'>";
        echo "<img src='".$row['image']."'";
        echo "<h2>".$row['name']."</h2>";
        echo "<p>".$row['description']."</p>";
        echo "<a class='button new' href='message.php?username=".$row['username']."&name=".$row['name']."&suname=".$_SESSION["username"]."'>Send a message</a>" ;
        echo "<button onclick='zoomin(".$row['lat'].",".$row['lng'].")'>view on map</button>";
    
        echo "</div>";
        

    }
echo "</div>";
for($page=1;$page<=$no_of_pages;$page++)
{



}
?>

</div>
<div id="map">
<script>alert("Allow Location to See your current location");</script>
<!------ Include the above in your HEAD tag ---------->
<script>
    var map;
    var marker;
    var infowindow;
    var infoWindow;
    var red_icon =  'marker.png' ;
    var pending_icon =  'wait.png' ;
    var farmergreen = 'mapbox-icon1.png';
    var farmerblue = 'mapbox-icon.png';
    var farmerred = 'mapbox-icon0.png';
    var farmerval = 'mapbox-icon-val.png';
    var locations = <?php get_all_locations() ?>;

    function initMap() {
        var colombo = {lat: 6.9271, lng: 79.8612};
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
            center: colombo,
            zoom: 13
        });




         infoWindow = new google.maps.InfoWindow;
        //get the current location of you
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
        var i ; var confirmed = 0;
        for (i = 0; i < locations.length; i++) {
            var val = locations[i][5] === '4' ? 'hidden' : 'button';
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon :   locations[i][5] === '1' ?  farmergreen  : locations[i][5] === '2' ? farmerblue : locations[i][5] === '3' ? farmerred :locations[i][5] === '4' ? farmerval: pending_icon,
                html: "<table class=\"map1\">"+
             "   <center>"+
                "      <img src= '"+locations[i][4]+"' width=200px height=150px>"+
             
                "   <input name='id' value="+locations[i][0]+" type='hidden' id='id'/>"+
                "    <h4>"+locations[i][6]+"</h4>"+
                "   Description: "+locations[i][3]+" <br>"+
                    
        "<button><a href='buyproduct.php?username="+locations[i][7]+"&quantity="+locations[i][8]+"&product="+locations[i][6]+"'>Buy Product</a></button>"+    
        "<input type='"+ val +"' id='validate' onclick='saveData()' value='Validate'></input><br>"+
            "Rate! Set Flag<br>"+
            "<button id='gb' onclick='saveData1()'>😃</button>"+
             "<button id='bb' onclick='saveData2()'>😐</button>"+
              "<button id='rb' onclick='saveData3()'>😥</button>"+
        
            "</center>"+
            "   </table>"
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  
                    $("#id").val(locations[i][0]);
                    $("#description").val(locations[i][3]);
                    $("#image").val(locations[i][4]);
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
    }

    function zoomin(lat,lng){
    var location =  new google.maps.LatLng(lat, lng);
                    map.setCenter(location);
                    map.setZoom(17);
}



    function saveData() {
        console.log("worked");
      
        var id = document.getElementById('id').value;
        var url = 'locations_model.php?confirm_location&id=' + id ;
        downloadUrl(url, function(data, responseCode) {
            console.log(responseCode);
            console.log(data);
            if (responseCode === 200  && data.length > 1) {
                infowindow.close();
                window.location.reload(true);
            }else{
                infowindow.setContent("<div style='color: purple; font-size: 25px;'>Inserting Errors</div>");
            }
        });
    }
    function saveData1() {
        console.log("worked");
      
        var id = document.getElementById('id').value;
        var url = 'locations_model.php?confirm_location1&id=' + id ;
        downloadUrl(url, function(data, responseCode) {
            console.log(responseCode);
            console.log(data);
            if (responseCode === 200  && data.length > 1) {
                infowindow.close();
                window.location.reload(true);
            }else{
                infowindow.setContent("<div style='color: purple; font-size: 25px;'>Inserting Errors</div>");
            }
        });
    }

    function saveData2() {
        console.log("worked");
      
        var id = document.getElementById('id').value;
        var url = 'locations_model.php?confirm_location2&id=' + id ;
        downloadUrl(url, function(data, responseCode) {
            if (responseCode === 200  && data.length > 1) {
                infowindow.close();
                window.location.reload(true);
            }else{
                infowindow.setContent("<div style='color: purple; font-size: 25px;'>Inserting Errors</div>");
            }
        });
    }
    function saveData3() {
        console.log("worked");
      
        var id = document.getElementById('id').value;
        var url = 'locations_model.php?confirm_location3&id=' + id ;
        downloadUrl(url, function(data, responseCode) {
            if (responseCode === 200  && data.length > 1) {
                infowindow.close();
                window.location.reload(true);
            }else{
                infowindow.setContent("<div style='color: purple; font-size: 25px;'>Inserting Errors</div>");
            }
        });
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyA-AB-9XZd-iQby-bNLYPFyb0pR2Qw3orw&callback=initMap">
</script>
