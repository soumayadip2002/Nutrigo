<?php
    require 'config/database.php';
    if(isset($_POST['place_order']) && isset($_SESSION['user-id'])){
        $user_id = $_SESSION['user-id'];
        $customer_name = $_POST['customer_name'];
        $customer_number = $_POST['customer_number'];
        $customer_pin = $_POST['customer_pin'];
        $payment_mode = $_POST['payment_mode'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $insert_query1 = "insert into orders (user_id, name, number, pin, payment_mode, address)
        values ('$user_id', '$customer_name', '$customer_number', '$customer_pin', '$payment_mode','$address')";
        $insert_result1 = mysqli_query($conn, $insert_query1);
        function generateOrderID() {
            $uniqueIdentifier = uniqid(); // Generate a unique identifier based on current time
            $randomNumber = mt_rand(1000000000, 9999999999); // Generate a 4-digit random number
            
            // Combine the unique identifier and random number
            $transaction_id = substr($uniqueIdentifier, -5) . $randomNumber;
            
            return $transaction_id;
        }
        $transaction_id = generateOrderID();

        if($insert_result1){
            $order_id = mysqli_insert_id($conn);
            if(isset($_SESSION['cart-items'])){
                $cart_items = $_SESSION['cart-items'];
                foreach($cart_items as $cart){
                    $use_id = $cart['user_id'];
                    $product_id = $cart['product_id'];
                    $quantity = $cart['quantity'];
                    $price = $cart['price'];
                    $insert_query2 = "insert into order_items (order_id, user_id, product_id, transaction_id, quantity, price)
                    values ('$order_id', '$use_id', '$product_id', '$transaction_id', '$quantity', '$price')";
                    $insert_result = mysqli_query($conn, $insert_query2);
                    if(!mysqli_errno($conn)){
                        $_SESSION['order-success'] = "Order place successfully!!";
                    }
                }
            }

            $delete_query = "delete from cart where user_id='$user_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            unset($_SESSION['cart-items']);
            
        }
    }

    header('location: ' . ROOT_URL . 'orders.php');
    exit();
?>