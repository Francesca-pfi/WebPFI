<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "Image";

    $content = array();
    
    $module = "imageview.php";
    array_push($content, $module);
    
    require_once __DIR__ . "/HTML/masterpage.php";

?>