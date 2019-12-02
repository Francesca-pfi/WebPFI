<div class="container-fluid mt-30 pl-5 d-flex justify-content-center ">
    <?php 
        include_once __DIR__ . "/../CLASSES/IMAGE/image.php"; 
        $image = new Image();
        $image->load_image($_GET["imageID"]);
        $image->display();
    ?>
</div>