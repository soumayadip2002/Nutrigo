<?php
    include 'partials/header.php';
    $fname = $_SESSION['add-user-data']['$fname'] ?? null;
    $lname = $_SESSION['add-user-data']['$lname'] ?? null;
    $uname = $_SESSION['add-user-data']['$uname'] ?? null;
    $email = $_SESSION['add-user-data']['$email'] ?? null;

    unset($_SESSION['add-user-data']);
?>
<section class="form_container" style="margin-top:6rem">
    <?php if(isset($_SESSION['add-user'])) {?>
        <div class="alert error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
        <?php } ?>
    <h3 class="heading">add <span>user</span></h3>
    <form action="./add_user-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="text" name="fname" value="<?= $fname ?>" placeholder="enter first name..." required>
        <input type="text" name="lname" value="<?= $lname ?>" placeholder="enter last name...." required>
        <input type="text" name="uname" value="<?= $uname ?>" placeholder="enter user name...." required>
        <input type="email" name="email" value="<?= $email ?>" placeholder="enter email...." required>
        <input type="password" name="password" value="" placeholder="enter password...." required>
        <input type="password" name="cpassword" value="" placeholder="confirm password...." required>
        <select name="user_role" id="" required>
            <option selected disabled>select user role</option>
            <option value="0">user</option>
            <option value="1">admin</option>
        </select>
        <label for="avatar">choose avatar</label>
        <input type="file" name="avatar" required>

        <button type="submit" name="submit" class="btn">add user</button>
    </form>
</section>

<?php
    include 'partials/footer.php';
?>