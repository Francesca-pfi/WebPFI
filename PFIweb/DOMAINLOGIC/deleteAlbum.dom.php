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

    $TDG->delete_images_by_albumID($_POST["albumID"]);

    $TDG = CommentTDG::get_instance();
    $TDG->delete_comment_by_elemID($_POST["albumID"], "album");

    $TDG = LikeTDG::get_instance();
    $TDG->delete_likes_by_elemID($_POST["albumID"], "album");

    header("Location: ../billboard.php");
    die();
?>