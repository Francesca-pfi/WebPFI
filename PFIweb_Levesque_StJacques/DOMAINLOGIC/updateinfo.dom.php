<?php
  //pour mettre à jour les infos non sensible, arrivé de myprofileview.php
  include "../CLASSES/USER/user.php";
  include "../UTILS/formvalidator.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";
  include_once __DIR__ . "/../UTILS/formvalidator.php";

  session_start();

  if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
  }

  $email = $_POST["email"];
  $username = Validator::sanitize($_POST["username"]);

  //verification des parametres
  if(empty($email) && empty($username)){
    header("Location: ../error.php?ErrorMSG=invalid email or username");
    die();
  }

  //si une des cases est vide, on prend la valeur de la session
  if(!empty($email) && Validator::validate_email($email)){
    $newmail = $email;
  }
  else{
    $newmail = $_SESSION["userEmail"];
  }

  if(!empty($username)){
    $newname = $username;
  }
  else{
    $newname = $_SESSION["userName"];
  }

  $user = new User();
  //mise à jour des valeurs
  if(!$user->update_user_info($_SESSION["userEmail"], $newmail, $newname)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
  }

  header("Location: ../myProfile.php");
  die();
?>
