<?php
    //Antoine Lévesque et Francesca St-Jacques
    //lorsqu'il y a une erreur, on arrive ici
    session_start();

    $title="Error";
    $module="errorview.php";
    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>
