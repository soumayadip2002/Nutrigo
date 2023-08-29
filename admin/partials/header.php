<?php
    require 'config/database.php';
    $uname = $_SESSION['signin-data']['$uname'] ?? null;
    $password = $_SESSION['signin-data']['$password'] ?? null;
    unset($_SESSION['signin-data']);

    if(isset($_SESSION['user-id'])){
        $uid = $_SESSION['user-id'];
        $user_query = "select * from users where id='$uid'";
        $user_result = mysqli_query($conn, $user_query);
        if(mysqli_num_rows($user_result)==1){
            $users = mysqli_fetch_assoc($user_result);
        }
    }
    else{
        header('location: ' . ROOT_URL);
        die();
    }

    $cart_query = "select * from cart where user_id='$uid' order by id desc";
    $cart_result = mysqli_query($conn, $cart_query);
    $total_item_cart='';
    if(mysqli_num_rows($cart_result)>0){
        $total_item_cart = mysqli_num_rows($cart_result);
    }
    else{
        $total_item_cart='';
    }

    $fav_query = "select * from favourite where user_id='$uid' order by id desc";
    $fav_result = mysqli_query($conn, $fav_query);
    $total_item_fav='';
    if(mysqli_num_rows($fav_result)>0){
        $total_item_fav = mysqli_num_rows($fav_result);
    }
    else{
        $total_item_fav='';
    }

    
    function isActivePage($page){
        $current_page = $_SERVER['PHP_SELF'];
        return strpos($current_page, $page) !== false ? 'activePage' : '';
    }

    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grocery Shop</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/jquery.jqZoom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="<?= ROOT_URL ?>upload/logo.png"/>
</head>

