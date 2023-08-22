<?php
    include 'Partials/header.php';
?>  

    <?php if(isset($_SESSION['signup-success'])) {?>
        <?php  echo "<script>alert('{$_SESSION['signup-success']}')</script>";unset($_SESSION['signup-success']) ?>
    <?php } ?>
    <?php if(isset($_SESSION['add-cart-success'])){ ?>
        <?php
            echo "<script>alert('{$_SESSION['add-cart-success']}')</script>";
            unset($_SESSION['add-cart-success']);
        ?>
    <?php } elseif(isset($_SESSION['add-cart'])){?>
        <?php
            echo "<script>alert('{$_SESSION['add-cart']}')</script>";
            unset($_SESSION['add-cart']);
        ?>
    <?php } ?>

    <?php if(isset($_SESSION['add-fav-success'])){ ?>
        <?php
            echo "<script>alert('{$_SESSION['add-fav-success']}')</script>";
            unset($_SESSION['add-fav-success']);
        ?>
    <?php } elseif(isset($_SESSION['add-fav'])){?>
        <?php
            echo "<script>alert('{$_SESSION['add-fav']}')</script>";
            unset($_SESSION['add-fav']);
        ?>
    <?php } ?>

    <?php if(isset($_SESSION['review-fail'])) {?>
        <?php
            echo "<script>alert('{$_SESSION['review-fail']}')</script>";
            unset($_SESSION['review-fail']);
        ?>
    <?php } ?>
    <!-- home section starts -->

    <section class="home" id="home">
        <div class="content">
            <h3>fresh and <span>organic</span> Products for you</h3>
            <p>
            Welcome to Nutrigo, your ultimate destination for a diverse range of fresh produce and pantry essentials. 
            Experience seamless online shopping and doorstep delivery, making nutrition-packed choices easier than ever.
            </p>
            <button class="btn">explore</button>
        </div>
    </section>
    <!-- home section ends -->

    <!-- Category Section Starts -->

    <section class="category" id="category ">
        <h3 class="heading">products <span>category</span></h3>
        <?php  
            $category_query = "select * from category limit 6";
            $category_result= mysqli_query($conn, $category_query);
        ?>
        <div class="box-container">
            <?php while($category = mysqli_fetch_assoc($category_result)) {?>
            <div class="box" onclick="location.href='<?= ROOT_URL ?>categories.php?id=<?= $category['id'] ?>' ">
                <img src="<?= ROOT_URL . 'upload/' . $category['image'] ?>" alt=" " />
                <h3><?= $category['name'] ?></h3>
                <p>Upto <?= $category['offer'] ?>% Off</p>
            </div>
            <?php } ?>
        </div>
        <a href="<?= ROOT_URL ?>category.php" class="btn-1">see all <i class="fas fa-arrow-right"></i></a>
    </section>
    <!-- Category Section ends -->

    <!-- todays offer start -->
    <section class="offer">
        <h3 class="heading">Today's <span>offer</span></h3>
        <?php  
            $offer_query = "select * from products where todays_offer=1";
            $offer_result = mysqli_query($conn, $offer_query);
        ?>
        <div class="box-container">
            <?php while($offer = mysqli_fetch_assoc($offer_result)) {?>
            <div class="box" onclick=location.href="<?= ROOT_URL ?>Buy_item.php?id=<?= $offer['id'] ?>">
                <img src="<?= ROOT_URL . 'upload/' . $offer['image'] ?>" alt="">
                <h3><?= $offer['name'] ?></h3>
                <p>upto <?= $offer['offer'] ?>% off</p>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- todays offer ends -->

    <!-- Top selling Product Section Starts -->

    <section class="products" id="product">
        <h1 class="heading">Top selling <span>products</span></h1>
        <?php
            $top_query = "select * from review where value >= 4.5 limit 5";
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


        <a href="<?= ROOT_URL ?>top_selling.php" class="btn-1">see all <i class="fas fa-arrow-right"></i></a>
    </section>
    <!-- Top selling Product Section ends -->

    <!-- Product Section Starts -->

    <section class="products" id="products ">
        <h1 class="heading">Our <span>products</span></h1>
        <?php
            $product_query = "select * from products group by category limit 10";
            $product_result = mysqli_query($conn, $product_query);
        ?>
        <div class="product-slider">
            <?php while($products = mysqli_fetch_assoc($product_result)) {?>
            <div class="box">
                <img src="<?= ROOT_URL . 'upload/' . $products['image'] ?>" alt=" " onclick="location.href='<?= ROOT_URL ?>Buy_item.php?id=<?= $products['id'] ?>'" />
                <h3><?= $products['name'] ?></h3>
                <div class="price">₹ <?= $products['offer']<=0?$products['price']:($products['price']-($products['price']*$products['offer']/100)) ?>/- 
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
        <a href="<?= ROOT_URL ?>products.php" class="btn-1">see all<i class="fas fa-arrow-right"></i></a>
    </section>
    <!-- Product Section ends -->

    <!-- Blog Section starts -->

    <section class="blog" id="blog">
        <h3 class="heading">our <span>blogs</span></h3>
        <?php
            $query = "select * from blogs limit 3";
            $result = mysqli_query($conn, $query);
        ?>
        <div class="box-container">
            <?php while($blogs = mysqli_fetch_assoc($result)) {?>
            <div class="box">
                <img src="<?= ROOT_URL . 'upload/' . $blogs['image'] ?>" alt=" " />
                <?php
                    $author_id = $blogs['author_id'];
                    $user_query = "select * from users where id='$author_id'";
                    $user_result = mysqli_query($conn, $user_query);
                    $users = mysqli_fetch_assoc($user_result);
                ?>
                <div class="content">
                    <div class="icons">
                        <a href="#" style="display:flex;gap:1rem;">
                            <img src="<?= ROOT_URL . 'upload/' . $users['avatar'] ?>" alt="" style="height: 3.5rem;width:3.5rem;border-radius:50%;border:.2rem solid #F3AA60">
                            <p style="margin-top: .4rem;"> - by <?= $users['fname'] . "\n" . $users['lname'] ?></p>
                        </a>
                        <a href="#"><i class="fas fa-calendar"></i><?= $blogs['time'] ?></a>
                    </div>
                    <h3><?= explode(":", $blogs['name'])[0] ?></h3>
                    <p>
                        <?= substr($blogs['body'],0,100) ?>... <a href="<?= ROOT_URL ?>blog.php?id=<?= $blogs['id'] ?>">read more</a>
                    </p>
                    <a href="<?= ROOT_URL ?>blog.php?id=<?= $blogs['id']?>" class="btn">read more</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <a href="<?= ROOT_URL ?>all_blog.php" class="btn-1">see all <i class="fas fa-arrow-right"></i></a>
    </section>

    <!-- Blog Section ends -->

    <!-- features section start -->

    <section class="features" id="features">
        <div class="box">
            <h3>Fresh Vegetables</h3>
            <p>
                Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Daserunt Earum!
            </p>
            <a href="#" class="btn">order now</a>
        </div>
    </section>
    <!-- features section ends -->

    <!-- Review Section starts -->
    <section class="review" id="review">
        <h3 class="heading">customer's <span>review</span></h3>
        <?php
            $review_query = "select * from review group by author_id";
            $review_result = mysqli_query($conn, $review_query);
        ?>
        <div class="swiper review-slider">
            <div class="swiper-wrapper">
                <?php while($reviewers = mysqli_fetch_assoc($review_result)) {?>
                <div class="swiper-slide box">
                    <?php
                        $user_reviews_id = $reviewers['author_id'];
                        $user_query_review = "select * from users where id='$user_reviews_id'";
                        $user_result_review = mysqli_query($conn, $user_query_review);
                        $users_reviews = mysqli_fetch_assoc($user_result_review);
                    ?>
                    <img src="<?= ROOT_URL . 'upload/' . $users_reviews['avatar'] ?>" alt="">
                    <p><?= substr($reviewers['description'],0,100) ?>... <a href="<?= ROOT_URL ?>review.php">read more</a></p>
                    <h3><?= $users_reviews['fname'] . "\n" . $users_reviews['lname'] ?></h3>
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
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Review Section ends -->
<?php
    include 'Partials/footer.php';
?>