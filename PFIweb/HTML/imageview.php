<?php 
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php"; 
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php"; 
    $image = new Image();
    $image->load_image($_GET["imageID"]);
    $album = new Album();
    $album->load_album($image->get_albumID());
?>
<div class="container-fluid mt-30 pl-5 align-text" >
    <div class="text-left mb-2">
    <a href='album.php?albumID=<?php echo $image->get_albumID(); ?>' class='btn btn-primary'>BACK TO ALBUM</a>
    </div>
    <div>
        <?php $image->display(); ?>
    </div>
    <div>
        <?php $image->display_comments(); ?>
    </div>
    <div>
        <?php include "addcommentimageview.php";?>
    </div>
</div>