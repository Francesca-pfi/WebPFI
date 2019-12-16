<?php
    include "../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        echo false;
        die();
    }

    echo Album::like_album($_POST["id"],$_SESSION["userID"]);
?>