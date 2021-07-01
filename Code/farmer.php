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
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <style type="text/css">

        body{ 
          margin:0;
    padding:0;
    background:url(famer.jpg);
    background-size: 100%;


    font-family: sans-serif;

}
.h2{
    margin: o;
    padding: 0 0 20px;
    text-align: center;
    font-size:60px; 
}
.loginbox p{
    margin: 0;
    padding: 0;
    font-weight: bold;

}
.loginbox{
    width: 350px;
    height: 400px;
    color: #fff;
    box-sizing: border-box;
    align-items: center;
    text-align: center;
   position:relative
    left:100px;;

}
.user{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);

}
.part1 input{
    width: 250px;
    margin-bottom: 8px;
}


.part1 input[type="submit"]{
    border:none;
    outline: none;
    height: 40px;
    background: #fb2525;
    color: #fff;
    font-size:18px;
    border-radius: 20px;

}
.part1 input[type="submit"]:hover
{
    cursor: pointer;
    background: #FFC107;
    color: #000;

}

.part1 a{
    text-decoration: none;
    font-size: 20px;
    line-height: 20px;
    color: #f4efef;
}
.part1 a:hover
{
    color: #ffc107;
}

.web input[type="submit"]:hover
{
    
    background: #FFC107;
    color: #000;

}
.web input[type="submit"]{
    border:none;
    outline: none;
    height: 40px;
    background: #c90a0a;
    color: #fff;
    font-size:18px;
    border-radius: 20px;
}
.web1 input[type="submit"]:hover
{
    cursor: pointer;
    background: #FFC107;
    color: #000;

}
.web1 input[type="submit"]{
    border:none;
    outline: none;
    height: 40px;
    background: #0d58db;
    color: #fff;
    font-size:18px;
    border-radius: 20px;

}
.web2 input[type="submit"]:hover
{
    cursor: pointer;
    background: #a51c50;
    color: #000;

}
.web2 input[type="submit"]{
    border:02;
     top: 80%;
    left: 50%;
    position: absolute;
    outline: 02;
    height: 45px;
    background:#a51c50;
    color: #fff;
    font-size:19px;
    border-radius: 21px;

}
.web3 input[type="submit"]:hover
{
   
    background: #a51c50;
    color: #000;

}
.web3 input[type="submit"]{
    border:02;
    outline: 10;
    height: 45px;
    background:#a51c50;
    color: #fff;
    font-size:19px;
    border-radius: 21px;



}
.part1{
position: fixed;
  top: 30%;
  left: 47%;
  margin-top: -50px;
  margin-left: -100px;
  align-items: center: 

}
.map{

 
  left: 50%;

 
}
.logout{

  position: absolute;
  width: 50%;
  bottom: 10px;
  left:25%;
  
 
}

    </style>
</head>
<body>
<h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h3>

     <div class="part1">

        <h2>Welcome</h2>
        <br>
                <a href="user-map.php"><input type="submit" class="button_active" value="view map"></a>
                               <br>
                <a href="viewuser.php"><input type="submit" class="button_active" value="update/delete reports"></a><br>
                <a href="viewmessages.php"><input type="submit" class="button_active" value="view messages from keels"></a>
                <br>
                <a href="viewsentmessages.php"><input type="submit" class="button_active" value="view sent messages"></a>
                
                
                
                <br>
                <br>

            

     </div>
          
        <div class="map">
        

        </div>

<div class="logout">
        <a href="logout.php"><input type="submit" class="btn btn-warning" value="logout"></a>

        </div>  
    </div>
</div>


</body>
</html>