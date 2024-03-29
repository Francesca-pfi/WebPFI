<?php
    include "../CLASSES/USER/user.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";


    session_start();

    if(validate_session()){
        header("Location: ../error.php?ErrorMSG=already%20logged%20in!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $pw = $_POST["pw"];

    //Validation Posts
    $aUser = new User();

    //validateLogin
    if($aUser->Login($email, $pw))
    {
        login($aUser->get_id(), $aUser->get_email(), $aUser->get_username(), $aUser->get_pfp());
        header("Location: ../billboard.php");
        die();
    }

    header("Location: ../error.php?ErrorMSG=invalid email or password");
    die();
