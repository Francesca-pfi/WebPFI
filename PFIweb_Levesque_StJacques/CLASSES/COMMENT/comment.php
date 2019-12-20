<?php
include_once __DIR__ . "/commentTDG.PHP";
include_once __DIR__ . "/../LIKE/likeTDG.php";
include_once __DIR__ . "/../USER/user.PHP";
class Comment{
    private $id;
    private $authorID;
    private $elemID;
    private $typeElem;
    private $content;
    private $date;
    public function __construct(){
        //$this->id = $id;
        //$this->authorID = $authorID;
        //$this->threadID = $threadID;
        //$this->content = $content;
        //$this->TDG = new UserTDG;
    }
    //getters
    public function get_id(){
        return $this->id;
    }
    public function get_authorID(){
        return $this->authorID;
    }
    public function get_elemID(){
        return $this->elemID;
    }
    public function get_content(){
        return $this->content;
    }
    public function get_typeElem(){
        return $this->typeElem;
    }
    public function get_date(){
        return $this->date;
    }
    //setters
    public function set_authorID($authorID){
        $this->authorID = $authorID;
    }
    public function set_elemID($elemID){
        $this->elemID = $elemID;
    }
    public function set_content($content){
        $this->content = $content;
    }
    public function set_typeElem($typeElem){
        $this->typeElem = $typeElem;
    }
    public function set_date($date){
        $this->date = $date;
    }
    public function load_comment($id){
        $TDG = CommentTDG::get_instance();
        $res = $TDG->get_by_id($id);
        if(!$res)
        {
            return false;
        }
        $this->id = $res['id'];
        $this->authorID = $res['idUser'];
        $this->elemID = $res['elemID'];
        $this->typeElem = $res['typeElem'];
        $this->content = $res['content'];
        $this->date = $res['date'];
        
        return true;
    }
    public function display($noComment) {
        $author = new User();
        $author->load_user_id($this->authorID);
        $TDG = LikeTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id,"comment");
        $btnLike  = "Login to like comments";
        $btnsOwner = "";
        $editbox = "";
        $script = "";
        $content_edit = strip_tags($this->content);
        
        if (isset($_SESSION["userID"])) {
            if ($TDG->is_elem_liked_by($this->id, "comment", $_SESSION["userID"])) {
                $btnLike = 
                "<button id='btnUnlikecomment$this->id' class='btn btn-outline-light' onclick='unlike($this->id,\"comment\")'>Unlike</button>
                <button id='btnLikecomment$this->id' class='btn btn-outline-light d-none' onclick='like($this->id,\"comment\")'>Like</button>";
            }
            else {
                $btnLike = 
                "<button id='btnUnlikecomment$this->id' class='btn btn-outline-light d-none' onclick='unlike($this->id,\"comment\")'>Unlike</button>
                <button id='btnLikecomment$this->id' class='btn btn-outline-light' onclick='like($this->id,\"comment\")'>Like</button>";
            }
            if ( $_SESSION["userID"] == $this->authorID) {
                $btnsOwner = "<form class='d-inline' action='DOMAINLOGIC/deleteComment.dom.php' method='post'>
                    <input type='hidden' id='commentID' name='commentID' value='$this->id'>
                    <button class='btn btn-outline-danger'>Delete</button></form>
                    <button id='btnEdit' class='btn btn-outline-info' onclick='showEdit($this->id)'>Edit</button>";
                $editbox = "<div class='card-footer commentFooter d-none' id='editBox$this->id'>
                    <form action='DOMAINLOGIC/editComment.dom.php' method='post'>
                    <input type='hidden' id='commentID' name='commentID' value='$this->id'>
                    <textarea name='content' id='content' rows='7' required>$content_edit</textarea><br>
                    <button class='btn btn-outline-info' type='submit'>Save</button></form></div>";
            }
        }
        $id = $this->id;
        $pfp = $author->get_pfp();
        $authorID = $this->authorID;
        $username = $author->get_username();
        $date = $this->date;
        $content = $this->content;
        include __DIR__ . "/commenttemplate.php";
    }

    public function update_content($id, $content)
    {
        if (empty($content)) {
            return false;
        }
        if (!$this->load_comment($id)) {
            return false;
        }
        $TDG = CommentTDG::get_instance();
        $resp = $TDG->updateContent($content, $this->id);
        if ($resp) {
            $this->set_content($content);
        }
        $TDG = null;
        return $resp;
    }

    public function like_comment($id, $userID) {
        if (!$this->load_comment($id)) {
            return false;
        }
        if (empty($userID)) {
            
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->like_elem($id,"comment", $userID);
        $TDG = null;
        return $resp;
    }

    public function unlike_comment($id, $userID) {
        if (!$this->load_comment($id)) {
            return false;
        }
        if (empty($userID)) {           
            return false;
        }
        $TDG = LikeTDG::get_instance();
        $resp = $TDG->unlike_elem($id,"comment", $userID);
        $TDG = null;
        return $resp;
    }

    //STATIC FUNCTIONS
    public static function add_comment($authorID, $elemID, $typeElem, $content) {
        if (empty($authorID) || empty($elemID) || empty($typeElem) || empty($content)) {
            return false;
        }
        $TDG = CommentTDG::get_instance();
        $date = new DateTime("now", new DateTimeZone('America/New_York') );
        $resp = $TDG->add_comment($authorID, $elemID, $typeElem, $content, $date->format('Y-m-d H:i:s'));
        $TDG = null;
        return $resp;
    }

    public static function delete_comment($id){
        if (empty($id)) {
            return false;
        }
        $TDG = CommentTDG::get_instance();
        $resp = $TDG->delete_comment($id);
        if ($resp) {
            $TDG = LikeTDG::get_instance();
            $TDG->delete_likes_by_elemID($id,"comment");
        }
        $TDG = null;
        return $resp;
    }

    public static function delete_comment_by_elem($elemID, $typeElem){
        if (empty($elemID) || empty($typeElem)) {
            return false;
        }
        $TDG = CommentTDG::get_instance();
        $res = $TDG->get_by_elemID($elemID, $typeElem);
        if (!$res) {
            return false;
        }

        foreach ($res as $row) {
            Comment::delete_comment($row["id"]);
        }

        $TDG = null;
        return true;
    }
    
}
?>
