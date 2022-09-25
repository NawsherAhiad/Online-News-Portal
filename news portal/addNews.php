<?php
session_start();
include("connection.php");
include("function.php");
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
$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./image/" . $filename;
    $image_id = "i_".random_number(3);

    $news_id = "n_". random_number(3);
    $news_type = $_POST['news_type'];
    $headline = $_POST['headline'];
    $details = $_POST['details'];

    $news_type = mysqli_real_escape_string($conn, $news_type);
    $headline = mysqli_real_escape_string($conn, $headline);
    $details = mysqli_real_escape_string($conn, $details);

    $sql = "insert into news (news_id, news_type, headline, details) values ('$news_id', '$news_type', '$headline', '$details')";
    
    
            if(mysqli_query($conn, $sql))
            {
                if(!empty($filename))
                {
                    $sql = "insert into image (image_id,image_title,news_news_id) VALUES ('$image_id', '$filename', '$news_id')";
                    
                    
                        if(mysqli_query($conn, $sql)) //no error
                            {
                                if (move_uploaded_file($tempname, $folder)) {
                                    echo "<h3>  Image uploaded successfully!</h3>";
                                    header("Location: showAllNews.php");
                                    
                                } else {
                                    echo "<h3>  Failed to upload!</h3>";
                                }
                            }
                    
                }
                else
                {
                    header("Location: showAllNews.php");
                }
                
            }
    
}


?>

<html>
    <head>
    <title>Add News</title>
        <link href="logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        
    </style>
    </head>

    <body>
    <?php include "header.php"; ?>
    <div class="card" >
        <div class="card-header text-center">
            <h1>Add News</h1>
        </div>
        <div class="card-body">
        <form method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col">
        <label for="news_type">News Category *</label>
        <select class="form-control" name="news_type" id="news_type" required>
                    <option disabled selected>Choose One</option>
                    <option>National</option> 
                    <option>International</option>
                    <option>Sports</option>
                    <option>Entertainment</option>
                    <option>Lifestyle</option>
                </select>
                </div>
        </div>
        <br>

        <div class="row">
        <div class="col">    
    <label for="headline">News Headline *</label>
    <textarea rows="2" name="headline" class="form-control" required></textarea>
    </div>
        </div>
        <br>

        <div class="row">
        <div class="col">    
    <label for="details">News Details *</label>
    <textarea rows="5" name="details" class="form-control" required></textarea>
    </div>
        </div>
        <br>
        
        <div class="row">
        <div class="col">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control" type="file" name="image" id="formFile" value="" required>
        </div>
        </div>
        <br>
        <br>

        <input type="submit" value="Submit" class="btn btn-block btn-outline-success">
        </form>
        </div>
    </div>
    </body>
   
</html>