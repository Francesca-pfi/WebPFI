<?php
include_once __DIR__ . "/albumTDG.PHP";
include_once __DIR__ . "/../USER/user.php";

class Album{
    private $id;
    private $title;
    private $descr;
    private $userID;
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
        $this->date = $res['date'];

        $TDG = null;
        return true;
    }

    public function display_album($idUserDisplay){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_id($this->userID);
        $username = $res["username"];

        $style = "style='margin-bottom:30px;border:0.2vh solid rgba(57,184,188,1)'";
        $styleA = "style='text-decoration:none;color:white;font-size:1.3em'";
        $border = "style='border-top:0.2vh solid rgba(57,184,188,1);border-bottom:0.2vh solid rgba(57,184,188,1)'";

        echo "<div class='card text-white bg-dark'" . $style . " >";
        echo    "<div class='card-header'>";
        echo        "<a " . $styleA . "href=\"./album.php?albumID=" . $this->id . "&title=" . $this->title . "\">" . $this->title . "</a>";               
        echo    "</div>";        
        echo    "<div class='card-body' " . $border . ">";     
        echo        "<div>". $this->descr ."</div>";        
        echo    "</div>";
        echo    "<div class='card-footer text-left'>";
        echo        "<span style='margin-right:1vw;'>Author : " . $username . "</span>";
        if($this->userID = $idUserDisplay){
        echo        "<a href='./DOMAINLOGIC/deleteAlbum.dom.php?albumID=" . $this->id . "' class='btn btn-primary'>Delete</a>";
        }          
        echo    "</div>";        
        echo "</div>";

        
    }
}
?>