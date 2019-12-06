<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";  
    
    $album = new Album();
    $album->load_album($_GET["albumID"]);
?>

<div class="container-fluid mt-30 pl-5">
  <h1 class="mb-4" ><?php echo $album->get_title() ?> </h1>
    <div class="row justify-content-md-center">
        <div class="col-sm-8 mb-4">
            <?php 
                //include "imagelistview.php";
                $album->display_images_preview();
            ?>
            <br>
            <?php
                $album->display_comments();
                include "addcommentalbumview.php";
            ?>
        </div>
        <div class="col-sm-3 mb-4">
            <?php 
                if (validate_session())
                    if ($album->get_userID() == $_SESSION["userID"])
                        include "imageUploadView.php"; 
            ?>
        </div>
    </div>
</div>