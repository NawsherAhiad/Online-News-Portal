<?php
session_start();
include("connection.php");
include("function.php");

$news_id = $_GET['news_id'];

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $user_id = $_POST['user_id'];
    $comment_details = $_POST['comment_details'];
    $comment_id = "c_".random_number(3);
    $comment_details = mysqli_real_escape_string($conn, $comment_details);

    $sql = "insert into comments (comment_id, comment_details, user_user_id, news_news_id) values ('$comment_id', '$comment_details', '$user_id', '$news_id')";
        
            if(mysqli_query($conn, $sql))
            {
                header("Location: showNews.php?news_id=$news_id");
                
            }
            else{
                $error = "Comment failed";
            }
        
}

?>

<html>
    <head>
    <title>News</title>
        <link href="logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     
    <style>
pre {
    white-space: pre-wrap;
    font-family: Arial;
} 
</style>
    </head>
    <body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="card">
        <div class="card-body">
            <?php
                $sql = "select * from news,image where image.news_news_id= '$news_id' and news.news_id= '$news_id'";
                $result = mysqli_query($conn, $sql);
                 
                        if(mysqli_num_rows($result) > 0) 
                        {
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <h1><?php echo $rows['headline'];?></h1>
                                <h6>Category: <?php echo $rows['news_type'];?></h6>
                                <h6>Published: <?php echo $rows['timestamp'];?></h6><br>
                                <div class="img_container">
                                <img src="image/<?php echo $rows['image_title']; ?>" class="image" style="width: 50%; margin:auto; display:block">
                                </div>
                                
                                <pre>
                                    <?php echo $rows['details'];?>
                                </pre>
                                
                                
                                <?php
                            }
                        }
                    
                

            ?>

        </div>
        </div>
        <br>

        <div class="card">
        <div class="card-header">
                <h3>Comments</h3>
        </div>
        <br>
        
        <?php
            $sql = "select * from comments,users where comments.news_news_id= '$news_id' and comments.user_user_id=users.user_id order by comment_time";
            $result = mysqli_query($conn, $sql);
                 
            if(mysqli_num_rows($result) > 0)
                    {
                        while($rows = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <div class="card">
                                <h5><b><?php echo $rows['user_name']; ?></b> at <?php echo $rows['comment_time']; ?></h5>
                                <h6><i>"<?php echo $rows['comment_details']; ?>"</i></h6>
                                <?php
                                    
                                    if(isset($_SESSION['id']) && ($_SESSION['name'] == $rows['user_name']))
                                    {
                                        ?>
                                        <div class="row text-center">
                                            <div class="col">
                                            <a href="editComments.php?comment_id=<?php echo $rows['comment_id'];?>&destination=<?php echo $_SERVER["REQUEST_URI"]; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                                            </div>
                                            <div class="col">
                                            <a href="deleteComments.php?comment_id=<?php echo $rows['comment_id'];?>&destination=<?php echo $_SERVER["REQUEST_URI"]; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </div>

                                        </div>
                                        
                                        
                                    <?php
                                    }
                                ?>
                                </div>
                                <br>
                                <?php
                            }
                    }
                    else
                    {
                        ?>
                        <h4>No comments yet.</h4>
                        <?php
                    }
                
           
                    

            if(!isset($_SESSION['id']))
            {
                ?>
                <a href="login.php" class="btn btn-block btn-success">Please login to Comment</a>

            <?php
            }
            else
            {
                ?>
                    <div class="card" style="width: 60%; margin: auto;">
                        <h5 style="text-align: center;">Write a Comment</h5>
                        <form method="post" style="width: 90%; margin: auto">             
                        <input type="text" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>" class="form-control" hidden required>

                    <div class="row">
                        <div class="col">      
                        <textarea rows="2" name="comment_details" class="form-control" required></textarea>
                        </div>
                    </div><br>
                    <input type="submit" value="Comment" class="btn btn-block btn-success">
                        </form>
                        <br>
                    </div>
                <?php
            }

?>
<div class="card-footer">
<a href="index.php" class="btn btn-block btn-outline-primary">Back</a>
</div>
        </div>
    </div>

    </body>
</html>