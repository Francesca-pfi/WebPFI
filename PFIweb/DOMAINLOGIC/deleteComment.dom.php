<?php
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include __DIR__ . "/../CLASSES/LIKE/likeTDG.php"; 

    $TDG = CommentTDG::get_instance();    
    $comment = new Comment();
    $comment->load_comment($_POST["commentID"]);
    $elemID = $comment->get_elemID();
    $TDG->delete_comment($_POST["commentID"]);

    $TDG = LikeTDG::get_instance();
    $TDG->delete_likes_by_elemID($_POST["commentID"], "comment");

    if ($comment->get_typeElem() == 'image') {
        header("Location: ../image.php?imageID=$elemID");
        die();
    }
    else {
        header("Location: ../album.php?albumID=$elemID");
        die();
    }
    
?>