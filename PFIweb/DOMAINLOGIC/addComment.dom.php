<?php
    include "../CLASSES/COMMENT/comment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";
    include __DIR__ . "/../UTILS/formvalidator.php";

    session_start();
    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $elemID = $_POST["elemID"];
    $typeElem = $_POST["typeElem"];
    $content = Validator::sanitize($_POST["content"]);
    $userID = $_SESSION["userID"];
    
    if (!Comment::add_comment($userID, $elemID, $typeElem, $content)){
        header("Location: ../error.php?ErrorMSG=Could not add comment");
        die();
    }
    if ($typeElem == 'image') {
        header("Location: ../image.php?imageID=" . $elemID);
        die();
    }
    else {
        header("Location: ../album.php?albumID=" . $elemID);
        die();
    }
?>