<?php
include_once __DIR__ . "/imageTDG.PHP";

class Image{
    private $id;
    private $albumid;
    private $url;
    private $nombreLike;
    private $date;

    public function __construct($idP,$albumidP,$urlP,$nombreLikeP,$dateP){
        Parent::__construct();
        $this->id = $idP;
        $this->albumid = $albumidP;
        $this->url = $urlP;
        $this->nombreLike = $nombreLikeP;
        $this->date = $dateP;
    }   

    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_albumid(){
        return $this->albumid;
    }

    public function get_url(){
        return $this->url;
    }

    public function get_nombreLike(){
        return $this->nombreLike;
    }

    public function get_date(){
        return $this->date;
    }

    //display
    public function display_image(){
        $style = "style='margin-bottom:30px;position:relative;right:10vw;border:0.5vh solid rgba(57,184,188,1)'";

        $album =  
        "<div class='card text-white bg-dark w-75'" . $style . " >
            <div class='card-header'>

            </div>
            <div class='card-body text-center'>
                <a class='btn btn-dark' href=\"./billboard.php?threadID=" . $id . "&title=" . $title . "\">" . $title . "</a>
            </div>
        </div>";

        return $album;
    }
?>