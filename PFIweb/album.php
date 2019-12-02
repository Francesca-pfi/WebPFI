<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = $_GET["title"];

    $content = array();
    
    $module = "albumview.php";
    array_push($content, $module);
    
    require_once __DIR__ . "/HTML/masterpage.php";

?>