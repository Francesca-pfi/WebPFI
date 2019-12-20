<?php
    //Antoine Lévesque et Francesca St-Jacques
    //Point d'entré pour la page My Profile
    session_start();
    include "UTILS/sessionhandler.php";

    if(!validate_session())
    {
        header("Location: error.php?ErrorMSG=Not%20Logged%20in!");
        die();
    }

    $title = "Profile";
    $module = "myprofileview.php";
    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";
?>