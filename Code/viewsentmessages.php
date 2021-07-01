
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then reddirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
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
	<title>User Incident Details</title><center>
	<a href="farmer.php"><img src=back.png height="40px" width="40px"></a>
	</center>
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
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  text-align:center;
  font-size: 20px;
  font-weight: bold;
  color: black;

}
p {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  text-align:right;
  font-size: 20px;
  color: white;
  align-items: right

}
#replybtn {
  width: 10%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  text-align:right;
  font-size: 20px;
  color: black;
  background-color: white;
  text-decoration: none;
}

body{ 
  
    
    background:url(details.jpg);
    background-size: 100%;
width: 850px;
  top: 30%;
  left: 30%;
  margin-top: -50px;
  margin-left: -100px;
  align-items: center;
 position:absolute;

    font-family: sans-serif;

}
h3{

  color: white;
}
div{
   background: rgba(0,0,0,0.5);
   padding: 20px;
}


</style>
</head>
<body>
</div>
<h2 style="text-align: center;">Messages you have sent to keels</h2>
<form method="post" action="viewuser.php" enctype="multipart/form-data">

</form>
<div>
<?php
	
	$db = mysqli_connect("localhost","root","","demo");
	$username =$_SESSION["username"];
	$sql = "SELECT * FROM farmmsg Where username='$username'";

	
	$results = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($results)) {
  echo "<h3>Product Name : ".$row['name']."</h3>";
		echo "<input disabled type='text' value='".$row['messagefarm']."'>";
    echo "<p> to ".$row['keelsuname']."</p>";
    echo "<center>";
    echo "<br>";echo "<br>";
    echo "<p> -----------------------------------------------------------------------------------------------------------------</p>";
echo "</center>";

	
		?>
			
<?php 
	}
	echo "</table>";

?>
</div>
</body>
</html>