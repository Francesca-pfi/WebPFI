<?php
  include "../CLASSES/USER/user.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

  if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
  }

  if(isset($_FILES['Media'])){
      $file = $_FILES['Media'];
      $target_dir = "MEDIAS/PFPs/";

      $media_file_type = pathinfo($file['name'] ,PATHINFO_EXTENSION);
        //$media_file_ext = strtolower(end(explode('.',$_FILES['Media']['name'])));
  
      $img_extensions_arr = array("jpg","jpeg","png","gif");

      if(!in_array($media_file_type, $img_extensions_arr)){
        header("Location: ../error.php?ErrorMSG=Invalide file type");
        die();
      }

        //creation d'un nom unique pour la "PATH" du fichier
      $path = tempnam("MEDIAS/PFPs", '');
      unlink($path);
      $file_name = basename($path, ".tmp");
    
        //creation de l'url pour la DB
      $url = $target_dir . $file_name . "." . $media_file_type;
    
        //deplacement du fichier uploader vers le bon repertoire (Medias)
      move_uploaded_file($file['tmp_name'], "../" . $url);
      $user = new User();
      $user->load_user($_SESSION["userEmail"]);
      $oldPFP = $user->get_pfp();
      if (!$user->update_user_pfp($_SESSION["userEmail"], $url)) {
          header("Location: ../error.php?ErrorMSG=Could not update file");
          die();
      }
      if ($oldPFP != "MEDIAS/PFPs/default.jpg") {
        unlink("../" . $oldPFP);
      }
      $_SESSION["userPFP"] = $url;

}
else {
    header("Location: ../error.php?ErrorMSG=Missing file");
   die();
}

header("Location: ../myProfile.php");
  die();

?>