<?php include 'partials/header.php' ?>
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
                <a href="./manage_user.php">
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
                <a href="./manage_blog.php"  class="active">
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
    <h3 class="heading">manage <span>blogs</span></h3>
    <?php if(isset($_SESSION['add-blogs-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-blogs-success'];
                    unset($_SESSION['add-blogs-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['edit-blogs-success'])) {?>
        <div class="alert success ">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['edit-blogs-success'];
                    unset($_SESSION['edit-blogs-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['edit-blogs'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-blogs'];
                    unset($_SESSION['edit-blogs']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['delete-blogs-success'])) {?>
        <div class="alert success ">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['delete-blogs-success'];
                    unset($_SESSION['delete-blogs-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['delete-blogs'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['delete-blogs'];
                    unset($_SESSION['delete-blogs']);
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
                    <th>image</th>
                    <th>author name</th>
                    <th>time</th>
                    <th>update</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php
                    $query = "select * from blogs order by id desc";
                    $result = mysqli_query($conn, $query);
                ?>
                <?php while($blogs = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?= explode(":", $blogs['name'])[0] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $blogs['image'] ?>" alt="" style="height:8rem;width:12rem;"></td>
                    <?php
                        $author_id = $blogs['author_id'];
                        $user_query = "select * from users where id='$author_id'";
                        $user_result = mysqli_query($conn, $user_query);
                        $users = mysqli_fetch_assoc($user_result);
                    ?>
                    <td><?= $users['fname'] . "\n" . $users['lname'] ?></td>
                    <td><?= $blogs['time'] ?></td>
                    <td><a href="<?= ROOT_URL ?>admin/edit_blog.php?id=<?= $blogs['id'] ?>" style="background:#53cf31;" class="btn">update</a></td>
                    <td><a href="<?= ROOT_URL ?>admin/delete_blog.php?id=<?= $blogs['id'] ?>" style="background:#fe5458" class="btn">remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php include 'partials/footer.php' ?>