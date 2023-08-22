<?php

    require 'config/database.php';

    if(isset($_POST['submit'])){
        $uname = $_POST['uname'];
        $password = $_POST['password'];

        $query = "select * from users where uname='$uname'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==1){
            $details = mysqli_fetch_assoc($result);
            $db_password = $details['password'];
            if(password_verify($password, $db_password)){
                $_SESSION['user-id'] = $details['id'];

                if($details['is_admin']==1){
                    $_SESSION['user-admin'] = true;
                }

                $_SESSION['signin-success'] = "You are logged in !!";
                header('location: ' . ROOT_URL);
                die();
            }
            else{
                $_SESSION['signin'] = "Please Check Your Password !!";
            }
        }
        else{
            $_SESSION['signin'] = "Username doesn't exist !!";
        }

        if(isset($_SESSION['signin'])){
            $_SESSION['signin-data'] = $_POST;
            header('location: ' . ROOT_URL);
            die();
        }
    }
    header('location: ' . ROOT_URL);
    die();
?>