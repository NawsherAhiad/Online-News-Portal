<?php
session_start();
include("connection.php");
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }
if (isset($_SESSION['id']) && $_SESSION['rank'] != "Admin")
{
    header("Location: index.php");
    die;
} 
?>

<html>
    <head>
        <title>Admin</title>
        <link href="logo.png" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>   
        </head>
    <body>
    <?php include "header.php"; ?>


<div class="container">
<h1 style="text-align: center;"><?php echo "Hello ".$_SESSION['name']; ?></h1><br>
    <div class="row">
        <div class="col-sm">
        <div class="card">
                <img src="news.png" class="card-img-top" alt="News">
                <div class="card-body text-center">
                  <h5 class="card-title ">Total News</h5>
                  <p class="card-text ">
                    <?php
                        $sql = "select count(*) as count_news from news";
                        $result=mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($rows= mysqli_fetch_assoc($result))
                                {
                                    echo $rows['count_news'];
                                }
                            }      
                        
                    ?>
                  </p>
                  <a href="showAllNews.php" class="btn btn-primary">View</a>
                  
                </div>
              </div>
        </div>
        <div class="col-sm">
        
        <div class="card">
                <img src="user.png" class="card-img-top" alt="User">
                <div class="card-body text-center">
                  <h5 class="card-title">Total Users</h5>
                  <p class="card-text">
                  <?php
                        $sql = "select count(*) as count_user from users";
                        $result=mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($rows= mysqli_fetch_assoc($result))
                                {
                                    echo $rows['count_user'];
                                }
                            }
                    ?>
                  </p>
                  <a href="showAllUsers.php" class="btn btn-primary">View</a>
                </div>
              </div>
              
        </div>
        <div class="col-sm">
        
        <div class="card">
                <img src="comment.png" class="card-img-top" alt="Comments">
                <div class="card-body text-center">
                  <h5 class="card-title">Total Comments</h5>
                  <p class="card-text">
                  <?php
                        $sql = "select count(*) as count_comments from comments";
                        $result=mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($rows= mysqli_fetch_assoc($result))
                                {
                                    echo $rows['count_comments'];
                                }
                            }
                    ?>
                  </p>
                  <a href="showAllComments.php" class="btn btn-primary">View</a>
                </div>
              </div>
              
        </div>

        <div class="col-sm">
        <div class="card">
                <img src="settings.png" class="card-img-top" alt="Comments">
                <div class="card-body text-center">
                  <h5 class="card-title">Account Settings</h5>
                  <p class="card-text">
                        <?php
                            echo $_SESSION['name'];
                        ?>
                  </p>
                  <a href="accountSettings.php" class="btn btn-primary">Go</a>
                </div>
              </div>
              
        </div>
    </div>
</div>
                    
    </body>
</html>