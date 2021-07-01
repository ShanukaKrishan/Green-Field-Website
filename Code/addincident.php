<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php

if(isset($_GET['lat'])){
	$lat = $_GET['lat'];
}else{
	$name = "Name not set in GET Method";
}
if(isset($_GET['lng'])){
	$lng = $_GET['lng'];
}else{
	$name = "<br>Age not set in GET Method";
}
?>
<?php

$msg="";	


if (isset($_POST['upload'])) {
	
	$target = basename($_FILES['image']['name']);

	$db = mysqli_connect("localhost","root","","demo");


	$Lat = $_POST['lat'];
	$Lng = $_POST['lng'];
	$description = $_POST['description'];
	$image = $_FILES['image']['name'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$quantity = $_POST['quantity'];
	$sql = "INSERT INTO locations(lat, lng, description, image, img, name,username, quantity) VALUES ('$Lat','$Lng','$description','$image',1,'$name','$username', '$quantity')";
	
	mysqli_query($db,$sql);

	if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
	{
		$msg = "Image uploaded successfully";
		
	}

	else
	{
		$msg = "There was a problem in uploading the image";


	} 	 
}





?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Incident</title>
	<style>

body{
	background-image: url('harvest.jpg');
	 background-size: 100%;
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
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
textarea{
width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
form{
	width: 900px;
}
	</style>

</head>
<body>
<center>
	<h1 style="color: white">Upload Information about your harvest </h1>
	<a href="farmer.php"><img src=back.png height="50px" width="50px"></a>
<form method="post" action="addincident.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<input type="file" name="image">

			</div>
			<div>
				<input type="hidden" name="username" value=<?php echo $_SESSION["username"]?>>
			</div>
			<div>
				<input type="text" name="name" placeholder="Product Name">
			</div>
			<div>
				<input type="text" name="quantity" placeholder="Product Quantity">
			</div>
			<div>
				<textarea name="description" cols="40" rows="4" placeholder="Details about the product"></textarea>
			</div>
				<input  type="hidden" name="lat" placeholder="Latitude" value=<?php echo $lat?>>
				<input  type="hidden" name="lng" placeholder="Longitude" value=<?php echo $lng?>>
				
			</div>
			
			<div>
				<input type="submit" name="upload" value="upload" onclick="complete()">

				<script>
					function complete(){
						window.alert("Information Sent for Validation");
					}
				</script>
			</div>
		 </form>
		</center>
</body>
</html>