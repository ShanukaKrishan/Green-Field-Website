<?php
$db = mysqli_connect("localhost","root","","demo");

if (!$db) {

    die("Connection failed".mysql_connect_error());
}

?>

<?php


$msg="";	


if (isset($_POST['upload'])) {
	

	$db = mysqli_connect("localhost","root","","demo");


	$quantity = $_POST['quantity'];
	$id = $_POST['id'];
	$Username = $_POST['username'];
	$sql = "UPDATE locations
SET quantity='$quantity'
WHERE id='$id'";
	
	mysqli_query($db,$sql);

	}

?>
<?php



if (isset($_POST['delete'])) {
	

	$db = mysqli_connect("localhost","root","","demo");


	$id = $_POST['id'];
	$sql = "DELETE FROM locations
WHERE id='$id'";
	
	mysqli_query($db,$sql);

	}

?>



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
	<title>User Incident Details</title>
	<a href="farmer.php"><img src=back.png height="50px" width="50px"></a>
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
body{ 
          margin:0;
    padding:0;
    background:url(details.jpg);
    background-size: 100%;
width: 850px;
position: fixed;
  top: 30%;
  left: 30%;
  margin-top: -50px;
  margin-left: -100px;
  align-items: center:
 

    font-family: sans-serif;

}
input[type=text]{
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: lightblue;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
 tr{
 	background-color: white;
 }
</style>
</head>
<body>
</div>
<h3>Location details</h3>
<form method="post" action="viewuser.php" enctype="multipart/form-data">

</form>
<?php
	
	$db = mysqli_connect("localhost","root","","demo");
	$username =$_SESSION["username"];
	$sql = "SELECT * FROM locations Where username='$username'";

	
	$results = mysqli_query($db,$sql);
	echo "<table id='customers'>";
	echo "<th>Product id</th>";
	echo "<th>Product name</th>";
	echo "<th>description</th>";
	echo "<th>Quantity</th>";
	echo "</tr>";


	while ($row = mysqli_fetch_array($results)) {
		echo "</td><td>";
		echo $row['id'];	
		echo "</td><td>";
		echo $row['name'];	
		echo "</td><td>";
		echo $row['description'];
		echo "</td><td>";
		echo $row['quantity'];
		echo "</td><td>";
		?>
		</tr>
<?php 
	}
	echo "</table>";

?>
<center>
	
<form method="post" action="viewuser.php" >
			<div>
				<input type="text" name="quantity" placeholder="Please Enter the new quantity">
			</div>
			<div>
				<input type="text" name="id" placeholder="Please Enter the Product id you want to delete or update">
			</div>
			<div>
				<input type="hidden" name="username" value=<?php echo $username?>>
			</div>
			
			<div>
				<input type="submit" name="upload" value="Update" onclick="complete()">
				<input type="submit" name="delete" value="Delete" onclick="deleted()" >

				<script>
					function complete(){
						window.alert("Quantity updated successfully");
					}
				</script>
				<script>
					function deleted(){
						window.alert("Prodcut deleted successfully");
					}
				</script>
			</div>
		 </form>
		</center>
</body>
</html>