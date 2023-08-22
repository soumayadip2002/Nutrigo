<?php
    include 'partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from category where id='$id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==1){
            $category = mysqli_fetch_assoc($result);
        }
        
    }
?>
<section class="form_container">
    <?php if(isset($_SESSION['edit-category'])){?>
        <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <h3 class="heading">edit <span>category</span></h3>
    <form action="./edit_category-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?= $category['id'] ?>" name="id">
        <input type="hidden" value="<?= $category['image'] ?>" name="pre_image">
        <input type="text" name="name" value="<?= $category['name'] ?>" placeholder="enter category name..." required>
        <input type="text" name="offer" value="<?= $category['offer'] ?>" placeholder="enter offer..." required>
        <label for="avatar">add thumbnail</label>
        <input type="file" name="picture">

        <button type="submit" name="submit" class="btn">update</button>
    </form>
</section>

<?php
    include 'partials/footer.php';
?>
