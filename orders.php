<?php
include 'Partials/header.php';
if(isset($_SESSION['user-id'])){
    $user_id = $_SESSION['user-id'];
    $query = "select * from order_items where user_id='$user_id' order by id desc";
    $result = mysqli_query($conn, $query);
}
else{
    header('location: ' . ROOT_URL);
    die();
}

?>

<div class="dashboard">
    <h3 class="heading">ordered <span>items</span></h3>
    <?php if(isset($_SESSION['order-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['order-success'];
                    unset($_SESSION['order-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <main>
        <?php if(mysqli_num_rows($result)>0) {?>
        <table>
            <thead>
                <tr>
                    <th>order id</th>
                    <th>name</th>
                    <th>image</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>Time</th>
                </tr>

            </thead>
            <tbody>
                <?php while($orders = mysqli_fetch_assoc($result)) {
                    $products_query = "select * from products where id='{$orders['product_id']}'";
                    $product_result = mysqli_query($conn, $products_query);
                    $products = mysqli_fetch_assoc($product_result);
                ?>
                <tr>
                    <td><?= $orders['transaction_id'] ?></td>
                    <td><?= $products['name'] ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt=""></td>
                    <td>₹ <?= $orders['price'] ?>/-</td>
                    <td><?= $orders['quantity'] ?> <?= $products['measurement'] ?></td>
                    <td><?= $orders['created_at'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php }else {?>
            <div class="alert error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>
                        You haven't ordered anything yet !!
                    </p>
    	    </div>
        <?php } ?>
    </main>
</div>
<script>
    window.addEventListener('load', function() {
        window.history.pushState(null, '', window.location.href);
        window.onpopstate = function(event) {
            window.location.replace("<?= ROOT_URL ?>");
        };
    });
</script>
<?php include 'Partials/footer.php';  ?>