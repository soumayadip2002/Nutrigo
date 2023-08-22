<?php
    include 'Partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from products where id='$id'";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_assoc($result);
        $category_id = $products['category'];
        $category_query = "select * from category where id='$category_id'";
        $category_result = mysqli_query($conn, $category_query);
        $categories = mysqli_fetch_assoc($category_result);
    }
?>
<section class="Buy">
    <?php if(isset($_SESSION['post-review-success'])) {?>
        <div class="alert success">
        <i class="fa-regular fa-circle-check" id="success"></i>
            <p>
               <?= $_SESSION['post-review-success'];
                    unset($_SESSION['post-review-success']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } elseif(isset($_SESSION['post-review'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['post-review'];
                    unset($_SESSION['post-review']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <div class="box-container">
        <div class="zoom-box">
            <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" id="myimg" class="imgZoom" alt="" />
        </div>
        <div class="details">
            <h1><?= $products['name'] ?></h1>
            <p>
                <?php if($categories['name']!="Cleaning Supplies" && $categories['name']!="Personal Care") {?>
                    nutrients - <?= $products['nutrients'] ?>
                <?php } else{?>
                    description - <?= $products['nutrients'] ?>
                <?php } ?>
            </p>
            <form method="post" id="form_quantity">
            <h3>
                quantity = 
                <i class="fa fa-minus" id="minus"></i>
                <input type="text" name="quantity" value="<?= $products['quantity'] ?>" style="width: 5rem;padding: 0.5rem;text-align: center;background: #eccdb4;" />
                <i class="fa fa-plus" id="plus"></i> <?= $products['measurement'] ?>
            </h3>
            </form>
            <h4>
                price = ₹ <span class="single_price"><?= $products['offer']<0?$products['price']:($products['price']-($products['price']*$products['offer']/100)) ?></span>/-  
                <?php if($products['offer']>0) {?>
                    <small style="text-decoration:line-through;font-size:1.8rem;margin-left:2rem">₹ <small class="actual_price" style="font-size:1.8rem;"><?= $products['price'] ?></small>/-</small>
                <?php } ?>
            </h4>
            <a href="<?= ROOT_URL ?>categories.php?id=<?= $products['category'] ?>">
                <h5><?= $categories['name'] ?></h5>
            </a>
            <?php
                $review_query = "select value, count(*) as count from review where product_id='$id' group by value order by value desc";
                $review_result = mysqli_query($conn, $review_query);
                $ratingDistribution = [];
                while($row = mysqli_fetch_assoc($review_result)){
                    $ratingDistribution[intval($row['value'])] = $row['count'];
                }

                $totalrating = array_sum($ratingDistribution);
            ?>
            <div class="rating">
                <small>Rating - <span style="color:rgb(73, 73, 240);background:#ccc;padding:.5rem 1rem;font-size:1.3rem"><?= $totalrating ?> rated</span></small>
                <?php for($i=5;$i>=1;$i--) {
                    $count = isset($ratingDistribution[$i])?$ratingDistribution[$i]:0;
                    $percentage = $totalrating>0?($count/$totalrating)*100:0;
                ?>
                    <span><small><?= $i ?> <i class="fas fa-star"></i></small> <progress value="<?= $percentage ?>" max="100"></progress> <small><?= $count ?></small></span>
                <?php } ?>
            </div>

            <form action="./single_order.php" method="post">
                <input type="hidden" name="item_id" value="<?= $products['id'] ?>">
                <input type="hidden" name="food_price" value="<?= $products['price'] ?>">
                <input type="hidden" name="food_quan" value="<?= $products['quantity'] ?>">
                <button type="submit" class="btn" name="send_data" style="background:#0B666A;">Buy now</button>
            </form>
        </div>


    </div>
    <div class="reviews">
        <h1 style="margin: 1rem; font-size:2rem;color:#130f40">Cutomers review - </h1>
        <?php  
            $rating_query = "select * from review where product_id='$id' order by value desc";
            $rating_result = mysqli_query($conn, $rating_query);
        ?>
        <div class="box-container">
            <?php while($rating = mysqli_fetch_assoc($rating_result))  {?>
            <div class="box">
                <?php
                    $user_id = $rating['author_id'];
                    $user_query = "select * from users where id='$user_id'";
                    $user_result = mysqli_query($conn, $user_query);
                    $users = mysqli_fetch_assoc($user_result);
                ?>
                <img src="<?= ROOT_URL . 'upload/' . $users['avatar'] ?>" alt="">
                <div class="others">
                    <h4><?= $users['fname'] . "\n" . $users['lname'] ?></h4>
                    <?php if($rating['value']==1) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php }elseif($rating['value']>1 && $rating['value']<2) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']==2){?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']>2 && $rating['value']<3) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']==3){?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']>3 && $rating['value']<4) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']==4) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($rating['value']>4 && $rating['value']<5) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                    </div>
                    <?php } elseif(($rating['value'])==5) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="form_container" style="min-height:fit-content">
    <h3 class="heading">rate <span>product</span></h3>
    <form action="./review-logic.php" class="container form_inline" method="post">
        <input type="hidden" name="name" value="<?= $products['name'] ?>">
        <input type="hidden" name="product_id" value="<?= $products['id'] ?>">
        <input type="text" value="<?= $products['name'] ?>" disabled>
        <input type="number" step="0.01" min="0" max="100" name="value" placeholder="enter rating value from 1 to 5 ..." required>
        <textarea rows="10" cols="" placeholder="write a review...." name="description" required></textarea>
        <button type="submit" name="review_submit" class="btn">post</button>
    </form>
</section>

<?php
    include 'Partials/footer.php';
?>