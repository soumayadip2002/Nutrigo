<?php
    require 'config/constants.php';

    $fname = $_SESSION['signup-data']['$fname'] ?? null;
    $lname = $_SESSION['signup-data']['$lname'] ?? null;
    $uname = $_SESSION['signup-data']['$uname'] ?? null;
    $email = $_SESSION['signup-data']['$email'] ?? null;

    unset($_SESSION['signup-data']);
?>

<head>
    <link rel="stylesheet" href="<?=ROOT_URL ?>CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>
<section class="form_container" style="margin-top:1rem">
        <?php if(isset($_SESSION['signup'])) {?>
        <div class="alert error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['signup'];
                    unset($_SESSION['signup']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
        <?php } ?>
    <h3 class="heading">sign <span>up</span></h3>
    <form action="./signup-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="text" name="fname" value="<?= $fname ?>" placeholder="enter first name..." required>
        <input type="text" name="lname" value="<?= $lname ?>" placeholder="enter last name...." required>
        <input type="text" name="uname" value="<?= $uname ?>" placeholder="enter user name...." required>
        <input type="email" name="email" value="<?= $email ?>" placeholder="enter email...." required>
        <input type="password" name="password" value="" placeholder="enter password...." required>
        <input type="password" name="cpassword" value="" placeholder="confirm password...." required>
        <label for="avatar">choose avatar</label>
        <input type="file" name="avatar" required>

        <button type="submit" class="btn" name="submit">sign up</button>
        <p style="margin-top:1rem;font-size:1.4rem">Already have an account <a href="./index.php" style="text-decoration:underline;">login</a></p>
    </form>
</section>
<script src="<?= ROOT_URL ?>JS/alert.js"></script>