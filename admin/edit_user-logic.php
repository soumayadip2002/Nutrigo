<?php
    require 'config/database.php';
    
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $pre_avatar = $_POST['pre_avatar'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $user_role = $_POST['user_role'];
        $avatar = $_FILES['avatar'];

        if($avatar['name']){
            $previous_avtar_path = '../upload/' . $pre_avatar;

            if($previous_avtar_path){
                unlink($previous_avtar_path);
            }

            $avatar_name = $avatar['name'];
            $avatar_temp = $avatar['tmp_name'];
            $avatar_destination = '../upload/' . $avatar_name;
            $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = explode('.', $avatar_name);
            $extension = end($extension);

            if(in_array($extension, $allowed_files)){
                move_uploaded_file($avatar_temp, $avatar_destination);
            }
            else{
                $_SESSION['edit-user'] = "file should be in png, jpg, jpeg, webp format";
            }
        }

        if(isset($_SESSION['edit-user'])){
            header('location: ' . ROOT_URL . 'admin/manage_user.php');
            die();
        }
        else{
            $avatar_to_insert = $avatar_name ?? $pre_avatar;
            $update_query = "update users set fname='$fname', lname='$lname', email='$email', avatar='$avatar_to_insert', is_admin='$user_role' where id='$id' limit 1";
            $update_result = mysqli_query($conn, $update_query);

            if(!mysqli_errno($conn)){
                $_SESSION['edit-user-success'] = "user $fname $lname updated Successfully!!";
                header('location: ' . ROOT_URL . 'admin/manage_user.php');
                die();
            }
        }
    }

    else{
        header('location: ' . ROOT_URL . 'admin/manage_user.php');
        die();
    }

?>