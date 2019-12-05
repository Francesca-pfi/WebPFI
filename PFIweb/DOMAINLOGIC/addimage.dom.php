<?php
  include_once "../CLASSES/IMAGE/image.php";
  include_once "../CLASSES/ALBUM/album.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
}

if(isset($_FILES["file"]) && isset($_POST["albumID"]) && isset($_POST["descr"])){
    $file = $_FILES["file"];
    $TDG = ImageTDG::get_instance();

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

    if (!$TDG->add_image($_POST["albumID"], $url, $_POST["descr"])) {
        header("Location: ../error.php?ErrorMSG=Coudld not upload file");
        die();
    }

}
else {
    header("Location: ../error.php?ErrorMSG=Missing inputs");
   die();
}
$album = new Album();
$album->load_album($_POST['albumID']);
$albumID = $album->get_id();
$albumTitle= $album->get_title();
header("Location: ../album.php?albumID=$albumID&title=$albumTitle");
  die();

?>