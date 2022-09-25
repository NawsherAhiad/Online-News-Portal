<?php
session_start();
$error = "";
include("connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $user_email = $_POST['user_email'];
    $sql = "select * from users where user_email = '$user_email' limit 1";
    $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) 
            {
                $new_password = trim(hash('sha1', $_POST['new_password']));
                $sql = "update users set user_password='$new_password' where user_email = '$user_email'";
                
                if(mysqli_query($conn, $sql))
                {
                    header("Location: login.php");
                }
                else{
                    $error="Password Recovery Failed";
                }
            }
            else
            {
                $error = "Register First!";
            }
        
    
}



?>

<html>
<head>
        <title>Forget Password</title>
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
        <h1>Forget Password</h1>
        </div>
<?php
        if($error != "")
        {
            echo "<span style:'color: red;'>".$error."</span><br>";
        } 
        ?>
    <div class="card-body">
        <form method="post">
            <div class="row">
            <div class="col">
            <label for="user_email">Enter Email:</label>
            <input id="user_email" type="email" class="form-control" name="user_email" required>
            </div>
            </div>
            <br>

            <div class="row">
            <div class="col">
            <label for="new_password">Enter New Password:</label>
            <input id="new_password" type="password" class="form-control" name="new_password" required onchange="form.confirm_password.pattern=this.value">
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
			<input type="submit" class="btn btn-block btn-outline-success" value="Submit">
            </div>
            </div>
    </div>       
        </form>
    </div>
    </div>

    <script>
function showPassFunction() {
  var x = document.getElementById("new_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    </body>
</html>