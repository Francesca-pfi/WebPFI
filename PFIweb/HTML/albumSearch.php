<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../UTILS/sessionhandler.php";

    $TDG = AlbumTDG::get_instance();   
    $title = $_POST['search'];
    $albums = $TDG->search_title($title);

    if(count($albums) > 0){
        echo "<h3 class='my-4'>Albums</h3>";
    }
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