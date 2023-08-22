<?php
    require 'config/database.php';
    if(isset($_GET['id']) && isset($_SESSION['user-id'])){
        $id = $_GET['id'];
        $user_id = $_SESSION['user-id'];

        $query = "select * from products where id='$id'";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_assoc($result);
        $name = $products['name'];
        $offer = $products['offer'];
        $price = $products['price'];
        $price = $offer<0?$price:($price-(($price*$offer)/100));
        $image = $products['image'];
        $quantity = $products['quantity'];
        $measurement = $products['measurement'];

        $find_query = "select * from favourite where user_id='$user_id' && product_id='$id'";
        $find_result = mysqli_query($conn, $find_query);
        if(mysqli_num_rows($find_result)==1){
            $_SESSION['add-fav'] = "$name already exist in favourite!!";
        }
        else{
            $insert_query = "insert into favourite (user_id, product_id, name, price, quantity, measurement, image) values ('$user_id','$id', '$name','$price', '$quantity','$measurement','$image')";
            $insert_result = mysqli_query($conn, $insert_query);
            if(!mysqli_errno($conn)){
                $_SESSION['add-fav-success'] = "$name added to favourite !!";
            }
            else{
                $_SESSION['add-fav'] = "failed to  add $name in favourite !!";
            }
        }
        $source_page = ROOT_URL;
        if(isset($_SERVER['HTTP_REFERER'])){
            $refer = $_SERVER['HTTP_REFERER'];

            if(strpos($refer, "top_selling.php")!==false){
                $source_page= ROOT_URL . "top_selling.php";
            }
            elseif(strpos($refer, "products.php")!==false){
                $source_page=ROOT_URL . "products.php";
            }
            elseif(strpos($refer, "/")!==false){
                $source_page =  ROOT_URL;
            }
        }
    }

    header('location: ' . $source_page);
    die();



?>