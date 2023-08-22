<?php 
    include 'Partials/header.php'; 
?>
<section class="review" style="margin-top:6rem">
    <h3 class="heading">all <span>reviews</span></h3>
    <?php
        $review_query = "select * from review group by author_id";
        $review_result = mysqli_query($conn, $review_query);
    ?>
    <div class="box-container">
    <?php while($reviewers = mysqli_fetch_assoc($review_result)) {?>
        <div class="box">
        <?php
            $user_reviews_id = $reviewers['author_id'];
            $user_query_review = "select * from users where id='$user_reviews_id'";
            $user_result_review = mysqli_query($conn, $user_query_review);
            $users_reviews = mysqli_fetch_assoc($user_result_review);
        ?>

        <?php
            $product_query = "select * from products where id='{$reviewers['product_id']}'";
            $product_result = mysqli_query($conn, $product_query);
            $products=mysqli_fetch_assoc($product_result);
        ?>
            <img src="<?= ROOT_URL . 'upload/' . $users_reviews['avatar'] ?>" alt="">
            <h3><?= $users_reviews['fname'] . "\n" . $users_reviews['lname'] ?></h3>
            <small><?= $products['name'] ?></small>
            <div class="details">
                <i class='bx bxs-quote-alt-left' id="left"></i>
                <p>
                    <?= $reviewers['description'] ?>
                </p>
                <i class='bx bxs-quote-alt-right' id="right"></i>
                <?php if($reviewers['value']==1) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php }elseif($reviewers['value']>1 && $reviewers['value']<2) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']==2){?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']>2 && $reviewers['value']<3) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']==3){?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']>3 && $reviewers['value']<4) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']==4) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php } elseif($reviewers['value']>4 && $reviewers['value']<5) {?>
                    <div class="stars">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fa-solid fa-star-half-stroke checked"></i>
                    </div>
                    <?php } elseif(($reviewers['value'])==5) {?>
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
</section>

<?php include 'Partials/footer.php'; ?>