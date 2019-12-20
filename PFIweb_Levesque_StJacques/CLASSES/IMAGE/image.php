<?php
include_once __DIR__ . "/imageTDG.PHP";
include_once __DIR__ . "/../ALBUM/album.php";
include_once __DIR__ . "/../COMMENT/comment.php";

class Image{
    private $id;
    private $albumID;
    private $url;
    private $descr;
    private $nombreVues;
    private $type;
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

    public function get_type(){
        return $this->type;
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
        $this->albumID = $res['albumID'];
        $this->url = $res['url'];
        $this->descr = $res['descr'];
        $this->nombreVues = $res['nombreVues'];
        $this->type = $res['type'];
        $this->date = $res['date'];;

        $TDG = null;
        return true;
    }

    //display
    public function display_preview(){
        if ($this->type == "image") {
            echo "<a href=image.php?imageID=$this->id><img alt='$this->descr' src='$this->url' class='m-1 preview'></a>";
            } else if ($this->type == "video") {
                 echo "<a href=image.php?imageID=$this->id><video height='150' class='m-1 align-middle' autoplay loop>
                        <source src='$this->url'>
                        ?
                        </video></a>";
            }
    }
    
    public function display(){
        $style = "style='margin-bottom:30px;border:0.5vh solid rgba(57,184,188,1)'";
        $TDG = LikeTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id,"image");
        $btnLike  = "Login to like images";
        $btnDelete = "";
        if (isset($_SESSION["userID"])) {
            if ($_SESSION["userID"] == $this->get_authorID())
                $btnDelete = "<form class='d-inline' action='DOMAINLOGIC/deleteImage.dom.php' method='post'>
                <input type='hidden' name='imageID' value='$this->id'>
                <input class='btn btn-outline-danger m-1' type='submit' value='Delete'>
                </form>";
            if ($TDG->is_elem_liked_by($this->id, "image", $_SESSION["userID"])) {
                $btnLike = 
                "<button id='btnUnlikeimage$this->id' class='btn btn-outline-light' onclick='unlike($this->id,\"image\")'>Unlike</button>
                <button id='btnLikeimage$this->id' class='btn btn-outline-light d-none' onclick='like($this->id,\"image\")'>Like</button>";
            }
            else {
                $btnLike = 
                "<button id='btnUnlikeimage$this->id' class='btn btn-outline-light d-none' onclick='unlike($this->id,\"image\")'>Unlike</button>
                <button id='btnLikeimage$this->id' class='btn btn-outline-light' onclick='like($this->id,\"image\")'>Like</button>";
            }
        }
        $type = $this->type;
        $id = $this->id;
        $descr = $this->descr;
        $date = $this->date;
        $url = $this->url;
        $nbVues = $this->nombreVues;
        include __DIR__ . "/imagetemplate.php";
    }
    
    public function display_comments() {
        $compteur = 1;
        $TDG = CommentTDG::get_instance();
        $posts = $TDG->get_by_elemID($this->id, 'image');
        $res = false;
  
        foreach ($posts as $post) {
            $res = true;
            $comment = new Comment();
            $comment->load_comment($post['id']);
            $comment->display($compteur);
            $compteur += 1;
        }
    }

    public function add_view($id) {
        if (!$this->load_image($id)) {
            return false;
        }
        $TDG = ImageTDG::get_instance();
        $resp = $TDG->add_view($id);
        $TDG = null;
        return $resp;
    }

    public function like_image($id, $userID) {
        if (!$this->load_image($id)) {
            return false;
        }
        if (empty($userID)) {
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->like_elem($id,"image", $userID);
        $TDG = null;
        return $resp;
    }

    public function unlike_image($id, $userID) {
        if (!$this->load_image($id)) {
            return false;
        }
        if (empty($userID)) {
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->unlike_elem($id,"image", $userID);
        $TDG = null;
        return $resp;
    }

    //STATIC FUNCTIONS

    public static function add_image($albumID, $url, $descr, $type) {
        if (empty($albumID) || empty($url) || empty($type)) {
            return false;
        }
        $date = new DateTime("now", new DateTimeZone('America/New_York') );
        $TDG = ImageTDG::get_instance();
        $resp = $TDG->add_image($albumID, $url, $descr, $type, $date->format('Y-m-d H:i:s'));
        $TDG = null;
        return $resp;
    }

    public static function delete_image($id){
        if (empty($id)) {
            return false;
        }
        $TDG = ImageTDG::get_instance();
        $resp = $TDG->delete_image($id);
        if ($resp) {
            $TDG = LikeTDG::get_instance();
            $TDG->delete_likes_by_elemID($id,"image");
            Comment::delete_comment_by_elem($id, "image");
        }
        $TDG = null;
        return $resp;
    }

    public static function delete_image_by_albumID($albumID){
        if (empty($albumID)) {
            return false;
        }
        $res = Image::get_by_albumID($albumID);
        if (!$res) {
            return false;
        }

        foreach ($res as $row) {
            Image::delete_image($row["id"]);
        }

        $TDG = null;
        return true;
    }
    
    public static function get_by_albumID($albumID){
        $TDG = ImageTDG::get_instance();
        return $TDG->get_by_albumID($albumID);
    }
    
    public static function create_list_by_albumID($albumID){
        $res = Image::get_by_albumID($albumID);
        $lst = array();
        foreach ($res as $row) {
            $img = new Image();
            $img->load_image($res["id"]);
            array_push($lst,$img);
        }
    }

    public static function create_image_list($res){        
        $lst = array();
        foreach ($res as $row) {
            $img = new Image();
            $img->load_image($row["id"]);
            array_push($lst,$img);
        }

        return $lst;
    }

    public static function search_descr($descr){
        $TDG = ImageTDG::get_instance();
        $res = $TDG->search_descr($descr);
        $TDG = null;
        return $res;
    }
}
?>
