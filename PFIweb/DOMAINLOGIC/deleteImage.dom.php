<?php
  include_once "../CLASSES/IMAGE/image.php";
  include_once "../CLASSES/ALBUM/album.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
}

$imageID = $_POST["imageID"];
$image = new Image();
$image->load_image($imageID);
$albumID = $image->get_albumID();

$TDG = ImageTDG::get_instance();

if (!$TDG->delete_image($imageID)){
    header("Location: ../error.php?ErrorMSG=Could not like image");
    die();
}
unlink("../" . $image->get_url());

$album = new Album();
$album->load_album($albumID);
$albumTitle= $album->get_title();
header("Location: ../album.php?albumID=$albumID&title=$albumTitle");
  die();

?>