<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: keels.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM keels WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: keels.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    background: url('keelslog.jpg');
    background-size: 100%;

}

.container {
    height: 500px;
    width: 650px;
    box-shadow: 0px 30px 40px black;
    display: flex;
    border-radius: 10px;
}

.image {
    flex: 50%;
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('port.jpg');
    background-size: cover;
    text-align: center;
    color: white;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.image h1 {
    margin-top: 50%;
    padding-left: 20px;
    padding-right: 20px;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

span {
    color: chartreuse;
}

.content {
    flex: 50%;
    background-color: white;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
}

.content h1 {
    padding: 40px;
    padding-top: 30px;
    font-family: 'Niconne', cursive;
    font-size: 40px;
    color: #c446c9;
}

#txt {
    margin: 10px;
    padding: 5px;
    border: none;
    background-color: rgba(156, 77, 156, 0.3);
    border-radius: 10px;
    font-weight: bold;
    font-size: small;
    font-family: 'Montserrat', sans-serif;
    color: #aa38a4;
}

label {
    font-weight: bold;
    font-size: small;
}

#txt:focus {
    outline: none;
}

.fp {
    text-decoration: none;
    font-weight: bold;
    font-size: small;
    transition: 0.3s;
}

.fp:hover {
    color: #c446c9;
}

button {
    padding: 10px 40px;
    margin-top: 20px;
    border: none;
    background: linear-gradient(to right, #4568DC, #B06AB3);
    border-radius: 20px;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.2);
}

button a {
    text-decoration: none;
    color: white;
}
.form-control{
width:90%; 
}
    </style>
</head>
<body>
    <div class="wrapper">
       
        <p style="color: white">Please fill in your credentials to login.</p>
        <div class="container">
        <div class="image">
            <h1>Welcome To <span>Green Fields</span></h1>
        </div>
        <div class="content">
            <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" id="txt" aria-describedby="helpId" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="txt" aria-describedby="helpId">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
          
        </form>
    </div>   
</body>
</html>