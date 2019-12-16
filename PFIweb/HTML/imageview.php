<?php 
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php"; 
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php"; 
    $image = new Image();
    $image->add_view($_GET["imageID"]);
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
    <div style="margin: 5vh 0">
        <button id="comments-load-btn" type="button" class="btn btn-primary mb-2" name="button" style="text-align:left">More comments!</button>
        <?php include "addcommentimageview.php";?>        
    </div>
</div>