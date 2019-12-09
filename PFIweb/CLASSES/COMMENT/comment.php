<?php
include_once __DIR__ . "/commentTDG.PHP";
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
    public function display() {
        $author = new User();
        $author->load_user_id($this->authorID);
        $TDG = CommentTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id);
        $btnLike  = "Login to like comments";
        $btnDelete = "";
        $editbox = "<div class='card-footer'>
            <input type='hidden' id='elemID' name='elemID' value='" . $_GET["albumID"] . "'>
            <input type='hidden' id='typeElem' name='typeElem' value='album'>
            <textarea class='form-control' name='content' id='content' rows='7' placeholder='What do you think about this album?' required></textarea><br>
            <button class='btn btn-success' type='submit'>Save</button></div>";
        if (isset($_SESSION["userID"])) {
            if ($TDG->is_comment_liked_by($this->id, $_SESSION["userID"])) {
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/unlikeComment.dom.php' method='post'>
                <input type='hidden'  id='commentID' name='commentID' value='$this->id'>
                <input class='btn btn-danger m-1' type='submit' value='Unlike'></form>";
            }
            else {
                $btnLike = "<form class='d-inline' action='DOMAINLOGIC/likeComment.dom.php' method='post'>
                <input type='hidden' id='commentID' name='commentID' value='$this->id'>
                <input class='btn btn-primary m-1' type='submit' value='Like'></form>";
            }
            if ( $_SESSION["userID"] == $this->authorID) {
                $btnDelete = "<form class='d-inline' action='DOMAINLOGIC/deleteComment.dom.php' method='post'>
                <input type='hidden' id='commentID' name='commentID' value='$this->id'>
                <button class='btn btn-danger'>Delete</a></form>";
            }
        }
        echo "<div class='card' style='text-align:left;margin-top:30px;'>";
        echo "<div class='card-header'>";
        echo    "<img alt='pfp' src='" . $author->get_pfp() . "' height='50px' width='50px'>";
        echo    "<span style='margin:0 1vw'>" . $author->get_username() . "</span>";
        echo    "<small class='text-muted'>" . $this->date . "</small></div>";
        echo "<div class = 'card-body'>";
        echo "<p class='card-text'>". $this->content . "</p></div>";
        echo "<div class='card-footer'>";
        echo "<span class='badge badge-primary m-1'>$nbLikes likes</span>";
        echo $btnLike;
        echo $btnDelete;
        echo "</div></div>";
    }
}
?>
