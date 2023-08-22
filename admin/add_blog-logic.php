<?php
    require 'config/database.php';

    if(isset($_POST['submit']) && isset($_SESSION['user-id'])){
        $author_id = $_SESSION['user-id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $thumbnail = $_FILES['picture'];

        if(!$content)
            $_SESSION['add-blogs'] = "please add content !!";
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
            $_SESSION['add-blogs'] = "File should be in png, jpg, jpeg, webp format !!";
        }

        if(isset($_SESSION['add-blogs'])){
            $_SESSION['add-blogs-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add_blog.php');
            die();
        }
        else{
            $insert_query = "INSERT INTO blogs (author_id, name, body, image) VALUES (?, ?, ?, ?)";
            $insert_statement = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_statement, "isss", $author_id, $title, $content, $thumbnail_name);
            $insert_result = mysqli_stmt_execute($insert_statement);
            mysqli_stmt_close($insert_statement);

            if(!mysqli_errno($conn)){
                $_SESSION['add-blogs-success'] = "Blog added successfully !!";
                header('location: ' . ROOT_URL . 'admin/manage_blog.php');
                die();
            }
        }
    }
    else{
        header('location: ' . ROOT_URL . 'admin/add_blog.php');
        die();
    }

?>