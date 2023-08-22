<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $query = "select * from users where id='$id'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)==1){
            $users = mysqli_fetch_assoc($result);
            $avatar = $users['avatar'];
            $avatar_path = '../upload/' . $avatar;
            if($avatar_path){
                unlink($avatar_path);
            }

            $fname = $users['fname'];
            $lname = $users['lname'];
        }

        $delete_query = "delete from users where id='$id'";
        $delete_result = mysqli_query($conn, $delete_query);
        if(!mysqli_errno($conn)){
            $_SESSION['delete-user-success'] = "user $fname $lname deleted successfully !!";
        }
        else{
            $_SESSION['delete-user'] = "user $fname $lname couldn't delete !!";
        }
    }

    header('location: ' . ROOT_URL . 'admin/manage_user.php');
    die();
?>