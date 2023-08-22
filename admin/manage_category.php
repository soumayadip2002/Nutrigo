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
                <a href="./manage_category.php"  class="active">
                    <i class="fa-regular fa-rectangle-list"></i>
                    <h5>manage categories</h5>
                </a>
            </li>
        </ul>
    </aside>
    <h3 class="heading">manage <span>categories</span></h3>
    <?php if(isset($_SESSION['add-category-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['edit-category-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['edit-category-success'];
                    unset($_SESSION['edit-category-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['edit-category'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['delete-category-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['delete-category-success'];
                    unset($_SESSION['delete-category-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['delete-category'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['delete-category'];
                    unset($_SESSION['delete-category']);
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
                    <th>offer</th>
                    <th>update</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php
                    $query = "select * from category order by id desc";
                    $result = mysqli_query($conn, $query);
                ?>
                <?php while($category = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?= $category['name'] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $category['image'] ?>" alt="" style="height:4rem;width:4rem"></td>
                    <td>upto <?= $category['offer'] ?>% off</td>
                    <td><a href="<?= ROOT_URL ?>admin/edit_category.php?id=<?= $category['id'] ?>" style="background:#53cf31;" class="btn">update</a></td>
                    <td><a href="<?= ROOT_URL ?>admin/delete_category.php?id=<?= $category['id'] ?>" style="background:#fe5458" class="btn">remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php include 'partials/footer.php' ?>