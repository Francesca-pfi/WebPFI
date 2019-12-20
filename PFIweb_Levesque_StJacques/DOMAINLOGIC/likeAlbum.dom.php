<?php
    //appelé par functions.js lorsqu'un click sur le bouton approprié est détecté
    include "../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        echo false;
        die();
    }

    echo Album::like_album($_POST["id"],$_SESSION["userID"]);
?>