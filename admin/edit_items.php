<?php
    include 'partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from products where id='$id'";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_assoc($result);
    }
?>
<section class="form_container" style="margin-top:6rem">
    <?php if(isset($_SESSION['edit-items'])) {?>
    <div class="alert error">
        <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-items'];
                    unset($_SESSION['edit-items']);
                ?>
            </p>
        <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    </div>
    <?php } ?>
    <h3 class="heading">edit <span>items</span></h3>
    <form action="./edit_items-logic.php" class="container form_inline" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $products['id'] ?>">
        <input type="hidden" name="pre_img" value="<?= $products['image'] ?>">
        <input type="text" name="name" value="<?= $products['name'] ?>" placeholder="enter item name...." required>
        <input type="number" name="price" value="<?= $products['price'] ?>" placeholder="enter price...." required>
        <input type="number" name="quantity" value="<?= $products['quantity']  ?>" placeholder="enter quantity...." required>
        <input type="text" name="measurment" value="<?= $products['measurement'] ?>" placeholder="enter measurment..." required>
        <select name="category" required>
            <?php  
                $category_query = "select * from category";
                $category_result= mysqli_query($conn, $category_query);
            ?>
            <?php while($category = mysqli_fetch_assoc($category_result))  {?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
        </select>
        <textarea rows="13" cols="" placeholder="enter nutrients...." name="nutrients" required><?= $products['nutrients'] ?></textarea>
        <div class="check">
            <?php if(($products['todays_offer'])==1) {?>
            <label><input type="checkbox" name="is_today" onclick="toogleOff()" value="1" id="" checked> Todays offer</label>
            <input type="text" name="off" id="" value="<?=$products['offer']?>" placeholder="enter offer percentage....">
            <?php } else{?>
            <label><input type="checkbox" name="is_today" onclick="toogleOff()" value="1" id=""> Todays offer</label>
            <input type="text" name="off" id="" style="display:none" placeholder="enter offer percentage....">
            <?php } ?>
        
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

        </div>
        <label for="avatar">choose thumbnail</label>
        <input type="file" name="thumbnail">
        <button type="submit" name="submit" class="btn">update</button>
    </form>
</section>

<?php
 include 'partials/footer.php';
?>