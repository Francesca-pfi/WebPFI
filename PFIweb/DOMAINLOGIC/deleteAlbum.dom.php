<?php
    include __DIR__ . "/../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../CLASSES/IMAGE/image.php";

    $TDG = AlbumTDG::get_instance();

    $TDG->delete_album($_POST["albumID"]);

    $TDG = ImageTDG::get_instance();    

    $images = $TDG->get_by_albumID($_POST["albumID"]);

    foreach ($images as $image) {
        unlink("../" . $image["url"]);
    }

    $TDG->delete_images_by_albumID($_POST["albumID"]);

    header("Location: ../billboard.php");
    die();
?>