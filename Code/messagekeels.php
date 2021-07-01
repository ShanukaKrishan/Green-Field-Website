<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
if(isset($_GET['username'])){
    $username = $_GET['username'];
}else{
    $username = "userName not set in GET Method";
} 
?>
<?php
if(isset($_GET['name'])){
    $name = $_GET['name'];
}else{
    $name = "Name not set in GET Method";
} 


?>
<?php
if(isset($_GET['suname'])){
    $suname = $_GET['suname'];
}else{
    $suname = "suName not set in GET Method";
} 
?>


<?php




if (isset($_POST['upload'])) {



$dbname = "demo";
$message = $_POST['message'];
$username = $_POST['username'];
$suname = $_POST['suname'];
$name = $_POST['name'];
$conn = mysqli_connect("localhost", "root", "", $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql ="INSERT INTO `farmmsg`(`username`, `messagefarm`, `name`,`keelsuname`) VALUES ('$username','$message','$name','$suname')"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: viewmessages.php');
    exit;
} else {
    echo "Error sending message";
}

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>send message</title>
  <style>

body{
  background-image: url('msgfromkeels.jpg');
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
h1{
  color: white;
}
form{
 width: 70%; 
}
  </style>
}

</head>
<body>
<center>
  <h1>Send message </h1>
<form method="post" action="messagekeels.php" enctype="multipart/form-data">
      
      </div>
      <input type="hidden" name="username" value=<?php echo $username?>>
      <input type="hidden" name="name" value=<?php echo $name?>>
      <input type="hidden" name="suname" value=<?php echo $suname?>>
      <div>
        <input type="text" name="message" placeholder="Type your message here">
      </div>
      
      
      <div>
        <input type="submit" name="upload" value="upload">

      </div>
     </form>
    </center>
</body>
</html>z