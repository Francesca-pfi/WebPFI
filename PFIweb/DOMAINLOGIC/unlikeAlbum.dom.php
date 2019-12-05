<?php
    include "../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $albumID = $_POST["albumID"];
    $userID = $_SESSION["userID"];

    $TDG = AlbumTDG::get_instance();

    if (!$TDG->unlike_album($albumID,$userID)){
        header("Location: ../error.php?ErrorMSG=Could not unlike image");
        die();
    }

    header("Location: ../billboard.php");
    die();
?>