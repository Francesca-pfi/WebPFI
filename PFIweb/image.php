<?php
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/IMAGE/image.php";

    $imageID = $_GET["imageID"];
    $TDG = ImageTDG::get_instance();
    $TDG->add_view($imageID);

    $title = "Image";

    $content = array();
    
    $module = "imageview.php";
    array_push($content, $module);
    
    require_once __DIR__ . "/HTML/masterpage.php";

    

    die();

?>