<?php
    include "../CLASSES/COMMENT/comment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $commentID = $_POST["commentID"];
    $userID = $_SESSION["userID"];
    $comment = new Comment();

    if (!$comment->like_comment($commentID,$userID)){
        header("Location: ../error.php?ErrorMSG=Could not like comment");
        die();
    }
    
    $elemID = $comment->get_elemID();
    if ($comment->get_typeElem() == "image") {
        header("Location: ../image.php?imageID=$elemID");
        die();
    } else {
        header("Location: ../album.php?albumID=$elemID");
        die();
    }
?>