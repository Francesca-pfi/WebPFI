<?php
include_once __DIR__ . "/imageTDG.PHP";

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
        echo "<a href=image.php?imageID=$this->id><img alt=$this->descr src=$this->url height='60px'></a>";
    }
    public function display(){
        $style = "style='margin-bottom:30px;position:relative;right:10vw;border:0.5vh solid rgba(57,184,188,1)'";
        $TDG = ImageTDG::get_instance();
        $nbLikes = $TDG->get_number_of_likes($this->id);
        $btnLike  = "Login to like images";
        if (isset($_SESSION["userID"])) {
            if ($TDG->is_image_liked_by($this->id, $_SESSION["userID"])) {
                $btnLike = "<a href='./DOMAINLOGIC/unlikeImage.dom.php?albumID=" . $this->id . "' class='btn btn-danger'>Unlike</a>";
            }
            else {
                $btnLike = "<a href='./DOMAINLOGIC/likeImage.dom.php?albumID=" . $this->id . "' class='btn btn-primary'>Like</a>";;
            }
        }
        echo "<div class='card text-white bg-dark w-75'" . $style . " >";
        echo "<div class='card-header'>";
        echo "<img alt=$this->descr src=$this->url>";
        echo "</div><div class='card-body'>";
        echo "<p class='card-text'>$this->descr</p>";
        echo "<p class='card-text'><small class='text-muted'>Added on $this->date</small></p>";
        echo "</div><div class='card-footer'>";
        echo "<span class='badge badge-primary'>$nbLikes likes</span>";
        echo "<span class='badge badge-secondary'>$this->nombreVues views</span>";
        echo $btnLike;
        echo "</div></div>";
    }
}
?>