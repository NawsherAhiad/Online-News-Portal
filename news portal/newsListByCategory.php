<?php
session_start();
include("connection.php");

$news_type = $_GET['news_type'];

?>


<html>
    <head>
        <title><?php echo $news_type;?></title>
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
            <h1>Recent News</h1><br>
        <?php
        $sql = "select * from news,image where image.news_news_id=news.news_id and news_type= '$news_type' order by timestamp desc";
        $result = mysqli_query($conn, $sql);
          
                if(mysqli_num_rows($result) > 0)
                {
                    while($rows = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <div class="card">
                            <div class="card-body">  
                                <img src="image/<?php echo $rows['image_title']; ?>" class="image" style="width: 100%; margin:auto; display: block">
                                <h3><b><?php echo $rows['headline'];?></b></h3>
                                <h4>Category: <?php echo $rows['news_type']; ?></h4>
                                <p><?php echo substr($rows['details'], 0, 100); ?>...
                                <a href="showNews.php?news_id=<?php echo $rows['news_id'];?>"> See Details</a></p>
                            </div>

                        </div>
                        
                    <?php
                    }
                }
                else
                {
                    ?>
                        <h3 class="text-center">No <?php echo $news_type;?> news</h3>
                    <?php
                }
?>
        </div>
        
    </body>
    
</html>