<?php
    include "Partials/header.php";
    $fav_query="select * from favourite";
    $fav_result = mysqli_query($conn, $fav_query);
?>
<div class="dashboard">
    <h3 class="heading">favourite <span>items</span></h3>
    <?php if(isset($_SESSION['remove-fav-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['remove-fav-success'];
                    unset($_SESSION['remove-fav-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <main>
        <?php if(mysqli_num_rows($fav_result)>0) {?>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>image</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>add to cart</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php while($favs = mysqli_fetch_assoc($fav_result)) {?>
                <tr>
                    <td><?= $favs['name'] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $favs['image'] ?>" alt=""></td>
                    <td>₹ <?= $favs['price'] ?>/-</td>
                    <td><?= $favs['quantity'] ?> <?= $favs['measurement'] ?></td>
                    <td><a href="<?= ROOT_URL ?>cart-logic.php?id=<?= $favs['product_id'] ?>" style="color:#7bff55"><i class="fas fa-shopping-cart"></i></a></td>
                    <td><a href="<?= ROOT_URL ?>remove-fav.php?id=<?= $favs['id'] ?>" style="color:#fe5458"><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else{?>
            <div class="alert error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>
                        No item added in favourite
                    </p>
    	    </div>
        <?php } ?>
    </main>
</div>
<?php
    include 'Partials/footer.php';
?>