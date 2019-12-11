<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    $albums = Album::search_title($_POST['search']);
    $albums = Album::create_album_list($albums);

    if(count($albums) > 0){
        echo "<h3 class='my-4'>Albums</h3>";
    }
    foreach($albums as $album){
        if(validate_session()){
            $album->display_album($_SESSION['userID']);
        }
        else{
            $album->display_album(0);
        }
    }
?>