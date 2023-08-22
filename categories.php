<?php
    include 'Partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $product_query = "select * from products where category='$id'";
        $product_result = mysqli_query($conn, $product_query);
        $category_query = "select * from category where id='$id'";
        $category_result = mysqli_query($conn, $category_query);
        $categories = mysqli_fetch_assoc($category_result);
    }
    
?>
<section class="products" id="products" style="margin-top:6rem">
    <h1 class="heading"><span><?= $categories['name'] ?></span></h1>
    <?php if(mysqli_num_rows($product_result)>0) {?>
    <div class="product-slider">
        <?php while($products = mysqli_fetch_assoc($product_result)) {?>
        <div class="box">
            <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt=" " onclick="location.href='<?= ROOT_URL ?>Buy_item.php?id=<?= $products['id'] ?>'" />
            <h3><?= $products['name'] ?></h3>
            <div class="price">₹ <?= $products['offer']<0?$products['price']:($products['price']-($products['price']*$products['offer']/100)) ?>/- 
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
            <a href="#" class="btn"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" class="btn"><i class="fa fa-heart"  id="love"></i></a>
        </div>
        <?php } ?>
    </div>
    <?php } else {?>
    <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               Currently No products available for <?= $categories['name'] ?>
            </p>
    </div>
    <?php } ?>
</section>

<?php include "Partials/footer.php"; ?>
