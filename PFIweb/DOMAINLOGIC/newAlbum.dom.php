<?php
    session_start();

    include "../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";
    
    Album::add_album($_POST["title"],$_POST["descr"],$_SESSION["userID"]);

    header("Location: ../billboard.php");
    die();
?>