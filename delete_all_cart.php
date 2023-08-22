<?php
    require 'config/database.php';
    if(isset($_GET['delete']) && isset($_SESSION['user-id'])){
        $user_id = $_SESSION['user-id'];
        $delete_query = "delete from cart where user_id='$user_id'";
        $delete_result = mysqli_query($conn, $delete_query);

    }

    header('location: ' . ROOT_URL . 'cart.php');
    die();

?>