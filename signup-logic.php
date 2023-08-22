<?php
    require 'config/database.php';

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['cpassword'];
        $avatar = $_FILES['avatar'];


        if(strlen($password) < 8 && strlen($confirm_password)<8){
            $_SESSION['signup'] = "password length sould be greater than 8";
        }
        else{
            if($password !== $confirm_password){
                $_SESSION['signup'] = "password should be match";
            }
            else{
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $user_query = "select * from users where uname='$uname'";
                $user_result = mysqli_query($conn, $user_query);

                if(mysqli_num_rows($user_result)==1){
                    $_SESSION['signup'] = "username already exist";
                }
                else{
                    $avatar_name = $avatar['name'];
                    $avatar_temp = $avatar['tmp_name'];
                    $avatar_destination = 'upload/' . $avatar_name;
                    $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                    $extension = explode('.', $avatar_name);
                    $extension = end($extension);

                    if(in_array($extension, $allowed_files)){
                       move_uploaded_file($avatar_temp, $avatar_destination);
                    }
                    else{
                        $_SESSION['signup'] = "file should be in png, jpg, jpeg, webp format";
                    }
                }
            }
            
        }

        if(isset($_SESSION['signup'])){
            $_SESSION['signup-data'] = $_POST;
            header('location: ' . ROOT_URL . 'signup.php');
            die();
        }
        else{
            $insert_query = "insert into users (fname, lname, uname, email, password, avatar, is_admin) values ('$fname', '$lname', '$uname', '$email', '$hashed_password', '$avatar_name', 0)";
            $insert_result = mysqli_query($conn, $insert_query);

            if(!mysqli_errno($conn)){
                $_SESSION['signup-success'] = "Registration Successful !!";
                header('location: ' . ROOT_URL . 'index.php');
                die();
            }
        }
    }

    else{
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    }
?>