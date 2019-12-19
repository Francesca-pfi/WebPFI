<?php
include_once __DIR__ . "/albumTDG.PHP";
include_once __DIR__ . "/../USER/user.php";
include_once __DIR__ . "/../IMAGE/image.php";
include_once __DIR__ . "/../COMMENT/comment.php";
include_once __DIR__ . "/../LIKE/likeTDG.php";

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

    public function get_nombreVues(){
        return $this->nombreVues;
    }

    public function get_date(){
        return $this->date;
    }

    //setters
    public function set_id($id){
        $this->id = $id;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_descr($descr){
        $this->descr = $descr;
    }

    public function set_userID($userID){
        $this->userID = $userID;
    }

    public function set_nombreVues($nombreVues){
        $this->nombreVues = $nombreVues;
    }

    public function set_date($date){
        $this->date = $date;
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
        $author = new User();
        $author->load_user_id($this->userID);   
        $username = $author->get_username();
        $pfp = $author->get_pfp();;

        $TDG = AlbumTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id);

        $btnLike  = "";
        $btnDelete = "";       

        if (validate_session()) {
            if ($_SESSION["userID"] == $this->userID)
                $btnDelete = "<form class='d-inline' action='DOMAINLOGIC/deleteAlbum.dom.php' method='post'>
                <input type='hidden' name='albumID' value='$this->id'>
                <input class='btn btn-outline-danger m-1' type='submit' value='Delete'>
                </form>";
            if ($TDG->is_album_liked_by($this->id, $_SESSION["userID"])){
                $btnLike = 
                "<button id='btnUnlikealbum$this->id' class='btn btn-outline-light' onclick='unlike($this->id,\"album\")'>Unlike</button>
                <button id='btnLikealbum$this->id' class='btn btn-outline-light d-none' onclick='like($this->id,\"album\")'>Like</button>";
            }
            else {
                $btnLike = 
                "<button id='btnUnlikealbum$this->id' class='btn btn-outline-light d-none' onclick='unlike($this->id,\"album\")'>Unlike</button>
                <button id='btnLikealbum$this->id' class='btn btn-outline-light' onclick='like($this->id,\"album\")'>Like</button>";
            }
        }

        include __DIR__ . "/albumTemplate.php";
    }

    public function display_images_preview() {       
        $TDG = AlbumTDG::get_instance();
        $TDG->add_view($this->id);

        $TDG = ImageTDG::get_instance();
        $images = $TDG->get_by_albumID($this->id);
        foreach($images as $image){
            $display = new Image();
            $display->load_image($image['id']);
            $display->display_preview();
        }
    }
    public function display_comments() {
        $compteur = 1;
        $TDG = CommentTDG::get_instance();
        $posts = $TDG->get_by_elemID($this->id, 'album');
        $res = false;
  
        for ($i = count($posts) - 1; $i >= 0; $i--) {
            $res = true;
            $comment = new Comment();
            $comment->load_comment($posts[$i]['id']);
            $comment->display($compteur);
            $compteur += 1;
        }
        
    }

    //STATIC FUNCTIONS

    public static function list_all_albums(){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->get_all_albums();
        $TDG = null;
        
        return $res;
    }

    public static function create_album_list($TDG_res){
        $albums_list = array();
        foreach($TDG_res as $r){
            $album = new Album();

            $album->set_id($r["id"]);
            $album->set_title($r["title"]);
            $album->set_descr($r["descr"]);
            $album->set_userID($r["userID"]);
            $album->set_nombreVues($r["nombreVues"]);
            $album->set_date($r["date"]);

            array_push($albums_list, $album);
        }
        return $albums_list;
    }

    public static function delete_album($id){
        if (empty($id)){
            return false;
        }
        $TDG = AlbumTDG::get_instance();
        $resp = $TDG->delete_album($id);
        if ($resp) {
            $TDG = LikeTDG::get_instance();
            $TDG->delete_likes_by_elemID($id,"album");
            Image::delete_image_by_albumID($id);
            Comment::delete_comment_by_elem($id,"album");
        }
        $TDG = null;
        return $resp;
    }

    public static function like_album($albumID,$userID){
        if (empty($albumID) || empty($userID)){
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->like_elem($albumID,"album",$userID);
        $TDG = null;
        return $resp;
    }

    public static function add_album($title,$descr,$userID){
        if (empty($title) || empty($userID)){
            return false;
        }
        $TDG = AlbumTDG::get_instance();
        $resp = $TDG->add_album($title,$descr,$userID,date("Y/m/d"));
        $TDG = null;
        return $resp;
    }

    public static function unlike_album($albumID,$userID){
        if (empty($albumID) || empty($userID)){
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->unlike_elem($albumID,"album",$userID);
        $TDG = null;
        return $resp;
    }

    public static function search_title($title){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->search_title($title);
        $TDG = null;
        return $res;
    }

    public static function get_by_userID($userID){
        $TDG = AlbumTDG::get_instance();
        $albums = $TDG->get_by_userID($userID);
        $TDG = null;
        return $albums;
    }
}
?>