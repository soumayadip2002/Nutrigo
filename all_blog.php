<?php
    include 'Partials/header.php';
?>


    <!-- Blog Section starts -->

    <section class="blog" id="blog" style="margin-top:6rem">
        <h3 class="heading">our <span>blogs</span></h3>
        <?php
            $query = "select * from blogs";
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
    </section>

    <!-- Blog Section ends -->


<?php
    include 'Partials/footer.php';
?>