<body>
    <!-- header section start -->
    <header class="header">
        <?php if(isset($_SESSION['signin'])) {?>
            <?php echo "<script>alert('{$_SESSION['signin']}')</script>";unset($_SESSION['signin']) ?>
        <?php } ?>

        <?php if(isset($_SESSION['signin-success'])) {?>
            <?php echo "<script>alert('{$_SESSION['signin-success']}')</script>";unset($_SESSION['signin-success']) ?>
        <?php } ?>
        <a href="<?= ROOT_URL ?>" class="logo"><img src="<?= ROOT_URL . 'upload/' . 'logo1.png' ?>" alt="" style="height:4rem;width:4rem;margin-top:-1.3rem">NutriGo</a>

        <nav class="navbar">
            <a href="<?= ROOT_URL?>" class="<?= isActivePage('/index.php')?'activePage':'' ?>">Home</a>
            <a href="<?= ROOT_URL ?>about.php" class="<?= isActivePage('/about.php')?'activePage':'' ?>">about</a>
            <a href="<?= ROOT_URL ?>products.php" class="<?= isActivePage('/products.php')?'activePage':'' ?>">Products</a>
            <a href="<?=ROOT_URL ?>category.php" class="<?= isActivePage('/category.php')?'activePage':'' ?>">Categories</a>
            <a href="<?= ROOT_URL ?>review.php" class="<?= isActivePage('/review.php')?'activePage':'' ?>">Reviews</a>
            <a href="<?= ROOT_URL ?>all_blog.php" class="<?= isActivePage('/all_blog.php')?'activePage':'' ?>">Blogs</a>
            <?php if(isset($_SESSION['user-id']))  {?>
            <a href="<?= ROOT_URL ?>orders.php" class="<?= isActivePage('/orders.php')?'activePage':'' ?>">orders</a>
            <?php } ?>
        </nav>

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-search" id="search-btn"></div>
            <?php if(isset($_SESSION['user-id'])) {?>
            <div class="fa fa-heart" id="fav-btn" style="position: relative">
                <p style="
              position: absolute;
              top: -10px;
              right: 0;
              border-radius: 50%;
              font-size: 1.2rem;
              color: #ef6262;
            ">
                    <?php if(isset($_SESSION['user-id'])) {?>
                        <?= $total_item_fav ?>
                    <?php } ?>
                </p>
            </div>
            <div class="fas fa-shopping-cart" style="position: relative" id="cart-btn">
                <p style="
              position: absolute;
              top: -10px;
              right: 0;
              border-radius: 50%;
              font-size: 1.2rem;
              color: #ef6262;
            ">
                    <?php if(isset($_SESSION['user-id'])) {?>
                        <?= $total_item_cart ?>
                    <?php } ?>
                </p>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['user-id'])) {?>
            <div class="nav_profile">
                <p class="avatar">
                    <img src="<?= ROOT_URL . 'upload/' . $users['avatar'] ?>" alt="">
                </p>
                <ul class="nav_items">
                    <?php if(isset($_SESSION['user-admin'])) {?>
                        <li><a href="<?= ROOT_URL ?>admin/" class="btn">Dashboard</a></li>
                    <?php } ?>
                    <li><a href="<?= ROOT_URL ?>logout.php" class="btn" style="margin-top:0;background:red;">logout</a></li>
                </ul>
            </div>
            <?php } else{?>
            <div class="fas fa-user" id="login-btn"></div>
            <?php } ?>
        </div>
        <form action="<?= ROOT_URL ?>search.php" class="search-form" method="get">
            <input type="search" id="search-box" placeholder="search here..." name="search"/>
            <label for="search-box" class="fas fa-search"></label>
            <button type="submit" name="submit"></button>
        </form>

        <div class="fav-cart">
        <?php if(mysqli_num_rows($fav_result)>0) {?>
        <?php 
            $items_to_display_fav=0;
            while($favs = mysqli_fetch_assoc($fav_result))  {
            if($items_to_display_fav>=3){
                break;
            }    
            ?>
            <div class="box">
                <a href="<?= ROOT_URL ?>remove-fav.php?id=<?= $favs['id'] ?>"><i class="fas fa-trash"></i></a>
                <img src="<?= ROOT_URL . 'upload/' . $favs['image'] ?>" alt=" " />
                <div class="content">
                    <h3><?= $favs['name'] ?></h3>
                    <span class="price">₹ <?= $favs['price'] ?>/-</span>
                    <span class="quantity"> <?= $favs['quantity']  ?><?= $favs['measurement'] ?></span>
                </div>
            </div>
            <?php $items_to_display_fav++; } ?>
            <a href="<?= ROOT_URL ?>fav.php" class="btn">show all</a>
        <?php } else{?>
            <h3 style="color:red;font-weight:normal;font-size:1.8rem;">No items</h3>
        <?php } ?>
        </div>
        <div class="shopping-cart">
            <?php if(mysqli_num_rows($cart_result)>0) {?>
            <?php 
            $items_to_display=0;
            while($carts = mysqli_fetch_assoc($cart_result))  {
            if($items_to_display>=3){
                break;
            }    
            ?>
            <div class="box">
                <a href="<?= ROOT_URL ?>remove-cart-logic.php?id=<?= $carts['id'] ?>"><i class="fas fa-trash"></i></a>
                <img src="<?= ROOT_URL . 'upload/' . $carts['image'] ?>" alt=" " />
                <div class="content">
                    <h3><?= $carts['name'] ?></h3>
                    <span class="price">₹ <?= $carts['price'] ?>/-</span>
                    <span class="quantity"> <?= $carts['quantity']  ?><?= $carts['measurement'] ?></span>
                </div>
            </div>
            <?php $items_to_display++; } ?>
            <a href="<?= ROOT_URL ?>cart.php" class="btn">show all</a>
            <?php } else {?>
                <h3 style="color:red;font-weight:normal;font-size:1.8rem;">No items</h3>
            <?php } ?>
        </div>
        <form action="<?=ROOT_URL?>signin-logic.php" class="login-form" method="post" enctype="multipart/form-data">
            <h3>login now</h3>
            <input type="text" name="uname" value="<?= $uname ?>" placeholder="your username.." required/>
            <input type="password" value="<?= $password ?>"name="password" placeholder="your password.." required/>
            <p>don't have an account <a href="<?=ROOT_URL?>signup.php">create now</a></p>
            <button type="submit" name="submit" class="btn">login now</button>
        </form>
    </header>
    <!-- header section ends -->
