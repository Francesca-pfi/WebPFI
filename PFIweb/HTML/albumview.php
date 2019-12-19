<?php    
    $album = new Album();
    $album->load_album($_GET["albumID"]);
?>

<div class="container-fluid mt-30 pl-5">
  <h1 class="mb-4 blanchedalmond" ><?php echo $album->get_title() ?> </h1>
    <div class="row justify-content-md-center">
        <div class="col-sm-8 mb-4">
            <div id='medias'>
                <?php 
                    $album->display_images_preview();
                ?>
            </div>
            <div id='comments'>
                <?php $album->display_comments(); ?>
                <button id="comments-load-btn" type="button" class="btn btn-outline-light moreComment" name="button">More comments!</button>
                <?php include "addcommentalbumview.php"; ?>           
            </div>           
        </div>
        <div class="col-sm-3 mb-4">
            <?php                
                include "imageUploadView.php"; 
            ?>
        </div>
    </div>
</div>