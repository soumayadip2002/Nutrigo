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
                <a href="./index.php" class="active">
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
                <a href="./manage_category.php">
                    <i class="fa-regular fa-rectangle-list"></i>
                    <h5>manage categories</h5>
                </a>
            </li>
        </ul>
    </aside>
    <h3 class="heading">manage <span>items</span></h3>
    <?php if(isset($_SESSION['add-items-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-items-success'];
                    unset($_SESSION['add-items-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['edit-items-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['edit-items-success'];
                    unset($_SESSION['edit-items-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['edit-items'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-items'];
                    unset($_SESSION['edit-items']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['delete-items-success'])) {?>
        <div class="alert success ">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['delete-items-success'];
                    unset($_SESSION['delete-items-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['delete-items'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['delete-items'];
                    unset($_SESSION['delete-items']);
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
                    <th>price</th>
                    <th>quantity</th>
                    <th>category</th>
                    <th>update</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php
                    $query = "select * from products order by id desc";
                    $result = mysqli_query($conn, $query);
                ?>
                <?php while($products = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?= $products['name'] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt=""></td>
                    <td>₹ <?= $products['price'] ?>/-</td>
                    <td><?= $products['quantity'] ?> <?= $products['measurement'] ?></td>
                    <?php
                        $category_id = $products['category'];
                        $category_query = "select * from category where id='$category_id'";
                        $category_result = mysqli_query($conn, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <td><?= $category['name'] ?></td>
                    <td><a href="<?= ROOT_URL ?>admin/edit_items.php?id=<?= $products['id']?>" style="background:#53cf31;" class="btn">update</a></td>
                    <td><a href="<?= ROOT_URL ?>admin/delete_items.php?id=<?= $products['id']?>" style="background:#fe5458" class="btn">remove</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

<?php include 'partials/footer.php' ?>