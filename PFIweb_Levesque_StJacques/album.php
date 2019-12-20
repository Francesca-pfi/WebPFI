<?php
    //on arrive ici lorsqu'on click sur le titre d'un album, va afficher les previews des médias avec les commentaires de l'album
    session_start();
    include_once "UTILS/sessionhandler.php";
    include_once "CLASSES/ALBUM/album.php";  

    $title = "Album";

    $content = array();
    
    $module = "albumview.php";
    array_push($content, $module);
    
    require_once __DIR__ . "/HTML/masterpage.php";
?>