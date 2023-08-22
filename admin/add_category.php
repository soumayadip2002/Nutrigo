<?php
    include 'partials/header.php';
    $name = $_SESSION['add-category-data']['name'] ?? null;
    $offer = $_SESSION['add-category-data']['offer'] ?? null;
    unset($_SESSION['add-category-data'])
?>
<section class="form_container">
    <?php if(isset($_SESSION['add-category']))  {?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <h3 class="heading">add <span>category</span></h3>
    <form action="./add_category-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $name ?>" placeholder="enter category name..." required>
        <input type="text" name="offer" value="<?= $offer ?>" placeholder="enter offer..." required>
        <label for="avatar">add thumbnail</label>
        <input type="file" name="picture" required>

        <button type="submit" name="submit" class="btn">add category</button>
    </form>
</section>

<?php
    include 'partials/footer.php';
?>
