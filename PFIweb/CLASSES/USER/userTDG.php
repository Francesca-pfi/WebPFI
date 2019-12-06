<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class UserTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    //singleton
    private function __construct(){
        Parent::__construct();
        $this->tableName = "users";
    }

    public static function get_instance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new UserTDG();
          }
      
          return self::$_instance;
    }

    public function get_by_id($id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_by_email($email){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE email=:email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_by_username($username){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE username=:username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function search_name($name){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, email, username, profilePic FROM $tableName WHERE username like :name";
            $stmt = $conn->prepare($query);
            $param = "%" . $name . "%";
            $stmt->bindParam(':name', $param);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_all_users(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, email, username, profilePic FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function add_user($email, $username, $password, $pfp){
        $username = validator::sanitize($username);       
        $email = validator::sanitize($email);   

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (email, username, password, profilePic) VALUES (:email, :username, :password, :profilePic)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':profilePic', $pfp);
            $stmt->execute();
            $resp =  true;
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    /*
      update juste pour les infos non sensibles
    */
    public function update_info($email, $username, $id){
        $username = validator::sanitize($username);   
        $email = validator::sanitize($email);   

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET email=:email, username=:username WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    /*
      update juste pour le password
    */
    public function update_password($NHP, $id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET password=:password WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $NHP);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    public function update_pfp($file, $id) {
        $target_dir = "MEDIAS/PFPs/";

        $media_file_type = pathinfo($file['name'] ,PATHINFO_EXTENSION);
        //$media_file_ext = strtolower(end(explode('.',$_FILES['Media']['name'])));
  
        $img_extensions_arr = array("jpg","jpeg","png","gif");

        if(!in_array($media_file_type, $img_extensions_arr)){
            return false;
        }

        //creation d'un nom unique pour la "PATH" du fichier
        $path = tempnam("MEDIAS/PFPs", '');
        unlink($path);
        $file_name = basename($path, ".tmp");
    
        //creation de l'url pour la DB
        $url = $target_dir . $file_name . "." . $media_file_type;
    
        //deplacement du fichier uploader vers le bon repertoire (Medias)
        move_uploaded_file($file['tmp_name'], "../" . $url);

        //create entry in database
        //Media::create_entry($type, $url, $title);
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET profilePic=:pfp WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':pfp', $url);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;

            $_SESSION["userPFP"] = $url;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }

        $conn = null;
        return $resp;
    }

}
