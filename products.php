<?php

    include 'Partials/header.php';
    $category_query = "select * from category";
    $category_result = mysqli_query($conn, $category_query);

?>

<!-- Product Section Starts -->
<section class="products" style="margin-top: 6rem;" id="products">
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
        <h1 class="heading">all <span>products</span></h1>
        <?php while($categories = mysqli_fetch_assoc($category_result))  {
            $category_id = $categories['id'];
            $item_count_query = "select count(*) as item_count from products where category='$category_id'";
            $item_result = mysqli_query($conn, $item_count_query);
            $items = mysqli_fetch_assoc($item_result)['item_count'];

            if($items>0){
        ?>
        <?php
            $product_query = "select * from products where category='$category_id'";
            $product_result = mysqli_query($conn, $product_query);
        ?>
        <h1 class="heading"><span style="background:#A8DF8E;color:#444;"><?= $categories['name'] ?></span></h1>
        <div class="product-slider">
            <?php while($products = mysqli_fetch_assoc($product_result)) {?>
            <div class="box">
                <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt=" " onclick="location.href='<?= ROOT_URL ?>Buy_item.php?id=<?= $products['id'] ?>'" />
                <h3><?= $products['name'] ?></h3>
                <div class="price">
                ₹ <?= $products['offer']<=0?$products['price']:($products['price']-($products['price']*$products['offer']/100)) ?>/- 
                <?= $products['quantity'] ?><?= $products['measurement'] ?>
                <?php if($products['offer']>0) {?>
                        <small style="text-decoration:line-through;font-size:1.5rem;margin-left:2rem" class="actual_price">₹ <?= $products['price'] ?>/-</small>
                    <?php } ?>
                </div>
                <?php
                    $product_id = $products['id'];
                    $rating_query = "select * from review where product_id='$product_id'";
                    $rating_result = mysqli_query($conn, $rating_query);
                    $rating=0;

                    while($rating_sum = mysqli_fetch_assoc($rating_result)){
                        $rating+=$rating_sum['value'];
                    }

                    if(mysqli_num_rows($rating_result)>0){
                        $rating=$rating/mysqli_num_rows($rating_result);
                    }
                    else{
                        $rating=0;
                    }
                ?>
                <?php if($rating==1) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php }elseif($rating>1 && $rating<2) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fa-solid fa-star-half-stroke checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating==2){?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating>2 && $rating<3) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fa-solid fa-star-half-stroke checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating==3){?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating>3 && $rating<4) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fa-solid fa-star-half-stroke checked"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating==4) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star"></i>
                </div>
                <?php } elseif($rating>4 && $rating<5) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fa-solid fa-star-half-stroke checked"></i>
                </div>
                <?php } elseif(($rating)==5) {?>
                <div class="stars">
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                </div>
                <?php } ?>
                <a href="<?= ROOT_URL  ?>cart-logic.php?id=<?= $products['id'] ?>" class="btn"><i class="fas fa-shopping-cart"></i></a>
                <a href="<?= ROOT_URL ?>fav-logic.php?id=<?= $products['id'] ?>" class="btn"><i class="fa-regular fa-heart"></i></a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
    </section>
<?php

    include 'Partials/footer.php';

?>