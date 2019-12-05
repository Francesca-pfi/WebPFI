<?php
    include "../CLASSES/IMAGE/image.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    $imageID = $_POST["imageID"];

    $TDG = ImageTDG::get_instance();

    $TDG->add_view($imageID);

    header("Location: ../login.php");
    die();
?>