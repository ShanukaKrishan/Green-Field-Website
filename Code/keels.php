<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE HTML>

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
a{
	text-decoration: none;
}
		</style>
	</head>
	<body>
		<header id="header" class="alt">
				<div class="inner">
					<h1>Green Fields</h1>
					<p>The Department of Agriculture (DoA) along with the Keels <br>A market for the farmers</br><br></p>
					<center>
        <a href="admin-map.php" class="button big">View Map</a>
					<a href="viewsentmessagestofarm.php" class="button big">view sent messages</a>
					<a href="viewmessagesfromfarm.php" class="button big">view messages from farmers</a></center><br>	

				
			</div>
			</header>

<div>	

</div>
	
			<!-- Wrapper -->
			<div id="wrapper">

				<!-- Banner -->
<center>

					<?php
	
	$db = mysqli_connect("localhost","root","","demo");
	$sql = "SELECT * FROM locations";
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
	$sql = "SELECT * FROM locations LIMIT ".$this_page_first_result.','.$results_per_page;
	$result = mysqli_query($db,$sql);
echo "<div class='pagination'>";
	while ($row = mysqli_fetch_array($result)) {
		
		echo "<div id='img_div'> <br>";
		echo "<img src='".$row['image']."' <br>";
		echo "<p>".$row['name']."</p>";
		echo "<p>".$row['description']."</p>";
		echo "<a class='button new' href='message.php?username=".$row['username']."&name=".$row['name']."&suname=".$_SESSION["username"]."'>Send a message to the farmer</a>" ;
		echo "</div>";

	}
echo "</div>";
for($page=1;$page<=$no_of_pages;$page++)
{



}

	?>	
</center>

<div class="logout">
        <a href="logout.php" class="btn btn-warning"><input type="submit" class="btn btn-warning" value="logout"></a>

        </div> 
	</body>
</html>