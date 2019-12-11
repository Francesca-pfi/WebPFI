<?php
    include "../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    if (!Album::unlike_album($_POST["albumID"],$_SESSION["userID"])){
        header("Location: ../error.php?ErrorMSG=Could not unlike album");
        die();
    }

    header("Location: ../billboard.php");
    die();
?>