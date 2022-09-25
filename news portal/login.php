<?php

$error = "";
include("connection.php");


if($_SERVER['REQUEST_METHOD'] == "POST") 
{    
    $user_email = $_POST['user_email'];
    $password = hash('sha1', $_POST['password']); 

    $user_email = stripslashes($user_email);
    $password = stripslashes($password);

    $user_email = mysqli_real_escape_string($conn, $user_email);
    $password = mysqli_real_escape_string($conn, $password);

	$sql = "select * from users where user_email = '$user_email' && user_password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
  
                if($count==1)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                    session_start();
                    $_SESSION['id'] = $row["user_id"];
                    $_SESSION['name'] = $row["user_name"];
                    $_SESSION['email'] = $row["user_email"];
                    $_SESSION['rank'] = $row["user_position"];
                    }
                }
                else{
                    $error = "Wrong Email or Password!";
                }
            

            if($error == "") 
            {
                header("Location: index.php");  
                die; 
            }
}

?>


<html>
<head>
        <title>Login</title>
        <link href="logo.png" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
    </head>
    <body>

<?php include "header.php" ?>
<div class="containter">
    <div class="card">
        <div class="card-header text-center">
        <h1>LOGIN</h1>
        </div>
<?php
        if($error != "")
        {
            echo $error;
        } 
        ?>
    <div class="card-body">
        <form method="post">

            <div class="row">
            <div class="col">
            <label for="user_email">Enter Email:</label>
            <input id="user_email" type="email" class="form-control" name="user_email" placeholder="Enter Email" required>
			</div>
            </div>
            <br>
            <div class="row">
            <div class="col">
            <label for="password">Enter Password:</label>
            <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>
            </div>
            <br>
            <div class="row form-check">
                <div class="col">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showPassFunction()">Show Password
            </label>
                </div>
            </div>
            <br>
            <div class="row">
            <div class="col">
			<input type="submit" class="btn btn-block btn-outline-success" value="Login">
            </div>
            </div>
    </div>       
        </form>
        <div class="card-footer">
        <a href="signup.php" class="btn btn-block btn-outline-primary">Click to Signup</a>
        <a href="forgetPassword.php" class="btn btn-block btn-outline-danger">Forgot Password?</a>
        </div>
        
    </div>
    </div>

    <script>
function showPassFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    </body>
</html>