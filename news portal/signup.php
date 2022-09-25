<?php

$error = "";

include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $user_id = "u_".random_number(3);
    $rank = "User";
    $user_name  = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $password = hash('sha1', $_POST['password']); 
     
    
	    $sql = "insert into users (user_id,user_position,user_name,user_email,user_password) values ('$user_id', '$rank', '$user_name', '$user_email', '$password')";
        if (mysqli_query($conn, $sql))
        {
            header("Location: login.php"); 
            die;  
        }
        else{
            $error = "Register Failed";
        }
    

}

?>



<html>
<head>
        <title>Register</title>
        <link href="logo.png" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
    </head>
    <body>

<?php include "header.php"; ?>
    <div class="card">
        <div class="card-header text-center">
        <h1>Register</h1>
        </div>
        <div class="card-body">
        <?php
        if($error != "")
        {
            echo $error;
        } 
        ?>
        <form method="post">
        <div class="row">
        <div class="col">
            <label for="user_name">Name </label>
            <input id="user_name" type="text" name="user_name" class="form-control" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col">
            <label for="user_email">Email </label>
            <input id="user_email" type="email" name="user_email" class="form-control" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col">
            <label for="password">Password </label>
            <input id="password" type="password" name="password" class="form-control" required onchange="form.confirm_password.pattern=this.value">
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
            <label for="confirm_password">Confirm Password </label>
            <input id="confirm_password" type="password" name="confirm_password" class="form-control" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col">
            <input type="submit" value="Signup" class="btn btn-block btn-outline-danger">
        </div>
        </div>
            </form>
            <div class="card-footer">
            <a href="login.php" class="btn btn-block btn-success">Click to Login</a>
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

</html>