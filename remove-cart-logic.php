<?php
    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "delete from cart where id='$id'";
        $result = mysqli_query($conn, $query);

        if(!mysqli_errno($conn)){
            $_SESSION['remove-cart-success'] = "Item removed successfully !!";
        }
    }

    header('location: ' . ROOT_URL . 'cart.php');
    die();

?>