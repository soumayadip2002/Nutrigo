<?php
    include 'Partials/header.php';
?>

    <!-- Category Section Starts -->

    <section class="category" style="margin-top:6rem">
        <h3 class="heading">all <span>categories</span></h3>
        <?php  
            $category_query = "select * from category";
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
    </section>
    <!-- Category Section ends -->


<?php
    include 'Partials/footer.php';
?>