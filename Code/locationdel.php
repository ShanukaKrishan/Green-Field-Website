<?php
$db = mysqli_connect("localhost","root","","demo");
if (isset($_GET['deletelocation'])) {
		
		$id = $_GET['deletelocation'] ; 

		mysqli_query($db,"DELETE FROM locations WHERE id ='$id' ");


}



if (!$db) {

	die("Connection failed".mysql_connect_error());
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Location Details</title>
	<a href="MainMenu.php"><img src=back.png height="50px" width="50px"></a>
	<style type="text/css">
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: blue;
  color: white;
}
</style>
</head>
<body>
</div>
<h3>Location Details</h3>
<?php
	
	$db = mysqli_connect("localhost","root","","demo");
	$sql = "SELECT * FROM locations";

	
	$results = mysqli_query($db,$sql);
	echo "<table id='customers'>";
	echo "<tr>";
	echo "<th>id</th>";
	echo "<th>name</th>";
	echo "<th>lat</th>";
	echo "<th>lng</th>";
	echo "<th>description</th>";
	echo "<th>location_status</th>";
	echo "<th>With_Image</th>";
	echo "</tr>";


	while ($row = mysqli_fetch_array($results)) {
		$id = $row['id'];
		echo "<tr><td>";
		echo $row['id'];
		echo "</td><td>";
		echo $row['name'];	
		echo "</td><td>";
		echo $row['lat'];	
		echo "</td><td>";
		echo $row['lng'];
		echo "</td><td>";
		echo $row['description'];
		echo "</td><td>";
		echo $row['location_status'];
		echo "</td><td>";
		echo $row['img'];
		echo "</td><td>";

	
		?>
			<a href="locationdel.php?deletelocation=<?php echo $id?>" onclick = "return confirm('Are you sure?');">Delete</a>
<?php 
	}
	echo "</table>";

?>
</body>
</html>