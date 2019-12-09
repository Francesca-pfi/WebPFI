<?php
  include_once "../CLASSES/IMAGE/image.php";
  include_once "../CLASSES/COMMENT/comment.php";
  include __DIR__ . "/../CLASSES/LIKE/likeTDG.php"; 
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

$TDG = CommentTDG::get_instance();
$TDG->delete_comment_by_elemID($imageID, "image");

$TDG = LikeTDG::get_instance();
$TDG->delete_likes_by_elemID($imageID, "image");

header("Location: ../album.php?albumID=$albumID");
  die();

?>