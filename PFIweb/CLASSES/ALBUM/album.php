<?php
include_once __DIR__ . "/albumTDG.PHP";

class Album{
    private $id;
    private $title;
    private $descr;
    private $userID;
    private $date;

    public function __construct($idP,$titleP,$descrP,$userIDP,$dateP){
        Parent::__construct();
        $this->id = $idP;
        $this->title = $titleP;
        $this->descr = $descr;
        $this->userID = $userIDP;
        $this->date = $dateP;
    }

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
    
    public function display_album(){
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