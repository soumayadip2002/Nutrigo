<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from blogs where id='$id'";
        $result = mysqli_query($conn, $query);
        $blogs = mysqli_fetch_assoc($result);
        $image = $blogs['image'];
        $image_path = '../upload/' . $image;
        if($image_path){
            unlink($image_path);
        }


        $delete_query = "delete from blogs where id='$id'";
        $delete_result = mysqli_query($conn, $delete_query);
        if(!mysqli_errno($conn)){
            $_SESSION['delete-blogs-success'] = "Blog Deleted successfully !!";
        }
        else{
            $_SESSION['delete-blogs'] = "Failed to delete Blog !!";
        }
    }

    header('location: ' . ROOT_URL . 'admin/manage_blog.php');
    die();

?>