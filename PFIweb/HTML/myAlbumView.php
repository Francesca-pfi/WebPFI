<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    $TDG = AlbumTDG::get_instance();
    $albums = $TDG->get_by_userID($_GET["userID"]);
?>

<h3 class="my-4">Albums</h3>
<?php
    foreach($albums as $album){
        $display = new Album();
        $display->load_album($album['id']);

        if(validate_session()){
            $display->display_album($_SESSION['userID']);
        }
        else{
            $display->display_album(0);
        }
    }
?>