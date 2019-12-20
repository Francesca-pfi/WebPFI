<?php
    //appelé par functions.js lorsqu'un click sur le bouton approprié est détecté
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $comment = new Comment();
    $content = Validator::sanitize_textBox($_POST["content"]);

    if (!$comment->update_content($_POST["commentID"],$content)){
        header("Location: ../error.php?ErrorMSG=Could not update comment");
        die();
    }
    
    $elemID = $comment->get_elemID();
    if ($comment->get_typeElem() == 'image') {
        header("Location: ../image.php?imageID=$elemID");
        die();
    }
    else {
        header("Location: ../album.php?albumID=$elemID");
        die();
    }
    
?>