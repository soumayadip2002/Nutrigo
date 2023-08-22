<?php
    include "Partials/header.php";
    $total=0;
    if(isset($_SESSION['cart-items'])){
        $cart_items = $_SESSION['cart-items'];
    }
?>

<section class="order_page" style="margin-top:6rem;">
<h3 class="heading"><span>order</span></h3>
    <div class="box-container">
        <div class="order">
            <form action="./cart_order.php"class="form_inline" style="width:100%" method="post">
            <input type="text" name="customer_name" id="" placeholder="enter name..." required>
                <input type="tel" name="customer_number" id="" placeholder="enter number...." required>
                <input type="text" name="customer_pin" id="" placeholder="enter pin...." required>
                <select name="payment_mode" required>
                    <option value="">select mode</option>
                    <option value="COD">COD</option>
                    <option value="upi">UPI</option>
                    <option value="credit">CREDIT CARD</option>
                </select>
                <textarea name="address" rows="10" placeholder="enter address..."></textarea>
                <button type="submit" class="btn" style="background:#974EC3" name="place_order">place order</button>
            </form>
        </div>
        <div class="details">
            <?php foreach($cart_items as $cart) {
                $product_id = $cart['product_id'];
                $product_query = "select * from products where id='$product_id'";
                $product_result = mysqli_query($conn, $product_query);
                $products = mysqli_fetch_assoc($product_result); 
                $total+=$cart['price'];   
            ?>
            <div class="box"  style="display:flex;justify-content:space-between;border-bottom:.1rem solid black;padding-bottom:.7rem">
                <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt="" style="height:8rem;width:8rem">
                <h3 style="display:flex;align-items:center;padding:1rem;font-size:2rem"><?= $products['name'] ?></h3>
                <div class="content" style="display:flex;align-items:center;padding:1rem">
                    <p style="font-size:2rem;">₹ <?= $cart['price'] ?>/- <?= $products['measurement']?></p>
                </div>
            </div>
            <?php } ?>
            <h1 style="margin-top:1rem;background:#FFEECC;width:fit-content;padding:1rem">Total - ₹ <?= $total ?>/-</h1>
        </div>
    </div>
</section>

<?php
    include 'Partials/footer.php';
?>