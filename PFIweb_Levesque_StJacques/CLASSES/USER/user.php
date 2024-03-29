<?php
include_once __DIR__ . "/userTDG.PHP";

class User{

    private $id;
    private $email;
    private $username;
    private $password;
    private $pfp;

    /*
        utile si on utilise un factory pattern
    */
    public function __construct(){
        //$this->id = $id;
        //$this->email = $email;
        //$this->username = $username;
        //$this->password = $password;
        //$this->TDG = new UserTDG;
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->password;
    }

    public function get_pfp(){
        return $this->pfp;
    }


    //setters
    public function set_email($email){
        $this->email = $email;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($password){
        $this->password = $password;
    }

    public function set_pfp($pfp){
        $this->pfp = $pfp;
    }

    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_user($email){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->pfp = $res['profilePic'];

        $TDG = null;
        return true;
    }
    
    public function load_user_id($id){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->pfp = $res['profilePic'];

        $TDG = null;
        return true;
    }

    public function display_user(){   
        $styleA = "style='text-decoration:none;color:white;font-size:1.3em;margin-left:2vw;'";

        echo "<div class='card user'>";   
        echo    "<div class='card-body'>";    
        echo        '<img  alt="" src="' . $this->pfp . '" height="80" width ="80">';
        echo        "<a href='./billboard.php?userID=" . $this->id . "' " . $styleA . ">" . $this->username . "</a>";
        echo    "</div>";               
        echo "</div>";       
    }

    //Login Validation
    public function Login($email, $pw){

        // Regarde si l'utilisateur existes deja
        if(!$this->load_user($email))
        {
            return false;
        }

        // Regarde si le password est verifiable
        if(!password_verify($pw, $this->password))
        {
            return false;
        }

        return true;
    }

    //Register Validation
    public function validate_email_not_exists($email){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function register($email, $username, $pw, $vpw, $pfp){

        //check is both password are equals
        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        //check if email is used
        if(!$this->validate_email_not_exists($email))
        {
            return false;
        }

        //add user to DB
        $TDG = UserTDG::get_instance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT), $pfp);
        $TDG = null;
        return true;
    }

    public function update_user_info($email, $newmail, $newname){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newmail) || empty($newname)){
          return false;
        }

        //check if email is already used
        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        $this->email = $newmail;
        $this->username = $newname;

        $TDG = UserTDG::get_instance();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userName"] = $this->username;
          $_SESSION["userEmail"] = $this->email;
        }

        $TDG = null;
        return $res;
    }

    /*
      @var: current $email, oldpw, new pw, newpw validation
    */
    public function update_user_pw($email, $oldpw, $pw, $pwv){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        //check if passed param are valids
        if(empty($pw) || $pw != $pwv){
          return false;
        }

        //verify password
        if(!password_verify($oldpw, $this->password))
        {
            return false;
        }

        //create TDG and update to new hash
        $TDG = UserTDG::get_instance();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->password = $NHP;
        $TDG = null;
        //only return true if update_user_pw returned true
        return $res;
    }

    public function update_user_pfp($email, $pfpUrl){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        //check if passed param are valids
        if(empty($pfpUrl)){
          return false;
        }

        $TDG = UserTDG::get_instance();
        $res = $TDG->update_pfp($pfpUrl, $this->id);
        if ($res) {
            $this->pfp = $pfpUrl;
        }
        $TDG = null;
        
        return $res;
    }

    public static function get_username_by_ID($id){
        $TDG = UserTDG::get_instance();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }

    public static function create_users_list($res){        
        $lst = array();
        foreach ($res as $row) {
            $img = new User();
            $img->load_user_id($row["id"]);
            array_push($lst,$img);
        }

        return $lst;
    }

    public static function search_name($name){
        $TDG = UserTDG::get_instance();
        $res = $TDG->search_name($name);
        $TDG = null;
        return $res;
    }
}
