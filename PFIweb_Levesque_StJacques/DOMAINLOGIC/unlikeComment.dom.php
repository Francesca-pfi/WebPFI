<?php
    //appelé par functions.js lorsqu'un click sur le bouton approprié est détecté
    include "../CLASSES/COMMENT/comment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $commentID = $_POST["id"];
    $userID = $_SESSION["userID"];
    $comment = new Comment();
    
    echo $comment->unlike_comment($commentID,$userID);
    
?>