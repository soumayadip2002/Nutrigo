<?php
    require 'config/database.php';
    if(isset($_POST['place_order']) && isset($_SESSION['user-id'])){
        $id = $_POST['id'];
        $user_id = $_SESSION['user-id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $customer_name = $_POST['customer_name'];
        $customer_number = $_POST['customer_number'];
        $customer_pin = $_POST['customer_pin'];
        $payment_mode = $_POST['payment_mode'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $insert_query1 = "insert into orders (user_id, name, number, pin, payment_mode, address)
        values ('$user_id', '$customer_name', '$customer_number', '$customer_pin', '$payment_mode','$address')";
        $insert_result1 = mysqli_query($conn, $insert_query1);

        if($insert_result1){
            $order_id = mysqli_insert_id($conn);
            function generateOrderID() {
                $uniqueIdentifier = uniqid(); // Generate a unique identifier based on current time
                $randomNumber = mt_rand(1000000000, 9999999999); // Generate a 4-digit random number
                
                // Combine the unique identifier and random number
                $transaction_id = substr($uniqueIdentifier, -5) . $randomNumber;
                
                return $transaction_id;
;            }
            $transaction_id = generateOrderID();
            $select_query = "select * from order_items where transaction_id='$transaction_id'";
            $select_result = mysqli_query($conn, $select_query);
            if(mysqli_num_rows($select_result)>0){
                $transaction_id=generateOrderID();
            }else{
                $insert_query2 = "insert into order_items (order_id, user_id, product_id, transaction_id, quantity, price)
                values ('$order_id', '$user_id', '$id', '$transaction_id', '$quantity', '$price')";
                $insert_result = mysqli_query($conn, $insert_query2);

                if(!mysqli_errno($conn)){
                    $_SESSION['order-success'] = "Order place successfully!!";
                }
            }

        } 
    }

    header('location: ' . ROOT_URL . 'orders.php');
    exit();
?>