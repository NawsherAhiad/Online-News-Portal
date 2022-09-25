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
    <title>All Users</title>
    <link href="logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <body>
    <?php include "header.php"; 
        $sql = "select * from users";
        $result = mysqli_query($conn, $sql);
     
                if(mysqli_num_rows($result) > 0)
                {

                ?>
                <div class="card">
                <div class="card-header text-center">
                    <h1>All Users</h1>
                 </div>
                 <div class="card-body">
                 <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                ?>
                                    <tr>
                                        <td> <?php echo $rows['user_name']; ?></td>
                                        <td> <?php echo $rows['user_email']; ?></td>
                                        <td> <?php echo $rows['user_position']; ?></td>
                                        <td><a href="editUsers.php?user_id=<?php echo $rows['user_id'];?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a></td>
                                        <td><a href="deleteUser.php?user_id=<?php echo $rows['user_id'];?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    
                <?php
                }
                else
                        {
                            ?>
                            <h1>There are no Users available right now</h1>
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