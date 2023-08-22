<?php
    include 'partials/header.php';
?>
<div class="dashboard">
    <aside>
        <ul>
            <li>
                <a href="./add_items.php">
                    <i class="fas fa-lemon"></i>
                    <h5>add items</h5>
                </a>
            </li>


            <li>
                <a href="./index.php">
                    <i class="fa-solid fa-pepper-hot"></i>
                    <h5>manage items</h5>
                </a>
            </li>

            <li>
                <a href="./add_user.php">
                    <i class="fas fa-user"></i>
                    <h5>add user</h5>
                </a>
            </li>

            <li>
                <a href="./manage_user.php" class="active">
                    <i class="fas fa-users"></i>
                    <h5>manage users</h5>
                </a>
            </li>

            <li>
                <a href="./add_blog.php">
                    <i class="fas fa-blog"></i>
                    <h5>add blog</h5>
                </a>
            </li>

            <li>
                <a href="./manage_blog.php">
                    <i class="fa-brands fa-blogger"></i>
                    <h5>manage blogs</h5>
                </a>
            </li>

            <li>
                <a href="./add_category.php">
                    <i class="fa-solid fa-pen-clip"></i>
                    <h5>add category</h5>
                </a>
            </li>

            <li>
                <a href="./manage_category.php">
                    <i class="fa-regular fa-rectangle-list"></i>
                    <h5>manage categories</h5>
                </a>
            </li>
        </ul>
    </aside>
    <h3 class="heading">manage <span>users</span></h3>
    <?php if(isset($_SESSION['add-user-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['edit-user-success'])) {?>
        <div class="alert success ">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['edit-user'])){?>
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

    <?php if(isset($_SESSION['delete-user-success'])) {?>
        <div class="alert success ">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['delete-user'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <main>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>avatar</th>
                    <th>username</th>
                    <th>update</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php
                    $query = "select * from users order by id desc";
                    $result = mysqli_query($conn, $query);
                ?>

                <?php while($user = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?= $user['fname'] . "\n" . $user['lname'] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $user['avatar'] ?>" alt="" style="height:4rem;width:4rem;border-radius:50%;border:.2rem solid #7043ec"></td>
                    <td><?= $user['uname'] ?></td>
                    <td><a href="<?= ROOT_URL ?>admin/edit_user.php?id=<?= $user['id']?>" style="background:#53cf31;" class="btn">update</a></td>
                    <td><a href="<?= ROOT_URL ?>admin/delete_user.php?id=<?= $user['id']?>" style="background:#fe5458" class="btn">remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php include 'partials/footer.php' ?>