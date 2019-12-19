<h3 class="my-4 blanchedalmond" id="albums">Albums</h3>
<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    $albums = Album::list_all_albums();
    $albums = Album::create_album_list($albums);

    foreach($albums as $album){
        $album->display_album();        
    }
?>