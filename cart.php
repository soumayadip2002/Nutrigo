<?php
    include "Partials/header.php";
    $total=0;
?>

<?php
if(isset($_POST['update_button'])){
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_query = "update cart set quantity='$quantity' where id='$cart_id'";
    $update_result = mysqli_query($conn, $update_query);
}

?>
<div class="dashboard">
    <?php
    if(isset($_SESSION['user-id'])){
        $uid = $_SESSION['user-id'];
        
        $cart_query = "select * from cart where user_id='$uid' order by id desc";
        $cart_result = mysqli_query($conn, $cart_query);
    }
    ?>
    <h3 class="heading">cart <span>items</span></h3>
    <?php if(isset($_SESSION['remove-cart-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['remove-cart-success'];
                    unset($_SESSION['remove-cart-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <main>
        <?php if(mysqli_num_rows($cart_result)>0){
            $cart_items = array();
        ?>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>image</th>
                    <th>quantity</th>
                    <th>update</th>
                    <th>price</th>
                    <th>remove</th>
                </tr>

            </thead>
            <tbody>
                <?php while($carts = mysqli_fetch_assoc($cart_result))  {
                    $subtotal = $carts['price']*$carts['quantity'];
                    $cart_items[]=array(
                        'user_id'=>$carts['user_id'],
                        'product_id'=>$carts['product_id'],
                        'quantity'=>$carts['quantity'],
                        'price'=>$subtotal,
                    ) 
                ?>
                <tr>
                    <td><?= $carts['name']  ?></td>
                    <td><img src="<?= ROOT_URL . 'upload/' . $carts['image']  ?>" alt=""></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?= $carts['id'] ?>">
                            <input type="number" name="quantity" value="<?= $carts['quantity'] ?>"> </i> <?= $carts['measurement'] ?> 
                            <td><button type="submit" style="background:#53cf31;" class="btn" name="update_button">update</button></td>
                        </form>
                    </td>
                    <td>₹ <?= $subtotal ?>/-</td>
                    <td><a href="<?= ROOT_URL ?>remove-cart-logic.php?id=<?= $carts['id'] ?>" style="background:#fe5458;" class="btn">remove</a></td>
                </tr>
                <?php $total+=$subtotal;} ?>
                <tr>
                    <td colspan="4">Grand Total - </td>
                    <td>₹ <?= $total ?>/-</td>
                    <td style="padding:1rem 0;" colspan="2"><a href="<?= ROOT_URL ?>delete_all_cart.php?delete=1 ?>" class="btn" style="background:#a70105;">delete all</a></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php $_SESSION['cart-items'] = $cart_items ?>
        <?php } else {?>
            <div class="alert error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>
                        No item added in cart!!
                    </p>
    	    </div>
        <?php } ?>
    </main>
    <div style="text-align-last:right;padding-top:1rem;">
        <a href="<?= ROOT_URL ?>order_page.php" class="btn <?= ($total>1) ? '' : 'disabled' ?>" style="background:#5B9A8B;padding:1.5rem 1.5rem;">place order</a>
    </div>
</div>

<script src="./script.js"></script>
<?php
    include 'Partials/footer.php';
?>