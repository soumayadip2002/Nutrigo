<?php
    require 'config/database.php';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $offer = $_POST['offer'];
        $thumbnail = $_FILES['picture'];

        $query = "select * from category where name='$name'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)){
            $_SESSION['add-category'] = "category $name already exist !!";
        }

        else{
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
                $_SESSION['add-category'] = "file should be in png, jpg, jpeg, webp format !!";
            }
        }

        if(isset($_SESSION['add-category'])){
            $_SESSION['add-category-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add_category.php');
            die();
        }
        else{
            $insert_query = "insert into category (name, offer, image) values ('$name','$offer','$thumbnail_name')";
            $insert_result = mysqli_query($conn, $insert_query);

            if(!mysqli_errno($conn)){
                $_SESSION['add-category-success'] = "category $name added successfully !!";
                header('location: ' . ROOT_URL . 'admin/manage_category.php');
                die();
            }
        }
    }
    else{
        header('location: ' . ROOT_URL . 'admin/add_category.php');
        die();
    }
?>