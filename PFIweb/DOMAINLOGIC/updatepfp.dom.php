<?php
  include "../CLASSES/USER/user.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

  if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
  }

  if(isset($_FILES['Media'])){

    $TDG = new UserTDG();

    if (!$TDG->update_pfp($_FILES['Media'], $_SESSION["userID"])) {
        header("Location: ../error.php?ErrorMSG=Coudld not update file");
        die();
    }

}
else {
    header("Location: ../error.php?ErrorMSG=No file found");
   die();
}

header("Location: ../billboard.php");
  die();

?>