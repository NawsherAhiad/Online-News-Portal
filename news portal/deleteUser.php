<?php
session_start();
include("connection.php");
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

    $user_id = $_GET['user_id'];
    $sql = "delete from comments where user_user_id= '$user_id'";
       
            if(mysqli_query($conn, $sql))
            {
                $sql = "delete from users where user_id= '$user_id'";           
                            if(mysqli_query($conn, $sql)) 
                            {
                                if($_SESSION['rank'] == "Admin")
                                {
                                    header("Location: showAllUsers.php");
                                }
                                else
                                {
                                    //log out of the system
                                    session_destroy();
                                    header("Location: index.php");
                                }
                                
                            }
                    
                    
            }
    


?>

