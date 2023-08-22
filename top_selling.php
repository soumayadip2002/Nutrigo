<?php
    include 'Partials/header.php';
?>

<!-- Top selling Product Section Starts -->
<section class="products" id="product" style="margin-top:6rem;">
    <?php if(isset($_SESSION['add-cart-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-cart-success'];
                    unset($_SESSION['add-cart-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['add-cart'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['add-cart'];
                    unset($_SESSION['add-cart']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>

    <?php if(isset($_SESSION['add-fav-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['add-fav-success'];
                    unset($_SESSION['add-fav-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['add-fav'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['add-fav'];
                    unset($_SESSION['add-fav']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <h1 class="heading">Top selling <span>products</span></h1>
    <?php
        $top_query = "select * from review where value >= 4.5";
        $top_result = mysqli_query($conn, $top_query);

    ?>
    <div class="product-slider">
        <?php while($top_products = mysqli_fetch_assoc($top_result)) {
            $top_product_id = $top_products['product_id'];
            $select_products = "select * from products where id='$top_product_id'";
            $select_result = mysqli_query($conn, $select_products);    
        ?>
        <?php while($top_selling_products=mysqli_fetch_assoc($select_result))  {?>
        <div class="box">
            <img src="<?= ROOT_URL . 'upload/' . $top_selling_products['image'] ?>" alt=" " onclick="location.href='<?= ROOT_URL ?>Buy_item.php?id=<?= $top_product_id ?>'" />
            <h3><?= $top_selling_products['name'] ?></h3>
            <div class="price">
            ₹ <?= $top_selling_products['offer']<=0?$top_selling_products['price']:($top_selling_products['price']-($top_selling_products['price']*$top_selling_products['offer']/100)) ?>/- 
                <?= $top_selling_products['quantity'] ?><?= $top_selling_products['measurement'] ?>
                <?php if($top_selling_products['offer']>0) {?>
                        <small style="text-decoration:line-through;font-size:1.5rem;margin-left:2rem" class="actual_price">₹ <?= $top_selling_products['price'] ?>/-</small>
                    <?php } ?>
            </div>
            <div class="add" style="display: flex;justify-content:center;gap:1rem;">
            <a href="<?= ROOT_URL  ?>cart-logic.php?id=<?= $top_product_id ?>" class="btn"><i class="fas fa-shopping-cart"></i></a>
            <a href="<?= ROOT_URL ?>fav-logic.php?id=<?= $top_product_id ?>" class="btn"><i class="fa-regular fa-heart"></i></a>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>

</section>
<!-- Top selling Product Section ends -->

<?php 
    include 'Partials/footer.php';
?>