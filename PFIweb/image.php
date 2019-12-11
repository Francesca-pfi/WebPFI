<?php
    session_start();
    include "UTILS/sessionhandler.php";
    include "CLASSES/IMAGE/image.php";
    include_once "CLASSES/ALBUM/album.php"; 

    $imageID = $_GET["imageID"];

    $title = "Image";

    $content = array();
    
    $module = "imageview.php";
    array_push($content, $module);
    
    require_once __DIR__ . "/HTML/masterpage.php";

    die();
?>