<div class="row justify-content-md-center">
    <div class="col-sm-8 mb-4">
        <?php 
            include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
            include_once __DIR__ . "/../UTILS/sessionhandler.php";
            include_once __DIR__ . "/../CLASSES/IMAGE/image.php"; 
            include_once __DIR__ . "/../CLASSES/USER/user.php";  
        
            //display les albums qui continnent le terme recherché
            $albums = Album::search_title($_POST['search']);
            $albums = Album::create_album_list($albums);       
            if(count($albums) > 0){
                echo "<h3 class='my-4 blanchedalmond' id='albums'>Albums</h3>";
            }
            foreach($albums as $album){
                if(validate_session()){
                    $album->display_album($_SESSION['userID']);
                }
                else{
                    $album->display_album(0);
                }
            }

            //display les users qui continnent le terme recherché
            $users = User::search_name($_POST['search']);
            $users = User::create_users_list($users);        
            if(count($users) > 0){
                echo "<h3 class='my-4 blanchedalmond'>Users</h3>";
            }
            foreach($users as $user){
                $user->display_user();
            }

            //display les images qui continnent le terme recherché
            $images = Image::search_descr($_POST['search']);
            $images = Image::create_image_list($images);
            if(count($images) > 0){
                echo "<h3 class='my-4 blanchedalmond'>Images</h3>";
            }
            foreach($images as $image){       
                $image->display_preview();
            }
        ?>
    </div>
</div>