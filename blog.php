<?php
    include 'Partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from blogs where id='$id'";
        $result = mysqli_query($conn, $query);
        $blogs = mysqli_fetch_assoc($result);

        $author_id = $blogs['author_id'];
        $user_query = "select * from users where id='$author_id'";
        $user_result = mysqli_query($conn, $user_query);
        $users = mysqli_fetch_assoc($user_result);
    }
?>
<section class="blog_post">
    <div class="container post">
        <h3 class="heading" style="text-decoration:underline;"><?= $blogs['name'] ?></h3>
        <div class="image">
            <img src="<?= ROOT_URL . 'upload/' . $blogs['image'] ?>" alt="">
        </div>
        <div class="user_details">
            <img src="<?= ROOT_URL . 'upload/' . $users['avatar'] ?>" alt="">
            <div class="details">
                <h3> by: <?= $users['fname'] . "\n" . $users['lname']?></h3>
                <small><i class="fas fa-calendar"></i>  <?= $blogs['time'] ?></small>
            </div>
        </div>
        <div class="content" style="font-size:1.5rem;">
            <?= $blogs['body'] ?>
        </div>
    </div>
</section>
<?php
    include 'Partials/footer.php';
?>