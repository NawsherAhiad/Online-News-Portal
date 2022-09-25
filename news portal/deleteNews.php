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

$news_id = $_GET['news_id'];

$sql1 = "delete from image where news_news_id= '$news_id'";
$sql2 = "delete from comments where news_news_id= '$news_id'";

    if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) 
    {
        $sql = "delete from news where news_id= '$news_id'";
                
            if(mysqli_query($conn, $sql)) 
            {
                header("Location: showAllNews.php");
            }
            else{
                $error = "Delete Failed";
            }
                    
                    
    }
    else{
        $error = "Delete Failed";
    }
    
?>


