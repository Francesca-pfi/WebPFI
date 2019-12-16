<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        echo false;
        die();
    }

    $imageID = $_POST["id"];
    $userID = $_SESSION["userID"];

    $image = new Image();

    echo $image->like_image($imageID,$userID);

?>