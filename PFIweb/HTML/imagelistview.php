<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    $images = IMAGE::create_list_by_albumID($_GET["albumID"]);
    foreach($images as $image){
        $display->display_preview();
    }

    $TDG = AlbumTDG::get_instance();
    $TDG->add_view($_GET["albumID"]);
?>