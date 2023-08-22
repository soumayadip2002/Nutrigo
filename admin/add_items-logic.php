<?php
    require 'config/database.php';
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $measurment = $_POST['measurment'];
        $category = $_POST['category'];
        $nutrients = $_POST['nutrients'];
        $is_today = isset($_POST['is_today'])?1:0;
        $offer = isset($_POST['off'])?$_POST['off']:0;
        $thumbnail = $_FILES['thumbnail'];

        $query = "select * from products where name='$name'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['add-items'] = "$name already exist !!";
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
                $_SESSION['add-items'] = "File should be in png, jpg, jpeg, webp format !!";
            }
        }
        if(isset($_SESSION['add-items'])){
            $_SESSION['add-items-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add_items.php');
            die();
        }
        else{
            $insert_query = "insert into products (name, price, quantity, measurement, category, nutrients, todays_offer, offer, image) 
            values ('$name', '$price', '$quantity', '$measurment', '$category', '$nutrients', '$is_today', '$offer', '$thumbnail_name')";
            $insert_result = mysqli_query($conn, $insert_query);

            if(!mysqli_errno($conn)){
                $_SESSION['add-items-success'] = "$name added successfully !!";
                header('location: ' . ROOT_URL . 'admin/index.php');
                die();
            }

        }
    }
    else{
        header('location: ' . ROOT_URL . 'admin/add_items.php');
        die();
    }

?>