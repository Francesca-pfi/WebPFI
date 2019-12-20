<?php
    //Antoine Lévesque et Francesca St-Jacques
    //Point d'entré pour la page billboard
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "billboard";

    if(validate_session()){
        $name = $_SESSION["userName"];
    }
    else{
        $name="Anon";
    }
    $content = array();

    //si on arrive par la barre de recherche
    if(isset($_POST["search"])){
        $module = "searchView.php";
        array_push($content, $module);
    }
    //si on arrive avec le billboard par défaut
    else{
        $module = "billboardview.php";
        array_push($content, $module);
    }
    require_once __DIR__ . "/HTML/masterpage.php";

?>
