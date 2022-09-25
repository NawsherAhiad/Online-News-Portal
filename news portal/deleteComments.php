<?php
session_start();
include("connection.php");
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$comment_id = $_GET['comment_id'];


$sql = "delete from comments where comment_id= '$comment_id'";
   
            if(mysqli_query($conn, $sql)) 
            {
                
                header("Location: {$_REQUEST["destination"]}");
     
            }
            else
            {
                echo "Deleting comment Failed.";
            }
    



?>
