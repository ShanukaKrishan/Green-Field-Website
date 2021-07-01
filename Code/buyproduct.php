<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php

if(isset($_GET['username'])){
	$username = $_GET['username'];
}else{
	$username = "username not set in GET Method";
}
if(isset($_GET['product'])){
	$name = $_GET['product'];
}else{
	$name = "<br>Name not set in GET Method";
}
if(isset($_GET['quantity'])){
	$quantity = $_GET['quantity'];
}else{
	$quantity = "Quantity not set in GET Method";
}
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="assets/css/button.css" />
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
a{
    text-decoration: none;
}
.container {
    height: 400px;
    width: 650px;
    box-shadow: 0px 30px 40px black;
    
    border-radius: 10px;
}
	</style>

</head>
<body>
<center>
   <div class="container">
	<h1 style="color: black">Product of <?php echo $username?></h1>
	

			<input type="hidden" name="size" value="1000000">
		
		<h3>Products could be bought through direct contact with the farmer</h3>

        <h3>Product Name: <?php echo $name?></h3>

        <h3>Product Quantity <?php echo $quantity?></h3>

			
			<div>
				<a href="message.php" class="button big">Contact the farmer to buy product</a><br><br><br>
        <a href="keels.php"><img src=back.png height="30px" width="30px"></a>
        </center>
    
			</div>
      
		</div>
		

</body>
</html>