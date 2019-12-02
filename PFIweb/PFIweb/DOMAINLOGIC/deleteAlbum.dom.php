<?php
    include __DIR__ . "/../CLASSES/ALBUM/album.php";

    $TDG = AlbumTDG::get_instance();

    $TDG->delete_album($_GET["albumID"]);

    //delete les images

    header("Location: ../billboard.php");
    die();
?>