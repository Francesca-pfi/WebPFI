<?php
include_once __DIR__ . "/albumTDG.PHP";
include_once __DIR__ . "/../USER/user.php";
include_once __DIR__ . "/../IMAGE/image.php";
include_once __DIR__ . "/../COMMENT/comment.php";

class Album{
    private $id;
    private $title;
    private $descr;
    private $userID;
    private $nombreVues;
    private $date;

    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_descr(){
        return $this->descr;
    }

    public function get_userID(){
        return $this->userID;
    }

    public function get_date(){
        return $this->date;
    }
    
    public function load_album($albumID){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->get_by_albumID($albumID);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->title = $res['title'];
        $this->descr = $res['descr'];
        $this->userID = $res['userID'];
        $this->nombreVues = $res['nombreVues'];
        $this->date = $res['date'];

        $TDG = null;
        return true;
    }

    public function display_album(){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_id($this->userID);
        $username = $res["username"];

        $TDG = AlbumTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id);

        $btnLike  = "";
        $btnDelete = "";

        $style = "style='margin-bottom:30px;border:0.2vh solid rgba(57,184,188,1)'";
        $styleA = "style='text-decoration:none;color:white;font-size:1.3em'";
        $border = "style='border-top:0.2vh solid rgba(57,184,188,1);border-bottom:0.2vh solid rgba(57,184,188,1)'";

        if (validate_session()) {
            if ($_SESSION["userID"] == $this->userID)
                $btnDelete = "<form class='d-inline' action='DOMAINLOGIC/deleteAlbum.dom.php' method='post'>
                <input type='hidden' name='albumID' value='$this->id'>
                <input class='btn btn-danger m-1' type='submit' value='Delete'>
                </form>";
            if ($TDG->is_album_liked_by($this->id, $_SESSION["userID"])){
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/unlikeAlbum.dom.php' method='post'>
                <input type='hidden' name='albumID' value='$this->id'>
                <input class='btn btn-danger m-1' type='submit' value='Unlike'>
                </form>";
            }
            else {
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/likeAlbum.dom.php' method='post'>
                <input type='hidden' name='albumID' value='$this->id'>
                <input class='btn btn-primary m-1' type='submit' value='Like'>
                </form>";
            }
        }

        echo "<div class='card text-white bg-dark'" . $style . " >";
        echo    "<div class='card-header'>";
        echo        "<a " . $styleA . "href=\"./album.php?albumID=" . $this->id . "&title=" . $this->title . "\">" . $this->title . "</a>";               
        echo    "</div>";        
        echo    "<div class='card-body' " . $border . ">";     
        echo        "<div>". $this->descr ."</div>";        
        echo    "</div>";
        echo    "<div class='card-footer text-left'>";
        echo        "<span style='margin-right:1vw;'>Author : " . $username . "</span>";
        echo        "<span class='badge badge-primary m-1'>$nbLikes likes</span>";
        echo        "<span class='badge badge-secondary m-1'>$this->nombreVues views</span>";              
        echo        $btnLike;
        echo        $btnDelete;
        echo    "</div>";        
        echo "</div>";

        
    }

    public function display_images_preview() {       
        $TDG = ImageTDG::get_instance();
        $images = $TDG->get_by_albumID($this->id);
        foreach($images as $image){
            $display = new Image();
            $display->load_image($image['id']);
            $display->display_preview();
        }
    }
    public function display_comments() {
        
        $TDG = CommentTDG::get_instance();
        $posts = $TDG->get_by_elemID($this->id, 'album');
        $res = false;
  
        foreach($posts as $post) {
            $res = true;
            $comment = new Comment();
            $comment->load_comment($post['id']);
            $comment->display();
        }
  
        if (!$res){
        echo "<div><p>No comments yet.</p></div>";
        }
    }
}
?>