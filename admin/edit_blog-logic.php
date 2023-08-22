<?php
    require 'config/database.php';
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $pre_img = $_POST['pre_img'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $thumbnail = $_FILES['picture'];

        if(!$content)
            $_SESSION['add-blogs'] = "please add content !!";
        if($thumbnail['name']){
            $thumbnail_path = '../upload/' . $pre_img;
            if($thumbnail_path){
                unlink($thumbnail_path);
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
                $_SESSION['edit-blogs'] = "File should be in png, jpg, jpeg, webp format !!";
            }
        }
        if(isset($_SESSION['edit-blogs'])){
            header('location: ' . ROOT_URL . 'admin/edit_blog.php');
            die();
        }
        else{
            $pic_to_insert = $thumbnail_name ?? $pre_img;

            $update_query = "update blogs set name=?, body=?, image=? where id='$id' limit 1";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $pic_to_insert);
            $result_query = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if(!mysqli_errno($conn)){
                $_SESSION['edit-blogs-success'] = "blog updated successfully !!";
            }
            else{
                $_SESSION['edit-blogs'] = "blog couldn't update !!";
            }

        }
    }

    header('location: ' . ROOT_URL . 'admin/manage_blog.php');
    die();
?>