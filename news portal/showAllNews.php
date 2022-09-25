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
    <title>All News</title>
        <link href="logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    </head>
    <body>
    <?php include "header.php"; ?>
    <br>
    <div class="container-sm">
    <a href="addNews.php" class="btn btn-block btn-outline-success"><i class="fas fa-plus"></i> Add News</a>
    </div>
    <br>
    
    <?php
        $sql = "select * from news order by timestamp desc";
        $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0)
                {

                ?>
                <div class="card text-center">
                <div class="card-header">
                    <h1>All News</h1>
                 </div>
                 <div class="card-body">
                 <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th>Category</th>
                        <th>Headline</th>
                        <th>Date & Time</th>
                        <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                ?>
                                    <tr>
                                        <td> <?php echo $rows['news_type']; ?></td>
                                        <td> <?php echo $rows['headline']; ?></td>
                                        <td> <?php echo $rows['timestamp']; ?></td>
                                        <td><a href="showNews.php?news_id=<?php echo $rows['news_id'];?>" class="btn btn-primary"><i class="fas fa-info-circle"></i> Details</a></td>
                                        <td><a href="editNews.php?news_id=<?php echo $rows['news_id'];?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a></td>
                                        <td><a href="deleteNews.php?news_id=<?php echo $rows['news_id']; ?>" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete</td>
                                        
                                    </tr>
                                <?php
                            }
                        ?>
                    
                <?php
                }
                else
                        {
                            ?>
                            <h1>There are no news available right now</h1>
                            <?php
                        }
            

        

?>
</tbody>
                 </table>
                 </div>

                 <div class="card-footer">
                 <a href="admin.php" class="btn btn-block btn-outline-primary" >Back</a>
                 </div>
                </div>


                
                
    </body>
</html>