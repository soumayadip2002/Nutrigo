<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from products where id='$id'";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_assoc($result);
        $name = $products['name'];
        $image = $products['image'];
        $image_path = '../upload/' . $image;
        if($image_path){
            unlink($image_path);
        }

        $delete_query = "delete from products where id='$id'";
        $delete_result = mysqli_query($conn, $delete_query);
        if(!mysqli_errno($conn)){
            $_SESSION['delete-items-success'] = "$name deleted successfully !!";
        }
        else{
            $_SESSION['delete-items'] = "failed to delete $name !!";
        }
    }

    header('location: ' . ROOT_URL . 'admin/');
    die();
?>