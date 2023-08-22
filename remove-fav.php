<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $remove_query = "delete from favourite where id='$id'";
        $remove_result = mysqli_query($conn, $remove_query);
        if(!mysqli_errno($conn)){
           $_SESSION['remove-fav-success'] = "Item successfully removed!!";
        }
    }
    header('location: ' . ROOT_URL . 'fav.php');
    die();
?>