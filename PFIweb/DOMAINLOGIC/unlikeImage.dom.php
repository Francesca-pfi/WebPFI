<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $imageID = $_POST["imageID"];
    $userID = $_SESSION["userID"];

    $image = new Image();

    if (!$image->unlike_image($imageID,$userID)){
        header("Location: ../error.php?ErrorMSG=Could not unlike image");
        die();
    }

    header("Location: ../image.php?imageID=" . $imageID);
    die();
?>