<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php"; 
    include_once __DIR__ . "/../CLASSES/LIKE/likeTDG.php"; 

    Album::delete_album($_POST["albumID"]);

    $TDG = ImageTDG::get_instance();    

    $images = $TDG->get_by_albumID($_POST["albumID"]);

    foreach ($images as $image) {
        unlink("../" . $image["url"]);
    }

    header("Location: ../billboard.php");
    die();
?>