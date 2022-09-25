<?php
session_start();
include("connection.php");
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

?>

<html>
<head>
        <title>Account Settings</title>
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
    <div class="card-header">
        <h1>Personal Information</h1>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tbody>
            <tr>
                <td style="width: 30%;">
                    Name
                </td>
                <td>
                    <?php
                        echo $_SESSION['name'];
                        ?>
                </td>
            </tr>

            <tr>
                <td style="width: 30%;">
                    Email
                </td>
                <td>
                    <?php
                        echo $_SESSION['email'];
                        ?>
                </td>
            </tr>

            <tr>
                <td style="width: 30%;">
                    Position
                </td>
                <td>
                    <?php
                        echo $_SESSION['rank'];
                        ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    
                    <a href="editUsers.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block btn-success"><i class="fas fa-edit"></i> Edit</a>
                       
                </td>
            </tr>
            </tbody>
            
        </table>
    </div>
    </div>
<br> <br>
    <div class="card">
    <div class="card-header">
        <h1>Security</h1>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <tbody>
            
            <tr>
                <td>
                    
                <a href="editPassword.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block btn-primary"><i class="fas fa-edit"></i> Change Password</a>
                       
                </td>
            </tr>
            <tr>
                <td>       
                <a href="forgetPassword.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block btn-primary"><i class="fas fa-edit"></i> Forgot Password?</a>      
                </td>
            </tr>
            <tr>
                <td> 
                <a href="deleteUser.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block btn-danger"><i class="fas fa-trash"></i> Delete Account</a>            
                </td>
            </tr>
            </tbody>
            
        </table>
    </div>
    </div>
    <br><br>



</body>

</html>