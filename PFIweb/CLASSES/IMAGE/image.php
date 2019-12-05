<?php
include_once __DIR__ . "/imageTDG.PHP";
include_once __DIR__ . "/../ALBUM/album.php";

class Image{
    private $id;
    private $albumID;
    private $url;
    private $descr;
    private $nombreVues;
    private $date;
/*
    public function __construct($idP,$albumID,$urlP,$nombreLikeP,$dateP){
        Parent::__construct();
        $this->id = $idP;
        $this->albumid = $albumidP;
        $this->url = $urlP;
        $this->nombreLike = $nombreLikeP;
        $this->date = $dateP;
    }  */ 

    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_albumID(){
        return $this->albumID;
    }

    public function get_url(){
        return $this->url;
    }

    public function get_descr() {
        return $this->descr;
    }

    public function get_nombreVues(){
        return $this->nombreVues;
    }

    public function get_date(){
        return $this->date;
    }

    public function get_authorID(){
        $album = new Album();
        $album->load_album($this->albumID);
        return $album->get_userID();
    }

    public function load_image($id){
        $TDG = ImageTDG::get_instance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->albumID = $res['albumID'];;
        $this->url = $res['url'];;
        $this->descr = $res['descr'];;
        $this->nombreVues = $res['nombreVues'];;
        $this->date = $res['date'];;

        $TDG = null;
        return true;
    }

    //display
    public function display_preview(){
        echo "<a href=image.php?imageID=$this->id><img alt='$this->descr' src='$this->url' height='100px' class='m-1'></a>";
    }
    public function display(){
        $style = "style='margin-bottom:30px;border:0.5vh solid rgba(57,184,188,1)'";
        $TDG = ImageTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id);
        $btnLike  = "Login to like images";
        $btnDelete = "";
        if (isset($_SESSION["userID"])) {
            if ($_SESSION["userID"] == $this->get_authorID())
                $btnDelete = "<form class='d-inline' action='DOMAINLOGIC/deleteImage.dom.php' method='post'>
                <input type='hidden' name='imageID' value='$this->id'>
                <input class='btn btn-danger m-1' type='submit' value='Delete'>
              </form>";
            if ($TDG->is_image_liked_by($this->id, $_SESSION["userID"])) {
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/unlikeImage.dom.php' method='post'>
                <input type='hidden' name='imageID' value='$this->id'>
                <input class='btn btn-danger m-1' type='submit' value='Unlike'>
                </form>";
            }
            else {
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/likeImage.dom.php' method='post'>
                <input type='hidden' name='imageID' value='$this->id'>
                <input class='btn btn-primary m-1' type='submit' value='Like'>
                </form>";
            }
        }
        echo "<div class='d-block card text-white bg-dark w-95'" . $style . " >";
        echo "<div class='card-header'>";
        echo "<img alt='$this->descr' src='$this->url'>";
        echo "</div><div class='card-body'>";
        echo "<p class='card-text'>$this->descr</p>";
        echo "<p class='card-text'><small class='text-muted'>Added on $this->date</small></p>";
        echo "</div><div class='card-footer'>";
        echo "<span class='badge badge-primary m-1'>$nbLikes likes</span>";
        echo "<span class='badge badge-secondary m-1'>$this->nombreVues views</span>";
        echo $btnLike;
        echo $btnDelete;
        echo "</div></div>";
    }

    public function display_comments() {
        include_once __DIR__ . "/../COMMENT/comment.php";
        $TDG = CommentTDG::get_instance();
        $posts = $TDG->get_by_elemID($this->id, 'image');
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