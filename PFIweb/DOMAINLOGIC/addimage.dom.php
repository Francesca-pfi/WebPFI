<?php
  include_once "../CLASSES/IMAGE/image.php";
  include_once "../CLASSES/ALBUM/album.php";
  include_once __DIR__ . "/../UTILS/sessionhandler.php";
  include_once __DIR__ . "/../UTILS/formvalidator.php";

  session_start();

if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
}

if(!empty($_FILES["file"]) && !empty($_POST["albumID"]) && isset($_POST["descr"])){
    $file = $_FILES["file"];

    $target_dir = "MEDIAS/album_medias/";
    $media_file_type = pathinfo($file['name'] ,PATHINFO_EXTENSION);
    $img_extensions_arr = array("jpg","jpeg","png","gif");

    if(!in_array($media_file_type, $img_extensions_arr)){
        header("Location: ../error.php?ErrorMSG=Invalid file type");
        die();
    }

    $path = tempnam("MEDIAS/album_medias", '');
    unlink($path);
    $file_name = basename($path, ".tmp");
    $url = $target_dir . $file_name . "." . $media_file_type;
    move_uploaded_file($file['tmp_name'], "../" . $url);

    $descr = Validator::sanitize($_POST["descr"]);

    if (!Image::add_image($_POST["albumID"], $url, $descr)) {
        header("Location: ../error.php?ErrorMSG=Coudld not upload file");
        die();
    }
}
else {
    header("Location: ../error.php?ErrorMSG=Missing inputs");
   die();
}

$albumID = $_POST['albumID'];
header("Location: ../album.php?albumID=$albumID");
die();

?>