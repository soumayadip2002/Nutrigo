<?php
    require 'config/database.php';

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $pre_img = $_POST['pre_img'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $measurment = $_POST['measurment'];
        $category = $_POST['category'];
        $nutrients = $_POST['nutrients'];
        $is_today = isset($_POST['is_today'])?1:0;
        $offer = isset($_POST['off'])?$_POST['off']:0;
        $thumbnail = $_FILES['thumbnail'];

        if($thumbnail['name']){
            $pre_img_path = '../upload/' . $pre_img;
            if($pre_img_path){
                unlink($pre_img_path);
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
                $_SESSION['edit-items'] = "File should be in png, jpg, jpeg, webp format !!";
            }
        }

        if(isset($_SESSION['edit-items'])){
            header('location: ' . ROOT_URL . 'admin/edit_items.php');
            die();
        }
        else{
            $pic_to_insert = $thumbnail_name ?? $pre_img;
            $update_query = "update products set name='$name', price='$price', quantity='$quantity', measurement='$measurment', category='$category', 
            nutrients='$nutrients', todays_offer='$is_today',offer='$offer',image='$pic_to_insert' where id='$id' limit 1";
            $update_result = mysqli_query($conn, $update_query);

            if(!mysqli_errno($conn)){
                $_SESSION['edit-items-success'] = "$name updated successfully !!";
            }
            else{
                $_SESSION['edit-items'] = "failed to update $name !!";
            }
        }
    }

    header('location: ' . ROOT_URL . 'admin/');
    die();
?>