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
	height: 200px;

}
img {
	height: 100px;
	width: 100px;
}
.map{

 
  left: 50%;}
  a{
  	color: white;
  }

		</style>
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="inner">
					<h1>Green Fields</h1>
					<p>The Department of Agriculture (DoA) along with the Keels <br>A market for the farmers</br><br></p>
					<center>
						
						
							<a href="register.php" class="button big">Farmers signin/signup</a>

						

						
					
					
						<a href="logindao.php" class="button big">DAO signin</a>

						
						
						
							<a href="loginkeels.php" class="button big">keels signin</a>

					
						<a href="loginweb.php" class="button big">webmaster signin</a>

						</center>
				</div>
			</header>

			<div>	
						<br><br>
<center>
        <a href="publicmap.php"><input type="submit" class="button big" value="View Map"></a>
					</center><br>	
</div>
					

					

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Banner -->


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
		echo "<center>";
		echo "<div id='img_div'>";
		echo "<img src='".$row['image']."'";
		echo "<br>";
		echo "<h3>".$row['name']."</h3>";
	echo "<p>".$row['description']."</p>";
	
		echo "</div>";
		

	}
echo "</div>";
for($page=1;$page<=$no_of_pages;$page++)
{


}

	?>	
	
				
	

	</body>
</html>