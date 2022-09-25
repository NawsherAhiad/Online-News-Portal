<?php
session_start();
include("connection.php");
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$comment_id = $_GET['comment_id'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $comment_details = $_POST['comment_details'];

    $comment_details = mysqli_real_escape_string($conn, $comment_details);

    $sql = "update comments set comment_details= '$comment_details' where comment_id= '$comment_id'";
    
            if(mysqli_query($conn, $sql)) 
            {
                header("Location: {$_REQUEST["destination"]}");
            }
            else{
                echo "Comment edit failed.";
            }
    
}


?>

<html>
    <head>
    <title>Edit Comments</title>
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
            <h1>Edit Comment</h1>
        </div>
        <div class="card-body">
        <form method="post">
        <?php
        $sql = "select * from comments where comment_id = '$comment_id'";
        $result = mysqli_query($conn, $sql);
   
                if(mysqli_num_rows($result) > 0)
                {
                    while($rows = mysqli_fetch_assoc($result))
                    {
                        ?>

                        <div class="row">
                            <div class="col">      
                        <label for="comment_id">Comment ID</label>
                        <input type="text" id="comment_id" name="comment_id" class="form-control" value="<?php echo $rows['comment_id']; ?>" readonly required>
                        </div>
                    </div><br>

                            <div class="row">
                            <div class="col">    
                        <label for="comment_details">Comment</label>
                        <input type="text" id="comment_details" name="comment_details" class="form-control" value="<?php echo $rows['comment_details']; ?>" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Please fill out this field</div>
                        </div>
                            </div>
                            <br>  
                        <br>
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