<?php
    //arrivé de billboardview lorsqu'on doit affiché les albums d'un utilisateur
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    $albums = Album::get_by_userID($_GET["userID"]);
    $albums = Album::create_album_list($albums);
?>

<h3 class="my-4 blanchedalmond" id="albums">Albums</h3>
<?php
    foreach($albums as $album){
        if(validate_session()){
            $album->display_album($_SESSION['userID']);
        }
        else{
            $album->display_album(0);
        }
    }
?>