<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from category where id-'$id'";
        $result = mysqli_query($conn, $query);
        $category = mysqli_fetch_assoc($result);
        $thumbnail_name = $category['image'];
        $thumbnail_path = '../upload/' . $thumbnail_name;
        $name = $category['name'];
        if($thumbnail_name){
            unlink($thumbnail_path);
        }
        $delete_query = "delete from category where id='$id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if(!mysqli_errno($conn)){
            $_SESSION['delete-category-success'] = "$name deleted successfully !!";
        }
        else{
            $_SESSION['delete-category'] = "failed to delete $name !!";
        }
    }

    header('location: ' . ROOT_URL . 'admin/manage_category.php');
    die();

?>