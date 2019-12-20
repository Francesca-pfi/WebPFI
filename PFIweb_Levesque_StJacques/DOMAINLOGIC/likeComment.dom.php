<?php
    //appelé par functions.js lorsqu'un click sur le bouton approprié est détecté
    include "../CLASSES/COMMENT/comment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        echo false;
        die();
    }

    $commentID = $_POST["id"];
    $userID = $_SESSION["userID"];
    $comment = new Comment();

    echo $comment->like_comment($commentID,$userID)
?>