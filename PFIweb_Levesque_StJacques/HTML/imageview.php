<?php
    //on arrive de image.php
    $image = new Image();
    $image->add_view($_GET["imageID"]);
?>
<div class="container-fluid mt-30 pl-5 align-text" >
    <div class="text-left mb-2">
    <a href='album.php?albumID=<?php echo $image->get_albumID(); ?>' class='btn btn-outline-light moreComment'>BACK TO ALBUM</a>
    </div>
    <div>
        <?php $image->display(); ?>
    </div>
    <div>
        <?php $image->display_comments(); ?>
    </div>
    <div class="addComment">
        <button id="comments-load-btn" type="button" class="btn btn-outline-light moreComment" name="button" style="text-align:left">More comments!</button>
        <?php include "addcommentimageview.php";?>        
    </div>
</div>