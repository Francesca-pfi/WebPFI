<?php   
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";   

    $TDG = ImageTDG::get_instance();   
    $descr = $_POST['search'];
    $images = $TDG->search_descr($descr);

    if(count($users) > 0){
        echo "<h3 class='my-4'>Images</h3>";
    }
    foreach($images as $image){
        $display = new Image();
        $display->load_image($image["id"]);

        $display->display_preview();
    }
?>