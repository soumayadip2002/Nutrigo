<?php
    include 'partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from users where id='$id'";
        $result = mysqli_query($conn, $query);
        $users = mysqli_fetch_assoc($result);
    }
?>
<section class="form_container" style="margin-top:6rem">
    <?php if(isset($_SESSION['edit-user'])) {?>
        <div class="alert error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
        <?php } ?>
    <h3 class="heading">edit <span>user</span></h3>
    <form action="./edit_user-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $users['id'] ?>">
        <input type="hidden" name="pre_avatar" value="<?= $users['avatar'] ?>">
        <input type="text" name="fname" value="<?= $users['fname'] ?>" placeholder="enter first name..." required>
        <input type="text" name="lname" value="<?= $users['lname'] ?>" placeholder="enter last name...." required>
        <input type="email" name="email" value="<?= $users['email'] ?>" placeholder="enter email...." required>
        <select name="user_role" id="" required>
            <?php if($users['is_admin']==0) {?>
            <option value="0">user</option>
            <option value="1">admin</option>
            <?php } else {?>
                <option value="1">admin</option>
                <option value="0">user</option>
            <?php } ?>
        </select>
        <label for="avatar">choose avatar</label>
        <input type="file" name="avatar">
        <button type="submit" name="submit" class="btn">update</button>
    </form>
</section>

<?php
    include 'partials/footer.php';
?>