<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
    $TDG = AlbumTDG::get_instance();
    $albums = $TDG->get_all_albums();
?>

<h3 class="my-4">Albums</h3>
<?php
    foreach($albums as $album){
        $display = new Album();
        $display->load_album($album['id']);

        $display->display_album();        
    }
?>