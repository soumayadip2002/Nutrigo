<?php
    require 'config/database.php';
    if(isset($_POST['review_submit']) && isset($_SESSION['user-id'])){
        $user_id = $_SESSION['user-id'];
        $name = $_POST['name'];
        $id = $_POST['product_id'];
        $value = $_POST['value'];
        $value = floatval($value);
        $value = (float) $value;
        $description = $_POST['description'];
        $description = mysqli_real_escape_string($conn, $description);
        if($value>0 && $value <=5){
            $query = "insert into review (author_id, product_id, value, description) values('$user_id', '$id', '$value', '$description')";
            $result = mysqli_query($conn, $query);

            if(!mysqli_errno($conn)){
                $_SESSION['post-review-success'] = "Review posted successfully for $name !!";
            }
            else{
                $_SESSION['post-review'] = "Failed to post Review for $name !!";
            }
        }
        else{
            $_SESSION['post-review'] = "value should be in range of 1 to 5 !!";
        }


        header('location: ' . ROOT_URL . 'Buy_item.php?id=' . $id);
        die();
    }

    else{
        $_SESSION['review-fail']="You must have to login!!";
        header('location: ' . ROOT_URL);
        die();
    }
?>