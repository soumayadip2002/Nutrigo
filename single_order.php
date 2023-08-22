<?php
    include "Partials/header.php";
    if(isset($_POST['send_data'])){
        $product_id = $_POST['item_id'];
        $quantity = $_POST['food_quan'];
        $price = $_POST['food_price'];
        $product_query = "select * from products where id='$product_id'";
        $product_result = mysqli_query($conn, $product_query);
        $products = mysqli_fetch_assoc($product_result); 

    }
?>

<section class="order_page" style="margin-top:6rem;">
<h3 class="heading"><span>order</span></h3>
    <div class="box-container">
        <div class="order">
            <form action="./single-order-logic.php?timestamp=<?= time() ?>"class="form_inline" style="width:100%" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $products['id'] ?>">
                <input type="hidden" name="price" value="<?= $price ?>">
                <input type="hidden" name="quantity" value="<?= $quantity ?>">
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
            <div class="box"  style="display:grid;padding-bottom:.7rem;border:.1rem solid #555;place-items:center;">
                <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt="" style="max-height:50rem;max-width:40rem;display:block;border-bottom:.1rem solid #666;">
                <h3 style="display:flex;align-items:center;padding:1rem;font-size:2rem;border-bottom:.1rem solid #666"><?= $products['name'] ?></h3>
                <div class="content" style="display:grid;align-items:center;">
                    <p style="font-size:2rem;padding:1rem;border-bottom:.1rem solid #666"> <?= $quantity ?> <?= $products['measurement']?></p>
                    <p style="font-size:2rem;padding:1rem;">₹ <?= $price ?>/- </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include 'Partials/footer.php';
?>