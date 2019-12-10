<?php
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }
  
    $comment = new Comment();
    $comment->load_comment($_POST["commentID"]);
    $elemID = $comment->get_elemID();
    if (!Comment::delete_comment($comment->get_id())) {
        header("Location: ../error.php?ErrorMSG=Could not delete comment");
        die();
    }

    if ($comment->get_typeElem() == 'image') {
        header("Location: ../image.php?imageID=$elemID");
        die();
    }
    else {
        header("Location: ../album.php?albumID=$elemID");
        die();
    }
    
?>