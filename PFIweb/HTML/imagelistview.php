<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    $TDG = ImageTDG::get_instance();
    $images = $TDG->get_by_albumID($_GET["albumID"]);
    foreach($images as $image){
        $display = new Image();
        $display->load_image($image['id']);
       
        $display->display_preview();
    }

    $TDG = AlbumTDG::get_instance();
    $TDG->add_view($_GET["albumID"]);
?>