<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $images = Image::get_by_albumID($_POST["albumID"]);

    if(!Album::delete_album($_POST["albumID"])) {
        header("Location: ../error.php?ErrorMSG=Could not delete album");
        die();
    }

    foreach ($images as $image) {
        unlink("../" . $image["url"]);
    }
    

    header("Location: ../billboard.php");
    die();
?>