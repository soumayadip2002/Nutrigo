<?php
    require 'config/database.php';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $offer = $_POST['offer'];
        $id=$_POST['id'];
        $pre_image = $_POST['pre_image'];
        $thumbnail = $_FILES['picture'];


        if($thumbnail['name']){
            $pre_image_path = '../upload/' . $pre_image;
            if($pre_image_path){
                unlink($pre_image_path);
            }

            $thumbnail_name = $thumbnail['name'];
            $thumbnail_tmp = $thumbnail['tmp_name'];
            $thumbnail_destination = '../upload/' . $thumbnail_name;
            $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                move_uploaded_file($thumbnail_tmp, $thumbnail_destination);
            }
            else{
                $_SESSION['edit-category'] = "file should be in png, jpg, jpeg, webp format !!";
            }
        }

        if(isset($_SESSION['edit-category'])){
            header('location: ' . ROOT_URL . 'admin/edit_category.php');
            die();
        }
        else{
            $thumbnail_to_insert = $thumbnail_name ?? $pre_image;
            $update_query = "update category set name='$name', offer='$offer', image='$thumbnail_to_insert' where id='$id' limit 1";
            $update_result = mysqli_query($conn, $update_query);

            if(!mysqli_errno($conn)){
                $_SESSION['edit-category-success'] = "Successfully updated $name !!";
            }
            else{
                $_SESSION['edit-category'] = "Failed to updated $name !!";
            }
        }

    }

    header('location: ' . ROOT_URL . 'admin/manage_category.php');
    die();

?>