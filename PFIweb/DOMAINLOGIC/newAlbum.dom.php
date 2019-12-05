<?php
    session_start();

    include "../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";
    
    $TDG = AlbumTDG::get_instance();

    $TDG->add_album($_POST["title"],$_POST["descr"],$_SESSION["userID"],date("Y/m/d"));

    header("Location: ../billboard.php");
    die();
?>