<?php
session_start();
include("connection.php");

if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }


$user_id = $_GET['user_id'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];

    $user_name = mysqli_real_escape_string($conn, $user_name);
    $user_email = mysqli_real_escape_string($conn, $user_email);

    if(empty($_POST['user_position']))
    {
        $sql = "update users set user_name= '$user_name', user_email= '$user_email' where user_id= '$user_id'";
    }
    else{
        $user_position = $_POST['user_position'];
        $sql = "update users set user_name= '$user_name', user_email= '$user_email', user_position= '$user_position' where user_id= '$user_id'";
    }
       
            if(mysqli_query($conn, $sql)) 
            {
                if($_SESSION['rank'] == "Admin")
                {
                    header("Location: showAllUsers.php");
                }
                else
                {
                    $_SESSION['id'] = $user_id;
                    $_SESSION['name'] = $user_name;
                    $_SESSION['email'] = $user_email;
                    header("Location: accountSettings.php");
                }
                
            }
    
}

?>

<html>
    <head>
    <title>Edit Info</title>
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
            <h1>Edit Info</h1>
        </div>
        <div class="card-body">
        <form method="post">
        <?php
        $sql = "select * from users where user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
             if(mysqli_num_rows($result) > 0)
                {
                    while($rows = mysqli_fetch_assoc($result))
                    {
                        ?>

                        <div class="row">
                            <div class="col">      
                        <label for="user_id">User ID</label>
                        <input type="text" id="user_id" name="user_id" class="form-control" value="<?php echo $rows['user_id']; ?>" readonly required>
                        </div>
                    </div><br>

                            <div class="row">
                            <div class="col">    
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $rows['user_name']; ?>" required>
                        </div>
                            </div>
                            <br>

                            <div class="row">
                        <div class="col">    
                    <label for="user_email">Email</label>
                    <input type="text" id="user_email" name="user_email" class="form-control" value="<?php echo $rows['user_email']; ?>" required>
                    </div>
                        </div>
                        <br>
                <?php 
                if (isset($_SESSION['id']) && $_SESSION['rank'] == "Admin") 
                    {
                        ?>
                    <div class="row">
                        <div class="col">
                        <label for="user_position">Position</label>
                        <select class="form-control" name="user_position" id="user_position" required>
                            <option><?php echo $rows['user_position']; ?></option>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                        </div>
                        <br>
                        <?php
                    } 
                    ?>  
                        <br><br><br>
                        <input type="submit" value="Submit" class="btn btn-block btn-outline-success">
                        <?php
                    }
                }
            
        
        ?>
        </div>
        </form>
    </div>
    </div>
    </body>
</html>