<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not logged in");
        die();
    }

    $imageID = $_GET["imageID"];
    $userID = $_SESSION["userID"];

    $TDG = ImageTDG::get_instance();

    $TDG->like_image($imageID,$userID);

    header("Location: ../image.php?imageID=" . $imageID);
    die();
?>