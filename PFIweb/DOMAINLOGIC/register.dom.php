<?php
    include "../CLASSES/USER/user.php";
    include "../UTILS/formvalidator.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";
    include_once __DIR__ . "/../UTILS/formvalidator.php";

    session_start();

    if(validate_session()){
        header("Location: ../error.php?ErrorMSG=Already%20logged!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $username = Validator::sanitize($_POST["username"]);
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];

    //Validation Posts
    if(!Validator::validate_email($email) || !Validator::validate_password($pw))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    $aUser = new User();

    //validateLogin
    if(!$aUser->register($email, $username, $pw, $pwv, "MEDIAS/PFPs/default.jpg"))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    header("Location: ../login.php");
    die();
?>
