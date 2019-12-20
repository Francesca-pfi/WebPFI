<?php
    //arrivé de albumCreationView, permet de créer un nouvel album
    session_start();

    include "../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    
    if(!Album::add_album($_POST["title"],$_POST["descr"],$_SESSION["userID"])){
        header("Location: ../error.php?ErrorMSG=Could not add album");
        die();
    }

    header("Location: ../billboard.php");
    die();
?>