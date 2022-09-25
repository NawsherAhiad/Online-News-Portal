<?php
session_start();
include("connection.php");

if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$error = "";

$user_id = $_GET['user_id'];
if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $old_password = trim(hash('sha1', $_POST['old_password']));
    $sql = "select user_password from users where user_id = '$user_id' && user_password = '$old_password'";
    $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0) //password exists
                {
                    $new_password = trim(hash('sha1', $_POST['new_password']));
                    if($old_password == $new_password)
                    {
                        $error = "New Password Can't be the same as the Old Password!";
                    }
                    else{
                        $sql = "update users set user_password= '$new_password' where user_id = '$user_id'";
         
                            if(mysqli_query($conn, $sql))
                            {
                                $error="Password Changed!";
                                
                            }
                            else
                            {
                                $error="Password cannot be updated";
                            }
                        
                    }
                }
                else{
                    $error="Wrong Password!";
                }
        
    
    
}

?>

<html>
<head>
        <title>Change Password</title>
        <link href="logo.png" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
    </head>
    <body>
    <?php include "header.php"; ?>
    <?php
        if($error != "")
        {
            echo $error;
        } 
        ?>
    <div class="card">
    <div class="card-header text-center">
            <h1>Change Password</h1>
        </div>
        <div class="card-body">
        <form method="post">

            <div class="row">
                <div class="col">    
                    <label for="old_password">Previous Password</label>
                    <input type="password" id="old_password" name="old_password" class="form-control" required>

                </div>
            </div>
            

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
                    <label for="new_password">New Passowrd</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required required onchange="form.confirm_password.pattern=this.value">
                </div>
            </div>
            

            <div class="row form-check">
            <div class="col">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showNewPassFunction()">Show Password
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
            <div class="row form-check">
            <div class="col">
            <input type="submit" value="Submit" class="btn btn-block btn-outline-success">
            </div>
            </div>
            </form>
        </div>
        
    </div>
    </div>

    <script>
        function showPassFunction() {
  var x = document.getElementById("old_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showNewPassFunction() {
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