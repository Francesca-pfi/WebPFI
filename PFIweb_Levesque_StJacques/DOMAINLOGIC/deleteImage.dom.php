<?php
  //on arrive ici lorsqu'on click sur le bouton delete d'une image
  include_once "../CLASSES/IMAGE/image.php";
  include_once __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

  if(!validate_session()){
      header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
      die();
  }

  $imageID = $_POST["imageID"];
  $image = new Image();
  $image->load_image($imageID);
  $albumID = $image->get_albumID();

  if (!Image::delete_image($imageID)){
      header("Location: ../error.php?ErrorMSG=Could not delete image");
      die();
  }
  unlink("../" . $image->get_url());


  header("Location: ../album.php?albumID=$albumID");
  die();

?>