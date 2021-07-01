<?php
include_once 'adminheader.php';
include_once 'locations_model.php';
?>
<!DOCTYPE HTML>
<!--
	Epilogue by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Green Fields</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style type="text/css">
			#img_div
{
	width: 75%;
	padding: 5px;
	margin: 15px auto;
	border:1px solid #cbcbcb;
	overflow-y: scroll;
	overflow-x: hidden;
	height: 400px;

}
img {
	height: 100px;
	width: 100px;
}
.map{

 
  left: 50%;}

		</style>
	</head>
	<body>
		<header id="header" class="alt">
				<div class="inner">
					<h1>Green Fields</h1>
					<p>The Department of Agriculture (DoA) along with the Keels <br>A market for the farmers</br><br></p>
				
			</div>
			</header>

<div>	
<center>
	<br><br>
        <a href="doa-map.php"><input type="submit" class="button big" value="View Map"></a>
					</center><br>	
</div>
	
			<!-- Wrapper -->
			<div id="wrapper">

				<!-- Banner -->
<center>

					<?php

	
	$db = mysqli_connect("localhost","root","","demo");
	$counting1 = "SELECT COUNT( * ) as count1 from locations where location_status = '1'";
	$results1 = mysqli_query($db,$counting1);
	$row1 = mysqli_fetch_assoc($results1);
	$green = $row1['count1'];

	$counting2 = "SELECT COUNT( * ) as count2 from locations where location_status = '2'";
	$results2 = mysqli_query($db,$counting2);
	$row2 = mysqli_fetch_assoc($results2);
	$blue = $row2['count2'];

	$counting3 = "SELECT COUNT( * ) as count3 from locations where location_status = '3'";
	$results3 = mysqli_query($db,$counting3);
	$row3 = mysqli_fetch_assoc($results3);
	$red = $row3['count3'];
	
	$counting4 = "SELECT COUNT( * ) as count4 from locations where location_status = '4'";
	$results4 = mysqli_query($db,$counting4);
	$row4 = mysqli_fetch_assoc($results4);
	$validated = $row4['count4'];

	$counting = "SELECT COUNT( * ) as count from locations where location_status = '0'";
	$results = mysqli_query($db,$counting);
	$row = mysqli_fetch_assoc($results);
	$notval = $row['count'];



	$sql = "SELECT * FROM locations";
	$result = mysqli_query($db,$sql);
	$results_per_page = 5; //if you want to change the count of result change the number here
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
	$sql = "SELECT * FROM locations LIMIT ".$this_page_first_result.','.$results_per_page;
	$result = mysqli_query($db,$sql);

	while ($row = mysqli_fetch_array($result)) {	

	}


for($page=1;$page<=$no_of_pages;$page++)
{


}
?>	
</center>

<center><div id="piechart"></div></center>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
//get the data from locations_model.php
var locations = <?php get_all_locations() ?>;
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {

	
  var data = google.visualization.arrayToDataTable([
  ['Farmers', 'Transactions'],
  ['Excellent', <?php echo $green?>],
  ['Good Product', <?php echo $blue?>],
  ['Wasted Products', <?php echo $red?>],
  ['Only Validated', <?php echo $validated?>],
  ['Needs Validation', <?php echo $notval?>]
 
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Graph on Farmers and Products', 'width':550, 'height':400,colors: ['green','blue','red','grey','lightgrey'],is3D:true};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
<div class="logout">
        <a href="logout.php"><input type="submit" class="btn btn-warning" value="logout"></a>

        </div> 
	</body>
</html>