<?php
    include 'partials/header.php';
    $name = $_SESSION['add-items-data']['name'] ?? null;
    $price = $_SESSION['add-items-data']['price'] ?? null;
    $quantity = $_SESSION['add-items-data']['quantity'] ?? null;
    $measurment = $_SESSION['add-items-data']['measurment'] ?? null;
    $nutrients = $_SESSION['add-items-data']['nutrients'] ?? null;

    unset($_SESSION['add-items-data']);
?>
<section class="form_container" style="margin-top:6rem">
    <?php if(isset($_SESSION['add-items'])) {?>
    <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['add-items'];
                    unset($_SESSION['add-items']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    </div>
    <?php } ?>
    <h3 class="heading">add <span>items</span></h3>
    <form action="./add_items-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $name ?>" placeholder="enter item name...." required>
        <input type="number" name="price" value="<?= $price ?>" placeholder="enter price...." required>
        <input type="number" name="quantity" value="<?= $quantity  ?>" placeholder="enter quantity...." required>
        <input type="text" name="measurment" value="<?= $measurment ?>" placeholder="enter measurment..." required>
        <select name="category" required>
            <?php  
                $category_query = "select * from category";
                $category_result= mysqli_query($conn, $category_query);
            ?>
            <option value="">select category</option>
            <?php while($category = mysqli_fetch_assoc($category_result))  {?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
        </select>
        <textarea rows="13" cols="" placeholder="enter nutrients/description...." name="nutrients" required><?= $nutrients ?></textarea>
        <div class="check">
            <label><input type="checkbox" name="is_today" onclick="toogleOff()" value="1" id=""> Todays offer</label>
            <script>
                function toogleOff() {
                    var is_today_checked = document.getElementsByName('is_today')[0];
                    var offer = document.getElementsByName('off')[0];

                    if (is_today_checked.checked) {
                        offer.style.display = 'block';
                    } else {
                        offer.style.display = 'none';
                    }
                }
            </script>
            <input type="text" name="off" id="" style="display:none" placeholder="enter offer percentage....">
        </div>
        <label for="avatar">choose thumbnail</label>
        <input type="file" name="thumbnail" required>
        <button type="submit" name="submit" class="btn">add</button>
    </form>
</section>

<?php
 include 'partials/footer.php';
?>