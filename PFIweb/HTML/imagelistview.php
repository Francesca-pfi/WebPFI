<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    $TDG = ImageTDG::get_instance();
    $images = $TDG->get_by_albumID($_GET["albumID"]);
    foreach($images as $image){
        $display = new Image();
        $display->load_image($image['id']);
       
        $display->display_preview();
    }
?>