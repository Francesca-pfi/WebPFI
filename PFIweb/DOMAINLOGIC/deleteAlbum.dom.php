<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";

    $images = Image::get_by_albumID($_POST["albumID"]);

    foreach ($images as $image) {
        unlink("../" . $image["url"]);
    }
    Album::delete_album($_POST["albumID"]); 

    header("Location: ../billboard.php");
    die();
?>