<?php
    //Antoine Lévesque et Francesca St-Jacques
    //Point d'entré pour la page de login
    session_start();
    include "UTILS/sessionhandler.php";

    if(validate_session())
    {   
        header("Location: error.php?ErrorMSG=Already%20Logged!");
        die();
    }

    //load view content
    $module = "loginview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Login";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>
