<?php
    include 'partials/header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from blogs where id='$id'";
        $result = mysqli_query($conn, $query);
        $blogs = mysqli_fetch_assoc($result);

    }
?>

<section class="form_container" style="margin-top:6rem">
    <?php if(isset($_SESSION['edit-blogs'])) {?>
        <div class="alert error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>
               <?= $_SESSION['edit-blogs'];
                    unset($_SESSION['edit-blogs']);
                ?>
            </p>
            <i class="fa-solid fa-circle-xmark" id="alert_close"></i>
    	</div>
    <?php } ?>
    <h3 class="heading">edit <span>blog</span></h3>
    <form action="./edit_blog-logic.php" class="add_blog form_inline" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $blogs['id'] ?>">
        <input type="hidden" name="pre_img" value="<?= $blogs['image'] ?>">
        <input type="text" name="title" value="<?= $blogs['name'] ?>" placeholder="enter title..." required>
        <br>
        <textarea rows="20" name="content" id="myTextarea" placeholder="add body....." ><?= $blogs['body'] ?></textarea>
        <label for="blog_picture">choose thumbnail</label>
        <input type="file" name="picture">
        <button type="submit" name="submit" class="btn">update</button>
    </form>
</section>
<script src="<?=ROOT_URL?>tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
    selector: '#myTextarea',
    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
        title: 'My page 1',
        value: 'https://www.codexworld.com'
    }, {
        title: 'My page 2',
        value: 'http://www.codexqa.com'
    }],
    image_list: [{
        title: 'My page 1',
        value: 'https://www.codexworld.com'
    }, {
        title: 'My page 2',
        value: 'http://www.codexqa.com'
    }],
    image_class_list: [{
        title: 'None',
        value: ''
    }, {
        title: 'Some class',
        value: 'class-name'
    }],
    importcss_append: true,
    file_picker_callback: (callback, value, meta) => {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
            });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
            });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
            });
        }
    },
    templates: [{
        title: 'New Table',
        description: 'creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
    }, {
        title: 'Starting my story',
        description: 'A cure for writers block',
        content: 'Once upon a time...'
    }, {
        title: 'New list with dates',
        description: 'New List with dates',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
    }],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>

<?php include 'partials/footer.php' ?>